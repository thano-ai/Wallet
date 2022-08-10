<?php

session_start() ;

define('SITEURL' , 'http://localhost:8088/Wallet/') ;
$serverName = "THANAA"; 
$uid = "";   
$pwd = "";  
$databaseName = "finalWall"; 

$connectionInfo = array( "UID"=>$uid,                            
                         "PWD"=>$pwd,                            
                         "Database"=>$databaseName,
						 "CharacterSet" => "UTF-8"); 

/* Connect using SQL Server Authentication. */  
$con = sqlsrv_connect( $serverName, $connectionInfo);  


 
//  $con = mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die(mysqli_error()); //database connection
//  $db_select = mysqli_select_db($con,DB_NAME)  or die(mysqli_error()); //sellection database


?>