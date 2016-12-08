<?php

namespace App\Repositories\Order;

use App\OrderPayment;
use App\Repositories\Repository;

class EloquentOrderPayment extends Repository implements OrderPaymentRepository
{
	 /**
     * Fields attributes
     *
     * @var array
     */
    protected $attributes = [];

    /**
     * EloquentOrderPayment constructor
     *
     * @param OrderPayment $payment
     */
    public function __construct(OrderPayment $payment)
    {
        parent::__construct($payment, $this->attributes);
    }

}