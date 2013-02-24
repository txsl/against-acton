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
	if($result[0])
	{
		// Render good news page
		echo 'thanks!';
	}
	else
	{
		//Render error
		echo $twig->render('landing.html.twig', array('error' => $result[1], 'data'=>$data));
	}
}
else
{
	echo $twig->render('landing.html.twig');
}