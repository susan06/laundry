<?php

namespace App\Repositories\Client;

use App\Repositories\RepositoryInterface;

interface ClientRepository extends RepositoryInterface
{
    
     /**
     * lists locations labels
     *
     * @param int $client
     */
    public function lists_locations_labels($client);

}