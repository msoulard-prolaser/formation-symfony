<?php

namespace App\Movie;

use App\Entity\Movie;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\Attribute\Autowire;

class MovieManager
{
    public function __construct(
        private readonly EntityManagerInterface $manager,
        #[Autowire(param: 'app.items_per_page')]
        private readonly int $limit
    ){}

    public function getMovieList(): Iterable
    {
        return $this->manager->getRepository(Movie::class)->findAll();
    }
}