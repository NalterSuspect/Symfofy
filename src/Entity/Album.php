<?php

namespace App\Entity;

class Album
{
    private string $albumType;
    private array $artists;
    private array $availableMarkets;
    private string $spotifyUrl;
    private string $href;
    private string $id;
    private ?string $pictureLink;
    private string $name;
    private string $releaseDate;
    private string $releaseDatePrecision;
    private int $totalTracks;
    private string $type;
    private string $uri;

    public function __construct(
        string $albumType,
        array $artists,
        array $availableMarkets,
        string $spotifyUrl,
        string $href,
        string $id,
        ?string $pictureLink,
        string $name,
        string $releaseDate,
        string $releaseDatePrecision,
        int $totalTracks,
        string $type,
        string $uri
    ) {
        $this->albumType = $albumType;
        $this->artists = $artists;
        $this->availableMarkets = $availableMarkets;
        $this->spotifyUrl = $spotifyUrl;
        $this->href = $href;
        $this->id = $id;
        $this->pictureLink = $pictureLink;
        $this->name = $name;
        $this->releaseDate = $releaseDate;
        $this->releaseDatePrecision = $releaseDatePrecision;
        $this->totalTracks = $totalTracks;
        $this->type = $type;
        $this->uri = $uri;
    }

    // Getters for all properties
    public function getAlbumType(): string {
        return $this->albumType;
    }

    public function getArtists(): array {
        return $this->artists;
    }

    public function getAvailableMarkets(): array {
        return $this->availableMarkets;
    }

    public function getSpotifyUrl(): string {
        return $this->spotifyUrl;
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

    public function getReleaseDate(): string {
        return $this->releaseDate;
    }

    public function getReleaseDatePrecision(): string {
        return $this->releaseDatePrecision;
    }

    public function getTotalTracks(): int {
        return $this->totalTracks;
    }

    public function getType(): string {
        return $this->type;
    }

    public function getUri(): string {
        return $this->uri;
    }
}