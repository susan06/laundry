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

}