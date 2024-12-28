<?php

use PHPEvo\PHPEvo;
use PHPEvo\Services\Enums\MediaTypeEnum;

require_once __DIR__ . '/../vendor/autoload.php';

require_once __DIR__ . '/credentials.php';

$phpevo = new PHPEvo($apiKey, $apiBaseUrl);
$phpevo = $phpevo->send($instance);

// $phpevo
//     ->to($phone)
//     ->caption('PHPEvo is awesome!')
//     ->sendImage(__DIR__ . '/media/media.png', MediaTypeEnum::IMAGE);

// $phpevo
//     ->to($phone)
//     ->sendAudio(__DIR__ . '/media/media.mp3');

$response = $phpevo
    ->to($phone)
    ->caption('PHPEvo is awesome!')
    ->sendVideo(__DIR__ . '/media/media.mp4');

var_dump($response);

/* documents */
// $phpevo
//     ->send($instance)
//     ->to($phone)
//     ->fileName('media.pdf')
//     ->media(__DIR__ . '/media/media.pdf', MediaTypeEnum::DOCUMENT);
