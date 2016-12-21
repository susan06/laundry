<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientLocation extends Model
{
     /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'clients_locations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'lat', 'lng', 'address', 'client_id', 'label', 'description', 'confirmed'
    ];

    /**
     * Field type
     *
     * @var array
     */
    protected $casts = [
        'confirmed' => 'boolean'
    ];

     /**
     * Relationships
     *
     */

     public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function order()
    {
        return $this->hasOne(Order::class, 'client_location_id');
    }
}
