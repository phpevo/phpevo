<?php

use PHPEvo\PHPEvo;

require_once __DIR__ . '/../vendor/autoload.php';

require_once __DIR__ . '/credentials.php';

$phpevo = (new PHPEvo($apiKey, $apiBaseUrl));
$phpevo = $phpevo->send($instance);

$phpevo
    ->to($phone)
    ->caption('PHPEvo is awesome!')
    ->sendImage(__DIR__ . '/media/media.png');

$phpevo
    ->to($phone)
    ->sendAudio(__DIR__ . '/media/media.mp3');

$phpevo
    ->to($phone)
    ->fileName('media.pdf')
    ->sendDocument(__DIR__ . '/media/media.pdf');

// $vid = $phpevo
//     ->to($phone)
//     ->caption('PHPEvo is awesome!')
//     ->sendVideo(__DIR__ . '/media/media.mp4');
