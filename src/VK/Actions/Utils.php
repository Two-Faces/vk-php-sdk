<?php

namespace VK\Actions;

use VK\Actions\Enums\Utils\UtilsInterval;
use VK\Actions\Enums\Utils\UtilsSource;
use VK\Client\Enums\VKApiTokenTypes;
use VK\Exceptions\Api\VKApiNotFoundException;
use VK\Exceptions\VKApiException;
use VK\Exceptions\VKClientException;

class Utils extends Action
{
	/**
	 * Checks whether a link is blocked in VK.
	 *
	 * @param string $access_token
	 * @param array $params 
	 * - @var string url: Link to check (e.g., 'http://google.com').
	 * @throws VKClientException
	 * @throws VKApiException
	 * @return mixed
	 */
	public function checkLink(string $access_token, array $params = [], int $apiTokenType = VKApiTokenTypes::USER)
	{
		return $this->request->post('utils.checkLink', $access_token, $params, $apiTokenType);
	}

	/**
	 * Deletes shortened link from user's list.
	 *
	 * @param string $access_token
	 * @param array $params 
	 * - @var string key: Link key (characters after vk.cc/).
	 * @throws VKClientException
	 * @throws VKApiException
	 * @return mixed
	 */
	public function deleteFromLastShortened(string $access_token, array $params = [], int $apiTokenType = VKApiTokenTypes::USER)
	{
		return $this->request->post('utils.deleteFromLastShortened', $access_token, $params, $apiTokenType);
	}

	/**
	 * Returns a list of user's shortened links.
	 *
	 * @param string $access_token
	 * @param array $params 
	 * - @var integer count: Number of links to return.
	 * - @var integer offset: Offset needed to return a specific subset of links.
	 * @throws VKClientException
	 * @throws VKApiException
	 * @return mixed
	 */
	public function getLastShortenedLinks(string $access_token, array $params = [], int $apiTokenType = VKApiTokenTypes::USER)
	{
		return $this->request->post('utils.getLastShortenedLinks', $access_token, $params, $apiTokenType);
	}

	/**
	 * Returns stats data for shortened link.
	 *
	 * @param string $access_token
	 * @param array $params 
	 * - @var string key: Link key (characters after vk.cc/).
	 * - @var UtilsSource source: Source of scope
	 * - @var string access_key: Access key for private link stats.
	 * - @var UtilsInterval interval: Interval.
	 * - @var integer intervals_count: Number of intervals to return.
	 * - @var boolean extended: 1 — to return extended stats data (sex, age, geo). 0 — to return views number only.
	 * @throws VKClientException
	 * @throws VKApiException
	 * @throws VKApiNotFoundException Not found
	 * @return mixed
	 */
	public function getLinkStats(string $access_token, array $params = [], int $apiTokenType = VKApiTokenTypes::USER)
	{
		return $this->request->post('utils.getLinkStats', $access_token, $params, $apiTokenType);
	}

	/**
	 * Returns the current time of the VK server.
	 *
	 * @param string $access_token
	 * @throws VKClientException
	 * @throws VKApiException
	 * @return mixed
	 */
	public function getServerTime(string $access_token)
	{
		return $this->request->post('utils.getServerTime', $access_token);
	}

	/**
	 * Allows to receive a link shortened via vk.cc.
	 *
	 * @param string $access_token
	 * @param array $params 
	 * - @var string url: URL to be shortened.
	 * - @var boolean private: 1 — private stats, 0 — public stats.
	 * @throws VKClientException
	 * @throws VKApiException
	 * @return mixed
	 */
	public function getShortLink(string $access_token, array $params = [], int $apiTokenType = VKApiTokenTypes::USER)
	{
		return $this->request->post('utils.getShortLink', $access_token, $params, $apiTokenType);
	}

	/**
	 * Detects a type of object (e.g., user, community, application) and its ID by screen name.
	 *
	 * @param string $access_token
	 * @param array $params 
	 * - @var string screen_name: Screen name of the user, community (e.g., 'apiclub,' 'andrew', or 'rules_of_war'), or application.
	 * @throws VKClientException
	 * @throws VKApiException
	 * @return mixed
	 */
	public function resolveScreenName(string $access_token, array $params = [], int $apiTokenType = VKApiTokenTypes::USER)
	{
		return $this->request->post('utils.resolveScreenName', $access_token, $params, $apiTokenType);
	}
}
