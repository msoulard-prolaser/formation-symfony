<?php

namespace App\Movie\Search\Transformer;

use App\Entity\Movie;

class OmdbToMovieTransformer implements OmdbToTypeTransformerInterface
{
    public const KEYS = [
        'Title',
        'Year',
        'Released',
        'Plot',
        'Country',
        'Poster',
    ];

    public function transform(mixed $value): Movie
    {
        if(!\is_array($value) || \count(array_diff(self::KEYS, array_keys($value))) > 0) {
            throw new \InvalidArgumentException('The value must be an array');
        }

        $date = $value['Released'] === 'N/A' ? $value['Year'] : $value['Released'];

        $movie = (new Movie())
            ->setTitle($value['Title'])
            ->setPlot($value['Plot'])
            ->setCountry($value['Country'])
            ->setReleasedAt(new \DateTimeImmutable($date))
            ->setPoster($value['Poster'])
            //->setImdbId($datum['imdbID'])
            //->etRated($datum['Rated'])
            ->setPrice(5.0)
        ;

        return $movie;
    }
}