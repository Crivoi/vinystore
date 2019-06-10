<?php   
    session_start();
    if(isset($_POST['submit'])){
        echo 'de ce e totul asa urat';
        session_destroy();
        header('Location: http://localhost:81/login');
    }
?>