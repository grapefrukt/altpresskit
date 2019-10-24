<?php
/**
* The install path on your server, if it's in the root ie. http://altpresskit.grapefrukt.com leave it empty
* If in a subfolder like http://grapefrukt.com/presskit/, put presskit/ below. The trailing slash is important!
* To make the nice URLs work, you will also need to set your base path in the .htaccess file
*/
set('BASE_PATH', '');

/**
* Some hosts break the autodetect of mod_rewrite, set this to true to override the autodetect
*/
set('FORCE_MOD_REWRITE', 'false');

?>