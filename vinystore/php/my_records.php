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
        
        include_once 'app.model.php';
    ?>

    <div class = "records-container" id = "records-container-id">
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
    </div>

    <script>
        let container = document.getElementById('records-container-id');
        var id = <?php echo get_logged_user_id() ?>;

        fetch('http://localhost:81/api/users/' + id + '/my_records')

        .then(resp => resp.json())

        .then(jsonResp => {
            console.log(jsonResp);
            let table = document.createElement('table');
            table.setAttribute('class', 'records-table');
            
            let head = document.createElement('tr');

            let artist = document.createElement('th');
            artist.innerText = 'Artist';

            let album = document.createElement('th');
            album.innerText = 'Album';

            let label = document.createElement('th');
            label.innerText = 'Label';

            let genre = document.createElement('th');
            genre.innerText = 'Genre';

            let price = document.createElement('th');
            price.innerText = 'Price';

            let remove = document.createElement('th');
            remove.innerText = 'Remove';

            head.appendChild(artist);
            head.appendChild(album);
            head.appendChild(label);
            head.appendChild(genre);
            head.appendChild(price);
            head.appendChild(remove);

            table.appendChild(head);

            for(var i = 0; i < jsonResp.length; i++){
                let row = document.createElement('tr');

                artist = document.createElement('td');
                artist.innerText = jsonResp[i]['artist'];

                album = document.createElement('td');
                album.innerText = jsonResp[i]['album'];

                label = document.createElement('td');
                label.innerText = jsonResp[i]['label'];

                genre = document.createElement('td');
                genre.innerText = jsonResp[i]['genre'];

                price = document.createElement('td');
                price.innerText = jsonResp[i]['price'];

                remove = document.createElement('td');
                
                let removeForm = document.createElement('form');
                removeForm.setAttribute('method', 'POST');
                
                let removeInput = document.createElement('input');
                removeInput.setAttribute('type', 'text');
                removeInput.setAttribute('value', jsonResp[i]['id_record']);
                removeInput.setAttribute('name', 'record');
                removeInput.setAttribute("hidden", true);
                
                let removeButton = document.createElement('button');
                removeButton.setAttribute('type', 'submit');
                removeButton.setAttribute('name', 'submit');
                removeButton.setAttribute('value', 'remove');
                removeButton.innerText = '❌';

                removeForm.appendChild(removeInput);
                removeForm.appendChild(removeButton);

                remove.appendChild(removeForm);

                row.appendChild(artist);
                row.appendChild(album);
                row.appendChild(label);
                row.appendChild(genre);
                row.appendChild(price);
                row.appendChild(remove);

                table.appendChild(row);
            }

            container.appendChild(table);
        })    

    </script>

    <?php 
        if(isset($_POST['submit'])){
            $id_user = get_logged_user_id();
            $id_record = $_POST['record'];

            remove_record($id_user, $id_record);
        }
    ?>
</body>
</html>