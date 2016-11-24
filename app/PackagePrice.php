<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PackagePrice extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'package_prices';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'price', 'package_id', 'delivery_schedule'
    ];

    /**
    *Functions
    *
    */

     /**
     * Relationships
     *
     */
    public function package()
    {
        return $this->belongsTo(Package::class, 'package_id');
    }
}
