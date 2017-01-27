<?php

namespace App\Repositories\Notification;

use App\Notification;
use App\Repositories\Repository;
use Auth;

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
  
    /**
     * get count Notification driver
     */
    public function countNotificationDriver($driver)
    {      
        $result['count'] = $this->model->where('driver_id', $driver)
                                        ->where('read_on', false)->count();
        
        return $result;
    }

    /**
     * get count Notification supervisor
     */
    public function countNotificationSupervisor()
    {      
        $result['count'] = $this->model->where('driver_id', null)
                                       ->where('read_on', false)->count();
        
        return $result;
    }
}