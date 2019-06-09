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

    <!-- <div class = "content-container">
        <div class = "record-container" id = "record-container-id">
            <a href = "./record.php" class = "content-item">
                <img src = "../img/vinyl-record.jpg" alt = "vinyl_img" class = "content-img">
                <p class = "content-info">Artist - Album Name</p>
            </a>        
        </div>
    </div> -->

    <script>
        let body = document.querySelector('body');

        let contentContainer = document.createElement('div');
        contentContainer.setAttribute('class', 'content-container');
        let container = document.createElement('div');
        container.setAttribute('class', 'record-container');
        container.setAttribute('id', 'record-container-id')
        
        fetch("http://localhost:81/api/vinyls")

        .then(resp => resp.json())

        .then(jsonResp => {
            if(jsonResp.length == 0){
                let h = document.createElement('h3');
                h.innerText = 'Oops! Nothing in our database!';
                h.setAttribute('style', 'display: inline; width: 100%; overflow: hidden;')

                container.appendChild(h);
            }
            for(var i = 0; i < 8; i++){
                let a = document.createElement('a');
                a.setAttribute('href', 'users/1/records/' + jsonResp[i]['id_record']);
                a.setAttribute('class', 'content-item');

                let img = document.createElement('img');
                console.log(jsonResp[i]['path']);
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

            contentContainer.appendChild(container);
            body.append(contentContainer);

            document.addEventListener("scroll", function(event){
                checkForNewDiv();
            });

            var checkForNewDiv = function(){
                var lastItem = document.querySelector("#record-container-id > .content-item:last-child");
                var lastItemOffset = lastItem.offsetTop + lastItem.clientHeight;
                var pageOffset = window.pageYOffset + window.innerHeight;

                if(pageOffset > lastItemOffset - 20){
                    let a = document.createElement('a');
                a.setAttribute('href', 'users/1/records/' + jsonResp[i]['id_record']);
                a.setAttribute('class', 'content-item');

                let img = document.createElement('img');
                console.log(jsonResp[i]['path']);
                img.setAttribute('src', jsonResp[i]['path']);
                img.setAttribute('alt', 'vinyl_img');
                img.setAttribute('class', 'content-img');

                let p = document.createElement('p');
                p.setAttribute('class', 'content-info');
                p.innerText = jsonResp[i]["artist"] + ' - ' + jsonResp[i]['album'];

                a.appendChild(img);
                a.appendChild(p);

                container.appendChild(a);
                i++;
                checkForNewDiv();
                }

            };
        })
        .catch(err => {
            alert(err);
        });
    </script>
</body>
</html>
