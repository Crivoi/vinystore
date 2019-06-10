<?php

    $CONFIG = [
        'servername' => "localhost",
        'username' => "root",
        'password' => '',
        'db' => 'vinystore'
    ];

    $conn = new mysqli($CONFIG["servername"], $CONFIG["username"], $CONFIG["password"], $CONFIG["db"]);

    if($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }

    // add record to database
    function add_record($artist, $album, $label, $cat, $genre, $condition, $price){
        GLOBAL $conn;

        $date = date('y-m-d');

        $id_user = get_logged_user_id();

        $insertRecords = $conn->prepare("INSERT INTO records (id_user, artist, album, label, catalogue, genre, cond, price, date_added) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $insertRecords->bind_param("sssssssss", $id_user, $artist, $album, $label, $cat, $genre, $condition, $price, $date);

        $insertRecords->execute();
        $insertRecords->close();

        $id_record = get_record_id();

        $insertMyRecords = $conn->prepare("INSERT INTO my_records (id_user, id_record, date_added) VALUES (?, ?, ?)");
        $insertMyRecords->bind_param("sss", $id_user, $id_record, $date);

        $insertMyRecords->execute();
        $insertMyRecords->close();
        
        save_file('cover', "../img/records/");
        save_file('preview', "../audio_clips/previews/");
    }

    function add_artist($artist){
        GLOBAL $conn;

        $insertArtist = $conn->prepare("INSERT INTO artists (artist_name) VALUES (?)");
        $insertArtist->bind_param("s", $artist);
        
        $insertArtist->execute();
        $insertArtist->close();
    }

    function add_label($label){
        GLOBAL $conn;

        $insertLabel = $conn->prepare("INSERT INTO labels (label_name) VALUES (?)");
        $insertLabel->bind_param("s", $label);
        
        $insertLabel->execute();
        $insertLabel->close();
    }

    // get id of last record added 
    function get_record_id(){
        GLOBAL $conn;

        $idInfo = $conn->prepare("SELECT id_record FROM records ORDER BY id_record DESC LIMIT 1");
        $idInfo->execute();

        $id = $idInfo->get_result();

        foreach($id as $row){
            return $row['id_record'];
        }
    }

    // get id of last user added
    function get_user_id(){
        GLOBAL $conn;

        $idInfo = $conn->prepare("SELECT id_user FROM users ORDER BY id_user DESC LIMIT 1");
        $idInfo->execute();

        $id = $idInfo->get_result();

        foreach($id as $row){
            return $row['id_user'];
        }
    }

    // save cover_image and audio_preview for a record
    function save_file($id, $target_dir){
        if($_FILES[$id]['name'] != ""){
            $file = $_FILES[$id]['name'];
            $path = pathinfo($file);
            // $filename = $path['filename'];
            $filename = get_record_id();
            $ext = $path['extension'];
            $temp_name = $_FILES[$id]['tmp_name'];
            $path_filename_ext = $target_dir.$filename.".".$ext;
             
            if (file_exists($path_filename_ext)) {
                echo 'File already exists!';
            }
            else {
                move_uploaded_file($temp_name,$path_filename_ext);
                echo 'Upload success!';
            }
        }
    }

    // save profile_image for a user
    function get_profile_image($id, $target_dir = "/users/"){
        if($_FILES[$id]['name'] != ""){
            $file = $_FILES[$id]['name'];
            $path = pathinfo($file);
            // $filename = $path['filename'];
            $filename = get_user_id();
            $ext = $path['extension'];
            $temp_name = $_FILES[$id]['tmp_name'];
            $path_filename_ext = $target_dir.$filename.".".$ext;
             
            if (file_exists($path_filename_ext)) {
                echo "Sorry, file already exists.";
            }
            else {
                move_uploaded_file($temp_name,$path_filename_ext);
                echo "<p>Congratulations! File Uploaded Successfully.</p>";
            }
        }
    }

    // get record by id 
    function get_record_by_id($id){
        GLOBAL $conn;

        $getRecordInfo = $conn->prepare("SELECT * FROM records WHERE id_record = ?");
        $getRecordInfo->bind_param("s", $id);
        $getRecordInfo->execute();

        $record = $getRecordInfo->get_result();
        
        return $record;
    }

    // get user by id
    function get_user_by_id($id){
        GLOBAL $conn;

        $getUserInfo = $conn->prepare("SELECT * FROM users WHERE id_user = ?");
        $getUserInfo->bind_param("s", $id);
        $getUserInfo->execute();

        $user = $getUserInfo->get_result();

        return $user;
    }

    // add record to wishlist
    function add_to_wishlist($id_user, $id_record){
        GLOBAL $conn;

        $records = get_wish_by_user($id_user);
        foreach($records as $rec){
            if($rec['id_record'] == $id_record){
                echo 'Already in wishlist!';
                return -1;
            }
        }

        $insertWish = $conn->prepare("INSERT INTO wishlist (id_user, id_record) VALUES (?, ?)");
        $insertWish->bind_param("ss", $id_user, $id_record);

        $insertWish->execute();
        $insertWish->close();
    }

    // add record to cart
    function add_to_cart($id_user, $id_record){
        GLOBAL $conn;

        $records = get_cart_by_user($id_user);
        foreach($records as $rec){
            if($rec['id_record'] == $id_record){
                echo 'Already in cart!';
                return -1;
            }
        }

        $insertCart = $conn->prepare("INSERT INTO shopping_cart (id_user, id_record) VALUES (?, ?)");
        $insertCart->bind_param("ss", $id_user, $id_record);

        $insertCart->execute();
        $insertCart->close();
    }

    // calls an api
    function api_call($url, $method, $payload = ''){
    
        $req = curl_init($url);

        curl_setopt($req, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($req, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($req, CURLOPT_POSTFIELDS, json_encode($payload));
        curl_setopt($req, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);

        $responseBody = json_decode(curl_exec($req));
        $responseCode = curl_getinfo($req)['http_code'];

        curl_close($req);

        return [$responseCode, $responseBody];
    }

    // path parsing for display functions
    function cut_path($path){
        $i = 2;
        $copy = '';
        while($path[$i] != '.'){
            $copy[$i - 2] = $path[$i];
            $i += 1;
        }
        return $copy;
    }

    // display a record from an array 
    function display_record($record){
        GLOBAL $conn;

        $userInfo = $conn->prepare("SELECT first_name, last_name FROM users WHERE id_user = ?");
        $userInfo->bind_param("s", $record['id_user']);
        $userInfo->execute();

        $name = $userInfo->get_result();

        foreach($name as $n){
            $firstName = $n['first_name'];
            $lastName = $n['last_name'];
        }

        if(empty($firstName) && empty($lastName)){
            $firstName = 'User';
            $lastName = 'Unknown';
        }


        $img_files = glob("../img/records/*.{jpg,gif,png,PNG,BMP,jpeg}", GLOB_BRACE);
        $aud_files = glob("../audio_clips/previews/*.{mp3,flac,wav,aif,aiff}", GLOB_BRACE);

        $img_path_no_ext = "/img/records/".$record['id_record'];
        $img_path = $img_path_no_ext;

        foreach($img_files as $img){
            if($img_path_no_ext === cut_path($img)){
                $img_path = $img;
                break;
            }
        }

        $aud_path_no_ext = "/audio_clips/previews/".$record['id_record'];
        $aud_path = $aud_path_no_ext;

        foreach($aud_files as $aud){
            if($aud_path === cut_path($aud)){
                $aud_path = $aud;
                break;
            }
        }

        if($img_path_no_ext === $img_path){
            echo '<div class = "record-container">';
            echo '<div class = "img-magnifier-container">';
            echo '<img src="/img/records/0.jpg" alt="vinyl-record" id="record-img">';
            echo '</div>';
        }
        else{            
            echo '<div class = "record-container">';
            echo '<div class = "img-magnifier-container">';
            echo '<img src="'. substr($img_path, 2) .'" alt="vinyl-record" id="record-img">';
            echo '</div>';
        }

        echo '<div class="record-info">';
        echo '<span class="info" id="artist-name">'. $record['artist']. '</span><br><br>';
        echo '<span class="info" id="album-name">'. $record['album'] .'</span><br><br>';
        echo '<span class="info" id="label-name">'. $record['label'] .'</span><br><br>';
        echo '<span class="info">Genre: </span>';
        echo '<a href = "" class = "genre-name">'. $record['genre'] .'</a><br><br>';
        echo '<span class="info" id="price-tag">'. $record['price'] .'🥇</span><br><br>';
        echo '<span class="info" id="condition">'. $record['cond'] .'</span><br><br>';
        echo '<a href = \'/users/'. $record['id_user'] .'\'><span class="info" id="owner">'. $firstName .' '. $lastName .'</span></a>';
        if($aud_path_no_ext === $aud_path){
            echo '<br><br><span class="info">No Preview Available!</span>';
        }
        echo '</div>';

        echo '<div class = "audio-container">
            <audio controls loop>
                <source src = "'. substr($aud_path, 2) .'" type = "audio/flac">
                Your browser does not support audio.
            </audio>
        </div>';
 
        echo '<div class = "checkout-container">
                <form action = "" method = "POST">
                    <button type = "submit" class = "checkout-btn" id = "wishlist-btn" name = "submit" value = "wishlist">
                        <img src = "/img/wishlist-heart.png" alt = "wishlist_img">
                        Add to Wishlist 
                    </button>
                </form>
                <form action = "" method = "POST">
                    <button type = "submit" class = "checkout-btn" id = "buy-btn" name = "submit" value = "cart">
                        <img src = "/img/shopping-cart.png" alt = "wishlist_img">
                        Add to Cart
                    </button>
                </form>
                <form action = "" method = "POST">
                    <button type = "submit" class = "checkout-btn" id = "trade-btn" name = "submit" value = "trade">
                        <img src = "/img/trade.png" alt = "trade_img">
                        Propose Trade
                    </button>
                </form>
            </div>';

        echo '</div>';
    }

    // display a user from an array
    function display_user($user){
        
        $img_files = glob("../users/*.{jpg,gif,png,PNG,BMP,jpeg}", GLOB_BRACE);

        $img_path = "/users/".$user['id_user'];

        foreach($img_files as $img){
            if($img_path === cut_path($img)){
                $img_path = $img;
                break;
            }
        }

        if($img_path === "/users/".$user['id_user']){
            $img_path = "/users/1.png";
        }

        echo '<div class="profile">';
        echo '<img src="'. $img_path .'" alt="profile_image" class="profile-image">';
        echo '<div class="person-information">';
        echo '<h2 class="person-name">'. $user['first_name'] .' '. $user['last_name'] .'</h2>';
        echo '<h4 class="person-short-info ">'. $user['age'] .' Years Old</h4>';
        echo '<p class="person-details">'.
            'Address: '. $user['address'] .'<br>'.
            'Postal Code: '. $user['postal_code'] .'<br>'.
            'E-mail: '. $user['email'] .'<br>'.
            'Phone: '. $user['phone_nr'] .'</p>';
        echo '</div></div>'; 
    }

    // get all records from db
    function get_all_records(){
        GLOBAL $conn;

        $recordsInfo = $conn->prepare("SELECT id_record, artist, album, catalogue FROM records");
        $recordsInfo->execute();

        $result = $recordsInfo->get_result();

        return $result;
    }

    // get all artists from db
    function get_all_artists(){
        GLOBAL $conn;

        $recordsInfo = $conn->prepare("SELECT * FROM artists");
        $recordsInfo->execute();

        $result = $recordsInfo->get_result();

        return $result;
    }

    // get all labels from db
    function get_all_labels(){
        GLOBAL $conn;

        $recordsInfo = $conn->prepare("SELECT * FROM label");
        $recordsInfo->execute();

        $result = $recordsInfo->get_result();

        return $result;
    }

    // displays all records on home page
    function display_feed($records){

        $img_files = glob("../img/records/*.{jpg,gif,png,PNG,BMP,jpeg}", GLOB_BRACE);

        foreach($records as $rec){
            echo '<a href="/records/'. $rec['id_record'] .'" class="content-item">';
        
            $img_path_no_ext = "/img/records/".$rec['id_record'];
            $img_path = $img_path_no_ext;
            foreach($img_files as $img){
                if($img_path_no_ext === cut_path($img)){
                    $img_path = $img;
                }
            }

            if($img_path_no_ext === $img_path){
                echo '<img src="/img/records/0.jpg" alt="vinyl_img" class="content-img">';
            }
            else{
                echo '<img src="'. $img_path .'" alt="vinyl_img" class="content-img">';
            }
            
            echo '<p class="content-info">'. $rec['artist'] .' - '. $rec['album'] .'</p>';
            echo '</a>';
        }
    }

    // search for an img by its record id
    function get_img_by_id($id){

        $img_files = glob("../img/records/*.{jpg,gif,png,PNG,BMP,jpeg}", GLOB_BRACE);
        $img_path_no_ext = "/img/records/".$id;
        $img_path = $img_path_no_ext;
        foreach($img_files as $img){
            if($img_path_no_ext === cut_path($img)){
                $img_path = $img;
            }
        }

        if($img_path_no_ext === $img_path){
            return "/img/records/0.jpg";
        }
        else{
            return $img_path;
        }
    }

    // search for a preview by its record id
    function get_preview_by_id($id){

        $aud_files = glob("../audio_clips/previews/*.{mp3,flac,aif,aiff,wav}", GLOB_BRACE);
        $aud_path_no_ext = "/audio_clips/previews/".$id;
        $aud_path = $aud_path_no_ext;
        foreach($aud_files as $aud){
            if($aud_path_no_ext === cut_path($aud)){
                $aud_path = $aud;
            }
        }

        if($aud_path_no_ext === $aud_path){
            return "/audio_clips/previews/0.mp3";
        }
        else{
            return $aud_path;
        }
    }

    // get records added by certain user 
    function get_user_records($id){
        GLOBAL $conn;

        $myRecords = $conn->prepare("SELECT id_item, id_record FROM my_records WHERE id_user = ?");
        $myRecords->bind_param("s", $id);
        $myRecords->execute();

        $records = $myRecords->get_result();

        return $records;
    }

    // get wishlist by user id
    function get_wish_by_user($id){
        GLOBAL $conn;

        $wishlist = $conn->prepare("SELECT id_wish, id_record FROM wishlist WHERE id_user = ?");
        $wishlist->bind_param("s", $id);
        $wishlist->execute();

        $records = $wishlist->get_result();

        return $records;
    }

    // get shopping cart by user id
    function get_cart_by_user($id){
        GLOBAL $conn;

        $cart = $conn->prepare("SELECT id_cart, id_record FROM shopping_cart WHERE id_user = ?");
        $cart->bind_param("s", $id);
        $cart->execute();

        $records = $cart->get_result();

        return $records;
    }     

    // get id of logged in user (from url)
    function get_logged_user_id(){
        if(preg_match('/^.*\/users\/([0-9]*)\/.*$/', $_SERVER['REQUEST_URI'], $id)){
            return $id[1];
        }
        else{
            return 1;
        }
    }

    // remove a record and its files from db (and server)
    function remove_record($id_user, $id_record){
        GLOBAL $conn;

        $rm = $conn->prepare("DELETE FROM my_records WHERE id_user = ? AND id_record = ?");
        $rm->bind_param("ss", $id_user, $id_record);
        $rm->execute();
        $rm->close();

        $rm = $conn->prepare("DELETE FROM records WHERE id_record = ?");
        $rm->bind_param("s", $id_record);
        $rm->execute();
        $rm->close();

        $path_to_img = get_img_by_id($id_record);
        $path_to_aud = get_preview_by_id($id_record);

        if($path_to_img != "/img/records/0.jpg"){
            if(!unlink(realpath($path_to_img))){
                echo 'Img file can\'t be deleted.';
            }
            else{
                echo 'Img file deleted successfully.';
            }
        }

        if($path_to_aud != "/audio_clips/previews/0.mp3"){
            if(!unlink($path_to_aud)){
                echo 'Aud file can\'t be deleted.';
            }
            else{
                echo 'Aud file deleted successfully.';
            }
        }
    }

    // remove a record from wishlist
    function remove_wish($id_wish){
        GLOBAL $conn;

        $rm = $conn->prepare("DELETE FROM wishlist WHERE id_wish = ?");
        $rm->bind_param("s", $id_wish);
        $rm->execute();
        $rm->close();
    }

    // remove a record from cart
    function remove_cart($id_cart){
        GLOBAL $conn;

        $rm = $conn->prepare("DELETE FROM shopping_cart WHERE id_cart = ?");
        $rm->bind_param("s", $id_cart);
        $rm->execute();
        $rm->close();
    }

    // display all records by input in searchBar
    function display_records_by_searchBar($records){

        $img_files = glob("../img/records/*.{jpg,gif,png,PNG,BMP,jpeg}", GLOB_BRACE);

        foreach($records as $rec){
            echo '<a href="/records/'. $rec['id_record'] .'" class="content-item">';
        
            $img_path_no_ext = "/img/records/".$rec['id_record'];
            $img_path = $img_path_no_ext;
            foreach($img_files as $img){
                if($img_path_no_ext === cut_path($img)){
                    $img_path = $img;
                }
            }

            if($img_path_no_ext === $img_path){
                echo '<img src="/img/records/0.jpg" alt="vinyl_img" class="content-img">';
            }
            else{
                echo '<img src="'. $img_path .'" alt="vinyl_img" class="content-img">';
            }
            
            echo '<p class="content-info">'. $rec['artist'] .' - '. $rec['album'] .'</p>';
            echo '</a>';
        }
    }

    // display all records by filters
    function display_records_by_Filters($records){

        $img_files = glob("../img/records/*.{jpg,gif,png,PNG,BMP,jpeg}", GLOB_BRACE);

        foreach($records as $rec){
            echo '<a href="/records/'. $rec['id_record'] .'" class="content-item">';
        
            $img_path_no_ext = "/img/records/".$rec['id_record'];
            $img_path = $img_path_no_ext;
            foreach($img_files as $img){
                if($img_path_no_ext === cut_path($img)){
                    $img_path = $img;
                }
            }

            if($img_path_no_ext === $img_path){
                echo '<img src="/img/records/0.jpg" alt="vinyl_img" class="content-img">';
            }
            else{
                echo '<img src="'. $img_path .'" alt="vinyl_img" class="content-img">';
            }
            
            echo '<p class="content-info">'. $rec['artist'] .' - '. $rec['album'] .'</p>';
            echo '</a>';
        }
    }

    // place orders
    function checkout($id){
        GLOBAL $conn;

        $user = getLoggedUser($id);
        $cart_items = get_cart_by_user($id);

        $date = date('y-m-d');

        foreach($cart_items as $item){
            
            $rmCart = $conn->prepare('DELETE FROM shopping_cart WHERE id_record = ?');
            $rmCart->bind_param("s", $item['id_record']);

            $rmCart->execute();
            $rmCart->close();

            $rmWish = $conn->prepare('DELETE FROM wishlist WHERE id_record = ?');
            $rmWish->bind_param("s", $item['id_record']);

            $rmWish->execute();
            $rmWish->close();

            $rmMyRec = $conn->prepare('DELETE FROM my_records WHERE id_record = ?');
            $rmMyRec->bind_param("s", $item['id_record']);

            $rmMyRec->execute();
            $rmMyRec->close();

            remove_record($id, $item['id_record']);

            $inOrder = $conn->prepare('INSERT INTO orders (id_user, id_record, date_placed) VALUES (?, ?, ?)');
            $inOrder->bind_param("sss", $id, $item['id_record'], $date);

            $inOrder->execute();
            $inOrder->close();
        }

        $item_nr = sizeof($cart_items);

        $message = "Order placed! Sending ". $item_nr ." items to your address at: ". $user->address .". Postal Code: ". $user->postalCode .
            " Order will arrive in about 7 days.";

        // In case any of our lines are larger than 70 characters, we should use wordwrap()
        $message = wordwrap($message, 70, "\r\n");

        $subject = "Order at VinyStore";

        $headers = array(
            'From' => 'vinystore.test.email@gmail.com',
            'Reply-To' => 'vinystore.test.email@gmail.com',
            'X-Mailer' => 'PHP/' . phpversion()
        );
        
        // Send TEST
        // mail('andrei.crivoi1997@gmail.com', $subject, $message, $headers);

        // Send
        mail($user->email, $subject, $message, $headers);
    }

    function getLoggedUser($id) {
        GLOBAL $conn;

        $loginStmt = $conn -> prepare('SELECT * FROM users WHERE id_user = ?');
        $loginStmt -> bind_param('s', $id);

        $loginStmt -> execute();
        $results = $loginStmt -> get_result();
        $loginStmt -> close();

        
        if($results -> num_rows  === 1) {
            $firstRow = $results -> fetch_assoc();
            
            return new User($firstRow['id_user'], $firstRow['username'], $firstRow['password'], $firstRow['email'], $firstRow['first_name'], 
                $firstRow['last_name'], $firstRow['age'], $firstRow['address'], $firstRow['postal_code'], $firstRow['phone_nr']);
        } 

        return NULL;
    }

    function login($username, $password) {
        GLOBAL $conn;

        $hashedPassword = md5($password);
        $loginStmt = $conn -> prepare('SELECT * FROM users WHERE username = ? AND password = ?');
        $loginStmt -> bind_param('ss', $username, $hashedPassword);

        $loginStmt -> execute();
        $results = $loginStmt -> get_result();
        $loginStmt -> close();
        
        if($results -> num_rows  === 1) {
            $firstRow = $results -> fetch_assoc();

            return new User($firstRow['id_user'], $firstRow['username'], $firstRow['password'], $firstRow['email'], $firstRow['first_name'], 
            $firstRow['last_name'], $firstRow['age'], $firstRow['address'], $firstRow['postal_code'], $firstRow['phone_nr']);
        } 

        return NULL;
    }

    function register($username, $password, $email, $firstName, $lastName, $age, $address, $postalCode, $phoneNr) {
        GLOBAL $conn;

        $registerCheck = $conn->prepare('SELECT username FROM users WHERE username = ?');
        $registerCheck->bind_param('s', $username);
        $registerCheck->execute();

        $user = $registerCheck->get_result();
        if($user->num_rows  === 1){
            echo '<h2 style="color:white;">Username already exists!</h2>';
            return false;
        }

        $user->close();

        $hashedPassword = md5($password);
        $registerStmt = $conn -> prepare('INSERT INTO users (username, password, email, first_name, last_name, age, address, postal_code, phone_nr) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)');
        $registerStmt -> bind_param('sssssssss', $username, $hashedPassword, $email, $firstName, $lastName, $age, $address, $postalCode, $phoneNr);
        $registerStmt -> execute();

        $registerStmt -> close();

        $id = get_user_id();

        return $id;
    }

    class User {
        public $id;
        public $username;
        public $password;
        public $email;
        public $firstName;
        public $lastName;
        public $age;
        public $address;
        public $postalCode;
        public $phoneNr;

        function __construct($id, $username, $password, $email, $firstName, $lastName, $age, $address, $postalCode, $phoneNr) {
            $this -> id = $id;
            $this -> username = $username;
            $this -> password = $password;
            $this -> email= $username;
            $this -> fistName = $firstName;
            $this -> lastName = $lastName;
            $this -> age = $age;
            $this -> address = $address;
            $this -> postalCode = $postalCode;
            $this -> phoneNr = $phoneNr;
        }
    }

?>