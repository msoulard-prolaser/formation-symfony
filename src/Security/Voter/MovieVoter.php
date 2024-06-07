<?php

namespace App\Security\Voter;

use App\Entity\Book;
use App\Entity\Movie;
use App\Entity\User;
use App\Movie\Event\MovieRenderageEvent;
use App\Repository\MovieRepository;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

class MovieVoter extends Voter
{

    public const EDIT = 'movie.edit';
    public const VIEW = 'movie.view';

    public function __construct(
        private readonly EventDispatcherInterface $dispatcher,
    ){}


    protected function supports(string $attribute, mixed $subject): bool
    {
        return $subject instanceof Movie && \in_array($attribute, [self::EDIT, self::VIEW]);
    }

    /**
     * @inheritDoc
     */
    protected function voteOnAttribute(string $attribute, mixed $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();
        if(!$user instanceof User){
            return false;
        }


        $vote =  match ($attribute) {
            self::EDIT => $this->checkEdit($subject, $user),
            self::VIEW => $this->checkView($subject, $user),
            default => false,
        };

        return $vote;

    }
    public function checkView(Movie $movie, User $user): bool
    {
        if("G" === $movie->getRated()){
            return true;
        }

        $age = $user->getBirthday()?->diff(new \DateTimeImmutable())->y ?? null;
        $vote =  match ($movie->getRated()) {
            'PG', 'PG-13' => $age && $age >= 13,
            'R', 'NC-17' => $age && $age >= 17,
            default => false,
        };

        if(!$vote){
            $this->dispatcher->dispatch(new MovieRenderageEvent($movie, $user));
        }

        return $vote;
    }

    public function checkEdit(Movie $movie, User $user): bool
    {
        return $this->checkView($movie, $user) && $movie->getCreatedBy() === $user;
    }
}