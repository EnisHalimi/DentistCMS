<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Fusha following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'Fusha :attribute duhet të pranohet.',
    'active_url' => 'Fusha :attribute nuk është një URL.',
    'after' => 'Fusha :attribute duhet të jetë një datë pas datës :date.',
    'after_or_equal' => 'Fusha :attribute duhet të jetë një date pas ose e njëjtë me datën :date.',
    'alpha' => 'Fusha :attribute mund të përmbaj vetëm shkronja.',
    'alpha_dash' => 'Fusha :attribute mund të përmbaj vetëm shkronja, numra, dhe viza.',
    'alpha_num' => 'Fusha :attribute may only contain letters and numbers.',
    'array' => 'Fusha :attribute duhet të jetë një array.',
    'before' => 'Fusha :attribute duhet të jetë një datë para datës :date.',
    'before_or_equal' => 'Fusha :attribute duhet të jetë një datë para ose e njëjtë me datën :date.',
    'between' => [
        'numeric' => 'Fusha :attribute duhet të jetë mes :min dhe :max.',
        'file' => 'Fusha :attribute duhet të jetë mes :min dhe :max kilobajt.',
        'string' => 'Fusha :attribute duhet të jetë mes :min dhe :max karaktere.',
        'array' => 'Fusha :attribute duhet të ketë mes :min dhe :max gjëra.',
    ],
    'boolean' => 'Fusha :attribute duhet të jetë po ose jo.',
    'confirmed' => 'Fusha :attribute nuk është e njëjtë me atë paraprak.',
    'date' => 'Fusha :attribute nuk është një datë valide.',
    'date_equals' => 'Fusha :attribute duhet të jetë një datë e njëjtë me datën :date.',
    'date_format' => 'Fusha :attribute nuk i përshtatet formatit :format.',
    'different' => 'Fusha :attribute dhe :other duhet të jenë të ndryshme.',
    'digits' => 'Fusha :attribute duhet të jetë :digits shifra.',
    'digits_between' => 'Fusha :attribute duhet të jetë mes :min dhe :max shifra.',
    'dimensions' => 'Fusha :attribute ka dimezioni invalide të imazhit.',
    'distinct' => 'Fusha :attribute ka vlerë të duplikuar.',
    'email' => 'Fusha :attribute duhet të jetë një email adres valide.',
    'ends_with' => 'Fusha :attribute duhet të përfundojë me njërën nga këto: :values',
    'exists' => 'Fusha e selektuar :attribute është invalide.',
    'file' => 'Fusha :attribute duhet të jetë një fajll.',
    'filled' => 'Fusha :attribute duhet të ketë një vlerë.',
    'gt' => [
        'numeric' => 'Fusha :attribute duhet të jetë më e madhe se :value.',
        'file' => 'Fusha :attribute duhet të jetë më e madhe se :value kilobajt.',
        'string' => 'Fusha :attribute duhet të jetë më e madhe se :value karaktere.',
        'array' => 'Fusha :attribute duhet të ketë më shumë se :value gjëra.',
    ],
    'gte' => [
        'numeric' => 'Fusha :attribute duhet të jetë më e madhe ose e njëjtë se :value.',
        'file' => 'Fusha :attribute duhet të jetë më e madhe ose e njëjtë se :value kilobajt.',
        'string' => 'Fusha :attribute duhet të jetë më e madhe ose e njëjtë se :value karaktere.',
        'array' => 'Fusha :attribute duhet të ketë :value gjëra ose më shumë.',
    ],
    'image' => 'Fusha :attribute duhet të jetë një imazh.',
    'in' => 'Fusha e selektuar :attribute është invalide.',
    'in_array' => 'Fusha :attribute nuk egziston në :other.',
    'integer' => 'Fusha :attribute duhet të jetë një numër.',
    'ip' => 'Fusha :attribute duhet të jetë një IP adres valide.',
    'ipv4' => 'Fusha :attribute duhet të jetë një IPv4 adres valide.',
    'ipv6' => 'Fusha :attribute duhet të jetë një IPv6 adres valide.',
    'json' => 'Fusha :attribute duhet të jetë një string JSON valid.',
    'lt' => [
        'numeric' => 'Fusha :attribute duhet të jetë më pak se :value.',
        'file' => 'Fusha :attribute duhet të jetë më pak se :value kilobajt.',
        'string' => 'Fusha :attribute duhet të jetë më pak se :value karaktere.',
        'array' => 'Fusha :attribute duhet të ketë më pak se :value gjëra.',
    ],
    'lte' => [
        'numeric' => 'Fusha :attribute duhet të jetë më pak ose e njëjtë se :value.',
        'file' => 'Fusha :attribute duhet të jetë më pak ose e njëjtë se :value kilobajt.',
        'string' => 'Fusha :attribute duhet të jetë më pak ose e njëjtë se :value karaktere.',
        'array' => 'Fusha :attribute duhet të ketë më pak ose e njëjtë se :value gjëra.',
    ],
    'max' => [
        'numeric' => 'Fusha :attribute nuk duhet të jetë më shumë se :max.',
        'file' => 'Fusha :attribute nuk duhet të jetë më shumë se :max kilobajt.',
        'string' => 'Fusha :attribute nuk duhet të jetë më shumë se :max karaktere.',
        'array' => 'Fusha :attribute nuk duhet të ketë më shumë se :max gjëra.',
    ],
    'mimes' => 'Fusha :attribute duhet të jetë një fajll i tipit: :values.',
    'mimetypes' => 'Fusha :attribute duhet të jetë një fajll i tipit: :values.',
    'min' => [
        'numeric' => 'Fusha :attribute duhet të jetë së paku :min.',
        'file' => 'Fusha :attribute duhet të jetë së paku :min kilobajt.',
        'string' => 'Fusha :attribute duhet të jetë së paku :min karaktere.',
        'array' => 'Fusha :attribute duhet të ketë së paku :min gjëra.',
    ],
    'not_in' => 'Fusha e selektuar :attribute është invalide.',
    'not_regex' => 'Fusha :attribute ka formatin invalid.',
    'numeric' => 'Fusha :attribute duhet të jetë një numër.',
    'password' => 'Fjalëkalimi është i gabuar.',
    'present' => 'Fusha :attribute duhet të jetë prezente.',
    'regex' => 'Fusha :attribute ka formatin invalid.',
    'required' => 'Fusha :attribute duhet të mbushet.',
    'required_if' => 'Fusha :attribute kërkohet nëse :other është :value.',
    'required_unless' => 'Fusha :attribute kërkohet nëse :other është në :values.',
    'required_with' => 'Fusha :attribute kërkohet nëse :values është prezent.',
    'required_with_all' => 'Fusha :attribute kërkohet nëse :values janë prezente.',
    'required_without' => 'Fusha :attribute kërkohet nëse  :values nuk janë prezente.',
    'required_without_all' => 'Fusha :attribute kërkohet nëse asnjëra nga :values janë prezente.',
    'same' => 'Fusha :attribute dhe :other duhet të jenë të barabartë.',
    'size' => [
        'numeric' => 'Fusha :attribute duhet të jetë :size.',
        'file' => 'Fusha :attribute duhet të jetë :size kilobajt.',
        'string' => 'Fusha :attribute duhet të jetë :size karaktere.',
        'array' => 'Fusha :attribute duhet të ketë :size gjëra.',
    ],
    'starts_with' => 'Fusha :attribute duhet të fillojë me njërëna nga këto: :values',
    'string' => 'Fusha :attribute duhet të jetë një string .',
    'timezone' => 'Fusha :attribute duhet të jetë një zone valide.',
    'unique' => 'Fusha :attribute egziston në të dhënat.',
    'uploaded' => 'Fusha :attribute ka dështuar të bëhet upload.',
    'url' => 'Fusha :attribute ka formatin invalid.',
    'uuid' => 'Fusha :attribute duhet të jetë një UUID valide.',

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
        'pacient-id' => [
            'required' => 'Ju lutem zgjidhni pacientin.',
        ],
         'user-id' => [
            'required' => 'Ju lutem zgjidhni dentistin.',
        ],
        'treatment-id' => [
            'required' => 'Ju lutem zgjidhni trajtimin.',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | Fusha following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
