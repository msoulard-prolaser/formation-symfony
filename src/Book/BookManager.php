<?php

namespace App\Book;

use App\Entity\Book;
use App\Repository\BookRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\Attribute\Autowire;

class BookManager
{
    public function __construct(
        private readonly EntityManagerInterface $manager,
        #[Autowire(param: 'app.books_per_page')]
        private readonly int $limit
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

    public function getBookListPaginated(int $offset): iterable
    {
        return $this->manager->getRepository(Book::class)->findBy([], [], $this->limit, $offset);
    }
}