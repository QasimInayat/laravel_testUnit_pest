<?php

namespace App\Services;

class SlugService
{
    public function generate(string $string): string
    {
        // Convert to lowercase
        $slug = strtolower($string);
        // Replace spaces and special characters with hyphens
        $slug = preg_replace('/[^a-z0-9]+/i', '-', $slug);
        // Trim hyphens from the beginning and end
        $slug = trim($slug, '-');

        return $slug;
    }
}


