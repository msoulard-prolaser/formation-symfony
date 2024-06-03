<?php

namespace App\Movie\Search;

use Symfony\Component\DependencyInjection\Attribute\AsDecorator;
use Symfony\Component\DependencyInjection\Attribute\When;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Contracts\Cache\CacheInterface;

#[When(env: 'prod')]
#[AsDecorator(decorates: OmdbApiConsumer::class)]
class CacheableOmdbApiConsumer extends OmdbApiConsumer
{
    public function __construct(
        private readonly OmdbApiConsumer $inner,
        private readonly CacheInterface $cache,
        private readonly SluggerInterface $slugger
    ){}

    public function fetchmovie(SearchTypes $type, string $value): array
    {
        $ley = sprintf("%s_%s", $type->value, $this->slugger->slug($value));
        return $this->cache->get(
            $key,
            fn() => $this->inner->fetchMovie($type, $value)
        );
    }
}