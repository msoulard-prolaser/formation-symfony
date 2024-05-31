<?php

namespace App\Movie\Notifications;

use App\Entity\User;
use Symfony\Component\Notifier\NotifierInterface;

class MovieNotifier
{
    public function __construct(
        private readonly NotifierInterface $notifier,
    ){}
    public function sendNotification(string $title, User $user): void
    {
        $msg = sprintf('The movie %s has been added to our database!', $title);
        $this->notifier->send($notification, new Recipient($user->getEmail()));
    }
}