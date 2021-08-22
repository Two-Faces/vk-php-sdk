<?php

namespace VK\Actions;

use VK\Client\Enums\VKApiTokenTypes;
use VK\Exceptions\VKApiException;
use VK\Exceptions\VKClientException;

class Gifts extends Action
{
	/**
	 * Returns a list of user gifts.
	 *
	 * @param string $access_token
	 * @param array $params 
	 * - @var integer user_id: User ID.
	 * - @var integer count: Number of gifts to return.
	 * - @var integer offset: Offset needed to return a specific subset of results.
	 * @throws VKClientException
	 * @throws VKApiException
	 * @return mixed
	 */
	public function get(string $access_token, array $params = [], int $apiTokenType = VKApiTokenTypes::USER)
	{
		return $this->request->post('gifts.get', $access_token, $params, $apiTokenType);
	}
}
