<?php

namespace App\Helpers;

class PriceFormatter
{
    /**
     * Format price to Indonesian Rupiah with thousand separators
     * 
     * @param int|float $price
     * @param bool $withCurrency Include 'Rp' prefix
     * @return string
     */
    public static function format($price, bool $withCurrency = false): string
    {
        $formatted = number_format((int) $price, 0, ',', '.');
        
        return $withCurrency ? "Rp {$formatted}" : $formatted;
    }

    /**
     * Parse formatted price string to integer
     * Removes all non-numeric characters except decimal point
     * 
     * @param string $price Formatted price (e.g., "Rp 1.000.000" or "1.000.000")
     * @return int
     */
    public static function parse(string $price): int
    {
        return (int) preg_replace('/[^\d]/', '', $price);
    }

    /**
     * Format for display with Rp prefix and thousand separators
     * 
     * @param int|float $price
     * @return string
     */
    public static function display($price): string
    {
        return self::format($price, true);
    }

    /**
     * Format for HTML input field (without Rp prefix, with thousand separators)
     * 
     * @param int|float $price
     * @return string
     */
    public static function input($price): string
    {
        return self::format($price, false);
    }

    /**
     * Format for form field real value (no separators, just number)
     * 
     * @param int|float $price
     * @return int
     */
    public static function value($price): int
    {
        return (int) $price;
    }

    /**
     * Get formatted range for display (e.g., "Rp 500.000 - Rp 1.000.000")
     * 
     * @param int|float $minPrice
     * @param int|float $maxPrice
     * @return string
     */
    public static function range($minPrice, $maxPrice): string
    {
        return self::display($minPrice) . ' - ' . self::display($maxPrice);
    }

    /**
     * Validate if string is valid price format
     * 
     * @param string $price
     * @return bool
     */
    public static function isValid(string $price): bool
    {
        $parsed = self::parse($price);
        return $parsed > 0;
    }

    /**
     * Format percentage of price (e.g., 30% from total)
     * 
     * @param int|float $price
     * @param int|float $percentage
     * @return string
     */
    public static function percentage($price, $percentage): string
    {
        $amount = ($price * $percentage) / 100;
        return self::display($amount);
    }
}
