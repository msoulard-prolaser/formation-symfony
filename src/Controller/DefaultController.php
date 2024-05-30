<?php

namespace App\Controller;

use App\Dto\Contact;
use App\Form\ContactType;
use App\Repository\MovieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'app_default_index')]
    public function index(MovieRepository $repository): Response
    {
        $movies = $repository->findBy([], ['id' => 'DESC'], 6);
        return $this->render('default/index.html.twig', [
            'controller_name' => 'Index',
            'movies' => $movies
        ]);
    }

    #[Route('/contact', name: 'app_default_contact')]
    public function contact(): Response
    {
        $book = new Contact();
        $form = $this->createForm(ContactType::class, $book);

        return $this->render('default/contact.html.twig', [
            'form' => $form,
        ]);
    }
}
