<?php
	require_once('plugins/twitter-api/twitteroauth.php');
	
	define('CONSUMER_KEY', 'z7U8aLtYx6RayHz2xJcegWmYI');
	define('CONSUMER_SECRET', 'dTWikje9NdTat0SClvO9nblFjgOKK0ZK1ccHtFRgF63soJ6aSG');
	define('ACCESS_TOKEN', '118893770-hATc9y91PMt5xiPKM3xk8to25BPC1hlDWQAkZKT9');
	define('ACCESS_TOKEN_SECRET', 'L5HPD8igz3atazpLT6culxw9nkEjsLiSNEDwErDU2ofzz');

	function search($query){
	  $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, ACCESS_TOKEN, ACCESS_TOKEN_SECRET);
	  return $connection->get('search/tweets',$query);
	}
?>
