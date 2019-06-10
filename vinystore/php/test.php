<?php    

  ini_set("SMTP","ssl://smtp.gmail.com");
  ini_set("smtp_port","587");

  echo mail('andrei.crivoi1997@gmail.com', 'subject', 'message');
?>