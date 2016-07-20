<?php
	class AdminManager
	{
		protected $db;

		public function __construct(PDO $db)
		{
			$this->db = $db;
		}

		public  function keyChecker($key)
		{
			$stmt = $this->db->prepare("SELECT COUNT(*) FROM users WHERE userKey = ?");
			$stmt->execute([$key]);

			return $stmt->fetchColumn();
		}
	}
?>