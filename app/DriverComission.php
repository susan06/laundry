<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DriverComission extends Model
{
     /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'drivers_comission';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'percentage'
    ];

     /**
     * Relationships
     *
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
