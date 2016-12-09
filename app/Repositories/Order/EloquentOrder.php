<?php

namespace App\Repositories\Order;

use App\Order;
use App\OrderPayment;
use App\OrderPackage;
use App\Repositories\Repository;

class EloquentOrder extends Repository implements OrderRepository
{
	 /**
     * Fields attributes
     *
     * @var array
     */
    protected $attributes = [
        'bag_code',
        'date_search', 
        'date_delivery', 
        'special_instructions', 
        'total'
    ];

    /**
     * @var OrderPaymentRepository
     */
    protected $payments;

     /**
     * @var OrderPackageRepository
     */
    protected $order_packages;

    /**
     * EloquentOrder constructor
     *
     * @param Order $Order
     */
    public function __construct(
        Order $order, 
        OrderPaymentRepository $payments, 
        OrderPackageRepository $order_packages
    )
    {
        parent::__construct($order, $this->attributes);
        $this->payments = $payments;
        $this->order_packages = $order_packages;
    }

    /**
     * Create payment
     *
     *
     * @param array $attributes
     * @return Model
     *
     */
    public function create_payment(array $attributes)
    {
        return $this->payments->create($attributes);
    }

    /**
     * Update payment
     *
     *
     * @param $id
     * @param array $newData
     */
    public function update_payment($id, array $newData)
    {
        return $this->payments->update($id, $newData);
    }

    /**
     * create or update payment
     *
     * @param int $order
     * @param array $data
     */
    public function create_update_payment($id, Array $data)
    {
        $order = $this->model->find($id);  

       if ($order->order_payment->count() > 0) {
            
            $payment = $order->order_payment->updateExistingPivot($id, [ 
                'payment_method_id' => $data['payment_method_id'],
                'amount' => isset($data['total']) ? $data['total'] : $order->total,
            ]);

       } else {
            $payment = $order->order_payment->create([
                'payment_method_id' => $data['payment_method_id'],
                'amount' => $order->total,
                'status' => true
            ]);
       }

       return $payment;
    }

    /**
     * Create package
     *
     *
     * @param array $attributes
     * @return Model
     *
     */
    public function create_package(array $attributes)
    {
        return $this->order_packages->create($attributes);
    }

    /**
     * Update package
     *
     *
     * @param $id
     * @param array $newData
     */
    public function update_package($id, array $newData)
    {
        return $this->order_packages->update($id, $newData);
    }

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
    public function paginate_search($take = 10, $search = null, $status = null, $client = null)
    {
        $query = Order::query();

        if ($client) {
            $query->where('client_id', $client);
        }

        if ($search) {
            $searchTerms = explode(' ', $search);
            $query->where( function ($q) use($searchTerms) {
                foreach ($searchTerms as $term) {
                    foreach ($this->attributes as $attribute) {
                        $q->orwhere($attribute, "like", "%{$term}%");
                    }
                }
            });
        }

        if ($status) {
            $query->whereHas('order_payment', function($q) use($status) {
                $q->where('confirmed', $status);
            });
        }

        $result = $query->paginate($take);

        if ($search) {
            $result->appends(['search' => $search]);
        }

        if ($status) {
            $result->appends(['status' => $status]);
        }

        return $result;
    }


}