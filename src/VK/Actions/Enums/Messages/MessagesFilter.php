<?php

namespace VK\Actions\Enums\Messages;

interface MessagesFilter
{
	public const ALL = 'all';
	public const BUSINESS_NOTIFY = 'business_notify';
	public const IMPORTANT = 'important';
	public const MESSAGE_REQUEST = 'message_request';
	public const UNANSWERED = 'unanswered';
	public const UNREAD = 'unread';
}
