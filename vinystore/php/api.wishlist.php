<?php 
    include_once 'app.model.php';
    header("Content-Type: application/json; charset=UTF-8");

    $id = get_logged_user_id();

    $records = get_wish_by_user($id);

    if(!empty($records)){
        http_response_code(200);
    }
    else{
        http_response_code(404);
        echo 'Nothing found!';
    }

    $rec_json = [];
    foreach($records as $rec){
        $recInfo = get_record_by_id($rec['id_record']);
        foreach($recInfo as $inf){
            $temp = [
                'id_wish' => $rec['id_wish'],
                'id_record' => $inf['id_record'],
                'artist' => $inf['artist'],
                'album' => $inf['album'],
                'label' => $inf['label'],
                'genre' => $inf['genre'],
                'price' => $inf['price']
            ];
            array_push($rec_json, $temp);
        }
    }
    echo json_encode($rec_json);
?>