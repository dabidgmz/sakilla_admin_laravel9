<?php

/**
 * Clean a string by removing extra spaces.
 * 
 * @param string|null $text The string to clean.
 * @return string The cleaned string.
 */
if (!function_exists('cleanStringSpaces')) {
    function cleanStringSpaces(?string $text): string {
        if (empty($text)) return ''; // If the string is empty, return an empty string

        // Remove extra spaces from the string
        return preg_replace('/\s+/', ' ', trim($text));
    }
}