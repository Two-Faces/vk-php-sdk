<?php

namespace VK\Exceptions\Api;

use VK\Client\VKApiError;
use VK\Exceptions\VKApiException;

class VKApiLimitsException extends VKApiException
{
	public function __construct(VkApiError $error)
	{
		parent::__construct(103, 'Out of limits', $error);
	}
}
