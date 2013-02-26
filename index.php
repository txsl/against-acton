<?php

require __DIR__.'/src/bootstrap.php';

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$data = $_POST;
	// if(NoCSRF::check('notrolling', $data))
	// {
	// 	if(!array_key_exists('anon', $data))
	// 	{
	// 		$data['anon'] = 0;
	// 	}
	// 	$result = $signatures->insert($data);
	// 	if($result[0])
	// 	{
	// 		// Render good news page
	// 		echo $twig->render('thanks.html.twig');
	// 		session_destroy(); //No need to keep csrf hash any more
	// 	}
	// 	else
	// 	{
	// 		//Render error (and new CSRF key)
	// 		$csrfkey = NoCSRF::generate('notrolling');
	// 		echo $twig->render('landing.html.twig', array('error' => $result[1], 'data'=>$data, 'csrfkey'=>$csrfkey));
	// 	}
	// }
	// else
	// {
		//Render error (and new CSRF key)
		$csrfkey = NoCSRF::generate('notrolling');
		echo $twig->render('landing.html.twig', array('error' => 'Yikes! Our CSRF (Request Forgery Protection) system tripped. If this keeps happening, please <a href="mailto:thomas.lim11@imperial.ac.uk">let us know</a>.', 'data'=>$data, 'csrfkey'=>$csrfkey));
	//}
}
else
{
	$csrfkey = NoCSRF::generate('notrolling');
	echo $twig->render('landing.html.twig', array('csrfkey'=>$csrfkey));
	$analytics = new Analytics($db);
	$analytics->insertUAString($_SERVER['HTTP_USER_AGENT']);
	/*$parser = new UAParser;
	$client = $parser->parse($_SERVER['HTTP_USER_AGENT']);*/
}