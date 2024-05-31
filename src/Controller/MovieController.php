<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Form\MovieType;
use App\Repository\MovieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Exception\RepositoryException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    public function show(?Movie $movie): Response
    {
        return $this->render('movie/show.html.twig', [
            'movie' => $movie
        ]);
    }

    public function lastMovies(MovieRepository $repository): Response
    {
        $lastMovies = $repository->findBy([], ['releasedAt' => 'DESC'], 9);
        return $this->render('includes/_last_movies.html.twig', [
            'last_movies' => $lastMovies,
        ]);
    }

    #[Route('/new', name: 'app_movie_new')]
    #[Route('/{id<\d+>}/edit', name: 'app_movie_edit')]
    public function save(?Movie $movie, Request $request, EntityManagerInterface $manager): Response
    {
        $movie ??= new Movie();
        $form = $this->createForm(MovieType::class, $movie);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $manager->persist($movie);
            $manager->flush();

            return $this->redirectToRoute('app_movie_show',
                [
                    'id' => $movie->getId()
                ],
            );
        }

        return $this->render('movie/save.html.twig', [
            'movie' => $movie,
            'form' => $form,
        ]);
    }
}
