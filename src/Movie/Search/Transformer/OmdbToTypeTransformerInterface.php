<?php

namespace App\Movie\Search\Transformer;

use App\Entity\Movie;

interface OmdbToTypeTransformerInterface
{
    public function transform(mixed $value): object;
}