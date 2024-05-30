<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/book/{id<\d+>}/delete', name : 'app_book_delete')]
class DeleteBookController
{
    public function __invoke(int $id): Response
    {
        return new JsonResponse([
            'message' => 'delete book',
            'id' => $id,
        ]);
    }

}