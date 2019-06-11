<?php 

    $TWO_HOURS = 60 * 60 * 2;
    
    ini_set('session.cookie_lifetime', $TWO_HOURS);
    ini_set('session.gc_maxlifetime', $TWO_HOURS);
    
    session_start();

    if(isset($_SESSION['id_user'])) {
        header('Location: /users/'. $_SESSION['id_user'] .'/home');
    } else {
        header('Location: /login');
    }
?>