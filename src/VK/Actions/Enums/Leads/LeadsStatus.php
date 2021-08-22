<?php

namespace VK\Actions\Enums\Leads;

interface LeadsStatus
{
	public const BLOCKING_USERS = 2;
	public const FINISH = 1;
	public const FINISH_IN_TEST_MODE = 4;
	public const START = 0;
	public const START_IN_TEST_MODE = 3;
}
