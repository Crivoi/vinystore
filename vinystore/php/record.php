<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>VinyStore Record</title>
    <link rel = "stylesheet" type = "text/css" href = "../css/record.css">
    <link rel = "stylesheet" type = "text/css" href = "../css/top_nav.css">
    <link rel = "stylesheet" type = "text/css" href = "../css/bot_nav.css">
    <link rel = "stylesheet" type = "text/css" href = "../css/filters.css">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <script src = "../js/magnifier.js"></script>
</head>
<body>
    
    <?php 
        include_once './top_nav.php';
        include_once './bot_nav.php';
        include_once './filters.php';
    ?>

    <?php 
        include_once 'app.model.php';

        $endpoint = $_SERVER['REQUEST_URI'];
        $method = $_SERVER['REQUEST_METHOD'];
        //$payload = file_get_contents('php://input');

        if(preg_match('/^\/records\/([0-9]*)$/', $endpoint, $id)){

            $record = get_record_by_id($id[1]);
            $recordInfo = [];

            // if(empty($record)){
            //     header("HTTP/1.1 404 NOT FOUND");
            // }

            foreach($record as $rec){
                $recordInfo = [
                    "id" => $id[1],
                    "artist" => $rec['artist'],
                    "album" => $rec['album'],
                    "label" => $rec['label'],
                    "cat" => $rec['catalogue'],
                    "genre" => $rec['genre'],
                    "cond" => $rec['cond'],
                    "price" => $rec['price']
                ];
            }
            display_record($recordInfo);
        }

        if(isset($_POST['submit'])){
            switch($_POST['submit']){
                case 'wishlist':
                    //add_to_wishlist($id);
                    echo '<p>Added to wishlist.</p>';
                    break;
                case 'buy':
                    //add_to_cart($id);
                    echo '<p>Added to cart.</p>';
                    break;
            }
        }
    ?>

    <script>    
        magnify(2);
    </script>

</body>
</html>