<?php

use PHPEvo\PHPEvo;

require_once __DIR__ . '/../vendor/autoload.php';

$evophp = new PHPEvo($apiKey, $apiBaseUrl);

$evophp
    ->send($instance)
    ->to('5511999999999')
    ->plainText('PHPEvo is awesome!');
