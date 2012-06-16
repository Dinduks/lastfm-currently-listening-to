<?php

use Silex\Application;
use Silex\Provider\TwigServiceProvider;
use Symfony\Component\HttpFoundation\Response;

$loader = require_once __DIR__.'/../vendor/autoload.php';

$app = new Application();

require_once __DIR__.'/config.php';

$app->register(new TwigServiceProvider(), array('twig.path'    => __DIR__.'/views'));

$app->error(function (\Exception $e, $code) use ($app) {
    if ($app['debug'])
        return;

    $error = 404 == $code ? $e->getMessage() : null;

    return new Response($app['twig']->render('error.html.twig', array('error' => $error)), $code);
});

$app->before(function() use ($app, $lastfmApiKey) {
    if (isset($lastfmApiKey))
        $app['lastfmApiKey'] = $lastfmApiKey;
    else
        return new Response($app['twig']->render('error.html.twig', array('error' => 'No Last.fm API key found!')));
});

require_once __DIR__.'/controllers.php';

return $app;
