<?php

use PHPEvo\PHPEvo;

require_once __DIR__ . '/../vendor/autoload.php';

require_once __DIR__ . '/credentials.php';

$phpevo = (new PHPEvo($apiKey, $apiBaseUrl))
    ->send
    ->setInstance($instance)
    ->to($phone);

/**
 * send image
 *
 * @return array
 */
$phpevo->sendImage($imagePath);

/**
 * send audio
 *
 * @return array
 */
$phpevo->sendAudio($audioPath);

/**
 * send document
 *
 * @return array
 */
$phpevo->sendDocument($documentPath);

/**
 * send video
 *
 * @return array
 */
$phpevo->sendVideo($videoPath);
