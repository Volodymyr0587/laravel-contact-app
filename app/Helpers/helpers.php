<?php

if (!function_exists('generate_image_name_from_image_path')) {
    function generate_image_name_from_image_path($path)
    {
        // Get the filename without the extension
        $filenameWithoutExtension = preg_replace('/^\d+/', '', pathinfo($path, PATHINFO_FILENAME));
        // Replace underscores with spaces
        return str_replace('_', ' ', $filenameWithoutExtension);
    }
}

if (!function_exists('is_url')) {
    /**
     * Check if a given string is valid URL
     *
     * @param string $url
     * @return bool
     */
    function is_url($url)
    {
        return filter_var($url, FILTER_VALIDATE_URL) !== false;
    }

}
