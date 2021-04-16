<?php

	define('HOST2','localhost');
	define('DB_NAME2','banque');
	define('USER2','root');
	define('PASS2','');

	try
	{
		$dbBank = new PDO("mysql:host=" . HOST2 . ";dbname=" . DB_NAME2, USER2, PASS2);
		$dbBank->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}

	catch(PDOException $e)
	{
		echo $e;
	}

?>