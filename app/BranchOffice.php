<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\Support\BranchOffice\BranchOfficeStatus;

class BranchOffice extends Model
{
   /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'branch_offices';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'phone', 'representative_id', 'status', 'created_by'
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
            case BranchOfficeStatus::SERVICE:
                $class = 'success';
                break;

            case BranchOfficeStatus::OUTSERVICE:
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
    public function representative()
    {
        return $this->belongsTo(User::class, 'representative_id');
    }

    public function locations()
    {
        return $this->hasMany(LocationBranchOffice::class, 'branch_office_id');
    }
}
