<?php

namespace App\Repositories\Client;

use App\Repositories\RepositoryInterface;

interface ClientFriendRepository extends RepositoryInterface
{
	/**
     * chart get friend invited
     */
    public function chart_friend_invited($client = null);

}