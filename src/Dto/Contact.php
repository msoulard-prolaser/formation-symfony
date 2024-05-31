<?php

namespace App\Dto;

use phpDocumentor\Reflection\PseudoTypes\HtmlEscapedString;
use Symfony\Component\Validator\Constraints as Assert;

class Contact
{
    public function __construct(
        private ?string $name = null,
        #[Assert\Email]
        private ?string $email = null,
        private ?string $subject = null,
        private ?string $message = null,
    ){}

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    public function getSubject(): ?string
    {
        return $this->subject;
    }

    public function setSubject(?string $subject): void
    {
        $this->subject = $subject;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(?string $message): void
    {
        $this->message = $message;
    }
}