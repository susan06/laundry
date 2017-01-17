<?php

namespace App\Mailers;

use App\User;
use App\Order;

class NotificationMailer extends AbstractMailer
{
    public function newUserRegistration(User $recipient, User $newUser)
    {
        $view = 'emails.notifications.new-registration';
        $data = ['user' => $recipient, 'newUser' => $newUser];
        $subject = 'New User Registration';

        $this->sendTo($recipient->email, $subject, $view, $data);
    }

    public function sendNotificationStatusOrder(Order $order)
    {
        $view = 'emails.notifications.status_order';
        $data = ['order' => $order];
        $subject = 'status of order';

        $this->sendTo($order->user->email, $subject, $view, $data);
    }
}