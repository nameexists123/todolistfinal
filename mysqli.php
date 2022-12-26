<?php
$server = 'localhost';
$user = 'root';
$password = '';
$dataBase = 'agenda';


$mysqli =mysqli_connect($server,$user,$password,$dataBase)or die(mysqli_connect_error());

?>