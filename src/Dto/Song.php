<?php

namespace App\Dto;

class Song
{
    public function __construct(
        private ?string $title = null,
        private ?string $artist = null,
        private ?string $album = null,
        private ?\DateTimeImmutable $releasedAt = null,
    ){}
public function getTitle(): ?string
{
    return $this->title;
}
public function setTitle(?string $title): void
{
    $this->title = $title;
}
public function getArtist(): ?string
{
    return $this->artist;
}
public function setArtist(?string $artist): void
{
    $this->artist = $artist;
}
public function getAlbum(): ?string
{
    return $this->album;
}
public function setAlbum(?string $album): void
{
    $this->album = $album;
}
public function getReleasedAt(): ?\DateTimeImmutable
{
    return $this->releasedAt;
}
public function setReleasedAt(?\DateTimeImmutable $releasedAt): void
{
    $this->releasedAt = $releasedAt;
}
}