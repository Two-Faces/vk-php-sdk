<?php

namespace VK\Actions;

use VK\Client\Enums\VKApiTokenTypes;
use VK\Exceptions\Api\VKApiPrettyCardsCardIsConnectedToPostException;
use VK\Exceptions\Api\VKApiPrettyCardsCardNotFoundException;
use VK\Exceptions\Api\VKApiPrettyCardsTooManyCardsException;
use VK\Exceptions\VKApiException;
use VK\Exceptions\VKClientException;

class PrettyCards extends Action
{
	/**
	 * @param string $access_token
	 * @param array $params 
	 * - @var integer owner_id
	 * - @var string photo
	 * - @var string title
	 * - @var string link
	 * - @var string price
	 * - @var string price_old
	 * - @var string button
	 * @throws VKClientException
	 * @throws VKApiException
	 * @throws VKApiPrettyCardsTooManyCardsException Too many cards
	 * @return mixed
	 */
	public function create(string $access_token, array $params = [], int $apiTokenType = VKApiTokenTypes::USER)
	{
		return $this->request->post('prettyCards.create', $access_token, $params, $apiTokenType);
	}

	/**
	 * @param string $access_token
	 * @param array $params 
	 * - @var integer owner_id
	 * - @var integer card_id
	 * @throws VKClientException
	 * @throws VKApiException
	 * @throws VKApiPrettyCardsCardNotFoundException Card not found
	 * @throws VKApiPrettyCardsCardIsConnectedToPostException Card is connected to post
	 * @return mixed
	 */
	public function delete(string $access_token, array $params = [], int $apiTokenType = VKApiTokenTypes::USER)
	{
		return $this->request->post('prettyCards.delete', $access_token, $params, $apiTokenType);
	}

	/**
	 * @param string $access_token
	 * @param array $params 
	 * - @var integer owner_id
	 * - @var integer card_id
	 * - @var string photo
	 * - @var string title
	 * - @var string link
	 * - @var string price
	 * - @var string price_old
	 * - @var string button
	 * @throws VKClientException
	 * @throws VKApiException
	 * @throws VKApiPrettyCardsCardNotFoundException Card not found
	 * @return mixed
	 */
	public function edit(string $access_token, array $params = [], int $apiTokenType = VKApiTokenTypes::USER)
	{
		return $this->request->post('prettyCards.edit', $access_token, $params, $apiTokenType);
	}

	/**
	 * @param string $access_token
	 * @param array $params 
	 * - @var integer owner_id
	 * - @var integer offset
	 * - @var integer count
	 * @throws VKClientException
	 * @throws VKApiException
	 * @return mixed
	 */
	public function get(string $access_token, array $params = [], int $apiTokenType = VKApiTokenTypes::USER)
	{
		return $this->request->post('prettyCards.get', $access_token, $params, $apiTokenType);
	}

	/**
	 * @param string $access_token
	 * @param array $params 
	 * - @var integer owner_id
	 * - @var array[integer] card_ids
	 * @throws VKClientException
	 * @throws VKApiException
	 * @return mixed
	 */
	public function getById(string $access_token, array $params = [], int $apiTokenType = VKApiTokenTypes::USER)
	{
		return $this->request->post('prettyCards.getById', $access_token, $params, $apiTokenType);
	}

	/**
	 * @param string $access_token
	 * @throws VKClientException
	 * @throws VKApiException
	 * @return mixed
	 */
	public function getUploadURL(string $access_token)
	{
		return $this->request->post('prettyCards.getUploadURL', $access_token);
	}
}
