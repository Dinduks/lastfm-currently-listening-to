<?php

$app->get('/{name}', function($name) use ($app) {
    $params = array('username' => $name);

    $query  = "http://ws.audioscrobbler.com/2.0/?method=user.getrecenttracks&user={$name}&limit=1&api_key={$app['lastfmApiKey']}";
    $domdoc = new DOMDocument();
    $domdoc->load($query);
    $track  = $domdoc->getElementsByTagName('track')->item(0);

    if ('true' == $track->getAttribute('nowplaying')) {
        $params['artist'] = $track->getElementsByTagName('artist')->item(0)->nodeValue;
        $params['song'] = $track->getElementsByTagName('name')->item(0)->nodeValue;
        $params['is_listening'] = true;
    } else {
        $params['is_listening'] = false;
    }

    return $app['twig']->render('index.html.twig', $params);
});
