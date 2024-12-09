<?php

use Evolution\Evolution;
use Evolution\Services\Enums\MediaTypeEnum;

require_once __DIR__ . '/../vendor/autoload.php';

require_once __DIR__ . '/credentials.php';

$evolution = (new Evolution($apiKey, $apiBaseUrl))
    ->send($instance)
    ->to($phone);

// image
$image = $evolution
    ->caption('Image - Evolution SDK Running...')
    ->fileName('media.png')
    ->media('https://pps.whatsapp.net/v/t61.24694-24/461453889_1003211914911151_4640067951401387632_n.jpg?stp=dst-jpg_tt6&ccb=11-4&oh=01_Q5AaIPA44s_lY3wrfH-fBLBNPytUMRNTbpRNwuyU2gKearCm&oe=67634050&_nc_sid=5e03e0&_nc_cat=105', MediaTypeEnum::IMAGE);

print_r($image);

// audio
$audio = $evolution
    ->fileName('media.mp3')
    ->media('http://webaudioapi.com/samples/audio-tag/chrono.mp3', MediaTypeEnum::AUDIO);

print_r($audio);

// video
$video = $evolution
    ->caption('Video - Evolution SDK Running...')
    ->fileName('media.mp4')
    ->media('./media/media.mp4', MediaTypeEnum::VIDEO);

print_r($video);

// document
$document = $evolution
    ->caption('Document - Evolution SDK Running...')
    ->fileName('media.pdf')
    ->media('./media/media.pdf', MediaTypeEnum::DOCUMENT);

print_r($document);
