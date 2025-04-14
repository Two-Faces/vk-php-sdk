<?php

namespace VK\OAuth\User\DTO;

/**
 * see https://id.vk.com/about/business/go/docs/ru/vkid/latest/vk-id/connection/work-with-user-info/scopes
 */
class Scopes
{
    public const PERSONAL_INFO = 'vkid.personal_info';
    public const EMAIL = 'email';
    public const PHONE = 'phone';

    public const FRIENDS = 'friends';
    public const GROUPS = 'groups';
    public const WALL = 'wall';
    public const STORIES = 'stories';
    public const DOCS = 'docs';
    public const NOTES = 'notes';
    public const PAGES = 'pages';
    public const PHOTOS = 'photos';
    public const VIDEO = 'video';
    public const ADS = 'ads';
    public const MARKET = 'market';
    public const STATUS = 'status';
    public const NOTIFICATIONS = 'notifications';
    public const STATS = 'stats';
}
