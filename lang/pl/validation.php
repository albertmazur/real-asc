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

    'accepted' => ':attribute musi zostać zaakceptowany.',
    'accepted_if' => ':attribute musi być akceptowane, gdy :other jest równe :value.',
    'active_url' => ':attribute nie jest prawidłowym adresem URL.',
    'after' => ':attribute musi być data późniejsza :date.',
    'after_or_equal' => ':attribute musi być datą późniejszą lub równą :date.',
    'alpha' => ':attribute może zawierać tylko litery.',
    'alpha_dash' => ':attribute może zawierać tylko litery, cyfry, myślniki i podkreślenia.',
    'alpha_num' => ':attribute może zawierać tylko litery i cyfry.',
    'array' => ':attribute musi być tablicą.',
    'ascii' => ':attribute może zawierać wyłącznie jednobajtowe znaki alfanumeryczne i symbole.',
    'before' => ':attribute musi być datą wcześniejszą niż :date.',
    'before_or_equal' => ':attribute musi być datą wcześniejszą lub równą :date.',
    'between' => [
        'array' => ':attribute musi zawierać od :min do :max elementów.',
        'file' => ':attribute musi mieścić się w przedziale od :min do :max kilobajtów.',
        'numeric' => ':attribute musi być pomiędzy :min i :max.',
        'string' => ':attribute musi zawierać się pomiędzy :min i :max znaków.',
    ],
    'boolean' => ':attribute musi mieć wartość true lub false.',
    'confirmed' => ':attribute potwierdzenie nie pasuje.',
    'current_password' => 'Hasło jest nieprawidłowe.',
    'date' => ':attribute nie jest prawidłową datą.',
    'date_equals' => ':attribute musi być datą równą :date.',
    'date_format' => ':attribute nie pasuje do formatu :format.',
    'decimal' => ':attribute musi zawierać :decimal miejsc dziesiętnych.',
    'declined' => ':attribute musi zostać odrzucona.',
    'declined_if' => ':attribute musi zostać odrzucona, gdy opcja :other jest równa :value.',
    'different' => ':attribute i :other muszą być różne.',
    'digits' => ':attribute musi być równy :digits cyfr.',
    'digits_between' => ':attribute musi zawierać się pomiędzy cyframi :min i :max.',
    'dimensions' => ':attribute ma nieprawidłowe wymiary obrazu.',
    'distinct' => ':attribute ma powtarzającą się wartość.',
    'doesnt_end_with' => ':attribute nie może kończyć się żadną z następujących opcji: :values.',
    'doesnt_start_with' => ':attribute nie może zaczynać się od żadnej z następujących opcji: :values.',
    'email' => ':attribute musi być prawidłowym adresem e-mail.',
    'ends_with' => ':attribute musi kończyć się jedną z następujących opcji: :values.',
    'enum' => 'Wybrany :attribute jest nieprawidłowy.',
    'exists' => 'Wybrany :attribute jest nieprawidłowy.',
    'file' => ':attribute musi być plikiem.',
    'filled' => ':attribute musi mieć wartość.',
    'gt' => [
        'array' => ':attribute musi mieć więcej elementów niż :value.',
        'file' => ':attribute musi być większa niż :value kilobajtów.',
        'numeric' => ':attribute musi być większa niż :value.',
        'string' => ':attribute musi być większa niż :value znaków.',
    ],
    'gte' => [
        'array' => ':attribute musi zawierać elementy :value lub więcej.',
        'file' => ':attribute musi być większa lub równa :value kilobajtów.',
        'numeric' => ':attribute musi być większa lub równa wartości :value.',
        'string' => ':attribute musi być większa lub równa liczbie znaków :value.',
    ],
    'image' => ':attribute musi być obrazem.',
    'in' => 'Wybrany :attribute jest nieprawidłowy.',
    'in_array' => ':attribute nie istnieje w :other.',
    'integer' => ':attribute musi być liczbą całkowitą.',
    'ip' => ':attribute musi być prawidłowym adresem IP.',
    'ipv4' => ':attribute musi być prawidłowym adresem IPv4.',
    'ipv6' => ':attribute musi być prawidłowym adresem IPv6.',
    'json' => ':attribute musi być prawidłowym ciągiem JSON.',
    'lowercase' => ':attribute musi być pisana małymi literami.',
    'lt' => [
        'array' => ':attribute musi mieć mniej niż :value elementów.',
        'file' => ':attribute musi być mniejsza niż :value kilobajtów.',
        'numeric' => ':attribute musi być mniejsza niż :value.',
        'string' => ':attribute musi być mniejsza niż :value znaków.',
    ],
    'lte' => [
        'array' => ':attribute nie może mieć więcej elementów niż :value.',
        'file' => ':attribute musi być mniejsza lub równa :value kilobajtów.',
        'numeric' => ':attribute musi być mniejsza lub równa wartości :value.',
        'string' => ' :attribute musi być mniejsza lub równa liczbie znaków :value.',
    ],
    'mac_address' => ':attribute musi być prawidłowym adresem MAC.',
    'max' => [
        'array' => ':attribute nie może mieć więcej niż :max elementów.',
        'file' => ':attribute nie może być większa niż :max kilobajtów.',
        'numeric' => ':attribute nie może być większa niż :max.',
        'string' => ':attribute nie może być większa niż :max znaków.',
    ],
    'max_digits' => ':attribute nie może mieć więcej niż :max cyfr.',
    'mimes' => ':attribute musi być plikiem typu: :values.',
    'mimetypes' => ':attribute musi być plikiem typu: :values.',
    'min' => [
        'array' => ':attribute musi mieć co najmniej :min elementów.',
        'file' => ':attribute musi mieć co najmniej :min kilobajtów.',
        'numeric' => ':attribute musi wynosić co najmniej :min.',
        'string' => ':attribute musi mieć co najmniej :min znaków.',
    ],
    'min_digits' => ':attribute musi mieć co najmniej :min cyfr.',
    'multiple_of' => ':attribute musi być wielokrotnością opcji :value.',
    'not_in' => 'Wybrany :attribute jest nieprawidłowy.',
    'not_regex' => 'Format :attribute jest nieprawidłowy.',
    'numeric' => ':attribute musi być liczbą.',
    'password' => [
        'letters' => ':attribute musi zawierać co najmniej jedną literę.',
        'mixed' => ':attribute musi zawierać co najmniej jedną wielką i jedną małą literę.',
        'numbers' => ':attribute musi zawierać co najmniej jedną liczbę.',
        'symbols' => ':attribute musi zawierać co najmniej jeden symbol.',
        'uncompromised' => 'Podany :attribute pojawił się w wycieku danych. Wybierz inny :attribute.',
    ],
    'present' => ':attribute musi być obecne.',
    'prohibited' => ':attribute jest zabronione.',
    'prohibited_if' => ':attribute jest zabronione, gdy :other ma wartość :value.',
    'prohibited_unless' => ':attribute jest zabronione, chyba że :other znajduje się w :values.',
    'prohibits' => ':attribute zabrania obecności :other.',
    'regex' => 'Format :attribute jest nieprawidłowy.',
    'required' => ':attribute jest wymagane.',
    'required_array_keys' => ':attribute musi zawierać wpisy dla: :values.',
    'required_if' => ':attribute jest wymagane, gdy :other ma wartość :value.',
    'required_if_accepted' => ':attribute jest wymagane, gdy akceptowane jest :other.',
    'required_unless' => ':attribute jest wymagane, chyba że pole :other znajduje się w polu :values.',
    'required_with' => ':attribute jest wymagane, gdy obecne jest :values.',
    'required_with_all' => ':attribute jest wymagane, gdy obecne są :values.',
    'required_without' => ':attribute jest wymagane, gdy nie jest obecne pole :values.',
    'required_without_all' => 'attribute jest wymagane, gdy nie ma żadnego z :values.',
    'same' => ':attribute i :other muszą być takie same.',
    'size' => [
        'array' => ':attribute musi zawierać elementy :size.',
        'file' => ':attribute musi wynosić :size kilobajtów.',
        'numeric' => ':attribute musi być równy :size.',
        'string' => ':attribute musi składać się ze znaków :size.',
    ],
    'starts_with' => ':attribute musi zaczynać się od jednego z następujących elementów: :values.',
    'string' => ':attribute musi być ciągiem znaków.',
    'timezone' => ':attribute musi określać prawidłową strefę czasową.',
    'unique' => ':attribute jest już zajęta.',
    'uploaded' => 'Nie udało się przesłać :attribute.',
    'uppercase' => ':attribute musi być pisana wielkimi literami.',
    'url' => ':attribute musi być prawidłowym adresem URL.',
    'ulid' => ':attribute musi być prawidłowym identyfikatorem ULID.',
    'uuid' => ':attribute musi być prawidłowym identyfikatorem UUID.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
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
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'language_required' => 'Pole języka jest wymagane.',
    'language_invalid' => 'Wybrany język jest nieprawidłowy.',
    'attributes' => [],

    'at_least_one_admin' => 'W systemie musi pozostać przynajmniej jeden administrator.',
];
