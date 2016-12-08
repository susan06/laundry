<?php

namespace App\Repositories\Payment;

use App\Repositories\RepositoryInterface;

interface PaymentRepository extends RepositoryInterface
{
    /*
     * lists payment
     *
     */
    public function  lists_payments($column = 'name', $key = 'id');
}