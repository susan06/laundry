<?php

namespace App\Repositories\Package;

use App\Package;
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
        $query = Package::query();

        if ($search) {
            $searchTerms = explode(' ', $search);
            $query->where( function ($q) use($searchTerms) {
                foreach ($searchTerms as $term) {
                    foreach ($this->attributes as $attribute) {
                        $q->orwhere($attribute, "like", "%{$term}%");
                    }
                    $q->whereHas('package_category', function($qu) use($term) {
                        $qu->orwhere("name", "like", "%{$term}%");
                    });
                }
            });
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

    /**
     * Create price
     *
     *
     * @param array $attributes
     * @return Model
     *
     */
    public function create_price(array $attributes)
    {
        return $this->prices->create($attributes);
    }

    /**
     * Create category
     *
     *
     * @param array $attributes
     * @return Model
     *
     */
    public function create_category(array $attributes)
    {
        return $this->categories->create($attributes);
    }

    /**
     * Update category
     *
     *
     * @param $id
     * @param array $newData
     */
    public function update_category($id, array $newData)
    {
        return $this->categories->update($id, $newData);
    }

    /**
     * Destroy category
     *
     * @param $id
     */
    public function delete_category($id)
    {
        return $this->categories->delete($id);
    }

    /**
     * lists
     *
     * @param string $column
     * @param string $key
     */
    public function lists_categories($column = 'name', $key = 'id')
    {
        return $this->categories->lists($column, $key);
    }

}