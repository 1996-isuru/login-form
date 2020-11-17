<?php

   $dbhost = 'localhost';
   $dbuser = 'root';
   $dbpass = '';
   $dbname = 'starfest';

   $connection = mysqli_connect('localhost', 'root', '', 'starfest');

   if(mysqli_connect_error()){
       die('Database connection faild' . mysqli_connect_error());
   } else {
       //echo "Connection successful.";
   }
?>