<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shopping-cart</title>
    <link rel = "stylesheet" type = "text/css" href = "/css/top_nav.css">
    <link rel = "stylesheet" type = "text/css" href = "/css/bot_nav.css">
    <link rel = "stylesheet" type = "text/css" href = "/css/filters.css">
    <link rel = "stylesheet" type = "text/css" href = "/css/shopping_cart.css">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
</head>
<body>
    <?php 
        include_once 'top_nav.php';
        include_once 'bot_nav.php';
        include_once 'filters.php';

        include_once 'app.model.php';
    ?>
    
    <div class = "cart-container" id = "cart-container-id">
        <h3>Your cart: </h3>
    </div>

    <div class = "checkout-container">
        <form action = "" method = "POST">
            <button type = "submit" class = "checkout-btn" id = "buy-btn" name = "submit" value = "buy">
                <img src = "/img/shopping-cart.png" alt = "buy_img">
                Checkout 
            </button>
        </form>
    </div>

    <script>
        let container = document.getElementById('cart-container-id');
        var id = <?php echo get_logged_user_id() ?>;

        fetch('http://localhost:81/api/users/' + id + '/cart')

        .then(resp => resp.json())

        .then(jsonResp => {
            console.log(jsonResp);
            let table = document.createElement('table');
            table.setAttribute('class', 'cart-table');
            
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
                removeInput.setAttribute('value', jsonResp[i]['id_cart']);
                removeInput.setAttribute('name', 'cart');
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
        $user = getLoggedUser(get_logged_user_id());

        if(isset($_POST['submit'])){
            echo $_POST['submit'];
            if($_POST['submit'] === 'remove'){
                remove_cart($_POST['cart']);

            }else if($_POST['submit'] === 'buy'){
                checkout($user->id, $user->email);
            }
            
        }
    ?>

</body>
</html>