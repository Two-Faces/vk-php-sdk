<?php

namespace VK\Actions\Enums\Videos;

interface VideoPrivacy
{
	public const ALL = '0';
	public const FRIENDS = '1';
	public const FRIENDS_OF_FRIENDS = '2';
	public const ONLY_ME = '3';
}
