<?php 
session_start();
//connect.php
$server	    = '192.168.132.154';
$username	= 'root';
$password	= '0110';
$database	= 'Blog';
$connect = mysqli_connect($server, $username, $password);
if(!$connect)
{
 	exit('Error: could not establish database connection');
}
if(!mysqli_select_db($connect,$database))
{
 	exit('Error: could not select the database');
}
?>
