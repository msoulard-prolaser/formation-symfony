<?php

namespace App\Security\Voter;

use App\Entity\Book;

use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

//#[AutoconfigureTag(name: 'security.voter', attributes: ['priority' => 300])]
class BookEditVoter extends Voter
{

    public const EDIT = 'book.edit';

    protected function supports(string $attribute, mixed $subject): bool
    {
       return $subject instanceof Book && $attribute === self::EDIT;
    }


    protected function voteOnAttribute(string $attribute, mixed $subject, TokenInterface $token): bool
    {
        return $subject->getCreatedBy() === $token->getUser()
            || \in_array('ROLE_ADMIN', $token->getRoleNames());
    }
}