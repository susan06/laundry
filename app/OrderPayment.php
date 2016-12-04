<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderPayment extends Model
{
     /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'orders_payments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'order_id', 
    	'payment_method_id',
    	'reference',
    	'amount',
        'status',
    	'confirmed'
    ];

    /**
     * Relationships
     *
     */
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function payment_method()
    {
        return $this->belongsTo(PaymentMethods::class, 'payment_method_id');
    }
}
