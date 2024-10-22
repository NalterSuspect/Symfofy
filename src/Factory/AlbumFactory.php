<?php

namespace App\Factory;
use App\Entity\Album;

class AlbumFactory
{
    /**
     * Creates an Album object from Spotify API JSON data
     *
     * @param array $albumData The JSON response from the Spotify API (decoded into an associative array)
     * @return array
     */
    public static function albumFactory(array $albumData): array
    {
        $AlbumArray=[];
        $items = $albumData['albums']['items'];
        foreach ($items as $item) {
            $album = new Album(
                $item['album_type'] ?? '',
                self::extractArtists($item),
                $item['available_markets'] ?? [],
                $item['external_urls']['spotify'] ?? '',
                $item['href'] ?? '',
                $item['id'] ?? '',
                self::extractPictureLink($item),
                $item['name'] ?? 'Unknown',
                $item['release_date'] ?? '',
                $item['release_date_precision'] ?? '',
                $item['total_tracks'] ?? 0,
                $item['type'] ?? 'album',
                $item['uri'] ?? ''

            );
            $AlbumArray[] = $album;
        }
        return $AlbumArray;
    }

    /**
     * Extracts artist names from the album data.
     *
     * @param array $albumData
     * @return array
     */
    private static function extractArtists(array $albumData): array
    {
        $artists = [];
        if (isset($albumData['artists']) && is_array($albumData['artists'])) {
            foreach ($albumData['artists'] as $artist) {
                $artists[] = $artist['name'] ?? 'Unknown Artist';  // Extract artist name or default to 'Unknown Artist'
            }
        }
        return $artists;
    }

    /**
     * Extracts the album picture link (if available) from the song data.
     *
     * @param array $songData
     * @return string|null
     */
    private static function extractPictureLink(array $songData): ?string
    {
        if (isset($songData['images']) && is_array($songData['images'])) {
            return $songData['images'][0]['url'] ?? 'null';
        }
        return null;
    }
}