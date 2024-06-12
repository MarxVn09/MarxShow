<?php
// app/helpers.php
use Money\Money;
use Money\Currencies\ISOCurrencies;
use Money\Formatter\IntlMoneyFormatter;


// app/helpers.php

if (!function_exists('format_currency')) {
    function format_currency($amount, $currency = 'USD', $locale = 'en_US') {
        $formatter = new \NumberFormatter($locale, \NumberFormatter::CURRENCY);
        return $formatter->formatCurrency($amount, $currency);
    }
}

