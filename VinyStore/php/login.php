<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel = "stylesheet" type = "text/css" href = "../css/login.css">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <title>VinyStore</title>
    <script src="/js/magnifier.js"></script>
</head>
<body>

<?php
 session_start();
 include_once 'app.model.php';
 class Login extends Logare{

 	public function login(){
 		$modelcon = $this->model('Model');
 		$jsonData = file_get_contents('php://input');
 		$jsonData = json_decode($jsonData);
 		$user = $jsonData->user;
 		$parola = $jsonData->parola;
 		
 		$resultuser = $modelcon->getUser($user);
		$resultpassword = $modelcon->getParola($parola);
 		if ($resultuser == 1){
 			if ($resultpassword == 1){
				 $token = $modelcon->makeToken($user);
				 $_SESSION['token'] = $token ;
 				echo $_SESSION['token'];
 			} else {
 				echo "Parola incorecta";
 			}
 		} else {
 			echo "User incorect ";
 		}
     }
     
 	public function delogin(){
 		$modelcon = $this->model('Model');
 		$jsonData = file_get_contents('php://input');
		$jsonData = json_decode($jsonData);
		$token = $jsonData->token;
 		$result = $modelcon->deleteToken($token);
 		unset($_SESSION['user']);
 		session_destroy();
 		echo $result;
 	}
 }
?>

    <div class="card">
        <h3 class="form-text">To continue, log in to VinyStore.</h3>
            <form>
                <h2 id="username-title">Username:</h2>
                <input type="text" name="username" placeholder="Email adress or username" class="username">
                <h2 id="password-title">Password:</h2>
                <input type="password" name="password" placeholder="Password" class="password">
                <input type="button" onclick = "Logare()" value="Submit" class="submit-button">
            </form>
            <h3 class="form-text">Don't have an account?</h3>
            <input type = "button" onclick = "location.href = './register.html';" class="sign-up-button" value = "Sign up for VinyStore.">
    </div>
</body>
</html>

