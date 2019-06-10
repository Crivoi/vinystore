<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>VinyStore Profile</title>
    <link rel = "stylesheet" type = "text/css" href = "/css/filters.css">
    <link rel = "stylesheet" type = "text/css" href = "/css/profile.css">
    <link rel = "stylesheet" type = "text/css" href = "/css/top_nav.css">
    <link rel = "stylesheet" type = "text/css" href = "/css/bot_nav.css">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
</head>
<body>
    
    <?php 
        include_once 'top_nav.php';
        include_once 'bot_nav.php';
        include_once 'filters.php';

        include_once './app.model.php';

        $endpoint = $_SERVER['REQUEST_URI'];

        if(preg_match('/^\/users\/([0-9]+)$/', $endpoint, $id)){
            $user = get_user_by_id($id[1]);
            $userInfo = [];
            foreach($user as $usr){
                    $userInfo = [
                        "id_user" => $id[1],
                        "username" => $usr['username'],
                        "password" => $usr['password'],
                        "email" => $usr['email'],
                        "first_name" => $usr['first_name'],
                        "last_name" => $usr['last_name'],
                        "age" => $usr['age'],
                        "address" => $usr['address'],
                        "postal_code" => $usr['postal_code'],
                        "phone_nr" => $usr['phone_nr']
                    ];
            }
            if(!empty($userInfo)){
                http_response_code(200);
                display_user($userInfo);

                echo $_SESSION['id_user'];

                echo '<form action = "/php/profile.controller.php" id = "logout-form" method = "POST" id = "checkout-form">
                        <button type = "submit" name = "submit" class = "checkout-btn">
                            <img src = "/img/logout.png" alt = "cart_img">
                            Log Out
                        </button>
                    </form>';
            }
            else{
                http_response_code(404);
                echo '<h2 style="position: absolute;
                left: 30%;
                top: 50%;">Oops! This item is not in our database!</h2>';
            }
  
        }
    ?>    
</body>
</html>