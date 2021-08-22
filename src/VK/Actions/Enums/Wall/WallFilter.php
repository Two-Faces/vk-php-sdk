<?php

namespace VK\Actions\Enums\Wall;

interface WallFilter
{
	public const ALL = 'all';
	public const OTHERS = 'others';
	public const OWNER = 'owner';
	public const POSTPONED = 'postponed';
	public const SUGGESTS = 'suggests';
}
