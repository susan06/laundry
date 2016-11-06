<?php

namespace App\Repositories\User;

use App\User;
use App\Repositories\Repository;

class EloquentUser extends Repository implements UserRepository
{

    public function __construct(User $user)
    {
        parent::__construct($user);
    }

}