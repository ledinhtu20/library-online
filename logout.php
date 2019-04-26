<?php
      define("IN_SITE", true);
    include_once('functions.php');
   set_logout();
   db_disconnect();
   header('location:index.php');

 ?>
