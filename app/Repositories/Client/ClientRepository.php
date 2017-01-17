<?php

namespace App\Repositories\Client;

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
     * update locations labels
     *
     * @param int $client
     * @param array $data
     */
    public function update_locations_label($client, $data);
    
     /**
     * lists locations labels
     *
     * @param int $client
     */
    public function lists_locations_labels($client);

    /**
     * create or update location
     *
     * @param int $client_id
     * @param Array $data
     */
    public function create_update_location($client_id, Array $data);

    /**
     * create or update friends
     *
     * @param int $client_id
     * @param Array $data
     * return id of model 
     */
    public function create_friend(Array $data);

    /**
     * find friend
     *
     * @param string $email
     */
    public function find_friend($email);

    /**
     * Paginate friends
     *
     * @param int $take
     *
     */
    public function paginate_friends($take = 10);

     /**
     * update status location
     *
     */
    public function update_status_location($id, $data);

}