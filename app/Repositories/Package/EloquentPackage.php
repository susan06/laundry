<?php

namespace App\Repositories\Package;

use App\Package;
use App\Repositories\Package\PackageCategoryRepository;
use App\Repositories\Package\PackagePriceRepository;
use App\Repositories\Repository;

class EloquentPackage extends Repository implements PackageRepository
{
	 /**
     * Fields attributes
     *
     * @var array
     */
    protected $attributes = ['name'];

    /**
     * @var PackagePriceRepository
     */
    protected $prices;

     /**
     * @var PackageCategoryRepository
     */
    protected $categories;

    /**
     * EloquentPackage constructor
     *
     * @param Package $Package
     */
    public function __construct(
        Package $package, 
        PackagePriceRepository $prices, 
        PackageCategoryRepository $categories
    )
    {
        parent::__construct($package, $this->attributes);
        $this->prices = $prices;
        $this->categories = $categories;
    }

    /**
     * Paginate and search
     *
     * return the result paginated for the take value and with the attributes.
     *
     * @param int $take
     * @param string $search
     *
     * @return mixed
     *
     */
    public function paginate_search($take = 10, $search = null, $status = null)
    {
        //
    }

}