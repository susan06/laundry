<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class OrderPenalty extends Model
{
     /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'orders_penalty';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'order_id', 
    	'payment_method_id',
        'percentage',
    	'reference',
    	'amount',
        'status',
    	'confirmed'
    ];

    public function getCreatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d-m-Y G:ia');
    }

    public function getUpdatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d-m-Y G:ia');
    }

    public function getConfirmedPayment()
    {
        switch($this->confirmed) {
            case true:
                $text = '<span class="label label-success">'.trans("app.penalty").' - '.trans("app.confirmed").'</span>';
                break;

            case false:
                $text = '<span class="label label-danger">'.trans("app.penalty").' - '.trans('app.Unconfirmed').'</span>';
                break;

            default:
                $text = '';
        }

        return $text;
    } 

    public function getStatusPayment()
    {
        switch($this->status) {
            case true:
                $text = '<span class="label label-success">'.trans("app.penalty").' - '.trans("app.canceled").'</span>';
                break;

            case false:
                $text = '<span class="label label-danger">'.trans("app.penalty").' - '.trans('app.pending_payment').'</span>';
                break;

            default:
                $text = '';
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
