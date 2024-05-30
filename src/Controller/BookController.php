<?php

namespace App\Controller;

use App\Entity\Book;
use App\Entity\Comment;
use App\Form\BookType;
use App\Repository\BookRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
//use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/book')]
class BookController extends AbstractController
{
    #[Route('', name: 'app_book_index')]
    public function index(BookRepository $repository): Response
    {
        $books = $repository->findBy([], ['releasedAt' => 'DESC'], 9);
        return $this->render('book/index.html.twig', [
            'controller_name' => 'BookController::index',
            'books' => $books,
        ]);
    }

    #[Route('/{id<\d+>?2}',
        name: 'app_book_show',
        defaults: ['id' => 2],
        methods: ['POST', 'GET'],
        //priority: 1
        //condition: "request.headers.get('x-custom-header') == 'foo'"
    )]
    public function show(BookRepository $repository, int $id): Response
    {
        $book = $repository->find($id);
        return $this->render('book/show.html.twig', [
            'book' => $book,
        ]);
    }
    #[Route ('/new', name: 'app_book_new')]
    public function new(): Response
    {
        $book = new Book();
        $form = $this->createForm(BookType::class, $book);
        //$book = $form->getData();
//        return $this->render('book/show.html.twig', [
//            'controller_name' => 'BookController::new - id :'. $book->getId(),
//            'book' => $book,
//        ]);
        return $this->render('book/new.html.twig', [
            'form' => $form,
        ]);
    }
}
