<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\Support\Coupon\CouponStatus;

class Coupon extends Model
{
     /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'coupons';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code', 'validity', 'percentage', 'status', 'created_by'
    ];

    /**
     * Functions
     *
     */
    public function codeDecrypt()
    {
        return decrypt($this->code);
    }

    public function labelClass()
    {
        switch($this->status) {
            case CouponStatus::VALID:
                $class = 'success';
                break;

            case CouponStatus::USELESS:
                $class = 'danger';
                break;

            default:
                $class = 'success';
        }

        return $class;
    }

    public function getValidityAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d', $date)->format('d-m-Y');
    }

    public function getCreatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d-m-Y G:ia');
    }

    public function getUpdatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d-m-Y G:ia');
    }

    /**
     * Relationships
     *
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function client_coupon()
    {
        return $this->hasMany(ClientCoupon::class, 'coupon_id');
    }

}
