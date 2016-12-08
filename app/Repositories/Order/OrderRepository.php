<?php

namespace App\Repositories\Order;

use App\Repositories\RepositoryInterface;

interface OrderRepository extends RepositoryInterface
{
    /*
     * lists payment
     *
     */
    public function  lists_payments();

    /**
     * Create payment
     *
     *
     * @param array $attributes
     * @return Model
     *
     */
    public function create_payment(array $attributes);

    /**
     * Update payment
     *
     *
     * @param $id
     * @param array $newData
     */
    public function update_payment($id, array $newData);

    /**
     * Create package
     *
     *
     * @param array $attributes
     * @return Model
     *
     */
    public function create_package(array $attributes);

    /**
     * Update package
     *
     *
     * @param $id
     * @param array $newData
     */
    public function update_package($id, array $newData);

    /**
     * create or update payment
     *
     * @param int $order
     * @param array $data
     */
    public create_update_payment($id, Array $data);
}