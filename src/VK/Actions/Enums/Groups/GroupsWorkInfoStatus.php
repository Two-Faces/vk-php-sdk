<?php

namespace VK\Actions\Enums\Groups;

interface GroupsWorkInfoStatus
{
	public const ALWAYS_OPENED = 'always_opened';
	public const FOREVER_CLOSED = 'forever_closed';
	public const NO_INFORMATION = 'no_information';
	public const TEMPORARILY_CLOSED = 'temporarily_closed';
	public const TIMETABLE = 'timetable';
}
