<?php

declare(strict_types = 1);

namespace VK\OAuth\User\DTO;

class ViewType
{
    /** view type values  */
    public const VIEW_TYPE_RFC = 'rfc'; // rfc response format
    public const VIEW_TYPE_SDK = 'sdk'; // VK SDK response format
}