## lastfm-currently-listening-to

A [Silex][1] application to know which song is a [Last.fm][2] user listening to.

Originally a fork of [jmikola][3]'s [hhamon-flying][4] app.  

## Setup

### Install Dependencies

    $ composer.phar install

### Configuration

The `src/` directory includes a `config.php.dist` file, which should be copied
to `config.php` and populated with your Last.fm API key.

  [1]: http://silex.sensiolabs.org/
  [2]: http://last.fm/
  [3]: https://github.com/jmikola
  [4]: https://github.com/jmikola/hhamon-flying
