<?php

namespace App\Repositories\Order;

use App\OrderPenalty;
use App\Repositories\Repository;

class EloquentOrderPenalty extends Repository implements OrderPenaltyRepository
{
	 /**
     * Fields attributes
     *
     * @var array
     */
    protected $attributes = [];

    /**
     * EloquentOrderPenalty constructor
     *
     * @param OrderPenalty $payment
     */
    public function __construct(OrderPenalty $payment)
    {
        parent::__construct($payment, $this->attributes);
    }

}