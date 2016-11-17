<?php

namespace App\Repositories\Subscriber;

use App\Subscriber;
use App\Repositories\Repository;

class EloquentSubscriber extends Repository implements SubscriberRepository
{
	 /**
     * Fields attributes
     *
     * @var array
     */
    protected $attributes = [];

    /**
     * EloquentSubscriber constructor
     *
     * @param Subscriber $Subscriber
     */
    public function __construct(Subscriber $subscriber)
    {
        parent::__construct($subscriber, $this->attributes);
    }

}