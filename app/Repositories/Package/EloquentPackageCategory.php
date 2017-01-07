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
        $query = PackageCategory::query();

        if ($search) {
            $query->where('name', "like", "%{$search}%");
        }

        if ($status) {
            $query->where('status', '=', $status);
        }

        $result = $query->paginate($take);

        if ($search) {
            $result->appends(['search' => $search]);
        }

        if ($status) {
            $result->appends(['status' => $status]);
        }

        return $result;
    }

}