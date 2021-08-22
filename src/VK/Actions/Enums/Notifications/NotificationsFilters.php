<?php

namespace VK\Actions\Enums\Notifications;

interface NotificationsFilters
{
	public const COMMENTS = 'comments';
	public const FOLLOWERS = 'followers';
	public const FRIENDS = 'friends';
	public const LIKES = 'likes';
	public const MENTIONS = 'mentions';
	public const REPOSTED = 'reposted';
	public const WALL = 'wall';
}
