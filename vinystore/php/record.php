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

    <div class = "record-container">
        <div class = "img-magnifier-container">
            <img src = "../img/nimma-artwork.png" alt = "vinyl_record" id = "record-img">
        </div>
        <div class = "record-info">
            <span class = "info" id = "artist-name">Vot'e</span>
            <br>
            <br>
            <span class = "info" id = "album-name">Hammersmith Flyover</span>
            <br>
            <br>
            <span class = "info" id = "label-name">miNIMMAl movement [NIMMA008]</span>
            <br>
            <br>
            <span class = "info">Genre/s: </span>
            <a href = "#genre" class = "genre-name">Techno</a>
            <a href = "#genre" class = "genre-name">Minimal</a>
            <br>
            <br>
            <span class = "info" id = "price-tag"><del>100 Ron</del>  80 Ron</span>
            <br>
            <br>
            <span class = "info" id = "condition">Mint</span>
            <br>
            <br>
            <span class = "info" id = "added-by">Andrei Popescu</span>
        </div>

        <div class = "audio-container">
            <audio controls loop autoplay>
                <source src = "../audio_clips/A_Vot'e_-_Hammersmith_Flyover_snippet.flac" type = "audio/flac">
                Your browser does not support audio.
            </audio>
        </div>
        
        <div class = "checkout-container">
            <button class = "checkout-btn" id = "wishlist-btn">
                <img src = "../img/wishlist-heart.png" alt = "wishlist_img">
                Add to Wishlist 
            </button>
            <button class = "checkout-btn" id = "buy-btn">
                <img src = "../img/shopping-cart.png" alt = "wishlist_img">
                Add to Cart
            </button>
        </div>
    </div>

    <script>
        magnify(2);
    </script>
</body>
</html>