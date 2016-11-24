<?php

namespace App\Repositories\Package;

use App\PackagePrice;
use App\Repositories\Repository;

class EloquentPackagePrice extends Repository implements PackagePriceRepository
{
	 /**
     * Fields attributes
     *
     * @var array
     */
    protected $attributes = ['price'];

    /**
     * EloquentPackage constructor
     *
     * @param Package $Package
     */
    public function __construct(PackagePrice $price)
    {
        parent::__construct($price, $this->attributes);
    }

    //

}