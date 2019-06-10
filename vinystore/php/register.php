<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel = "stylesheet" type = "text/css" href = "css/register.css">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <title>VinyStore</title>
</head>
<body>
    <div class="card">
            <h3 class="form-text">And now, put your data in this form to enter in the beautiful world of vinyls.🎇</h3>
            <form class="form" action = "" method = "POST">
                <div class = "form-item">
                    <h2 id="username-title">Username:</h2>
                    <input type="text" name="username" placeholder="Username" class="username" value = "bob" required>
                </div>
                
                <div class = "form-item">
                    <h2 id="email-title">Email:</h2>
                    <input type="text" name="email" placeholder="Email" class="email" value = "bob@gmail.com" required>
                </div>

                <div class = "form-item">
                    <h2 class="password-title">Password:</h2>
                    <input type="password" name="password" placeholder="Password" class="password" value = "bob" required>
                </div>

                <div class = "form-item">
                    <h2 class="age-title">Age: </h2>
                    <input type="text" name="age" placeholder="Age" class="password" value = "25" required> 
                </div>

                <div class = "form-item">
                    <h2 class="password-title">First Name: </h2>
                    <input type="text" name="firstName" placeholder="First Name" class="password" value = "Bob" required>
                </div>

                <div class = "form-item">
                    <h2 class="password-title">Last Name: </h2>
                    <input type="text" name="lastName" placeholder="Last Name" class="password" value = "Bobber" required>
                </div>

                <div class = "form-item">
                    <h2 class="password-title">Address: </h2>
                    <input type="text" name="address" placeholder="Address" class="password" value = "Bob Str." required>
                </div>

                <div class = "form-item">
                    <h2 class="password-title">Postal Code: </h2>
                    <input type="text" name="postalCode" placeholder="Postal Code" class="password" value = "101010" required>
                </div>

                <div class = "form-item">
                    <h2 class="password-title">Phone Nr: </h2>
                    <input type="text" name="phoneNr" placeholder="Phone Nr" class="password" value = "+40723124123" required>
                </div>

                <button name = "submit" type="submit" value="register" class="submit-button">Register!</button>
            </form> 
    </div>

    <?php 
        include_once 'app.model.php';
        
        session_start(); 
        
        $id = NULL;
    
        if(isset($_POST['submit'])) {
            if($_POST['submit'] === 'register'){
                $id = register($_POST['username'], $_POST['password'], $_POST['email'], $_POST['firstName'], 
                    $_POST['lastName'], $_POST['age'], $_POST['address'], $_POST['postalCode'], $_POST['phoneNr']);

                if($id != false){
                    $_SESSION['id_user'] = $id;
                    header("Location: http://localhost:81/users/". $id ."/home");
                }
            }
        }
    ?>
</body>
</html>