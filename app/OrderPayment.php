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

    public function statuslabelClass()
    {
        switch($this->status) {
            case 1:
                $class = 'success';
                break;

            case 0:
                $class = 'danger';
                break;

            default:
                $class = 'warning';
        }

        return $class;
    }

    public function statusText()
    {
        switch($this->status) {
            case 1:
                $text = trans('app.canceled');
                break;

            case 0:
                $text = trans('app.canceled');
                break;

            default:
                $text = trans('app.pending_payment');
        }

        return $text;
    }

    public function confirmedlabelClass()
    {
        switch($this->confirmed) {
            case 1:
                $class = 'success';
                break;

            case 0:
                $class = 'danger';
                break;

            default:
                $class = 'warning';
        }

        return $class;
    }

    public function confirmedText()
    {
        switch($this->confirmed) {
            case 1:
                $text = trans('app.confirmed');
                break;

            case 0:
                $text = trans('app.Unconfirmed');
                break;

            default:
                $text = trans('app.pending_payment');
        }

        return $text;
    }

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
