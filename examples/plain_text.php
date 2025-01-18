<?php

use PHPEvo\PHPEvo;

require_once __DIR__ . '/../vendor/autoload.php';

require_once __DIR__ . '/credentials.php';

$phpevo = (new PHPEvo($apiKey, $apiBaseUrl))->send;
$phpevo
    ->setInstance($instance)
    ->to($phone);

/**
 * @return array
 */
$phpevo->text($message, $params);
