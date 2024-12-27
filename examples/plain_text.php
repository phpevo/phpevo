<?php

use PHPEvo\PHPEvo;

require_once __DIR__ . '/../vendor/autoload.php';

$phpevo = new PHPEvo($apiKey, $apiBaseUrl);

$phpevo
    ->send($instance)
    ->to('5511999999999')
    ->plainText('PHPEvo is awesome!');
