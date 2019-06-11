<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Trade Vinyls</title>
    <link rel = "stylesheet" type = "text/css" href = "/css/exchange.css">
    <link rel = "stylesheet" type = "text/css" href = "/css/top_nav.css">
    <link rel = "stylesheet" type = "text/css" href = "/css/bot_nav.css">
    <link rel = "stylesheet" type = "text/css" href = "/css/filters.css">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
</head>
<body>
    <?php 
        include_once 'top_nav.php';
        include_once 'bot_nav.php';
        include_once 'filters.php';
        include_once 'app.model.php';

        if(isset($_SESSION['id_user'])){
            $user = getLoggedUser($_SESSION['id_user']);
        }else{
            header('Location: /login');
        }

        $endpoint = $_SERVER['REQUEST_URI'];
        $id_owner = 0;
        if(preg_match('/^\/users\/[0-9]+\/exchange\/([0-9]*)$/', $endpoint, $id)){
            $id_owner = $id[1];
        }
        $owner = getLoggedUser($id_owner);
    ?>

    <div class = "trade-container">
        <h2>
            In order to exchange your records you must send an email stating your wish and discuss terms with the owner.
        </h2>
        <form action = "" method = "POST">
            <div class = "form-item">
                <label for = "to">Send to:</label>
                <br>
                <input type = "text" id = "to" placeholder = "Email" name = "to" value = <?php echo getLoggedUser($id_owner)->email ?> > 
            </div>
            <br>
            <div class = "form-item">
                <label for = "from">Send from:</label>
                <br>
                <input type = "text" id = "from" placeholder = "Email" name = "from" value = <?php echo $user->email ?> > 
            </div>
            <br>
            <div class = "form-item">
                <label for = "msg">Message:</label>
                <br>
                <input type = "text" id = "msg" placeholder = "Message" name = "msg" value = ""> 
            </div>
            <br>
            <button type = "submit" name = "submit" value = "trade">Send!</button>
        </form>
    </div>

    <?php 
        if(isset($_POST['submit'])){
            if($_POST['submit'] === 'trade'){
                propose_trade($_POST['to'], $_POST['from'], $_POST['msg']);
            }
        }
    ?>
</body>
</html>