<?php

namespace App\Repositories\Payment;

use App\PaymentMethods;
use App\Repositories\Repository;

class EloquentPayment extends Repository implements PaymentRepository
{
	 /**
     * Fields attributes
     *
     * @var array
     */
    protected $attributes = [
        'name'
    ];

    /**
     * @var PaymentRepository
     */
    protected $payments;

    /**
     * EloquentOrder constructor
     *
     * @param Order $Order
     */
    public function __construct(PaymentMethods $payment)
    {
        parent::__construct($payment, $this->attributes);
    }

    /*
     * lists payment
     *
     */
    public function  lists_payments($column = 'name', $key = 'id')
    {
        return $this->model->all()->sortBy($column)->where('status', 1)->pluck($column, $key)->all();
    }


}