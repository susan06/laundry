<?php

namespace App\Repositories\Coupon;

use App\Coupon;
use App\Repositories\RepositoryInterface;

interface CouponRepository extends RepositoryInterface
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
     * create client copuon
     *
     *
     */
    public function create_client_coupon(array $attributes);

}