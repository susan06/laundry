<?php

namespace App\Repositories\Client;

use App\User;
use App\ClientSetting;
use App\Repositories\Repository;

class EloquentClient extends Repository implements ClientRepository
{
    /**
     * @var ClientLocationRepository
     */
    protected $locations;

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
    public function __construct(User $client, ClientLocationRepository $locations)
    {
        parent::__construct($client, $this->attributes);
        $this->locations = $locations;
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
     * update locations labels
     *
     * @param int $client
     * @param array $data
     */
    public function update_locations_label($client, $data)
    {
        $location = ClientSetting::where('user_id', $client)->first();
        $setting = $location->update($data);
        
        return $setting;  
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

    /**
     * create or update location
     *
     * @param int $client_id
     * @param Array $data
     * return id of model 
     */
    public function create_update_location($client_id, Array $data)
    {
       $client = $this->model->find($client_id);  

       if ($client->client_location->count() > 0) {
            $location = $client->client_location->reject(function ($item) use($data) {
                if($item->lat == $data['lat'] && $item->lng == $data['lng']) {
                    $item;
                }
            })->values()->first();
            if ($location->id) {
                $data_update = [
                    'address' => isset($data['address']) ? $data['address'] : $location->address,
                    'label' => isset($data['label']) ? $data['label'] : $location->label,
                    'description' => isset($data['description']) ? $data['description'] : $location->description
                ];
                $this->locations->update($location->id, $data_update);
                $location_id = $location->id;
            } else {
                $location = $this->locations->create($data);
                $location_id = $location->id;
            }
       } else {
            $location = $this->locations->create($data);
            $location_id = $location->id;
       }

       return $location_id;
    }

}