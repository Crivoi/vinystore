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
        include_once 'app.model.php';
    ?>

    <div class = "content-container">
        <div class = "record-container" id = "record-container-id">
            <!--    RECORD FEED STRUCTURE 
            <a href = "./record.php" class = "content-item">
                <img src = "../img/vinyl-record.jpg" alt = "vinyl_img" class = "content-img">
                <p class = "content-info">Artist - Album Name</p>
            </a> 
            -->

            <!-- PHP --------------------------------------------------------------------------------->
            <?php 
                // include_once 'app.model.php';

                // $records = get_all_records();

                // display_feed($records);
            ?>            
        </div>
    </div>

    <script>
        let container = document.getElementById('record-container-id');
        
        fetch("http://localhost:8080/vinyls")

        .then(resp => resp.json())

        .then(jsonResp => {
            for(var i = 0; i < jsonResp.length; i++){
                let a = document.createElement('a');
                a.setAttribute('href', '/records/' + jsonResp[i]['id_record']);
                a.setAttribute('class', 'content-item');

                let img = document.createElement('img');
                img.setAttribute('src', jsonResp[i]['path']);
                img.setAttribute('alt', 'vinyl_img');
                img.setAttribute('class', 'content-img');

                let p = document.createElement('p');
                p.setAttribute('class', 'content-info');
                p.innerText = jsonResp[i]["artist"] + ' - ' + jsonResp[i]['album'];

                a.appendChild(img);
                a.appendChild(p);

                container.appendChild(a);
            }
        })
        .catch(err => {
            alert(err);
        });
    </script>
</body>
</html>
