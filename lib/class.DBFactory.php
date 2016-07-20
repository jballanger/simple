<?php
	class DBFactory
	{
    	public static function getPDO()
    	{
    		try
    		{
				$db = new PDO('mysql:host=localhost; dbname=simple', 'root', '');
	      		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	      		return $db;
	      	}
	      	catch(PDOException $e)
	      	{
	      		echo "/!\\ Unable to connect to the database, please contact the Administrator /!\\";
	      		exit();
	      	}
    	}
  	}
?>