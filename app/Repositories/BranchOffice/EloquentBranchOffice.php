<?php

namespace App\Repositories\BranchOffice;

use App\BranchOffice;
use App\LocationBranchOffice;
use App\Repositories\Repository;

class EloquentBranchOffice extends Repository implements BranchOfficeRepository
{
	 /**
     * Fields attributes
     *
     * @var array
     */
    protected $attributes = ["name", "phone"];

    /**
     * EloquentBranchOffice constructor
     *
     * @param BranchOffice $branch_offices
     */
    public function __construct(BranchOffice $branch_offices)
    {
        parent::__construct($branch_offices, $this->attributes);
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
    public function paginate_search($take = 10, $search = null)
    {
        if ($search) {
            $searchTerms = explode(" ", preg_replace("/\s+/", " ", $search));
    
            $result = BranchOffice::where( function ($q) use($searchTerms) {
                foreach ($searchTerms as $term) {
                    $q->whereHas('representative', function($q) use($term) {
                        $q->where("name", "like", "%{$term}%");
                        $q->orwhere("lastname", "like", "%{$term}%");
                    });
                    $q->orwhere("name", "like", "%{$term}%");
                    $q->orwhere("phone", "like", "%{$term}%");
                }
            })->paginate($take)->appends(['search' => $search]);
        } else {
            $result = $this->model->paginate($take);

        }

        return $result;
    }

    /**
     *
     * Creates a new location.
     *
     * @param array $attributes
     *
     * @return Model
     *
     */
    public function create_location(array $attributes)
    {
        LocationBranchOffice::create($attributes);
    }

     /**
     *
     * Update the location
     *
     * @param $id
     * @param array $newData
     */
    public function update_location($id, array $newData)
    {
        LocationBranchOffice::where('id', $id)->update($newData);
    }

    /**
     *
     * Delete the location
     *
     * @param $id
     * @param array $newData
     */
    public function delete_location($id)
    {
        LocationBranchOffice::destroy($id);
    }

}