<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>VinyStore Artist List</title>
    <link rel = "stylesheet" type = "text/css" href = "/css/filters.css">
    <link rel = "stylesheet" type = "text/css" href = "/css/artists_list.css">
    <link rel = "stylesheet" type = "text/css" href = "/css/top_nav.css">
    <link rel = "stylesheet" type = "text/css" href = "/css/bot_nav.css">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
</head>
<body>
    <?php 
        include_once 'top_nav.php';
        include_once 'bot_nav.php';
        include_once 'filters.php';
    ?>
    
    <!-- <div class="artist-list-container">
        <div class="artist-list">
            <h3>A</h3>
            <hr>
            <p>A Trap Jr. feat. Dj Slyngshot</p>
            <p>A_A</p>
            <p>A:G</p>
            <p>A. Trap Jr.</p>
            <p>A.Mochi</p>
            <p>A2</p>
            <p>Abell</p>
            <p>Abstract</p>
            <p>Abstract Frequencies</p>
            <p>Abstract Matters</p>
            <p>Ac$</p>
            <p>Acanalar</p>
            <p>Accatone</p>
        </div>
        <div class="artist-list">
            <h3>B</h3>
            <hr>
            <p>B-No</p>
            <p>B. B. King</p>
            <p>B.M.U.</p>
            <p>Baaz</p>
            <p>Babe Roots</p>
            <p>Baby Ford</p>
            <p>Babyface</p>
            <p>Bacauanu</p>
            <p>Backstage Boys</p>
            <p>Baertaub</p>
            <p>Babe Roots</p>
            <p>Baby Ford</p>
            <p>Babyface</p>
        </div>
    </div> -->
    <script>
        artistsContainer = document.createElement('div');
        artistsContainer.setAttribute('class', 'artist-list-container');
    </script>
</body>
</html>