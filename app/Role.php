<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
     /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'roles';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

     /**
     * Field type
     *
     * @var array
     */
    protected $casts = [
        'removable' => 'boolean'
    ];

     /**
     * Relationships
     *
     */
    public function user()
    {
        return $this->hasOne(User::class, 'role_id');
    }

}
