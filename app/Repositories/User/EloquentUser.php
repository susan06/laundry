<?php

namespace App\Repositories\User;

use App\User;
use App\Role;
use App\Repositories\Repository;

class EloquentUser extends Repository implements UserRepository
{
	 /**
     * Fields attributes
     *
     * @var array
     */
    protected $attributes = ['name', 'lastname', 'email'];

    /**
     * EloquentUser constructor
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        parent::__construct($user, $this->attributes);
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
        $query = User::whereHas(
                'role', function($q){
                    $q->where('name','!=', 'client');
                    $q->where('name','!=', 'driver');
                }
            );

        if ($search) {
            $searchTerms = explode(' ', $search);
            $query->where( function ($q) use($searchTerms) {
                foreach ($searchTerms as $term) {
                    $q->orWhereHas('role', function($qu) use($term) {
                        $qu->orwhere('name', "like", "%{$term}%");
                        $qu->orwhere('display_name', "like", "%{$term}%");
                    });
                    foreach ($this->attributes as $attribute) {
                        $q->orwhere($attribute, "like", "%{$term}%");
                    }
                }
            });
        }

        if ($status) {
            $query->where('status', $status);
        }

        $result = $query->paginate($take);

        if ($search) {
            $result->appends(['search' => $search]);
        }

        if ($status) {
            $result->appends(['status' => $status]);
        }

        return $result;
    }

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
    public function client_paginate_search($take = 10, $search = null, $status = null)
    {
        $query = User::where('role_id', 2);

        if ($search) {
            $searchTerms = explode(' ', $search);
            $query->where( function ($q) use($searchTerms) {
                foreach ($searchTerms as $term) {
                   foreach ($this->attributes as $attribute) {
                        $q->orwhere($attribute, "like", "%{$term}%");
                    }
                }
            });
        }

        if ($status) {
            $query->where('status', $status);
        }


        $result = $query->paginate($take);

        if ($search) {
            $result->appends(['search' => $search]);
        }

        if ($status) {
            $result->appends(['status' => $status]);
        }

        return $result;
    }

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
    public function driver_paginate_search($take = 10, $search = null, $status = null)
    {
        $query = User::where('role_id', 3);

        if ($search) {
            $searchTerms = explode(' ', $search);
            $query->where( function ($q) use($searchTerms) {
                foreach ($searchTerms as $term) {
                   foreach ($this->attributes as $attribute) {
                        $q->orwhere($attribute, "like", "%{$term}%");
                    }
                }
            });
        }

        if ($status) {
            $query->where('status', $status);
        }


        $result = $query->paginate($take);

        if ($search) {
            $result->appends(['search' => $search]);
        }

        if ($status) {
            $result->appends(['status' => $status]);
        }



        return $result;
    }

     /**
     * lists representative
     */
    public function lists_representative()
    {
        $result = array();
        $role = Role::where('name','branch-representative')->first();
        $users = User::where('role_id', $role->id)->get();
        foreach ($users as $user) {
            $result[$user->id] = $user->full_name();
        }

        return $result;
    }

    /**
     * lists representative actives
     */
    public function lists_representative_active()
    {
        $result = array();
        $role = Role::where('name','branch-representative')->first();
        $users = User::where('role_id', $role->id)->get();
        foreach ($users as $user) {
            if(!$user->branchOffice){
                $result[$user->id] = $user->full_name();
            }
        }
        
        return $result;
    }

     /**
     * Find user by confirmation token.
     *
     * @param $token
     * @return mixed
     */
    public function findByConfirmationToken($token)
    {
        return $this->model->where('confirmation_token', $token)->first();
    }

    /**
     * Client Paginate and search with coupons
     *
     *
     * @param int $take
     * @param string $search
     *
     * @return mixed
     *
     */
    public function client_coupon_paginate_search($take = 10, $search = null)
    {
        $query = User::where('role_id', 2);

        if ($search) {
            $searchTerms = explode(' ', $search);
            $query->where( function ($q) use($searchTerms) {
                foreach ($searchTerms as $term) {
                    $q->orwhere('name', "like", "%{$term}%");
                    $q->orwhere('lastname', "like", "%{$term}%");
                }
            });
        }

        $result = $query->paginate($take);

        if ($search) {
            $result->appends(['search' => $search]);
        }

        return $result;
    }

    /**
     * Find user by email.
     *
     * @param $token
     */
    public function findByEmail($email)
    {
        return $this->model->where('email', $email)->first();
    }

    /**
     * lists clients potencial send coupons
     */
    public function client_send_coupon()
    {
        $result = array();
        $role = Role::where('name','client')->first();
        $users = User::where('role_id', $role->id)->get();
        foreach ($users as $user) {
            $result[$user->id] = $user->full_name().' - correo: '.$user->email.' Cupones enviados: '.$user->countCoupon().' - última solicitud: '.$user->last_order().' - Amigos registrados: '.$user->count_friends();
        }

        return $result;
    }

}