<?php

use Evolution\Evolution;

require_once __DIR__ . '/../vendor/autoload.php';

require_once __DIR__ . '/credentials.php';

$evolution = (new Evolution($apiKey, $apiBaseUrl))
    ->send($instance);

$message = $evolution
    ->to('5599999999999')
    ->plainText('Evolution SDK Running...');
