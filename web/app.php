<?php

use Symfony\Component\HttpFoundation\Request;

/**
 * @var Composer\Autoload\ClassLoader
 */
$loader = require __DIR__ . '/../app/autoload.php';
include_once __DIR__ . '/../var/bootstrap.php.cache';

$debug = true;
$kernel = new AppKernel('dev', $debug);
$kernel->loadClassCache();

// When using the HTTP Cache to improve application performance, the application
// kernel is wrapped by the AppCache class to activate the built-in reverse proxy.
// See http://symfony.com/doc/current/book/http_cache.html#symfony-reverse-proxy
//$kernel = new AppCache($kernel);

// When using the HttpCache, you need to call the method in your front controller instead of relying on the configuration parameter
//Request::enableHttpMethodParameterOverride();

$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);
