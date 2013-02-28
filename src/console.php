#!/usr/bin/php
<?php

require __DIR__.'/bootstrap.php';

switch($argv[1])
{
	case "--cacheTotal":
		$sigs = array();
		$sigs['totalsigs'] = $signatures->numSigs();
		file_put_contents(CACHEDIR.'/totalSigs',json_encode($sigs));
		break;
	default:
		echo 'Invalid command';
}
