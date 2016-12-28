<?php

namespace App\Repositories\Client;

use App\ClientFriends;
use App\Repositories\Repository;

class EloquentClientFriend extends Repository implements ClientFriendRepository
{
	 /**
     * Fields attributes
     *
     * @var array
     */
    protected $attributes = [];

    /**
     * EloquentClientFriend constructor
     *
     * @param ClientFriend $clientfriend
     */
    public function __construct(ClientFriends $clientfriend)
    {
        parent::__construct($clientfriend, $this->attributes);
    }


}