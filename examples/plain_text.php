<?php

use PHPEvo\PHPEvo;

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/credentials.php';

$phpevo = new PHPEvo($apiKey, $apiBaseUrl);
$phpevo = $phpevo->send($instance);

$phpevo
    ->to($phone)
    ->plainText('PHPEvo is awesome!');
