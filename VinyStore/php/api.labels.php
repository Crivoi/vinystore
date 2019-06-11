<?php 
    include_once 'app.model.php';
    header("Content-Type: application/json; charset=UTF-8");

    $id = get_logged_user_id();

    $labels = get_all_labels();

    if(!empty($labels)){
        http_response_code(200);
    }
    else{
        http_response_code(404);
        echo 'Nothing found!';
    }

    $rec_json = [];
    foreach($labels as $label){
        $temp = [
            'id_label' => $label['id_label'],
            'label_name' => $label['label_name']
        ];
        array_push($rec_json, $temp);
    }
    echo json_encode($rec_json);
?>