<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My Records</title>
    <link rel = "stylesheet" type = "text/css" href = "/css/my_records.css">
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
        
        include_once 'app.model.php'
    ?>

    <div class = "records-container">
        <h3>Your records: </h3>
        <!-- <table class = "records-table">
            <tr>
                <th>Artist</th>
                <th>Album</th>
                <th>Label</th>
                <th>Genre</th>
                <th>Price</th>
                <th>Delete</th>
            </tr>
            <tr>
                <td>Vot'e</td>
                <td><a href = "./record.html">Hammersmith Flyover</a></td>
                <td>miNIMMAl movement [NIMMA008]</td>
                <td>Techno, Minimal</td>
                <td>80 Ron</td>
                <td>❌</td>
            </tr>
            <tr>
                <td>Vot'e</td>
                <td><a href = "./record.html">Hammersmith Flyover</a></td>
                <td>miNIMMAl movement [NIMMA008]</td>
                <td>Techno, Minimal</td>
                <td>80 Ron</td>
                <td>❌</td>
            </tr>
            <tr>
                <td>Vot'e</td>
                <td><a href = "./record.html">Hammersmith Flyover</a></td>
                <td>miNIMMAl movement [NIMMA008]</td>
                <td>Techno, Minimal</td>
                <td>80 Ron</td>
                <td>❌</td>
            </tr>
        </table> -->

        <?php 

            
        ?>
    </div>
</body>
</html>