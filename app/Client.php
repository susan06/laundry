<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

use App\Support\User\UserStatus;

class Client extends Authenticatable
{
    use Notifiable;

    protected $dates = ['last_login', 'date_of_birth'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 
        'first_name', 
        'last_name', 
        'email', 
        'password',
        'mobile',
        'telephone',
        'date_of_birth',
        'type_of_card',
        'name_on_card',
        'card_number',
        'cvv',
        'month_of_expiration',
        'year_of_expiration',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Functions
     *
     */
    public function full_name()
    {
        return $this->first_name.' '.$this->last_name;
    }

    public function getCreatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d-m-Y G:ia');
    }

    public function getUpdatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d-m-Y G:ia');
    }

    public function isUnconfirmed()
    {
        return $this->status == UserStatus::UNCONFIRMED;
    }

    public function isActive()
    {
        return $this->status == UserStatus::ACTIVE;
    }

    public function isBanned()
    {
        return $this->status == UserStatus::BANNED;
    }

    public function labelClass()
    {
        switch($this->status) {
            case UserStatus::ACTIVE:
                $class = 'success';
                break;

            case UserStatus::BANNED:
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
    public function userId()
    {
        return $this->belongsTo(User::class, 'id');
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function coupon()
    {
        return $this->belongsTo(Coupon::class, 'created_by');
    }

    public function branch_office()
    {
        return $this->hasOne(BranchOffice::class, 'representative_id');
    }

}
