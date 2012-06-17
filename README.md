## lastfm-currently-listening-to

A [Silex][1] application to know which song is a [Last.fm][2] user listening to.

Originally a fork of [jmikola][3]'s [hhamon-flying][4] app.  

## Setup

### Install Dependencies

    $ composer.phar install

### Configuration

* Set your Last.fm API key in an environment variable called `LASTFM_API_KEY`.  
If you use Apache you can put in your virtual host configuration or in `web/.htaccess`:

    SetEnv LASTFM_API_KEY your_key

* Create the database and the *users* table:

    sqlite3 db/users.db < db/create_table.sql

  [1]: http://silex.sensiolabs.org/
  [2]: http://last.fm/
  [3]: https://github.com/jmikola
  [4]: https://github.com/jmikola/hhamon-flying
