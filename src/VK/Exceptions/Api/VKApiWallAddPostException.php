<?php

namespace VK\Exceptions\Api;

use VK\Client\VKApiError;
use VK\Exceptions\VKApiException;

class VKApiWallAddPostException extends VKApiException
{
	public function __construct(VkApiError $error)
	{
		parent::__construct(214, 'Access to adding post denied', $error);
	}
}
