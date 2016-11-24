<?php

namespace App\Repositories\Package;

use App\PackageCategory;
use App\Repositories\Repository;

class EloquentPackageCategory extends Repository implements PackageCategoryRepository
{
	 /**
     * Fields attributes
     *
     * @var array
     */
    protected $attributes = ['name'];

    /**
     * EloquentPackage constructor
     *
     * @param Package $Package
     */
    public function __construct(PackageCategory $category)
    {
        parent::__construct($category, $this->attributes);
    }

    //

}