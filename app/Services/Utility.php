<?php

namespace App\Services;

/**
 * Class Utility
 * @package App\Services
 */
class Utility
{
    /**
     * @param $items
     * @return array
     */
    public static function stripXSS($items): array
    {
        return array_map(function ($item) {
            return strip_tags($item, '<a><code><i><strong>');
        }, $items);
    }
}
