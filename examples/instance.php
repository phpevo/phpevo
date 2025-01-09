<?php

use PHPEvo\PHPEvo;

require_once __DIR__ . '/../vendor/autoload.php';

require_once __DIR__ . '/credentials.php';

$phpevo = new PHPEvo($apiKey, $apiBaseUrl);

// create instance
$phpevo
    ->instance()
    ->setName('phpevo-instance')
    ->create();

// list instances
$phpevo
    ->instance()
    ->getAll();

// respond with path temp qrcode
$phpevo
    ->instance()
    ->setName('phpevo-instance')
    ->connect();

// connection state
$status = $phpevo
    ->instance()
    ->setName('phpevo-instance')
    ->getState();

// respond with path temp qrcode
$phpevo
    ->instance()
    ->setName('phpevo-instance')
    ->disconnect();

// destroy instance
$phpevo
    ->instance()
    ->setName('phpevo-instance')
    ->destroy();
