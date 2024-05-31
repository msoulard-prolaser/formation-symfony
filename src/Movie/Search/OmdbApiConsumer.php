<?php

namespace App\Movie\Search;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class OmdbApiConsumer
{
    private HttpClientInterface $omdbClient;
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