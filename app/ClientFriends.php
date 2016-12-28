<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientFriends extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'client_friends';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'registered', 'email'
    ];

     /**
     * Field type
     *
     * @var array
     */
    protected $casts = [
        'user_id' => 'integer',
        'registered' => 'boolean',

    ];

    public function get_status()
    {
        switch($this->status) {
            case 1:
                $text = '<span class="label label-success">'.trans("app.registered").'</span>';
                break;

            case 0:
                $text = '<span class="label label-danger">'.trans("app.noregistered").'</span>';
                break;

            default:
                $text = '<span class="label label-warning">'.trans("app.noregistered").'</span>';
        }

        return $text;
    }

     /**
     * Relationships
     *
     */
    public function user()
    {
        return $this->hasOne(User::class, 'user_id');
    }
}
