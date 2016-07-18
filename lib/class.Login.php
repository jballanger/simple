<?php
	class Login extends PasswordHash
	{
		protected $error = 0,
				  $db,
			      $email,
				  $password;

		public function __construct(PDO $db, $email, $password)
		{
			$this->db = $db;
			$this->PasswordHash(8, FALSE);
			$this->setEmail($email);
			$this->setPassword($password);
			$this->check();
		}

		public function setEmail($email)
		{
			if(filter_var($email, FILTER_VALIDATE_EMAIL))
			{
				$this->email = $email;
			}
			else
			{
				return $this->error = 1;
			}
		}

		public function setPassword($password)
		{
			if(strlen($password) >= 6)
			{
				$this->password = $password;
			}
			else
			{
				return $this->error = 2;
			}
		}

		public function check()
		{
			if($this->error == 0)
			{
				$query = $this->db->query("SELECT password FROM users WHERE email = '$this->email'");
				$hash = $query->fetch();
				if($this->CheckPassword($this->password, $hash[0]))
				{
					return;
				}
				else
				{
					return $this->error = 3;
				}
			}
		}

		public function error()
		{
			return $this->error;
		}
	}
?>