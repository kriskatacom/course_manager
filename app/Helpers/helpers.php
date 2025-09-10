<?php

if (!function_exists('format_number')) {
    function format_number($number, $decimals = 0, $decimalSeparator = ',', $thousandsSeparator = ' ')
    {
        if (!is_numeric($number)) {
            return $number;
        }
        return number_format($number, $decimals, $decimalSeparator, $thousandsSeparator);
    }
}

if (! function_exists('format_bgn')) {
    function format_bgn(float $amount, int $decimals = 2): string
    {
        return number_format($amount, $decimals, ',', ' ') . ' лв.';
    }
}

if (! function_exists('format_eur')) {
    function format_eur(float $amount, int $decimals = 2): string
    {
        $eurRate = 1.95583;

        $eur = $amount / $eurRate;

        return number_format($eur, $decimals, ',', ' ') . ' €';
    }
}

if (! function_exists('format_price')) {
    function format_price(float $amount, int $decimals = 2): string
    {
        return sprintf(
            '<span>%s</span><br /><span>%s</span>',
            format_bgn($amount, $decimals),
            format_eur($amount, $decimals)
        );
    }
}

function locale_route($name, $parameters = [])
{
    $parameters = array_merge(['locale' => app()->getLocale()], $parameters);
    return route($name, $parameters);
}
