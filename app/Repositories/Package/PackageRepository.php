<?php

namespace App\Repositories\Package;

use App\Repositories\RepositoryInterface;

interface PackageRepository extends RepositoryInterface
{
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
    public function paginate_search($take = 10, $search = null, $status = null);

     /**
     * Create category
     *
     *
     * @param array $attributes
     *
     * @return Model
     *
     */
    public function create_category(array $attributes);

    /**
     * Update category
     *
     *
     * @param $id
     * @param array $newData
     */
    public function update_category($id, array $newData);

    /**
     * Destroy category
     *
     *
     * @param $id
     */
    public function delete_category($id);

    /**
     * lists
     *
     * @param string $column
     * @param string $key
     */
    public function lists_categories($column = 'name', $key = 'id');
}