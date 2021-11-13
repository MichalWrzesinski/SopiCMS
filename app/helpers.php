<?php

function inflect($value, $words) {
    if($value == 1) return($words[0]);
    if($value % 100 > 10 && $value % 100 < 20) return($words[2]);
    switch($value % 10) {
        case 2:
        case 3:
        case 4: return($words[1]);
        default: return($words[2]);
    }
}

function numberFormat($value) {

    return number_format($value, 2, config('sopicms.format.decimalSeparate'), '');
}

function convertToNumber($value) {

    return floatval(str_replace(',', '.', str_replace('.', '', $value)));
}

function priceFormat($value) {

    $amount = numberFormat($value);
    $currency = config('sopicms.format.priceCurrency');

    if(config('sopicms.format.priceCurrencyPosition') == 0) {
        return $currency.' '.$amount;
    }

    return $amount.' '.$currency;
}

function dateFormat($value) {

    return date(config('sopicms.format.date'), $value);
}

function dateTimeFormat($value) {

    return date(config('sopicms.format.dateTime'), $value);
}

function textFormat($value) {

    return str_replace("\n", '<br>', $value);
}
