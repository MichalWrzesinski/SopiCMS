<?php

return [

    'siteName' => 'SopiCMS',

    'meta' => [
        'title' => 'SopiCMS',
        'description' => 'Opis strony',
        'keywords' => 'Słowa kluczowe',
    ],

    'url' => [
        'regulations' => 'regulamin',
        'privacyPolicy' => 'polityka-prywatnosci',
    ],

    'item' => [
        'name' => 'Ogłoszenia',
        'list' => 'Lista ogłoszeń',
        'search' => 'Szukaj ogłoszeń',
        'this' => 'Ogłoszenie',
        'add' => 'Dodaj ogłoszenie',
        'edit' => 'Edytuj ogłoszenie',
        'delete' => 'Usuń ogłoszenie',
        'promote' => 'Promuj ogłoszenie',
        'userList' => 'Moje ogłoszenia',
        'favoriteList' => 'Obserwowane ogłoszenia',

        'status' => [
            0 => 'Nieaktywne',
            1 => 'Aktywne'
        ],
        'premium' => [
            0 => 'Niepromowane',
            1 => 'Promowane'
        ],
    ],

    'payment' => [
        'type' => [
            1 => 'Promowanie ogłoszenia',
        ],
        'status' => [
            0 => 'Nieopłacony',
            1 => 'Opłacony',
            9 => 'Anulowany',
        ],
    ],

    'email' => 'wuerzet@gmail.com',
    'phone' => '111-222-333',

    'thumbnail' => [
        '50x50',
        '100x100',
        '150x150',
        '320x240',
        '480x320',
        '640x480',
        '800x600',
        '1024x768',
    ],

    'user' => [
        'status' => [
            0 => 'Nieaktywny',
            1 => 'Aktywny',
        ],
        'type' => [
            0 => 'Użytkownik',
            9 => 'Administrator',
        ],
    ],

    'format' => [
        'date' => 'd.m.Y',
        'dateTime' => 'd.m.Y H:i',
        'decimalSeparate' => ',',
        'priceCurrency' => 'zł',
        'priceCurrencyPosition' => 1,
    ],

    'paginate' => 12,

    'region' => [
        1 => 'Dolnośląskie',
        2 => 'Kujawsko-pomorskie',
        3 => 'Lubelskie',
        4 => 'Lubuskie',
        5 => 'Łódzkie',
        6 => 'Małopolskie',
        7 => 'Mazowieckie',
        8 => 'Opolskie',
        9 => 'Podkarpackie',
        10 => 'Podlaskie',
        11 => 'Pomorskie',
        12 => 'Śląskie',
        13 => 'Świętokrzyskie',
        14 => 'Warmińsko-mazurskie',
        15 => 'Wielkopolskie',
        16 => 'Zachodniopomorskie',
        17 => 'Zagranica'
    ],

    'month' => [
        1 => 'Styczeń',
        2 => 'Luty',
        3 => 'Marzec',
        4 => 'Kwiecień',
        5 => 'Maj',
        6 => 'Czerwiec',
        7 => 'Lipiec',
        8 => 'Sierpień',
        9 => 'Wrzesień',
        10 => 'Październik',
        11 => 'Listopad',
        12 => 'Grudzień'
    ],

    'day' => [
        0 => 'Niedziela',
        1 => 'Poniedziałek',
        2 => 'Wtorek',
        3 => 'Środa',
        4 => 'Czwartek',
        5 => 'Piątek',
        6 => 'Sobota',
        7 => 'Niedziela'
    ],

    'opd' => [
        'category' => 'kategoria',
        'region' => 'wojewodztwo',
        'city' => 'miejscowosc',
        'price' => 'cena',
        'price-from' => 'cena-od',
        'price-to' => 'cena-do',
        'query' => 'szukaj',
        'page' => 'strona',
        'user' => 'uzytkownik',
    ],
];
