<?php

namespace App\Factory;
use App\Entity\Song;

class SongFactory
{
    /**
     * Creates a Song object from Spotify API JSON data
     *
     * @param array $songData The JSON response from the Spotify API (decoded into an associative array)
     * @return array
     */
    public static function songFactory(array $songData): array
    {
        $SongsArray = [];
        $items = $songData['tracks']['items'];
        foreach ($items as $item) {
                $song = new Song(
                    $item['disc_number'] ?? 0,
                    $item['duration_ms'] ?? 0,
                    $item['explicit'] ?? false,
                    $item['external_ids']['isrc'] ?? '',
                    $item['external_urls']['spotify'] ?? '',
                    $item['href'] ?? '',
                    $item['id'] ?? '',
                    $item['is_local'] ?? false,
                    $item['name'] ?? 'Unknown',
                    $item['popularity'] ?? 0,
                    $item['preview_url'] ?? null,
                    $item['track_number'] ?? 0,
                    $item['type'] ?? 'track',
                    $item['uri'] ?? '',
                    self::extractPictureLink($item)
                );
                $SongsArray[] = $song;
        }
        return $SongsArray;
    }

    /**
     * Extracts the album picture link (if available) from the song data.
     *
     * @param array $songData
     * @return string|null
     */
    private static function extractPictureLink(array $songData): ?string
    {
        if (isset($songData['album']['images']) && is_array($songData['album']['images'])) {
            return $songData['album']['images'][0]['url'] ?? 'null';
        }
        return null;
    }
}