<?php 
    include_once 'app.model.php';

    $records = get_all_records();

    $img_files = glob("../img/records/*.{jpg,gif,png,PNG,BMP,jpeg}", GLOB_BRACE);
    sort($img_files);
    
    echo $img_files[1].'<br>';

    foreach($records as $rec){
        echo $rec['id_record'].'    '.
        $rec['artist'].'    '.
        $rec['album'].'<br>';
    }
?>
