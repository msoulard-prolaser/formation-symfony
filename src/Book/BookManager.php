<?php

namespace App\Book;

use App\Entity\Book;
use App\Repository\BookRepository;
use Doctrine\ORM\EntityManagerInterface;

class BookManager
{
    public function __construct(
        private readonly EntityManagerInterface $manager,
    ){}

    public function getOneByTitle(string $title): Book
    {
        /** @var BookRepository $repository **/
        $repository = $this->manager->getRepository(Book::class);
        return $repository->findByApproxTitle($title)[0];
    }

    public function getBookList(): Iterable
    {
        return $this->manager->getRepository(Book::class)->findAll();
    }
}