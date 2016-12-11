<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
     /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'orders';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'bag_code',
    	'client_id', 
    	'client_location_id',
    	'client_coupon_id', 
        'date_search', 
        'time_search', 
        'date_delivery', 
        'time_delivery', 
        'special_instructions', 
        'discount', 
        'sub_total',
        'total'
    ];

    /**
     * Functions
     *
     */

    public function getCreatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d-m-Y G:ia');
    }

    public function getUpdatedAtAttribute($date)
    {
        if($date) {
            return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d-m-Y G:ia');
        }
    }

    public function setDateSearchAttribute($value)
    {
        $this->attributes['date_search'] = date_format(date_create($value), 'Y-m-d');
    }

    public function setDateDeliveryAttribute($value)
    {
        $this->attributes['date_delivery'] = date_format(date_create($value), 'Y-m-d');
    }
    
    /**
     * Relationships
     *
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function order_package()
    {
        return $this->hasMany(OrderPackage::class, 'order_id');
    }

    public function order_payment()
    {
        return $this->hasOne(OrderPayment::class, 'order_id');
    }

    public function client_coupon()
    {
        return $this->belongsTo(ClientCoupon::class, 'client_coupon_id');
    }
}
