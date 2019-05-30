<?php    
  include_once 'app.model.php';
  $usr = get_user_by_id(3);
  foreach($usr as $u){
    echo gettype($u);
  }
?>