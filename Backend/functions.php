<?php
	session_start();
	include_once('connection.php');
	
	function register(){
		global $DB;
		$errors = [];
		$success = false;

		if(isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["confirm_password"]) ){
			$name = trim($_POST["name"]);
			$email = trim($_POST["email"]);
			$password = $_POST["password"];
			$confirm_password = $_POST["confirm_password"];
			
			// Form validation (email and password)
			if($password !== $confirm_password) $errors[] = 'Password do not match';
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$errors[]="Invalid email";
			}

			// Insert Data to DB if no errors
			if(count($errors) === 0){
				try{
					$query = $DB->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
					$query->execute([$name, $email, $password]);
					if($query->rowCount() > 0){
						$success = true;
					}
				}catch(PDOException $e){
					$errors[] = 'Error saving record <br>'.$e;
				}
			}			
		}else{
			$errors[] = 'Please check to confirm all required fields are filled';
		}

		return ['errors'=>$errors, 'success'=>$success];
	}

	function login(){
		$errors = [];
		$success = false;
		global $DB;

		if( isset($_POST["email"]) && isset($_POST["password"]) ){
			$email = trim($_POST["email"]);
			$password = $_POST["password"];
			
			// Form validation (email)
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$errors[]="Invalid email";
			}

			// Select User from DB if no errors
			if(count($errors) === 0){
				try{
					$query = $DB->prepare("SELECT id, name, email, created_at FROM users WHERE email = ? AND password = ?");
					$query->execute([$email, $password]);
					if($query->rowCount() > 0){
						$query = $query->fetch(PDO::FETCH_ASSOC);
						$success = true;
						$_SESSION['user'] = $query;
						redirect_to('index.php');
					}
				}catch(PDOException $e){
					$errors[] = 'Error saving record <br>'.$e;
				}
			}

		}else{
			$errors[] = 'Please check to confirm all required fields are filled';
		}

		return ['errors'=>$errors, 'success'=>$success, 'data'=>$query];
	}

	function logout(){
		//Erase all session variables
		$_SESSION = [];

		//Destroy the session
		session_destroy();

		// Redirect to login
		redirect_to('login.php');
	}

	function confirm_auth(){	
		if(!isset($_SESSION['user'])){
			redirect_to('login.php');
		}else{
			return $_SESSION['user'];
		}
	}

	function redirect_to(String $location){
		header("Location: {$location}"); 
		exit();
	}
	
?>
