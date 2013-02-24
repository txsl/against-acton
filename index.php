<?php

require __DIR__.'/src/bootstrap.php';

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$data = $_POST;
	if(!array_key_exists('anon', $data))
	{
		$data['anon'] = 0;
	}
	$result = $signatures->insert($data);
	var_dump($result);
}

echo $twig->render('landing.html.twig');

var_dump($_POST);