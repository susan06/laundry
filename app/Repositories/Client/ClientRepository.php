<?php

namespace App\Repositories\Client;

use App\Client;
use App\Repositories\RepositoryInterface;

interface ClientRepository extends RepositoryInterface
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
     * lists locations labels
     *
     * @param int $client
     */
    public function lists_locations_labels($client);

}