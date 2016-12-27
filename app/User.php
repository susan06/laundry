<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

use App\Support\User\UserStatus;

class User extends Authenticatable
{
    use Notifiable;

    protected $dates = ['last_login', 'birthday'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'lastname', 
        'email', 
        'password', 
        'status',
        'avatar', 
        'lang', 
        'role_id', 
        'last_login', 
        'birthday',
        'phones', 
        'confirmation_token'
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

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucwords(strtolower($value));
    }

    public function setLastnameAttribute($value)
    {
        $this->attributes['lastname'] = ucwords(strtolower($value));
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function setBirthdayAttribute($value)
    {
        if ($value) {
            $this->attributes['birthday'] = Carbon::createFromFormat('d-m-Y', $value)->format('Y-m-d');
        }
       
    }

    public function full_name()
    {
        return $this->name.' '.$this->lastname;
    }

    public function avatar()
    {
        if (! $this->avatar ) {
            return asset('public/images/noimage.png');
        }

        return asset('storage/app/users/'.$this->avatar);
    }

    public function label_phones()
    {
        $text_phones = '';
        if ($this->phones) {
            $phones = json_decode($this->phones, true);
            foreach ($phones as $label => $phone) {
                $text_phones .= trans('app.'.$label).': '.$phone.', ';
            }
            $text_phones = substr($text_phones, 0, -2);
        } 
        return $text_phones;
    }

    public function count_coupon()
    {
        return count($this->client_coupon);
    }

    public function getBirthdayAttribute($date)
    {
        if ($date) {
            return Carbon::createFromFormat('Y-m-d', $date)->format('d-m-Y');
        }
    }

    public function getCreatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d-m-Y G:ia');
    }

    public function getUpdatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d-m-Y G:ia');
    }

    public function isAdmin()
    {
        return in_array($this->role_id, [1,3,4,5]);
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
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function coupon()
    {
        return $this->hasMany(Coupon::class, 'created_by');
    }

    public function client_coupon()
    {
        return $this->hasMany(ClientCoupon::class, 'client_id');
    }

    public function client_location()
    {
        return $this->hasMany(ClientLocation::class, 'client_id');
    }

    public function branchOffice()
    {
        return $this->hasOne(BranchOffice::class, 'representative_id');
    }

    public function suggestion()
    {
        return $this->hasOne(Suggestion::class, 'user_id');
    }

}
