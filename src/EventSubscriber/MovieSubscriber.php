<?php

namespace App\EventSubscriber;

use App\Movie\Event\MovieImportEvent;
use App\Movie\Event\MovieRenderageEvent;
use App\Movie\Notifications\MovieNotifier;
use App\Repository\UserRepository;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class MovieSubscriber implements EventSubscriberInterface
{

    public function __construct(
        private readonly MovieNotifier $notifier,
        private readonly UserRepository $userRepository,
    ){}
    public function onMovieImportEvent(MovieImportEvent $event): void
    {
        $user = $this->userRepository->findOneBy([]);
        $this->notifier->sendNotification($event->getMovie()->getTitle(), $user);
    }

    public function onMovieRenderageEvent(MovieRenderageEvent $event): void
    {

    }

    public static function getSubscribedEvents(): array
    {
        return [
            MovieImportEvent::class => 'onMovieImportEvent',
            MovieRenderageEvent::class => 'onMovieRenderageEvent',
        ];
    }
}
