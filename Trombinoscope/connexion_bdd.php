<?php
/*try
{
	
	$user='root';
	$pass='';
	$db='trombi';
	$bdd = new PDO('mysql:host=localhost;dbname=trombi', $user, $pass);
}
catch (Exception $exception)
{
die($exception->getMessage());
}*/

try
{
	
	$user='guarssif3u_appli';
	$pass='amdnvidia07';
	$bdd = new PDO('mysql:host=infodb.iutmetz.univ-lorraine.fr:3306;dbname=guarssif3u_trombi', $user, $pass);
}
catch (Exception $exception)
{
die($exception->getMessage());
}
?>