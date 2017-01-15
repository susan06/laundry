<?php

namespace App\Repositories\Driver;

use App\DriverActivity;
use App\Repositories\Repository;

class EloquentDriverActivity extends Repository implements DriverActivityRepository
{
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
    public function __construct(DriverActivity $activity)
    {
        parent::__construct($activity, $this->attributes);
    }
  
    //
}