<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
        'code', 'validity', 'percentage', 'created_by'
    ];

    /**
     * Relationships
     *
     */
    public function user()
    {
        return $this->hasOne(User::class, 'created_by');
    }

}
