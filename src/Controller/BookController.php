<?php

namespace App\Controller;

use App\Book\BookManager;
use App\Entity\Book;
use App\Entity\Comment;
use App\Form\BookType;
use App\Repository\BookRepository;
use App\Security\Voter\BookEditVoter;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
//use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/book')]
class BookController extends AbstractController
{
    #[Route('', name: 'app_book_index')]
    public function index(BookManager $manager): Response
    {
        //$books = $repository->findBy([], ['releasedAt' => 'DESC'], 9);
        return $this->render('book/index.html.twig', [
            'controller_name' => 'BookController::index',
            'books' => $manager->getBookList(),
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
    #[Route('/{id}/edit', name: 'app_book_edit')]
    public function save(?Book $book, Request $request, EntityManagerInterface $manager): Response
    {
        if($book) {
           $this->denyAccessUnlessGranted(BookEditVoter::EDIT, $book);
        }
        $book ??= new Book();
        $form = $this->createForm(BookType::class, $book);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            dump($book);
            $manager->persist($book);
            $manager->flush();

            return $this->redirectToRoute('app_book_show', [
                'id' => $book->getId()
            ]);
        }
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
