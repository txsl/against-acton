<?php

require __DIR__.'/src/bootstrap.php';

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$data = $_POST;
	if(NoCSRF::check('notrolling', $data))
	{
		if(!array_key_exists('anon', $data))
		{
			$data['anon'] = 0;
		}
		$result = $signatures->insert($data);
		if($result[0])
		{
			// Render good news page
			echo $twig->render('thanks.html.twig');
			session_destroy(); //No need to keep csrf hash any more
		}
		else
		{
			//Render error (and new CSRF key)
			$csrfkey = NoCSRF::generate('notrolling');
			echo $twig->render('landing.html.twig', array('error' => $result[1], 'data'=>$data, 'csrfkey'=>$csrfkey));
		}
	}
	else
	{
		//Render error (and new CSRF key)
		$csrfkey = NoCSRF::generate('notrolling');
		echo $twig->render('landing.html.twig', array('error' => 'Someone was trying to hack you.', 'data'=>$data, 'csrfkey'=>$csrfkey));
	}
}
else
{
	$csrfkey = NoCSRF::generate('notrolling');
	echo $twig->render('landing.html.twig', array('csrfkey'=>$csrfkey));
	$parser = new UAParser;
	$client = $parser->parse($_SERVER['HTTP_USER_AGENT']);
	var_dump($client);
	echo $_SERVER['HTTP_USER_AGENT'];
}