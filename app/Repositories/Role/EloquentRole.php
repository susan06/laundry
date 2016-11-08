<?php

namespace App\Repositories\Role;

use App\Role;
use App\Repositories\Repository;

class EloquentRole extends Repository implements RoleRepository
{

    public function __construct(Role $Role)
    {
        parent::__construct($Role);
    }

}