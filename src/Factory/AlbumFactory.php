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
                $item['album_type'] ?? '',                       // Album type (e.g., 'album', 'single')
                self::extractArtists($item),                     // List of artist names
                $item['available_markets'] ?? [],                // Available markets
                $item['external_urls']['spotify'] ?? '',         // Spotify URL from external_urls
                $item['href'] ?? '',                             // API URL
                $item['id'] ?? '',                               // Album ID
                self::extractPictureLink($item),                           // Album images array
                $item['name'] ?? 'Unknown',                      // Album name
                $item['release_date'] ?? '',                     // Release date
                $item['release_date_precision'] ?? '',           // Release date precision
                $item['total_tracks'] ?? 0,                      // Total tracks
                $item['type'] ?? 'album',                        // Album type (e.g., 'album', 'single')
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