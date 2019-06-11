<?php 
    include_once 'app.model.php';
    
    session_start();

    $user = getLoggedUser($_SESSION['id_user']);

    if(isset($_POST['submit'])){
        header('Location: /users/'. $user->id .'/home/?search='. $_POST['search']);
    }
?>