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
        let body = document.querySelector('body');

        let container = document.createElement('div');
        container.setAttribute('class', 'artist-list-container');
        
        let artistsList = document.createElement('div');
        artistsList.setAttribute('class', 'artist-list');

        let head = document.createElement('h3');
        head.innerText = 'Our Labels';

        let hr = document.createElement('hr');

        artistsList.appendChild(head);
        artistsList.appendChild(hr);

        container.appendChild(artistsList);

        body.appendChild(container);

        fetch ("http://localhost:81/api/labels")

        .then(resp => resp.json())

        .then(jsonResp => {
            jsonResp = jsonResp.sort(function(a, b){
                var keyA = a.label_name;
                var keyB = b.label_name;
                if(keyA > keyB) return 1;
                if(keyB > keyA) return -1;
                return 0;
            });

            if(jsonResp.length == 0){
                let h = document.createElement('h3');
                h.innerText = 'Oops! Nothing in our database!';
                h.setAttribute('style', 'display: inline; width: 100%; overflow: hidden;')

                container.appendChild(h);
            }

            for(var i = 0; i < 8; i++){
                let p = document.createElement('p');
                p.innerText = jsonResp[i]['label_name'];

                artistsList.appendChild(p);
            }

            document.addEventListener("scroll", function(event){
                checkForNewP();
            })

            var checkForNewP = function(){
                var lastItem = document.querySelector(".artist-list > p:last-child");
                var lastItemOffset = lastItem.offsetTop + lastItem.clientHeight;
                var pageOffset = window.pageYOffset + window.innerHeight;

                if(pageOffset > lastItemOffset - 20){
                    let p = document.createElement('p');
                    p.innerText = jsonResp[i]['label_name'];

                    artistsList.appendChild(p);
                    i++;
                    checkForNewP();
                }
            }
        })
        .catch(err => {
            console.log(err);
        });
    </script>
</body>
</html>