<?php

return [
    'base_url' => env('PAYHUB_BASE_URL'),
    'webhook_uri' => env('PAYHUB_WEBHOOK'),
    'with_log' => env('PAYHUB_WITH_LOG', false),
    'log_table' => env('PAYHUB_LOG_TABLE', 'payhub_log')
];