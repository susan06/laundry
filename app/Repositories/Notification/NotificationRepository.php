<?php

namespace App\Repositories\Notification;

use App\Repositories\RepositoryInterface;

interface NotificationRepository extends RepositoryInterface
{
    /**
     * get count Notification driver
     */
    public function countNotificationDriver($driver);

     /**
     * get count Notification supervisor
     */
    public function countNotificationSupervisor();
}