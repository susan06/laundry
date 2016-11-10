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

}