<?php 
    include_once 'app.model.php';

    $TWO_HOURS = 60 * 60 * 2;

    ini_set('session.cookie_lifetime', $TWO_HOURS);
    ini_set('session.gc_maxlifetime', $TWO_HOURS);

    session_start(); 
    
    if(isset($_SESSION['id_user'])){
        $user = getLoggedUser($_SESSION['id_user']);
    }
    $id = $user -> id;
?>
<nav class ="topnav" id = "top_nav">
    <a href = <?php echo "/users/". $id ."/home" ?> class = "topnav-logo">
        <img src = "/img/logo.png" alt = "logo_img" class = "topnav-logo-img">
        <!-- <h4 class = "topnav-logo-btn">Home</h4> -->
    </a>
    <div class = "topnav-menu">
        <a  href = <?php echo "/users/". $id ."/cart" ?> class = "topnav-menu-item">
            <img src = "/img/shopping-cart.png" alt = "cart_img" class = "topnav-menu-img">
            <h4 class = "topnav-menu-btn">Cart</h4>
        </a>
        <a href = <?php echo "/users/". $id ."/my_records" ?> class = "topnav-menu-item">
            <img src = "/img/my_records.png" alt = "my_rec_img" class = "topnav-menu-img">
            <h4 class = "topnav-menu-btn">My Records</h4>
        </a>
        <a href = <?php echo "/users/". $id ."/add_record" ?> class = "topnav-menu-item">
            <img src = "/img/add_record.png" alt = "add_rec_img" class = "topnav-menu-img">
            <h4 class = "topnav-menu-btn">Add Record</h4>
        </a>   
        <a href = <?php echo "/users/". $id ."/wishlist" ?> class = "topnav-menu-item">
            <img src = "/img/wishlist-heart.png" alt = "wishlist_img" class = "topnav-menu-img">
            <h4 class = "topnav-menu-btn">Wishlist</h4>
        </a>
        <a href = <?php echo "/users/". $id ?> class = "topnav-menu-item">
            <img src = "/img/account-user.png" alt = "account_img" class = "topnav-menu-img">
            <h4 class = "topnav-menu-btn">Account</h4>
        </a> 
    </div>   
</nav>
