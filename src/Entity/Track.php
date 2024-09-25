<?php

namespace App\Entity;

class Track
{
    private string $name;

    public function __construct(
        string $name
    ) {
        $this->name = $name;
    
    }

    // Getters for all properties
    public function getName(): string
    {
        return $this->name;
    }
}