<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>VinyStore Record</title>
    <link rel = "stylesheet" type = "text/css" href = "/css/add_record.css">
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
    ?>

    <div class = "add-container">
        <form action = "" method = "POST" class = "add-form" id = "form-id" enctype="multipart/form-data">
            <h2>Insert Record Information: </h2>
            <div class = "form-item">
                <label for = "artist">Artist: </label>
                <input id = "artist" placeholder = "artist/s" type = "text" name = "artist" value = "ARTIST_TEST_1">
            </div>
            <div class = "form-item">
                <label for = "release">Album: </label>
                <input id = "release" placeholder = "release" type = "text" name = "release" value = "ALBUM_TEST_1">
            </div>
            <div class = "form-item">
                <label for = "label">Label: </label>
                <input id = "label" placeholder = "label" type = "text" name = "label" value = "LABEL_TEST_1">
            </div>
            <div class = "form-item">
                <label for = "cat">Catalogue: </label>
                <input id = "cat" placeholder = "catalogue" type = "text" name = "cat" value = "TEST001">
            </div>
            <div class = "form-item">
                <label for = "genre">Genre/s: </label>
                <input id = "genre" placeholder = "genre/s" type = "text" name = "genre" value = "HOUSE">
            </div>
            <div class = "form-item">
                <label>Record Condition: </label>
                <select form = "form-id" id = "condition" name = "condition">
                    <option value = "M">Mint</option>
                    <option value = "NM">Near Mint</option>
                    <option value = "VG">Very Good</option>
                    <option value = "G">Good</option>
                    <option value = "P">Poor</option>
                </select>
            </div>
            <div class = "form-item">
                <label for = "price">Price: </label>
                <input id = "price" placeholder = "price" type = "number" name = "price" value = "100">
            </div>
            <div class = "form-item">
                <label for = "cover">Upload cover art: </label>
                <input id = "cover" type = "file" name = "cover" accept = "image/*" hidden>
                <label for = "cover" id = "cover-label">
                    <div class = "cover-div">
                        Choose cover-art image
                    </div>
                </label>
            </div>
            <div class = "form-item">
                <label for = "clip">Upload preview: </label>
                <input id = "preview" type = "file" name = "preview" accept = "audio/*" hidden>
                <label for = "preview" id = "preview-label">
                    <div class = "cover-div">
                        Choose preview clip
                    </div>
                </label>
            </div>
            <div class = "form-item" id = "form-submit">
                <button id = "submit" type = "submit" name = "submit">Submit</button>
            </div>
        </form>
    </div>

    <?php
        include_once 'app.model.php';

        if(isset($_POST['submit'])){
            if(!empty($_POST['artist']) &&
                !empty($_POST['release']) &&
                !empty($_POST['label']) &&
                !empty($_POST['cat']) &&
                !empty($_POST['genre']) &&
                !empty($_POST['condition']) &&
                !empty($_POST['price'])){
                    add_record($_POST['artist'], $_POST['release'], $_POST['label'], $_POST['cat'], $_POST['genre'], $_POST['condition'],  $_POST['price']);
            }
            else{
                echo "<br><br><h2>Please fill in all the information needed!</h2>";
            }
        }
        
    ?>
</body>
</html>