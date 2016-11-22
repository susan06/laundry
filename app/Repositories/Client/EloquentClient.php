<?php

namespace App\Repositories\Client;

use App\User;
use App\ClientSetting;
use App\Repositories\Repository;

class EloquentClient extends Repository implements ClientRepository
{
	 /**
     * Fields attributes
     *
     * @var array
     */
    protected $attributes = ['name', 'lastname', 'email'];

    /**
     * EloquentClient constructor
     *
     * @param Client $Client
     */
    public function __construct(User $client)
    {
        parent::__construct($client, $this->attributes);
    }

  
     /**
     * lists locations labels
     *
     * @param int $client
     */
    public function lists_locations_labels($client)
    {
        $setting = ClientSetting::where('user_id', $client)->first();

        return json_decode($setting->locations_labels, true);
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
    public function paginate_search($take = 10, $search = null)
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

}