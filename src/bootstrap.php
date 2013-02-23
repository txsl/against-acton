<?php

/*
	Bootstrap file which includes all of the various bits we're gonna use.
*/

//We need a database!
require __DIR__.'/db.php';

//Let's get Twig set up
require __DIR__.'/../libs/vendor/autoload.php';

$loader = new Twig_Loader_Filesystem(__DIR__.'/views/');
$twig = new Twig_Environment($loader);

