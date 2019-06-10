<?php 
    include_once 'app.model.php';
    header("Content-Type: application/json; charset=UTF-8");

    $id = get_logged_user_id();

    $artists = get_all_artists();

    if(!empty($records)){
        http_response_code(200);
    }
    else{
        http_response_code(404);
        echo 'Nothing found!';
    }

    $rec_json = [];
    foreach($artists as $artist){
        $temp = [
            'id_artist' => $artist['id_artist'],
            'artist_name' => $artist['artist_name']
        ];
        array_push($rec_json, $temp);
    }
    echo json_encode($rec_json);
?>