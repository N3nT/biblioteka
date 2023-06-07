<?php
$db_host = "localhost";           
$db_name = "biblioteka";
$db_user = "root";
$db_pass = "";  
$db_conn = mysqli_connect("localhost","root","") or die ("Błąd połączenia z serwerem $host");
mysqli_select_db($db_conn, "biblioteka") or die("Trwa konserwacja bazy danych… Odśwież stronę za kilka sekund.");
?>