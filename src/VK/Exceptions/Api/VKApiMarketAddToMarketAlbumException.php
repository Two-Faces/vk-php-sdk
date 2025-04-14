<?php

namespace VK\Exceptions\Api;

use VK\Client\VKApiError;
use VK\Exceptions\VKApiException;

class VKApiMarketAddToMarketAlbumException extends VKApiException
{
	/**
	 * VKApiMarketAddToMarketAlbumException constructor.
	 * @param VkApiError $error
	 */
	public function __construct(VKApiError $error)
	{
		parent::__construct(1532, 'Add service to market album', $error);
	}
}

