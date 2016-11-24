<?php

namespace App\Repositories\Coupon;

use App\Coupon;
use App\Repositories\Repository;

class EloquentCoupon extends Repository implements CouponRepository
{
	 /**
     * Fields attributes
     *
     * @var array
     */
    protected $attributes = ['validity', 'percentage'];

    /**
     * EloquentCoupon constructor
     *
     * @param Coupon $Coupon
     */
    public function __construct(Coupon $Coupon)
    {
        parent::__construct($Coupon, $this->attributes);
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
        $result = $this->model;
        if ($search) {
            $searchTerms = explode(" ", preg_replace("/\s+/", " ", $search));
    
            $result = Coupon::where( function ($q) use($searchTerms) {
                foreach ($searchTerms as $term) {
                    $q->orwhere("percentage", "like", "%{$term}%");
                    $q->orwhere("validity", "like", "{$term}");
                }
            })->paginate($take)->appends(['search' => $search]);
        } 

        if ($status) {
            $result = $this->model->where('status', $status);
        }

        $result = $result->paginate($take);

        if ($search) {
            $result->appends(['search' => $search]);
        }

        if ($status) {
            $result->appends(['status' => $status]);
        }

        
        return $result;
    }

}