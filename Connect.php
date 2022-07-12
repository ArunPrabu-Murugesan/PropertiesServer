<?php
  $host = "127.0.0.1";
  $usr = "root";
  $pass = "";
  $conn = mysql_connect($host,$usr,$pass) or die("Host Connection Fails");
  $db = "properties";
  mysql_select_db($db,$conn) or die("Could Not Connect MySQL DataBase");
  error_reporting(0);
?>