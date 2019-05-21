<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>VinyStore</title>
    <link rel = "stylesheet" type = "text/css" href = "/css/top_nav.css">
    <link rel = "stylesheet" type = "text/css" href = "/css/bot_nav.css">
    <link rel = "stylesheet" type = "text/css" href = "/css/filters.css">
    <link rel = "stylesheet" type = "text/css" href = "/css/index.css">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
</head>
<body>
    <?php 
        include_once 'top_nav.php';
        include_once 'bot_nav.php';
        include_once 'filters.php';
    ?>

    <div class = "content-container">
        <div class = "record-container">
            <!--    RECORD FEED STRUCTURE 
            <a href = "./record.php" class = "content-item">
                <img src = "../img/vinyl-record.jpg" alt = "vinyl_img" class = "content-img">
                <p class = "content-info">Artist - Album Name</p>
            </a> 
            -->

            <?php 
                include_once 'app.model.php';

                $records = get_all_records();

                display_feed($records);
            ?>
            

        </div>
    </div>
</body>
</html>
