<?php   
    if(isset($_POST['submit'])){
        session_unset();
        header('Location: http://localhost:81/login');
    }
?>