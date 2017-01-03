<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\Support\BranchOffice\BranchServicesStatus;

class ServiceBranchOffice extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'branch_office_services';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'price', 'branch_office_id'
    ];

    /**
     * Field type
     *
     * @var array
     */
    protected $casts = [
        'price' => 'double'
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
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d-m-Y G:ia');
    }

  	public function labelClass()
    {
        switch($this->status) {
            case BranchServicesStatus::AVAILABLE:
                $class = 'success';
                break;

            case BranchServicesStatus::NOTAVAILABLE:
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

     public function branchOffice()
    {
        return $this->belongsTo(BranchOffice::class, 'branch_office_id');
    }
}
