<?php

namespace App\Repositories\Order;

use App\Order;
use App\OrderPayment;
use App\OrderPackage;
use App\Repositories\Repository;

class EloquentOrder extends Repository implements OrderRepository
{
    protected $attributes = [];
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
    public function paginate_search($take = 10, $search = null, $client = null, $status = null, $status_admin = null, $status_driver = null, $branch_office = null)
    {
        $query = Order::query();

        if ($client) {
            $query->where('client_id', $client)->orderBy('created_at', 'DESC');
        }
        
        if ($branch_office) {
            $query->where('branch_offices_id', $branch_office);
        }

        if ($status_driver) {
            $query->where('status', $status_driver);
        }

        if ($search) {
            $searchTerms = explode(' ', $search);
            $query->where( function ($q) use($searchTerms) {
                foreach ($searchTerms as $term) { 
                    $q->whereHas('user', function($qu) use($term) {
                        $qu->where('name', 'like', "%{$term}%");
                        $qu->orwhere('lastname', 'like', "%{$term}%");
                        $qu->orwhere('phones', 'like', "%{$term}%");
                        $qu->orwhere('email', 'like', "%{$term}%");
                    });
                } 
            });
        }

        if ($status) {
            $query->whereHas('order_payment', function($q) use($status) {
                $q->where('confirmed', $status);
            });
        }

        if ($status_admin) {
            $query->whereHas('order_payment', function($q) use($status_admin) {
                $q->where('status', $status_admin);
            });
        }

        $result = $query->paginate($take);

        if ($search) {
            $result->appends(['search' => $search]);
        }

        if ($status) {
            $result->appends(['status' => $status]);
        }

        if ($status_admin) {
            $result->appends(['status_admin' => $status_admin]);
        }

        if ($branch_office) {
            $result->appends(['branch_office' => $branch_office]);
        }

        if ($status_driver) {
            $result->appends(['status_driver' => $status_driver]);
        }

        return $result;
    }


}