<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientCoupon extends Model
{
     /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'clients_coupons';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'client_id', 'coupon_id', 'status'
    ];

    /**
     * Functions
     *
     */
        
    public function labelClass()
    {
        switch($this->status) {
            case true:
                $class = 'success';
                break;

            case false:
                $class = 'danger';
                break;

            default:
                $class = 'success';
        }

        return $class;
    }

    public function isValid()
    {
        return $this->status == true;
    }

    public function isNoValid()
    {
        return $this->status == false;
    }

    /**
     * Relationships
     *
     */
    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function coupon()
    {
        return $this->belongsTo(Coupon::class, 'coupon_id');
    }

    public function order()
    {
        return $this->hasOne(ClientCoupon::class, 'client_coupon_id');
    }
}
