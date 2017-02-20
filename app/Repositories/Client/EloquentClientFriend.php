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

    /**
     * chart get friend invited
     */
    public function chart_friend_invited($client = null)
    {
        $result = array();
        $query = ClientFriends::query();

        if($client) {
            $result = $query->where('user_id', $client);
        }

        $result = $query->get();

        $data[] = ['label' => 'total' , 'value' => $result->count()];

        $total = 0; 
        foreach ($result as $key => $value) {
            if($value->registered){
              $total++;  
            }
        }

        $data[] = ['label' => 'registrados' , 'value' => $total];
  
        return $data;
    }


}