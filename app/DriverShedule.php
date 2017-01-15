<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DriverShedule extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'drivers_shedule';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'value'
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
