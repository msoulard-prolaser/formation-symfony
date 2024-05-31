<?php

namespace App\Movie\Search;

use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class OmdbApiConsumer
{
    public function __construct(
        private readonly HttpClientInterface $omdbClient
    ){}
    public function fetchmovie(SearchTypes $type, string $value): array
    {
        $data = $this->omdbClient->request(
            'GET',
            '',
            ['query' => [$type->value => $value]]
        )->toArray();

        if(array_key_exists('Error', $data)) {
            if ($data['Error'] == "Movie not found!") {
                throw new NotFoundHttpException();
            }
            throw new \RuntimeException($data['Error']);
        }

        return $data;
    }
}