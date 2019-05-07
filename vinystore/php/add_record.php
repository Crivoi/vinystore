<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>VinyStore Record</title>
    <link rel = "stylesheet" type = "text/css" href = "../css/add_record.css">
    <link rel = "stylesheet" type = "text/css" href = "../css/top_nav.css">
    <link rel = "stylesheet" type = "text/css" href = "../css/bot_nav.css">
    <link rel = "stylesheet" type = "text/css" href = "../css/filters.css">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
</head>
<body>
    <?php 
        include_once './top_nav.php';
        include_once './bot_nav.php';
        include_once './filters.php';
    ?>

    <div class = "add-container">
        <form action = "./record.php" method = "POST" class = "add-form" id = "form-id">
            <h2>Insert Record Information: </h2>
            <div class = "form-item">
                <label for = "artist">Artist: </label>
                <input id = "artist" placeholder = "artist/s" type = "text" name = "artist">
            </div>
            <div class = "form-item">
                <label for = "release">Album: </label>
                <input id = "release" placeholder = "release" type = "text" name = "release">
            </div>
            <div class = "form-item">
                <label for = "label">Label: </label>
                <input id = "label" placeholder = "label" type = "text" name = "label">
            </div>
            <div class = "form-item">
                <label for = "cat">Catalogue: </label>
                <input id = "cat" placeholder = "catalogue" type = "text" name = "cat">
            </div>
            <div class = "form-item">
                <label for = "genre">Genre/s: </label>
                <input id = "genre" placeholder = "genre/s" type = "text" name = "genre">
            </div>
            <div class = "form-item">
                <label>Record Condition: </label>
                <!-- <input id = "quality" type = "select" name = "quality"> -->
                <select form = "form-id" id = "condition">
                    <option value = "M">Mint</option>
                    <option value = "NM">Near Mint</option>
                    <option value = "VG">Very Good</option>
                    <option value = "G">Good</option>
                    <option value = "P">Poor</option>
                </select>
            </div>
            <div class = "form-item">
                <label for = "cover">Upload cover art: </label>
                <input id = "cover" type = "file" name = "cover" accept = "image/*">
                <label for = "cover" id = "cover-label">
                    <div class = "cover-div">
                        <!-- <img src = "../img/upload.png" alt = "upload"> -->
                        Choose cover-art image
                        <!-- <img src = "../img/upload.png" alt = "upload"> -->
                    </div>
                </label>
            </div>
            <div class = "form-item" id = "form-submit">
                <input id = "sub" type = "submit" name = "sub">
            </div>
        </form>
    </div>
</body>
</html>