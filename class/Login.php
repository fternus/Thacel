<?php

class Login
{
	private $error = "";

	public function evaluate($data)
	{
		$email = addslashes($data["email"]);

		$password = addslashes($data["password"]);

		$query = "SELECT * FROM users WHERE email = '$email' LIMIT 1 ";

		$DB = new Database();
		$result = $DB->read($query);

		if ($result) {
			$row = $result[0];

			if ($password == $row["password"]) {
				// create session data
				$_SESSION["thacel_userid"] = $row["userid"];
			} else {
				$error .= "wrong password<br>";
			}
		} else {
			$this->error .= "No Email found <br>";
		}
		return $this->error;
	}
	public function check_login($id)
	{
		if (is_numeric($id)) {
			$query = "SELECT * FROM users WHERE userid = '$id' LIMIT 1 ";

			$DB = new Database();
			$result = $DB->read($query);

			if ($result) {
				$user_data = $result[0];
				return $user_data;
			} else {
				header("Location: login.php");
				die;
			}
		} else {
			header("Location: login.php");
			die();
		}
	}
}
