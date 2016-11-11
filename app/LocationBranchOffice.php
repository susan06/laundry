<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LocationBranchOffice extends Model
{
     /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'branch_office_locations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'lat', 'lng', 'address', 'branch_office_id'
    ];

     /**
     * Relationships
     *
     */

     public function branchOffice()
    {
        return $this->belongsTo(BranchOffice::class, 'branch_office_id');
    }
  
}
