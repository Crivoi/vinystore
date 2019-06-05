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

        $id_record = get_record_id();
        $id_user = get_logged_user_id();
        
        $insertRecords = $conn->prepare("INSERT INTO records (id_user, artist, album, label, catalogue, genre, cond, price, date_added) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $insertRecords->bind_param("sssssssss", $id_user, $artist, $album, $label, $cat, $genre, $condition, $price, $date);

        $insertRecords->execute();
        $insertRecords->close();
        
        get_file('cover', "../img/records/");
        get_file('preview', "../audio_clips/previews/");

        $insertMyRecords = $conn->prepare("INSERT INTO my_records (id_user, id_record, date_added) VALUES (?, ?, ?)");
        $insertMyRecords->bind_param("sss", $id_user, $id_record, $date);

        $insertMyRecords->execute();
        $insertMyRecords->close();
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
            return $row['id_record'];
        }
    }

    // save cover_image and audio_preview for a record
    function get_file($id, $target_dir){
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
    function add_to_wishlist($id){
        return 0;
    }

    // add record to cart
    function add_to_cart($id){
        return 0;
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
            echo '<img src="'. $img_path .'" alt="vinyl-record" id="record-img">';
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
        echo '<span class="info" id="owner">User 1</span>';
        if($aud_path_no_ext === $aud_path){
            echo '<br><br><span class="info">No Preview Available!</span>';
        }
        echo '</div>';

        echo '<div class = "audio-container">
            <audio controls loop>
                <source src = "'. $aud_path .'" type = "audio/flac">
                Your browser does not support audio.
            </audio>
        </div>';
 
        echo '<div class = "checkout-container">
                <form action = "/php/wishlist.php" method = "POST">
                    <button type = "submit" class = "checkout-btn" id = "wishlist-btn" name = "wish" value = "wishlist">
                        <img src = "../img/wishlist-heart.png" alt = "wishlist_img">
                        Add to Wishlist 
                    </button>
                </form>
                <form action = "/php/shopping_cart.php" method = "POST">
                    <button type = "submit" class = "checkout-btn" id = "buy-btn" name = "cart" value = "cart">
                        <img src = "../img/shopping-cart.png" alt = "wishlist_img">
                        Add to Cart
                    </button>
                </form>
                <form action = "/php/exchange.php" method = "POST">
                    <button type = "submit" class = "checkout-btn" id = "trade-btn" name = "trade" value = "trade">
                        <img src = "../img/trade.png" alt = "trade_img">
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
            // echo '<p>'.cut_path($img).'</p>';
            if($img_path === cut_path($img)){
                $img_path = $img;
                break;
            }
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

    function get_records_by_user_id($id){
        GLOBAL $conn;

        $myRecords = $conn->prepare("SELECT id_item, id_record FROM my_records WHERE id_user = ?");
        $myRecords->bind_param("s", $id);
        $myRecords->execute();

        $records = $myRecords->get_result();

        return $records;
    }

    function get_logged_user_id(){
        if(preg_match('/^\/users\/([0-9]*)\/.*$/', $_SERVER['REQUEST_URI'], $id)){
            return $id[1];
        }
        else{
            return 1;
        }
    }
?>