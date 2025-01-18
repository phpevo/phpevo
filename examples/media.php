<?php

use PHPEvo\PHPEvo;

require_once __DIR__ . '/../vendor/autoload.php';

require_once __DIR__ . '/credentials.php';

$phpevo = (new PHPEvo($apiKey, $apiBaseUrl))->send;
$phpevo = $phpevo
    ->setInstance($instance)
    ->to($phone);

/**
 * @return array
 */
$phpevo->sendImage($imagePath);

/**
 * @return array
 */
$phpevo->sendAudio($audioPath);

/**
 * @return array
 */
$phpevo->sendDocument($documentPath);

/**
 * @return array
 */
$phpevo->sendVideo($videoPath);
