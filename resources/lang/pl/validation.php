<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => 'Wartość musi zostać zaakceptowana',
    'accepted_if'          => 'Wartość musi zostać zaakceptowana, gdy :other ma wartość :value',
    'active_url'           => 'Wartość nie jest prawidłowym adresem URL',
    'after'                => 'Wartość musi być datą późniejszą niż :date',
    'after_or_equal'       => 'Wartość musi być datą po lub równą :date',
    'alpha'                => 'Wartość może zawierać tylko litery',
    'alpha_dash'           => 'Wartość może zawierać tylko litery, cyfry i podkreślenia',
    'alpha_num'            => 'Wartość może zawierać tylko litery i cyfry',
    'array'                => 'Wartość musi być tablicą',
    'attached'             => 'Wartość jest już dołączona',
    'before'               => 'Wartość musi być datą wcześniejszą niż :date',
    'before_or_equal'      => 'Wartość musi być datą przed lub równą :date',
    'between'              => [
        'numeric' => 'Wartość musi być wartością pomiędzy :min i :max',
        'file'    => 'Wartość musi mieć pomiędzy :min a :max kilobajtów',
        'string'  => 'Wartość musi mieć pomiędzy :min a :max znaków',
        'array'   => 'Wartość musi mieć pomiędzy :min a :max pozycji',
    ],
    'boolean'              => 'Wartość musi być true lub false',
    'confirmed'            => 'Potwierdzenie nie pasuje',
    'current_password'     => 'Hasło jest błędne',
    'date'                 => 'Wartość nie jest prawidłową datą',
    'date_equals'          => 'Wartość musi być datą równą :date',
    'date_format'          => 'Wartość nie zgadza się z formatem :format',
    'different'            => 'Wartość i :other muszą być różne',
    'digits'               => 'Wartość musi mieć :digits cyfr',
    'digits_between'       => 'Wartość musi mieć pomiędzy :min a :max cyfr',
    'dimensions'           => 'Wartość ma nieprawidłowe wymiary obrazu',
    'distinct'             => 'Wartość ma zduplikowaną wartość',
    'email'                => 'Wartość musi być poprawnym adresem e-mail',
    'ends_with'            => 'Wartość musi kończyć się jednym z następujących: :values',
    'exists'               => 'wybrany :attribute jest nieprawidłowy',
    'file'                 => 'Wartość musi być plikiem',
    'filled'               => 'Wartość musi mieć wartość',
    'gt'                   => [
        'numeric' => 'Wartość musi być większa niż :value',
        'file'    => 'Wartość musi być większa niż :value kilobajtów',
        'string'  => 'Wartość musi być większa niż znaki :value',
        'array'   => 'Wartość musi zawierać więcej niż :value elementów',
    ],
    'gte'                  => [
        'numeric' => 'Wartość musi być większa lub równa :value',
        'file'    => 'Wartość musi być większa lub równa :value kilobajtów',
        'string'  => 'Wartość musi być większa lub równa :value znaków',
        'array'   => 'Wartość musi zawierać elementy :value lub więcej',
    ],
    'image'                => 'Wartość musi być obrazkiem',
    'in'                   => 'Wartość jest nieprawidłowa',
    'in_array'             => 'Wartość nie istnieje w :other',
    'integer'              => 'Wartość musi być liczbą',
    'ip'                   => 'Wartość musi być poprawnym adresem IP',
    'ipv4'                 => 'Wartość musi być prawidłowym adresem IPv4',
    'ipv6'                 => 'Wartość musi być prawidłowym adresem IPv6',
    'json'                 => 'Wartość musi być prawidłowym ciągiem JSON',
    'lt'                   => [
        'numeric' => 'Wartość musi być mniejsza niż :value',
        'file'    => 'Wartość musi być mniejsza niż :value kilobajtów',
        'string'  => 'Wartość musi mieć mniej niż :value znaków',
        'array'   => 'Wartość musi mieć mniej niż :value elementów',
    ],
    'lte'                  => [
        'numeric' => 'Wartość musi być mniejsza lub równa :value',
        'file'    => 'Wartość musi być mniejsza lub równa :value kilobajtów',
        'string'  => 'Wartość musi być mniejsza lub równa :value znaków',
        'array'   => 'Wartość nie może zawierać więcej niż :value elementów',
    ],
    'max'                  => [
        'numeric' => 'Wartość nie może być większa niż :max',
        'file'    => 'Wartość nie może być większa niż :max kilobajtów',
        'string'  => 'Wartość nie może być dłuższa niż :max znaków',
        'array'   => 'Wartość nie może mieć więcej niż :max pozycji',
    ],
    'mimes'                => 'Wartość musi być plikiem typu: :values',
    'mimetypes'            => 'Wartość musi być plikiem typu: :values',
    'min'                  => [
        'numeric' => 'Wartość musi większa lub równa :min',
        'file'    => 'Wartość musi mieć co najmniej :min kilobajtów',
        'string'  => 'Wartość musi mieć co najmniej :min znaków',
        'array'   => 'Wartość musi mieć co najmniej :min pozycji',
    ],
    'multiple_of'          => 'Wartość musi być wielokrotnością :value',
    'not_in'               => 'Wybrana wartość jest nieprawidłowa',
    'not_regex'            => 'Format jest nieprawidłowy',
    'numeric'              => 'Wartość musi być liczbą',
    'password'             => 'Hasło jest błędne',
    'present'              => 'Wartość musi być obecna',
    'regex'                => 'Format jest nieprawidłowy',
    'relatable'            => 'Wartość nie może być powiązana z tym zasobem',
    'required'             => 'Wartość jest wymagana',
    'required_if'          => 'Wartość jest wymagana, gdy :other ma wartość :value',
    'required_unless'      => 'Wartość jest wymagana, chyba że :other jest w :values',
    'required_with'        => 'Wartość jest wymagana, gdy :values są zdefiniowane',
    'required_with_all'    => 'Wartość jest wymagana, gdy :values są zdefiniowane',
    'required_without'     => 'Wartość jest wymagana, gdy :values nie są zdefiniowane',
    'required_without_all' => 'Wartość jest wymagana, gdy żadne z :values nie są zdefiniowane',
    'prohibited'           => 'Wartość jest zabroniona',
    'prohibited_if'        => 'Wartość jest zabroniona, gdy :other ma wartość :value',
    'prohibited_unless'    => 'Wartość jest zabroniona, chyba że :other jest w :values',
    'prohibits'            => 'Wartość zabrania obecności :other',
    'same'                 => 'Wartość i :other muszą być takie same',
    'size'                 => [
        'numeric' => 'Wartość musi mieć wartość :size',
        'file'    => 'Wartość musi mieć :size kilobajtów',
        'string'  => 'Wartość musi mieć : rozmiar',
        'array'   => 'Wartość musi zawierać SIWZ',
    ],
    'starts_with'          => 'Wartość musi zaczynać się jednym z następujących: :values',
    'string'               => 'Wartość musi być ciągiem',
    'timezone'             => 'Wartość musi być prawidłową strefą czasową',
    'unique'               => 'Wartość jest już zajęta',
    'uploaded'             => 'Nie udało się przesłać wartości',
    'url'                  => 'Format jest błędny',
    'uuid'                 => 'Wartość musi być prawidłowym UUID',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention 'attribute.rule' to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as 'E-Mail Address' instead
    | of 'email'. This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
