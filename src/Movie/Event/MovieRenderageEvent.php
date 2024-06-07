<?php

namespace App\Movie\Event;

use App\Entity\Movie;
use App\Entity\User;

class MovieRenderageEvent extends MovieEvent
{
    public function __construct(?Movie $movie = null, private ?User $user = null)
    {
        $this->movie = $movie;
    }
}