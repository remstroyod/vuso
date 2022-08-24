<?php

$class = new ReflectionClass(\Egorovwebservices\Dictionaries\Providers\BaseServiceProvider::class);
$src_path = dirname($class->getFileName()) . '/../';

$config = [
    'package' => 'dictionaries',
    'root_path' => $src_path,
    'with_exchange' => env('DICTIONARIES_WITH_EXCHANGE', false)
];

$config['connections'] = [
    $config['package'] => env('DICTIONARIES_CONNECTION', $config['package'])
];


$config['database'] = env('DICTIONARIES_DATABASE', $config['root_path'] . 'database/' . $config['package'] . '.sqlite');

$config['tables'] = [
    'countries' => env('DICTIONARIES_COUNTRIES_TABLE', 'countries'),
    'ewa' => [
        'ewa_cities' => env('DICTIONARIES_CITIES_TABLE', 'ewa_cities'),
        'ewa_marks' => env('DICTIONARIES_EWA_MARKS_TABLE', 'ewa_marks'),
        'ewa_models' => env('DICTIONARIES_EWA_MODELS_TABLE', 'ewa_models'),
    ],
    'auto_ria' => [
        'auto_ria_marks' => env('DICTIONARIES_AUTO_RIA_MARKS_TABLE', 'auto_ria_marks'),
        'auto_ria_models' => env('DICTIONARIES_AUTO_RIA_MODELS_TABLE', 'auto_ria_models'),
        'auto_ria_transmissions' => env('DICTIONARIES_AUTO_RIA_TRANSMISSIONS_TABLE', 'auto_ria_transmissions'),
        'auto_ria_ts_types' => env('DICTIONARIES_AUTO_RIA_TS_TYPES_TABLE', 'auto_ria_ts_types'),
    ],
    'mtsbu' => [
        'cities' => env('DICTIONARIES_CITIES_TABLE', 'mtsbu_cities')
    ]
];

if($config['with_exchange']) {
    $config['connections']['exchange'] = env('DICTIONARIES_EXCHANGE_CONNECTION', env('DB_CONNECTION'));
    $config['tables']['exchange'] = env('DICTIONARIES_EXCHANGE_TABLE', 'exchange');
}

return $config;
