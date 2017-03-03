<?php

namespace App\Repositories\Order;

use App\Repositories\RepositoryInterface;

interface OrderRepository extends RepositoryInterface
{
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
     * Create payment penalty
     *
     *
     * @param array $attributes
     * @return Model
     *
     */
    public function create_penalty(array $attributes);

    /**
     * Update payment penalty
     *
     *
     * @param $id
     * @param array $newData
     */
    public function update_penalty($id, array $newData);

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
    public function create_update_payment($id, Array $data);

    /**
     * Paginate and search
     *
     * return the result paginated for the take value and with the attributes.
     *
     * @param int $take
     * @param string $search
     *
     * @return mixed
     *
     */
    public function paginate_search($take = 10, $search = null, $client = null, $status = null, $status_payment = null, $status_driver = null, $branch_office = null);

    /**
     * itinerary of driver
     *
     */
    public function itinerary_driver($take = 10, $itinerary = null, $driver = null, $search = null, $status_driver = null);

    /**
     * itinerary of driver
     *
     */
    public function itinerary_branch($take = 10, $status = null, $search = null);

    /**
     * echart data hour in day
     *
     */
    public function chart_order_by_hour($client = null, $driver = null);

    /**
     * echart data delivery hour in day
     *
     */
    public function chart_order_by_hour_delivery($client = null, $driver = null);

    /**
     * echart data by branch offices
     *
     */
    public function chart_order_branch($client = null, $driver = null);

    /**
     * echart data by orders delivery filter user
     *
     */
    public function chart_order_delivered($client = null, $driver = null);

    /**
     * chart_order_packages
     *     
     */
    public function chart_order_packages();

    /**
     * chart_order_payments
     *     
     */
    public function chart_order_payments();

}
