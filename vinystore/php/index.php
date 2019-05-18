<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>VinyStore</title>
    <link rel = "stylesheet" type = "text/css" href = "../css/top_nav.css">
    <link rel = "stylesheet" type = "text/css" href = "../css/bot_nav.css">
    <link rel = "stylesheet" type = "text/css" href = "../css/filters.css">
    <link rel = "stylesheet" type = "text/css" href = "../css/index.css">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
</head>
<body>
    <?php 
        include_once './top_nav.php';
        include_once './bot_nav.php';
        include_once './filters.php';
    ?>

    <div class = "content-container">
        <div class = "record-container">
            <!-- <a href = "./record.php" class = "content-item">
                <img src = "../img/vinyl-record.jpg" alt = "vinyl_img" class = "content-img">
                <p class = "content-info">Artist - Album Name</p>
            </a> -->
            <?php 
                ini_set('user_agent', $_SERVER['HTTP_USER_AGENT']);
                $per_page = 13;
                
                $rls_url = "https://api.discogs.com/artists/1/releases?page=\"1\"&per_page=". urlencode($per_page);

                $rls_json = file_get_contents($rls_url);
                $rls_array = json_decode($rls_json, true);

                foreach($rls_array['releases'] as $rls){
                    echo "<a href = \"/records/".$rls['id']."\" class = \"content-item\">";
                    echo "<img src = \"../img/vinyl-record.jpg\" alt = \"vinyl_img\" class = \"content-img\">";
                    echo "<p class = \"content-info\">". $rls['artist'] ." - ". $rls['title'] ."</p>";
                    echo "</a>";
                }
            ?>
        </div>

        <div class = "pagination">
            <a href="#prev">&lsaquo;</a>
            <a href="./index.php?page=1">1</a>
            <a href="./index.php?page=2" class="active">2</a>
            <a href="./index.php?page=3">3</a>
            <a href="./index.php?page=4">4</a>
            <a href="./index.php?page=5">5</a>
            <a href="./index.php?page=6">6</a>
            <a href="#next">&rsaquo;</a>
        </div>
        
        <form action = "./index.php" id = "next" method = "POST">
            <a id = "next" name = "next" href = "javascript:{}" onclick = "document.getElementById('next').submit();">
                <img src = "../img/right-arrow.png" alt = "right_arrow" class = "right-arrow">
            </a>
        </form>

        <a href = "#prev">
            <img src = "../img/left-arrow.png" alt = "left_arrow" class = "left-arrow">
        </a>

    </div>
</body>
</html>
