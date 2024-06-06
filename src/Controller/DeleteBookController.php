<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_ADMIN')]
#[Route('/book/{id<\d+>}/delete', name : 'app_book_delete')]
class DeleteBookController extends AbstractController
{
    public function __invoke(int $id): Response
    {
        //$this->denyAccessUnlessGranted('ROLE_ADMIN');

        return new JsonResponse([
            'message' => 'delete book',
            'id' => $id,
        ]);
    }

}