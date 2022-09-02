<?php
/*
session_start() ;

define('SITEURL' , 'http://localhost:8080/Wallet/') ;
$connectionInfo = array("UID" => "bank", "pwd" => "Yemen123", "Database" => "WalletV1_db", "CharacterSet" => "UTF-8", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
$serverName = "tcp:walletv1dbserver.database.windows.net,1433";
$con = sqlsrv_connect($serverName, $connectionInfo);

if($con){
    // echo "Connected";

}

else{
    echo (print_r(sqlsrv_errors(),true));
}
 
//  $con = mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die(mysqli_error()); //database connection
//  $db_select = mysqli_select_db($con,DB_NAME)  or die(mysqli_error()); //sellection database

*/




session_start() ;

define('SITEURL' , 'http://localhost:8080/Wallet/') ;
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

?>
