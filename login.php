<?php
	require('./lib/autoload.php');
	$db = DBFactory::getPDO();

	if(isset($_POST['email']) && isset($_POST['password']))
	{
		$login = new Login($db, $_POST['email'], $_POST['password']);
		if(!$login->error())
		{
			$_SESSION['email'] = $_POST['email'];
			header('Location:index.php');
		}
		else
		{
			switch($login->error())
			{
				case 1: $_SESSION['error'] = "Invalid email format";
				break;
				case 2: $_SESSION['error'] = "Invalid password format (6-25 characters)";
				break;
				case 3: $_SESSION['error'] = "Invalid email or password";
				break;
			}
			
			header('Location:index.php');
		}
	}
	else
	{
		$_SESSION['error'] = "Fill all the field please";
		header('Location:index.php');
	}
?>