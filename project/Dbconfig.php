<?php

    $DB_host = "10.0.10.13";
	$DB_user = "terminal";
	$DB_pass = "vbybfnc1232";
	$DB_name = "terminal";


try
{
 $DB_con = new PDO("mysql:host={$DB_host};dbname={$DB_name}",$DB_user,$DB_pass, array(PDO::MYSQL_ATTR_INIT_COMMAND =>"SET NAMES utf8"));
 $DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
 echo $e->getMessage();
}

include_once 'class.crud.php';

$crud = new crud($DB_con);

?>