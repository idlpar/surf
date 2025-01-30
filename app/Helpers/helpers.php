<?php

use Illuminate\Support\Number;

if (!function_exists('format_currency')) {
    function format_currency($amount, $currency = 'BDT', $decimal = 2)
    {
        $amount = (float) str_replace(',', '', $amount);

        if (function_exists('Number::currency')) {
            return Number::currency(
                $amount,
                $currency,
                locale: 'en', // Explicitly set locale
                options: [
                    'negative_pattern' => '¤ -#', // Key fix: Placeholder for currency symbol (¤)
                ]
            );
        }

        // Fallback for older Laravel versions
        $symbol = [
            'BDT' => 'Tk. ',
            'USD' => '$',
            'EUR' => '€',
        ][$currency] ?? $currency;

        $formatted = number_format(abs($amount), $decimal, '.', ',');
        if ($amount < 0) {
            $formatted = "-{$formatted}";
        }

        return $symbol . $formatted;
    }
}
