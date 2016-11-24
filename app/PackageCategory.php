<?php

namespace App;

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
     * Relationships
     *
     */
    public function package()
    {
        return $this->hasMany(Package::class, 'package_category_id');
    }
}
