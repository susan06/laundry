<?php

namespace App\Repositories\Notification;

use App\Notification;
use App\Repositories\Repository;

class EloquentNotification extends Repository implements NotificationRepository
{
	 /**
     * Fields attributes
     *
     * @var array
     */
    protected $attributes = [];

    /**
     * EloquentClient constructor
     *
     * @param Client $Client
     */
    public function __construct(Notification $notifications)
    {
        parent::__construct($notifications, $this->attributes);
    }
  
    //
}