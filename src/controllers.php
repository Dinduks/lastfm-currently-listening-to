<?php

$app->get('/{username}', function($username) use ($app) {
    $params = array('username' => $username);

    $query  = "http://ws.audioscrobbler.com/2.0/?method=user.getrecenttracks&user={$username}&limit=1&api_key={$app['lastfmApiKey']}";
    $domdoc = new DOMDocument();
    $domdoc->load($query);
    $track  = $domdoc->getElementsByTagName('track')->item(0);

    if ('true' == $track->getAttribute('nowplaying')) {
        $params['artist'] = $track->getElementsByTagName('artist')->item(0)->nodeValue;
        $params['song'] = $track->getElementsByTagName('name')->item(0)->nodeValue;
        $params['is_listening'] = true;
        $app['db']->query("REPLACE INTO users ('username', 'updated_at') VALUES ('$username', '".substr(microtime(true), 0, 10)."')");
    } else {
        $params['is_listening'] = false;
    }

    return $app['twig']->render('index.html.twig', $params);
});
