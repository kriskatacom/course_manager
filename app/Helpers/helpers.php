<?php

if (!function_exists('format_number')) {
    /**
     * Форматира число с разделители за хиляди и десетични знаци.
     *
     * @param float|int|null $number
     * @param int $decimals
     * @param string $decimalSeparator
     * @param string $thousandsSeparator
     * @return string
     */
    function format_number($number, $decimals = 0, $decimalSeparator = ',', $thousandsSeparator = ' ')
    {
        if (!is_numeric($number)) {
            return $number;
        }
        return number_format($number, $decimals, $decimalSeparator, $thousandsSeparator);
    }
}