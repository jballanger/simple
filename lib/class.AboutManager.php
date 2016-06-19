<?php
   	class AboutManager
	{
	    protected $db;

	    public function __construct(PDO $db)
	    {
	      $this->db = $db;
	    }

	    public function getAbout()
	    {
	    	return $this->db->query("SELECT content FROM about")->fetchColumn();
	    }
	}
?>