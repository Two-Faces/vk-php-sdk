<?php

declare(strict_types = 1);

namespace VK\OAuth;

use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\ResponseInterface;
use VK\Exceptions\VKClientException;
use VK\Exceptions\VKOAuthException;
use VK\Transport\Client;

abstract class AbstractOAuth
{
    protected const CONNECTION_TIMEOUT = 10.0;
    protected const HTTP_STATUS_CODE_OK = 200;

    protected const RESPONSE_KEY_ERROR = 'error';
    protected const RESPONSE_KEY_ERROR_DESCRIPTION = 'error_description';

    protected float $timeout = self::CONNECTION_TIMEOUT;

    /**
     * @var string
     */
    protected string $host;

    /**
     * @var ClientInterface
     */
    protected ClientInterface $client;

    /**
     * @param ClientInterface|null $client
     */
    public function __construct(?ClientInterface $client = null)
    {
        $this->client = $client ?? new Client();
    }

    /**
     * @return float
     */
    public function getTimeout(): float
    {
        return $this->timeout;
    }

    public function setTimeout(float $timeout): self
    {
        $this->timeout = $timeout;
        return $this;
    }

    public function getHost(): string
    {
        return $this->host;
    }

    public function setHost(string $host): self
    {
        $this->host = rtrim($host, '/');
        return $this;
    }

    /**
     * @param string $method
     * @param string $url
     * @param array<string, mixed> $params
     * @param array<string, mixed> $headers
     * @return mixed
     * @throws VKClientException
     * @throws VKOAuthException
     */
    protected function request(string $method, string $url, array $params = [], array $headers = []): array
    {
        $params['timeout'] = $this->getTimeout();

        try {
            $response = $this->client->request($method, $url, $params, $headers);
        } catch (GuzzleException $e) {
            throw new VKClientException($e);
        }

        return $this->checkOAuthResponse($response);
    }

    /**
     * Decodes the authorization response and checks its status code and whether it has an error.
     *
     * @param ResponseInterface $response
     *
     * @return mixed
     *
     * @throws VKClientException
     * @throws VKOAuthException
     */
    protected function checkOAuthResponse(ResponseInterface $response): mixed
    {
        if ($response->getStatusCode() !== static::HTTP_STATUS_CODE_OK) {
            throw new VKClientException("Invalid http status: {$response->getStatusCode()}");
        }

        $body = $response->getBody()->getContents();
        $decode_body = $this->decodeBody($body);

        if (isset($decode_body[static::RESPONSE_KEY_ERROR])) {
            throw new VKOAuthException(
                "{$decode_body[static::RESPONSE_KEY_ERROR_DESCRIPTION]}. OAuth error {$decode_body[static::RESPONSE_KEY_ERROR]}"
            );
        }

        return $decode_body;
    }

    /**
     * @param string $body
     * @return array
     */
    protected function decodeBody(string $body): array
    {
        $decoded_body = json_decode($body, true);

        if (!is_array($decoded_body)) {
            $decoded_body = [];
        }

        return $decoded_body;
    }
}
