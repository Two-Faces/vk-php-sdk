<?php

namespace VK\Actions\Enums\Boards;

interface BoardOrder
{
	public const AS_BY_ADMINISTRATOR = 0;
	public const CREATED_ASC = -2;
	public const CREATED_DESC = 2;
	public const UPDATED_ASC = -1;
	public const UPDATED_DESC = 1;
}
