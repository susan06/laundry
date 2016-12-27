<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Suggestion extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'suggestions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'content'
    ];

     /**
     * Field type
     *
     * @var array
     */
    protected $casts = [
        'user_id' => 'integer'
    ];

     /**
     * Relationships
     *
     */
    public function user()
    {
        return $this->hasOne(User::class, 'user_id');
    }
}
