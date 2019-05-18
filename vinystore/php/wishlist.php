<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Wishlist</title>
    <link rel = "stylesheet" type = "text/css" href = "/css/top_nav.css">
    <link rel = "stylesheet" type = "text/css" href = "/css/bot_nav.css">
    <link rel = "stylesheet" type = "text/css" href = "/css/filters.css">
    <link rel = "stylesheet" type = "text/css" href = "/css/wishlist.css">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
</head>
<body>
    <?php 
        include_once './top_nav.php';
        include_once './bot_nav.php';
        include_once './filters.php';
    ?>
    <div class = "wish-container">
        <h3>Your wishlist: </h3>
        <table class = "wish-table">
            <tr>
                <th>Artist</th>
                <th>Album</th>
                <th>Label</th>
                <th>Genre</th>
                <th>Price</th>
            </tr>
            <tr>
                <td>Vot'e</td>
                <td><a href = "./record.html">Hammersmith Flyover</a></td>
                <td>miNIMMAl movement [NIMMA008]</td>
                <td>Techno, Minimal</td>
                <td>80 Ron</td>
            </tr>
            <tr>
                <td>Vot'e</td>
                <td><a href = "./record.html">Hammersmith Flyover</a></td>
                <td>miNIMMAl movement [NIMMA008]</td>
                <td>Techno, Minimal</td>
                <td>80 Ron</td>
            </tr>
            <tr>
                <td>Vot'e</td>
                <td><a href = "./record.html">Hammersmith Flyover</a></td>
                <td>miNIMMAl movement [NIMMA008]</td>
                <td>Techno, Minimal</td>
                <td>80 Ron</td>
            </tr>
        </table>
    </div>

</body>
</html>