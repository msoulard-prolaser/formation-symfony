<?php

namespace App\Movie\Search\Transformer;


use App\Entity\Genre;

class OmdbToGenreTransformer implements OmdbToTypeTransformerInterface
{
    public function transform(mixed $value): Genre
    {
        if(!\isString($value)) {
            throw new \InvalidArgumentException('The value must be a string');
        }
        return (new Genre())->setName($value));
    }
}