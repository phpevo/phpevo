<?php

use Evolution\Evolution;

require_once __DIR__ . '/../vendor/autoload.php';

require_once __DIR__ . '/credentials.php';

$evolution = new Evolution($apiKey, $apiBaseUrl);

$message = $evolution
    ->send($instance)
    ->to('5599999999999')
    ->plainText('Evolution SDK Running...');

print_r($message);
