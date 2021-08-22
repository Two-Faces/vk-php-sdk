<?php

namespace VK\Actions\Enums\Orders;

interface OrdersAction
{
	public const CANCEL = 'cancel';
	public const CHARGE = 'charge';
	public const REFUND = 'refund';
}
