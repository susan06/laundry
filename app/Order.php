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
    	'client_id', 
    	'client_location_id',
    	'client_coupon_id', 
        'date_search', 
        'time_search', 
        'date_delivery', 
        'time_delivery', 
        'special_instructions', 
        'discount', 
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
        return $this->hasMany(OrderPayment::class, 'order_id');
    }
}
