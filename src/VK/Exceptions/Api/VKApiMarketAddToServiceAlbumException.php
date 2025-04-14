<?php

namespace VK\Exceptions\Api;

use VK\Client\VKApiError;
use VK\Exceptions\VKApiException;

class VKApiMarketAddToServiceAlbumException extends VKApiException
{
	/**
	 * VKApiMarketAddToServiceAlbumException constructor.
	 * @param VkApiError $error
	 */
	public function __construct(VKApiError $error)
	{
		parent::__construct(1531, 'Add item to service album', $error);
	}
}

