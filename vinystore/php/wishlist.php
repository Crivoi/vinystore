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
        include_once 'top_nav.php';
        include_once 'bot_nav.php';
        include_once 'filters.php';

        include_once 'app.model.php';
    ?>
    <div class = "wish-container" id = "wish-container-id">
        <h3>Your wishlist: </h3>
    </div>

    <script>
        let container = document.getElementById('wish-container-id');
        var id = <?php echo get_logged_user_id() ?>;

        fetch('http://localhost:81/api/users/' + id + '/wishlist')

        .then(resp => resp.json())

        .then(jsonResp => {
            console.log(jsonResp);
            let table = document.createElement('table');
            table.setAttribute('class', 'wish-table');
            
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

            let cart = document.createElement('th');
            cart.innerText = 'Add to cart';

            head.appendChild(artist);
            head.appendChild(album);
            head.appendChild(label);
            head.appendChild(genre);
            head.appendChild(price);
            head.appendChild(remove);
            head.appendChild(cart);

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
                removeInput.setAttribute('value', jsonResp[i]['id_wish']);
                removeInput.setAttribute('name', 'wish');
                removeInput.setAttribute("hidden", true);
                
                let removeButton = document.createElement('button');
                removeButton.setAttribute('type', 'submit');
                removeButton.setAttribute('name', 'submit');
                removeButton.setAttribute('value', 'remove');
                removeButton.innerText = '❌';

                removeForm.appendChild(removeInput);
                removeForm.appendChild(removeButton);

                remove.appendChild(removeForm);

                let addCart = document.createElement('td');

                let cartForm = document.createElement('form');
                cartForm.setAttribute('method', 'POST');
                
                let cartInput = document.createElement('input');
                cartInput.setAttribute('type', 'text');
                cartInput.setAttribute('value', jsonResp[i]['id_record']);
                cartInput.setAttribute('name', 'cart');
                cartInput.setAttribute("hidden", true);
                
                let cartButton = document.createElement('button');
                cartButton.setAttribute('type', 'submit');
                cartButton.setAttribute('name', 'submit');
                cartButton.setAttribute('value', 'cart');
                cartButton.innerText = '🛒';

                cartForm.appendChild(cartInput);
                cartForm.appendChild(cartButton);

                addCart.appendChild(cartForm);

                row.appendChild(artist);
                row.appendChild(album);
                row.appendChild(label);
                row.appendChild(genre);
                row.appendChild(price);
                row.appendChild(remove);
                row.appendChild(addCart);

                table.appendChild(row);

            }

            container.appendChild(table);
        })    

    </script>

    <?php 
        $id_user = get_logged_user_id();
        if(isset($_POST['submit'])){
            if($_POST['submit'] === 'remove'){
                
                $id_wish = $_POST['wish'];
                remove_wish($id_wish);

            }else if($_POST['submit'] === 'cart'){
                echo $_POST['cart'];
                add_to_cart($id_user, $_POST['cart']);
            }
        }
    ?>

</body>
</html>