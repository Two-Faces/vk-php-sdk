<?php

namespace VK\Actions;

use VK\Client\Enums\VKApiTokenTypes;
use VK\Exceptions\Api\VKApiAuthDelayException;
use VK\Exceptions\Api\VKApiAuthFloodException;
use VK\Exceptions\Api\VKApiParamPhoneException;
use VK\Exceptions\Api\VKApiPhoneAlreadyUsedException;
use VK\Exceptions\VKApiException;
use VK\Exceptions\VKClientException;

class Auth extends Action
{
	/**
	 * Checks a user's phone number for correctness.
	 *
	 * @param string $access_token
	 * @param array $params 
	 * - @var string phone: Phone number.
	 * - @var integer client_id: User ID.
	 * - @var string client_secret
	 * - @var boolean auth_by_phone
	 * @throws VKClientException
	 * @throws VKApiException
	 * @throws VKApiPhoneAlreadyUsedException This phone number is used by another user
	 * @throws VKApiAuthDelayException Processing.. Try later
	 * @throws VKApiParamPhoneException Invalid phone number
	 * @return mixed
	 */
	public function checkPhone(string $access_token, array $params = [], int $apiTokenType = VKApiTokenTypes::USER)
	{
		return $this->request->post('auth.checkPhone', $access_token, $params, $apiTokenType);
	}

	/**
	 * Allows to restore account access using a code received via SMS. " This method is only available for apps with [vk.com/dev/auth_direct|Direct authorization] access. "
	 *
	 * @param string $access_token
	 * @param array $params 
	 * - @var string phone: User phone number.
	 * - @var string last_name: User last name.
	 * @throws VKClientException
	 * @throws VKApiException
	 * @throws VKApiAuthFloodException Too many auth attempts, try again later
	 * @return mixed
	 */
	public function restore(string $access_token, array $params = [], int $apiTokenType = VKApiTokenTypes::USER)
	{
		return $this->request->post('auth.restore', $access_token, $params, $apiTokenType);
	}
}
