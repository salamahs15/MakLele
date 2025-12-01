<?php

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

require __DIR__.'/../vendor/autoload.php';

$kernel = require_once __DIR__.'/../bootstrap/app.php';

$response = $kernel->handle(
    $request = Request::capture()
);

$response->send();

$kernel->terminate($request, $response);
