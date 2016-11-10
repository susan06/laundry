<?php

namespace App\Repositories\BranchOffice;

use App\BranchOffice;
use App\Repositories\Repository;

class EloquentBranchOffice extends Repository implements BranchOfficeRepository
{
	 /**
     * Fields attributes
     *
     * @var array
     */
    protected $attributes = ['name', 'phone'];

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
            $result = BranchOffice::where( function ($q) use($search) {
                foreach ($this->attributes as $attribute) {
                    $q->orwhere($attribute, "like", "%{$search}%");
                }
                $q->whereHas('representative', function($qu) use($search) {
                    $qu->where('name', "like", "%{$search}%");
                    $qu->where('lastname', "like", "%{$search}%");
                });
            })->paginate($take)->appends(['search' => $search]);
        } else {
            $result = $this->model->paginate($take);

        }

        return $result;
    }

}