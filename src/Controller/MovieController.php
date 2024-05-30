<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/movie')]
class MovieController extends AbstractController
{
    #[Route('/', name: 'app_movie_index')]
    public function index(): Response
    {
        return $this->render('movie/index.html.twig', [
            'controller_name' => 'MovieController',
        ]);
    }

    #[Route('/{id<\d+>}', name: 'app_movie_show')]
    public function show(int $id): Response
    {
        $movie = [
            'id' => $id,
            'title' => 'Star Wars - Episode IV : A new Hope',
            'country' => 'United States',
            'releasedAt' => new \DateTimeImmutable('25-05-1977'),
            'genres' => [
                'Action',
                'Adventure',
                'Fantasy',
            ],
        ];

        return $this->render('movie/show.html.twig', [
            'movie' => $movie
        ]);
    }

    public function lastMovies(): Response
    {
        $lastMovies = [
            ['title' => '1984'],
            ['title' => 'The Matrix'],
        ];
        return $this->render('includes/_last_movies.html.twig', [
            'last_movies' => $lastMovies,
        ]);
    }
}
