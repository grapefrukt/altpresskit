<?php

/**
* The install path on your server, if it's in the root ie. http://altpresskit.grapefrukt.com leave it empty
* If in a subfolder like http://grapefrukt.com/presskit/, put presskit/ below 
*/
define('BASE_PATH', '');

/**
* Promoter overwrite
* Set to true (default), to have your promoter reviews overwrite any locally defined reviews
* Set to false to append any reviews from promoter to the locally defined list
*/
define('PROMOTER_OVERWRITE', true);

/**
* Promoter cache
* The number of seconds before locally cached copy of promoter data is invalidated (defaults to 3600)
*/
define('PROMOTER_CACHE_DURATION', 3600);

?>