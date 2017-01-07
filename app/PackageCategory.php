<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class PackageCategory extends Model
{
     /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'package_categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'status'
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
     * Functions
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

        /**
     * get span label status
     */
    public function getStatus()
    {
        switch($this->status) {
            case true:
                $class = '<span class="label label-success">'.trans("app.Published").'</span>';
                break;

            case false:
                $class = '<span class="label label-danger">'.trans("app.No Published").'</span>';
                break;

            default:
                $class = '';
        }

        return $class;
    }

     /**
     * Relationships
     *
     */
    public function package()
    {
        return $this->hasMany(Package::class, 'package_category_id');
    }
}
