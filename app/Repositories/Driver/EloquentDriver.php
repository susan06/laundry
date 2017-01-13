<?php

namespace App\Repositories\Driver;

use App\User;
use App\DriverComission;
use App\DriverShedule;
use App\Repositories\Repository;

class EloquentDriver extends Repository implements DriverRepository
{
    /**
     * @var DriverActivityRepository
     */
    protected $activities;

	 /**
     * Fields attributes
     *
     * @var array
     */
    protected $attributes = [];

    /**
     * EloquentClient constructor
     *
     * @param Client $Client
     */
    public function __construct(
        User $driver, 
        DriverActivityRepository $activities
    )
    {
        parent::__construct($driver, $this->attributes);
        $this->activities = $activities;
    }
  
    /**
     * update comission
     *
     * @param array $newData
     */
    public function update_comission($id, array $newData)
    {
        $model = DriverComission::find($id);
        $model->update($newData);

        return $model;
    }

    /**
     * update shedule
     *
     * @param array $newData
     */
    public function update_shedule($id, array $newData)
    {
        $model = DriverShedule::find($id);
        $model->update($newData);

        return $model;
    }

}