<?php

namespace VK\Client;

use Exception;
use JsonException;
use VK\Client\Enums\VKApiTokenTypes;
use VK\Exceptions\Api\ExceptionMapper;
use VK\Exceptions\Api\VKApiCaptchaException;
use VK\Exceptions\VKApiException;
use VK\Exceptions\VKClientException;
use VK\TransportClient\Curl\CurlHttpClient;
use VK\TransportClient\TransportClientResponse;
use VK\TransportClient\TransportRequestException;

class VKApiRequest
{
	private const PARAM_VERSION = 'v';
	private const PARAM_ACCESS_TOKEN = 'access_token';
	private const PARAM_LANG = 'lang';
	
	private const KEY_ERROR = 'error';
	private const KEY_RESPONSE = 'response';
	
	protected const CONNECTION_TIMEOUT = 10;
	protected const HTTP_STATUS_CODE_OK = 200;
	
	private string $host;
	private CurlHttpClient $http_client;
	private string $version;
	private ?string $language;
	
	public function __construct(string $api_version, ?string $language, string $host)
	{
		$this->http_client = new CurlHttpClient(static::CONNECTION_TIMEOUT);
		$this->version = $api_version;
		$this->host = $host;
		$this->language = $language;
	}
	
	/**
	 * Makes post request.
	 *
	 * @param string $method
	 * @param string $access_token
	 * @param array $params
	 * @param int $apiTokenType
	 *
	 * @return mixed
	 * @throws VKApiException
	 * @throws VKClientException
	 */
	public function post(string $method, string $access_token, array $params = [], int $apiTokenType = VKApiTokenTypes::USER): mixed
	{
		$params = $this->formatParams($params);
		$params[static::PARAM_ACCESS_TOKEN] = $access_token;
		
		if (!isset($params[static::PARAM_VERSION]))
		{
			$params[static::PARAM_VERSION] = $this->version;
		}
		
		if ($this->language && !isset($params[static::PARAM_LANG]))
		{
			$params[static::PARAM_LANG] = $this->language;
		}
		
		$url = $this->host . '/' . $method;
		
		try
		{
			$response = $this->getHttpResponse($url, $params, $apiTokenType);
		}
		catch (TransportRequestException $e)
		{
			throw new VKClientException($e);
		}
		
		$parsedResponse = $this->parseResponse($response);
		
		if (function_exists('logit'))
		{
			logit(
				message: 'VK request performed',
				payload: compact('method', 'params', 'access_token', 'apiTokenType', 'parsedResponse'),
				fileOnly: true,
				channel: 'requests'
			)->debug();
		}
		
		if ($parsedResponse instanceof VKApiError)
		{
			if (function_exists('recognizeCaptcha'))
			{
				$captchaImg = $parsedResponse->getCaptchaImg();
				$captchaSid = $parsedResponse->getCaptchaSid();
				$captchaKey = recognizeCaptcha($captchaImg);
				
				$params = array_merge_recursive($params, [
					'captcha_key' => $captchaKey,
					'captcha_sid' => $captchaSid,
				]);
				
				try
				{
					$response = $this->getHttpResponse($url, $params, $apiTokenType);
				}
				catch (TransportRequestException $e)
				{
					throw new VKClientException($e);
				}
				
				$parsedResponse = $this->parseResponse($response);
			}
			else
			{
				throw ExceptionMapper::parse($parsedResponse);
			}
		}
		
		return $parsedResponse;
	}
	
	/**
	 * Uploads data by its path to the given url.
	 *
	 * @param string $upload_url
	 * @param string $parameter_name
	 * @param string $path
	 *
	 * @return mixed
	 * @throws VKClientException
	 * @throws VKApiException
	 */
	public function upload(string $upload_url, string $parameter_name, string $path)
	{
		try
		{
			$response = $this->http_client->upload($upload_url, $parameter_name, $path);
		}
		catch (TransportRequestException $e)
		{
			throw new VKClientException($e);
		}
		
		return $this->parseResponse($response);
	}
	
	/**
	 * Decodes the response and checks its status code and whether it has an Api error. Returns decoded response.
	 *
	 * @param TransportClientResponse $response
	 *
	 * @return mixed
	 * @throws VKApiException
	 * @throws VKClientException
	 * @throws Exception
	 */
	private function parseResponse(TransportClientResponse $response)
	{
		$this->checkHttpStatus($response);
		
		$body = $response->getBody();
		$decode_body = $this->decodeBody($body);
		
		if (isset($decode_body[static::KEY_ERROR]))
		{
			$error = $decode_body[static::KEY_ERROR];
			$api_error = new VKApiError($error);
			$api_exception = ExceptionMapper::parse($api_error);
			
			if ($api_exception instanceof VKApiCaptchaException)
			{
				return $api_error;
			}
			
			throw $api_exception;
		}
		
		return $decode_body[static::KEY_RESPONSE] ?? $decode_body;
	}
	
	/**
	 * Formats given array of parameters for making the request.
	 *
	 * @param array $params
	 *
	 * @return array
	 */
	private function formatParams(array $params): array
	{
		foreach ($params as $key => $value)
		{
			if (is_array($value))
			{
				$params[$key] = implode(',', $value);
			}
			elseif (is_bool($value))
			{
				$params[$key] = $value ? 1 : 0;
			}
		}
		
		return $params;
	}
	
	/**
	 * Decodes body.
	 *
	 * @param string $body
	 *
	 * @return mixed
	 * @throws JsonException
	 */
	protected function decodeBody(string $body)
	{
		$decoded_body = json_decode($body, true, 512, JSON_THROW_ON_ERROR);
		
		if (!is_array($decoded_body))
		{
			$decoded_body = [];
		}
		
		return $decoded_body;
	}
	
	/**
	 * @param TransportClientResponse $response
	 *
	 * @throws VKClientException
	 */
	protected function checkHttpStatus(TransportClientResponse $response): void
	{
		if ((int) $response->getHttpStatus() !== static::HTTP_STATUS_CODE_OK)
		{
			throw new VKClientException("Invalid http status: {$response->getHttpStatus()}");
		}
	}
	
	/**
	 * Get throttled HTTP response.
	 *
	 * @throws TransportRequestException
	 */
	private function getHttpResponse(string $url, array $params, int $apiTokenType): TransportClientResponse
	{
		if (function_exists('throttle'))
		{
			$key = $params[static::PARAM_ACCESS_TOKEN];
			$maxAttempts = match ($apiTokenType) {
				VKApiTokenTypes::GROUP, VKApiTokenTypes::APP => 20,
				default => 3
			};
			$decaySeconds = 1;
			$callback = fn() => $this->http_client->post($url, $params);
			
			/**
			 * Throttle callback calls for requests per seconds
			 *
			 * @param string $key
			 * @param int $maxAttempts
			 * @param int $decaySeconds
			 * @param Closure $callback
			 * @param int $secondsTimeout
			 * @param float $secondsStep
			 *
			 * @return mixed
			 */
			return throttle($key, $maxAttempts, $decaySeconds, $callback);
		}
		
		return $this->http_client->post($url, $params);
	}
}
