<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
     /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'packages';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'package_category_id', 'image', 'status', 'description'
    ];

     /**
     * Field type
     *
     * @var array
     */
    protected $casts = [
        'status' => 'boolean'
    ];

    /**
    *Functions
    *
    */

    public function getCreatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d-m-Y G:ia');
    }

    public function getUpdatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d-m-Y G:ia');
    }

    public function labelClass()
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

     /**
     * Relationships
     *
     */
    public function package_category()
    {
        return $this->belongsTo(PackageCategory::class, 'package_category_id');
    }

    public function package_price()
    {
        return $this->hasMany(PackagePrice::class, 'package_id');
    }
}
