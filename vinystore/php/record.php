<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>VinyStore Record</title>
    <link rel = "stylesheet" type = "text/css" href = "/css/record.css">
    <link rel = "stylesheet" type = "text/css" href = "/css/top_nav.css">
    <link rel = "stylesheet" type = "text/css" href = "/css/bot_nav.css">
    <link rel = "stylesheet" type = "text/css" href = "/css/filters.css">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <script src = "../js/magnifier.js"></script>
</head>
<body>
    
    <?php 
        include_once 'top_nav.php';
        include_once 'bot_nav.php';
        include_once 'filters.php';

        include_once 'app.model.php';

        $endpoint = $_SERVER['REQUEST_URI'];
        // $method = $_SERVER['REQUEST_METHOD'];
        //$payload = file_get_contents('php://input');

        if(preg_match('/^\/records\/([0-9]*)$/', $endpoint, $id)){

            $record = get_record_by_id($id[1]);
            $recordInfo = [];

            foreach($record as $rec){
                $recordInfo = [
                    "id_record" => $id[1],
                    "artist" => $rec['artist'],
                    "album" => $rec['album'],
                    "label" => $rec['label'],
                    "cat" => $rec['catalogue'],
                    "genre" => $rec['genre'],
                    "cond" => $rec['cond'],
                    "price" => $rec['price']
                ];
            }
            if(!empty($recordInfo)){
                http_response_code(200);
                display_record($recordInfo);
            }
            else{
                http_response_code(404);
                echo '<h2 style="position: absolute;
                left: 30%;
                top: 50%;">Oops! This item is not in our database!</h2>';
            }
        }

        if(isset($_POST['submit'])){
            switch($_POST['submit']){
                case 'wishlist':
                    //add_to_wishlist($id);
                    echo '<p>Added to wishlist.</p>';
                    break;
                case 'cart':
                    //add_to_cart($id);
                    echo '<p>Added to cart.</p>';
                    break;
                case 'trade':
                    //propose_trade();
                    echo '<p>Traded.</p>';
                    break;
                default:
                    echo 'aiurea';

            }
        }
    ?>

    <script>    
        magnify(2);
    </script>

</body>
</html>