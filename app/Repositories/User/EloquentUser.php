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
    public function paginate_search($take = 10, $search = null)
    {

        $query = User::whereHas(
                'role', function($q){
                    $q->where('name','!=', 'client');
                }
            );

        if ($search) {
            $searchTerms = explode(' ', $search);
            $query->where( function ($q) use($searchTerms) {
                foreach ($searchTerms as $term) {
                   foreach ($this->attributes as $attribute) {
                        $q->orwhere($attribute, "like", "%{$term}%");
                    }
                    $q->whereHas('role', function($qu) use($term) {
                        $qu->orwhere('name', "like", "%{$term}%");
                        $qu->orwhere('display_name', "like", "%{$term}%");
                    });
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
    public function client_paginate_search($take = 10, $search = null)
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

        $result = $query->paginate($take);

        if ($search) {
            $result->appends(['search' => $search]);
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

}