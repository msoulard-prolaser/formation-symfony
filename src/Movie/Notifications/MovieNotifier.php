<?php

namespace App\Movie\Notifications;

use App\Entity\User;
use App\Movie\Notifications\Factory\NotificationFactoryInterface;
use Symfony\Component\DependencyInjection\Attribute\TaggedIterator;
use Symfony\Component\Notifier\NotifierInterface;
use Symfony\Component\Notifier\Recipient\Recipient;
use function Symfony\Component\DependencyInjection\Loader\Configurator\iterator;

class MovieNotifier
{
    /** @var NotificationFactoryInterface[]  */
    private iterable $factories;
    public function __construct(
        private readonly NotifierInterface $notifier,
        #[TaggedIterator(tag: 'app.notification_factory', defaultIndexMethod: 'getIndex')]
        iterable $factories,
    ){
        $this->factories = $factories instanceof \Traversable ? iterator_to_array($factories) : $factories;
    }
    public function sendNotification(string $title, User $user): void
    {
        $msg = sprintf('The movie %s has been added to our database!', $title);
        /** @var NotificationFactoryInterface $factories */
        $notification = $this->factories[$user->getPreferredChannel()]->createNotification($msg);

        $this->notifier->send($notification, new Recipient($user->getEmail()));
    }
}