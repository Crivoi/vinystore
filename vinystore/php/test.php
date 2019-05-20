<?php 
    include_once './app.model.php';

    ini_set('user_agent', $_SERVER['HTTP_USER_AGENT']);

    $response = api_call("https://api.discogs.com/releases/1", "GET");

    header('Content-Type: application/json');

    echo json_encode($response);

?>
