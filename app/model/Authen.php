<?php

namespace Auth;

class Authen {

	// function __construct(argument)
	// {
	//
	// }

	public function login($user, $pass)
	{

	}

	public function logout(){
		session_start();
		session_unset();
		session_destroy();
		header('Location: ../login.php');
	}
}

 ?>
