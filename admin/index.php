<?php
	require('../lib/autoload.php');
	if(isset($_SESSION['userKey']))
	{
		$db = DBFactory::getPDO();
		$AdminManager = new AdminManager($db);

		if($AdminManager->keyChecker($_SESSION['userKey']))
		{
			require('panel.php');
		}
		else
		{
			$_SESSION['error'] = "You're not authorized to access this page :/";
			header('Location:../index.php');
		}
	}
	else
	{
		$_SESSION['error'] = "You're not authorized to access this page :/";
		header('Location:../index.php');
	}
?>