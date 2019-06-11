<?php    
  include_once 'app.model.php';
  $queries = array();
  parse_str($_SERVER['QUERY_STRING'], $queries);
  print_r($queries);

  $records = get_all_records();
  foreach($records as $rec){
    print_r($rec);
    echo '<br>';
  }
?>