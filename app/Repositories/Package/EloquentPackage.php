<?php

namespace App\Repositories\Package;

use DB;
use App\Package;
use App\PackageCategory;
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
     * Update price
     *
     *
     * @param $id
     * @param array $newData
     */
    public function update_price($id, array $newData)
    {
        return $this->prices->update($id, $newData);
    }

    /**
     * Paginate and search categories
     *
     * return the result paginated for the take value and with the attributes.
     *
     * @param int $take
     * @param string $search
     *
     * @return mixed
     *
     */
    public function paginate_search_categories($take = 10, $search = null, $status = null)
    {
        return $this->categories->paginate_search($take, $search, $status);
    } 

    /**
     * Find category
     *
     *
     * @param int $id
     *
     * @return Model
     *
     */
    public function find_category($id)
    {
        return $this->categories->find($id);
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
     * Can Destroy category
     *
     * @param $id
     */
    public function can_delete_category($id)
    {
        if (!is_null($this->categories->find($id)->package)) {
            return [
                'success'   => false,
                'message' => 'La categoria no puede eliminarse porque esta asociada a uno o más paquete'
            ];
        }

        $this->categories->delete($id);

        return ['success' => true];
    }

    /**
     * lists
     *
     * @param string $column
     * @param string $key
     */
    public function lists_categories($column = 'name', $key = 'id')
    {
        return PackageCategory::all()->sortBy($column)->pluck($column, $key)->all();
    }

    /**
     * lists actives categories
     *
     * @param string $column
     * @param string $key
     */
    public function lists_categories_actives($column = 'name', $key = 'id')
    {
        return PackageCategory::all()->sortBy($column)->where('status', 1)->pluck($column, $key)->all();
    }

    /**
     * get categories
     *
     */
    public function categories()
    {
        return PackageCategory::where('status', 1)->get();
    }

}