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

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function full_name()
    {
        return $this->name.' '.$this->lastname;
    }

    public function avatar()
    {
        if (! $this->avatar ) {
            return url('assets/images/user.png');
        }

        return Storage::url('user/{$this->avatar}');
    }

    public function label_phones()
    {
        $text_phones = '';
        if ($this->phones) {
            $phones = json_decode($this->phones, true);
            foreach ($phones as $label => $phone) {
                $text_phones .= $label.': '.$phone.', ';
            }
            $text_phones = substr($text_phones, 0, -2);
        } 
        return $text_phones;
    }

    public function getBirthdayAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d', $date)->format('d-m-Y');
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
        return $this->belongsTo(Coupon::class, 'created_by');
    }

    public function branchOffice()
    {
        return $this->hasOne(BranchOffice::class, 'representative_id');
    }

}
