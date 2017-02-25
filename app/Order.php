<?php

namespace App;

use Carbon\Carbon;
use DateTime;
use Settings;
use Illuminate\Database\Eloquent\Model;
use App\Support\Order\OrderStatus;

class Order extends Model
{
     /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'orders';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'bag_code',
        'quantity',
    	'client_id', 
        'driver_id',
    	'client_location_id',
    	'client_coupon_id', 
        'branch_offices_id',
        'branch_offices_location_id',
        'date_search', 
        'time_search', 
        'date_delivery', 
        'time_delivery', 
        'special_instructions', 
        'discount', 
        'sub_total',
        'total',
        'status',
        'note'
    ];

    /**
     * Functions
     *
     */

    public function getCreatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d-m-Y G:ia');
    }

    public function getUpdatedAtAttribute($date)
    {
        if($date) {
            return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d-m-Y G:ia');
        }
    }

    public function setDateSearchAttribute($value)
    {
        $this->attributes['date_search'] = date_format(date_create($value), 'Y-m-d');
    }

    public function setDateDeliveryAttribute($value)
    {
        $this->attributes['date_delivery'] = date_format(date_create($value), 'Y-m-d');
    }

    public function getDateSearchAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d', $date)->format('d-m-Y');
    }

    public function getDateDeliveryAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d', $date)->format('d-m-Y');
    }

    public function get_time_search($time = null)
    {
        if(Settings::get('working_hours')) {
            $working_hours = json_decode(Settings::get('working_hours'), true);
        } else {
            $working_hours = array();
        }

        $time_search = null;
        if($time) {
            $search_time = $time;
        } else {
            $search_time = $this->time_search;
        }
        foreach ($working_hours as $key => $working_hour) {
            if($working_hour['id'] == $search_time) {
                $time_search = $working_hour['interval'];
            }
        }

        return $time_search;
    }

    public function get_date_search()
    {
        if(Settings::get('working_hours')) {
            $working_hours = json_decode(Settings::get('working_hours'), true);
        } else {
            $working_hours = array();
        }

        $time_search = false;
        foreach ($working_hours as $key => $working_hour) {
            if($working_hour['id'] == $this->time_search) {
                $time_search = $this->date_search.' '.$working_hour['start'];
                if(date('Y-m-d H:i') <= $time_search) {
                    $time_search = Carbon::createFromFormat('d-m-Y h:i A', $time_search)->format('Y-m-d H:i');
                } else {        
                    $time_search = true; 
                }
            }
        }

        return $time_search;
    }

    public function before_hour_search()
    {
        date_default_timezone_set(Settings::get('timezone'));

        if(Settings::get('working_hours')) {
            $working_hours = json_decode(Settings::get('working_hours'), true);
        } else {
            $working_hours = array();
        }

        $time_search = null;
        foreach ($working_hours as $key => $working_hour) {
            if($working_hour['id'] == $this->time_search) {
                $time_search = $this->date_search.' '.$working_hour['start'];
            }
        }
        $date_search = Carbon::createFromFormat('d-m-Y h:i A', $time_search)->format('Y-m-d H:i');
        $date1 = new DateTime(Carbon::now()->format('Y-m-d H:i'));
        $date2 = new DateTime($date_search);
        $diff = $date2->diff($date1);
        $time = 0;
        if( date('Y-m-d H:i') <= $date_search ) {
            $time = $diff->h;
        }

        return $time;
    }

     public function get_time_delivery($time = null)
    {
        if(Settings::get('delivery_hours')) {
            $time_deliveries = json_decode(Settings::get('delivery_hours'), true);
        } else {
            $time_deliveries = array();
        }

        $time_delivery = null;
        if($time) {
            $search_time = $time;
        } else {
            $search_time = $this->time_delivery;
        }
        foreach ($time_deliveries as $key => $time) {
            if($time['id'] == $search_time) {
                $time_delivery = $time['interval'];
            }
        }

        return $time_delivery;
    }

    public function getStatus()
    {
        switch($this->status) {
            case OrderStatus::search:
                $class = '<span class="label label-danger">'.trans("app.{$this->status}").'</span>';
                break;

            case OrderStatus::recoge:
                $class = '<span class="label label-warning">'.trans("app.{$this->status}").'</span>';
                break;

            case OrderStatus::inbranch:
                $class = '<span class="label label-info">'.trans("app.{$this->status}").'</span>';
                break;

            case OrderStatus::inexit:
                $class = '<span class="label label-success">'.trans("app.{$this->status}").'</span>';
                break;

            case OrderStatus::branch_finish:
                $class = '<span class="label label-warning">'.trans("app.{$this->status}").'</span>';
                break;

            case OrderStatus::change_branch:
                $class = '<span class="label label-danger">'.trans("app.{$this->status}").'</span>';
                break;

            case OrderStatus::delivered:
                $class = '<span class="label label-success">'.trans("app.{$this->status}").'</span>';
                break;

            default:
                $class = '<span class="label label-warning">'.trans("app.{$this->status}").'</span>';
        }

        return $class;
    }

    public function toArray()
    {
        $array = parent::toArray();

        if(isset($array['time_search'])) {
            $array['name'] = $this->get_time_search($array['time_search']);
        }

        if(isset($array['time_delivery'])) {
            $array['name'] = $this->get_time_delivery($array['time_delivery']);   
        }

        if(isset($array['branch_offices_id'])) {
            $array['name'] = BranchOffice::find($array['branch_offices_id'])->name;   
        }

        return $array;
    }

    /**
     * Relationships
     *
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function driver()
    {
        return $this->belongsTo(User::class, 'driver_id');
    }

    public function client_location()
    {
        return $this->belongsTo(ClientLocation::class, 'client_location_id');
    }

    public function order_package()
    {
        return $this->hasMany(OrderPackage::class, 'order_id');
    }

    public function order_payment()
    {
        return $this->hasOne(OrderPayment::class, 'order_id');
    }

    public function order_penalty()
    {
        return $this->hasOne(OrderPenalty::class, 'order_id');
    }

    public function client_coupon()
    {
        return $this->belongsTo(ClientCoupon::class, 'client_coupon_id');
    }

    public function coupon()
    {
        return $this->hasManyThrough(
            Coupon::class, 
            ClientCoupon::class, 
            'coupon_id',
            'id',
            'client_coupon_id'
        );
    }

    public function branch_office()
    {
        return $this->belongsTo(BranchOffice::class, 'branch_offices_id');
    }

    public function location_branch()
    {
        $location_branch = LocationBranchOffice::find($this->branch_offices_location_id);

        return $location_branch;
    }

}
