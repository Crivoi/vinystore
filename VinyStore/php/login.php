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
    <div class="card">
        <h3 class="form-text">To continue, log in to VinyStore.</h3>
            <form action = "" method="POST">
                <h2 id="username-title">Username:</h2>
				<input type="text" name="username" placeholder="Username" class="username" required>
				
                <h2 id="password-title">Password:</h2>
				<input type="password" name="password" placeholder="Password" class="password" required>
				
				<button type="submit" name = "submit" value="login" class="submit-button">Login!</button>
			</form>

			<h3 class="form-text">Don't have an account?</h3>
            <input type = "button" onclick="window.location='/register';" class="sign-up-button" value = "Sign up for VinyStore.">
    </div>

    <?php 
        include_once 'app.model.php';
        
        session_start(); 
        
        $id = NULL;

        if(isset($_POST['submit'])) {
            if($_POST['submit'] === 'login'){
                echo $_POST['username'].' '.$_POST['password'].' '. strlen(md5('pulapizdacoaiele')) .'<br>';
                $user = login($_POST['username'], $_POST['password']);

                if($user != NULL){
                    header("Location: http://localhost:81/users/". $user->id ."/home");
                    $_SESSION['id_user'] = $user->id;
                }
                else{
                    echo 'e null boule';
                }
            }
        }
    ?>
</body>
</html>