<?php
	class Login extends PasswordHash
	{
		protected $error = 0,
				  $db,
			      $email,
				  $password;

		public function __construct(PDO $db, $email, $password)
		{
			parent::__construct(8, FALSE);
			$this->db = $db;
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
				$stmt = $this->db->prepare("SELECT password FROM users WHERE email = ?");
				$stmt->execute([$this->email]);
				$hash = $stmt->fetch();
				if($this->CheckPassword($this->password, $hash[0]))
				{
					$this->updateKey();
					return;
				}
				else
				{
					return $this->error = 3;
				}
			}
		}

		public function updateKey()
		{
			$key = random_bytes(32);
			$stmt = $this->db->prepare("UPDATE users SET userKey = ? WHERE email = ?");
			$stmt->execute([$key, $this->email]);
			$_SESSION['userKey'] = $key;
		}

		public function error()
		{
			return $this->error;
		}
	}
?>