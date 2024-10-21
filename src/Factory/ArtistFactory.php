<?php

namespace App\Factory;

use App\Entity\Artist;
use function Webmozart\Assert\Tests\StaticAnalysis\null;

class ArtistFactory
{
    public static function artistFactory(array $artistData): array
    {
        $artistArray=[];
        $items = $artistData['artists']['items'];
        foreach ($items as $item) {
            $artist = new Artist(
                $item['external_urls']['spotify'] ?? null,
                    $item['followers']['total'] ?? null,
                    $item['genres'] ?? null,
                    $item['href'] ?? null,
                    $item['id'] ?? null,
                    self::extractPictureLink($item),
                    $item['name'] ?? null,
                    $item['popularity'] ?? null,
                    $item['type'] ?? null,
                    $item['uri'] ?? null,
            );
            $artistArray[] = $artist;
        }
        return $artistArray;
    }

    private static function extractPictureLink(array $artistData): ?string
    {
        if (isset($artistData['images']) && is_array($artistData['images'])) {
            return $artistData['images'][0]['url'] ?? 'null';
        }
        return null;
    }
}