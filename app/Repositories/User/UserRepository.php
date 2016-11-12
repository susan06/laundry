<?php

namespace App\Repositories\User;

use App\User;
use \Laravel\Socialite\Contracts\User as SocialUser;
use App\Repositories\RepositoryInterface;

interface UserRepository extends RepositoryInterface
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
    public function paginate_search($take = 10, $search = null);

     /**
     * Client Paginate and search
     *
     * return the result paginated for the take value and with the attributes.
     *
     * @param int $take
     * @param string $search
     *
     * @return mixed
     *
     */
    public function client_paginate_search($take = 10, $search = null);

    /**
     * Driver Paginate and search
     *
     * return the result paginated for the take value and with the attributes.
     *
     * @param int $take
     * @param string $search
     *
     * @return mixed
     *
     */
    public function driver_paginate_search($take = 10, $search = null);

     /**
     * lists representative
     */
    public function lists_representative();
}