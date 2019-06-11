<?php 
    include_once 'app.model.php';
    header("Content-Type: application/json; charset=UTF-8");

    $records = get_all_records();

    $queries = array();
    parse_str($_SERVER['QUERY_STRING'], $queries);
    
    $search = $queries['search'];

    if(!empty($records)){
        http_response_code(200);
    }
    else{
        http_response_code(404);
        echo 'Nothing found!';
    }

    $rec_json = [];
    foreach($records as $rec){
        if(strpos(strtolower($rec['artist']), strtolower($search)) !== false || 
            strpos(strtolower($rec['album']), strtolower($search)) !== false || 
            strpos(strtolower($rec['genre']), strtolower($search)) !== false ||
            strpos(strtolower($rec['label']), strtolower($search)) !== false){

            $path = get_img_by_id($rec['id_record']);
        
            $temp = [
                "id_record" => $rec['id_record'],
                "artist" => $rec['artist'],
                "album" => $rec['album'],
                "catalogue" => $rec['catalogue'],
                "path" => $path
            ];
            array_push($rec_json, $temp);
        }
    }
    echo json_encode($rec_json);
?>