<?php

use Silex\Application;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\DoctrineServiceProvider;
use Symfony\Component\HttpFoundation\Response;

$loader = require_once __DIR__.'/../vendor/autoload.php';

$app = new Application();

$app->register(new TwigServiceProvider(), array('twig.path'    => __DIR__.'/views'));

$app->register(new DoctrineServiceProvider(), array(
    'db.options' => array(
        'driver' => 'pdo_sqlite',
        'path'   => __DIR__.'/../db/users.db',
    ),
));

$app->error(function (\Exception $e, $code) use ($app) {
    if ($app['debug'])
        return;

    $error = 404 == $code ? $e->getMessage() : null;

    return new Response($app['twig']->render('error.html.twig', array('error' => $error)), $code);
});

$app->before(function() use ($app) {
    if (isset($_SERVER['LASTFM_API_KEY']))
        $app['lastfmApiKey'] = $_SERVER['LASTFM_API_KEY'];
    else if (isset($_SERVER['REDIRECT_LASTFM_API_KEY']))
        $app['lastfmApiKey'] = $_SERVER['REDIRECT_LASTFM_API_KEY'];
    else
        return new Response($app['twig']->render('error.html.twig', array('error' => 'No Last.fm API key found!')));
});

require_once __DIR__.'/controllers.php';

return $app;
