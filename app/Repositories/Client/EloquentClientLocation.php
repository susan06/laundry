<?php

namespace App\Repositories\Client;

use App\ClientLocation;
use App\ClientSetting;
use App\Repositories\Repository;

class EloquentClientLocation extends Repository implements ClientLocationRepository
{
	 /**
     * Fields attributes
     *
     * @var array
     */
    protected $attributes = ['address', 'description'];

    /**
     * EloquentClientLocation constructor
     *
     * @param ClientLocation $clientLocation
     */
    public function __construct(ClientLocation $clientLocation)
    {
        parent::__construct($clientLocation, $this->attributes);
    }

}