<?php

use PHPEvo\PHPEvo;
use PHPEvo\Services\Enums\MediaTypeEnum;

require_once __DIR__ . '/../vendor/autoload.php';

require_once __DIR__ . '/credentials.php';

$phpevo = new PHPEvo($apiKey, $apiBaseUrl);

$phpevo
    ->send($instance)
    ->to($phone)
    ->media(__DIR__ . '/media/media.png', MediaTypeEnum::IMAGE);

$audio = $phpevo
    ->send($instance)
    ->to($phone)
    ->media(__DIR__ . '/media/media.m4a', MediaTypeEnum::AUDIO);

$phpevo
    ->send($instance)
    ->to($phone)
    ->caption('Video - Evolution SDK Running...')
    ->media(__DIR__ . '/media/media.mp4', MediaTypeEnum::VIDEO);

$phpevo
    ->send($instance)
    ->to($phone)
    ->fileName('media.pdf')
    ->media(__DIR__ . '/media/media.pdf', MediaTypeEnum::DOCUMENT);
