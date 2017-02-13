<?php

namespace App;

use DateTime;
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
        'confirmation_token',
        'online'
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
        $avatar = asset('public/images/icon_user.png');

        if (! $this->avatar ) {
            $avatar = asset('public/images/noimage.png');
        }

        if ($this->role_id == 2) {
            $avatar = asset('public/images/icon_user.png');
        }

        return $avatar;
    }

    public function label_phones()
    {
        $text_phones = '';
        if ($this->phones) {
            $phones = json_decode($this->phones, true);
            foreach ($phones as $label => $phone) {
                $text_phones .= '<strong>'.trans('app.'.$label).'</strong>: '.$phone.', ';
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

    public function isOnline()
    {
        switch($this->online) {
            case true:
                $class = '<span class="badge bg-nav badge-green">&nbsp;</span>';
                break;

            case false:
                $class = '<span class="badge badge-gray">&nbsp;</span>';
                break;

            default:
                $class = '<span class="badge">&nbsp;</span>';
        }

        return $class;
    }

    public function timeLogin() {
        $time = '';
        if ( $this->last_login ) {
            $date1 = new DateTime(Carbon::now());
            $date2 = new DateTime($this->last_login);
            $diff = $date1->diff($date2);

            if( $diff->d) {
                $time.= trans('app.old').$diff->d.trans('app.days_and');
            }
            if( $diff->h) {
                $time.= $diff->h.trans('app.hours_and');
            }
            $time.= $diff->i.trans('app.seconds');
        }

        return  $time;
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

    public function count_friends() 
    {
        $count = 0;
        if($this->client_friends) {
            foreach ($this->client_friends as $key => $value) {
                if($value->registered){
                    $count++;
                }
            }
        } 

        return $count;
    }

    public function last_order() 
    {
        $order = '';
        if($this->order) {
            $order .= isset($this->order->last()->created_at) ? $this->order->last()->created_at : '0';
        } 

        return $order;
    }

    public function countCoupon() 
    {
        $count = 0;
        if($this->client_coupon) {
            $count = $this->client_coupon->count();
        } 

        return $count;
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

    public function order()
    {
        return $this->hasMany(Order::class, 'client_id');
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

    public function qualification()
    {
        return $this->hasOne(Qualification::class, 'user_id');
    }

    public function client_friends()
    {
        return $this->hasMany(ClientFriends::class, 'user_id');
    }

    public function driver_comission()
    {
        return $this->hasOne(DriverComission::class, 'user_id');
    }

    public function driver_shedules()
    {
        return $this->hasMany(DriverShedule::class, 'user_id');
    }

}
