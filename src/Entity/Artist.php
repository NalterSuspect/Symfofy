<?php

namespace App\Entity;

class Artist
{
    private string $spotifyUrl;
    private int $followers;
    private array $genres;
    private string $href;
    private string $id;
    private ?string $pictureLink;
    private string $name;
    private int $popularity;
    private string $type;
    private string $uri;

    public function __construct(
        string $spotifyUrl,
        int $followers,
        array $genres,
        string $href,
        string $id,
        ?string $pictureLink,
        string $name,
        int $popularity,
        string $type,
        string $uri
    ) {
        $this->spotifyUrl = $spotifyUrl;
        $this->followers = $followers;
        $this->genres = $genres;
        $this->href = $href;
        $this->id = $id;
        $this->pictureLink = $pictureLink;
        $this->name = $name;
        $this->popularity = $popularity;
        $this->type = $type;
        $this->uri = $uri;
    }

    // Getters for all properties
    public function getSpotifyUrl(): string {
        return $this->spotifyUrl;
    }

    public function getFollowers(): int {
        return $this->followers;
    }

    public function getGenres(): array {
        return $this->genres;
    }

    public function getHref(): string {
        return $this->href;
    }

    public function getId(): string {
        return $this->id;
    }

    public function getPictureLink(): string {
        return $this->pictureLink;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getPopularity(): int {
        return $this->popularity;
    }

    public function getType(): string {
        return $this->type;
    }

    public function getUri(): string {
        return $this->uri;
    }
}