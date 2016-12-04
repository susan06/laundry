<?php

namespace App\Repositories\Order;

use App\OrderPackage;
use App\Repositories\Repository;

class EloquentOrderPackage extends Repository implements OrderPackageRepository
{
	 /**
     * Fields attributes
     *
     * @var array
     */
    protected $attributes = [];

    /**
     * EloquentOrderPackage constructor
     *
     * @param OrderPackage $package
     */
    public function __construct(OrderPackage $package)
    {
        parent::__construct($package, $this->attributes);
    }

    //

}