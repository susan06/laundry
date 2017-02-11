<?php

namespace App\Mailers;

use App\User;
use App\Coupon;

class UserMailer extends AbstractMailer
{
    public function sendConfirmationEmail($user, $token)
    {
        $view = 'emails.registration.confirmation';
        $data = ['token' => $token];
        $subject = trans('app.registration_confirmation');

        $this->sendTo($user->email, $subject, $view, $data);
    }

    public function sendPasswordReminder(User $user, $token, $admin = 'false')
    {
        $view = 'emails.password.remind';
        $data = ['user' => $user, 'token' => $token, 'admin' => $admin];
        $subject = trans('app.password_reset_required');

        $this->sendTo($user->email, $subject, $view, $data);
    }

    public function sendCoupon(User $user, Coupon $coupon)
    {
        $view = 'emails.coupons.send';
        $data = ['user' => $user, 'coupon' => $coupon];
        $subject = trans('app.coupon_winnier');

        $this->sendTo($user->email, $subject, $view, $data);
    }
}