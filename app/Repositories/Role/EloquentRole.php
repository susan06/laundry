<?php

namespace App\Repositories\Role;

use App\Role;
use App\Repositories\Repository;

class EloquentRole extends Repository implements RoleRepository
{
	 /**
     * Fields attributes
     *
     * @var array
     */
    protected $attributes = ['name', 'display_name', 'description'];

    /**
     * EloquentRole constructor
     *
     * @param Role $Role
     */
    public function __construct(Role $Role)
    {
        parent::__construct($Role, $this->attributes);
    }

}