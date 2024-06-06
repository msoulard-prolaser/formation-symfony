<?php

namespace App\Security\Voter;

use App\Entity\Book;
use App\Entity\Movie;
use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class MovieEditVoter extends Voter
{

    public const EDIT = 'movie.show';

    protected function supports(string $attribute, mixed $subject): bool
    {
        return $subject instanceof Movie && $attribute === self::EDIT;
    }

    /**
     * @inheritDoc
     */
    protected function voteOnAttribute(string $attribute, mixed $subject, TokenInterface $token): bool
    {
        if($token->getUser() instanceof User){
            $user = $token->getUser();
        }
        $age = $user->getBirthday()?->diff(new \DateTimeImmutable())->y ?? null;
        $arrayRated = explode('-', $subject->getRated());
        if(count($arrayRated) > 1){
            return (int)$arrayRated[1] <= (int)$age;
        }
    }
}