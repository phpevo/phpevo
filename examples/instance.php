<?php

require_once __DIR__ . '/../vendor/autoload.php';

require_once __DIR__ . '/credentials.php';

use PHPEvo\PHPEvo;

$phpevo = (new PHPEvo($apiKey, $apiBaseUrl))->instance;

/**
 * set instance name
 *
 * @return PHPEvo
 */
$phpevo->setName('phpevo');

/**
 * create instance
 *
 * @return array with key qrcode with base64 image
 */
$phpevo->create();

/**
 * connect instance
 *
 * @return array with key qrcode with base64 image
 */
$phpevo->connect();

/**
 * get state of instance
 *
 * @return array with state key
 */
$phpevo->getState();

/**
 * disconnect instance
 *
 * @return bool
 */
$phpevo->disconnect();

/**
 * destroy instance
 *
 * @return bool
 */
$phpevo->destroy();
