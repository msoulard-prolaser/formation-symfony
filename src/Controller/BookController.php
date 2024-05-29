<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/book')]
class BookController extends AbstractController
{
    #[Route('', name: 'app_book_index')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/BookController.php',
        ]);
    }

    #[Route('/{id<\d+>?2}',
        name: 'app_book_show',
        defaults: ['id' => 2],
        methods: ['POST', 'GET'],
        //priority: 1
        //condition: "request.headers.get('x-custom-header') == 'foo'"
    )]
    public function show(int $id): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/BookController.php',
	        'id' => $id,
        ]);
    }  
}
