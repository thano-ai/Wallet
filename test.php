<?php

// start tthe session 
session_start() ;

$connectionInfo = array("UID" => "bank", "pwd" => "Yemen123", "Database" => "WalletV1_db", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
$serverName = "tcp:walletv1dbserver.database.windows.net,1433";
$con = sqlsrv_connect($serverName, $connectionInfo);

if($con){
    echo "Connected";

}

else{
    echo (print_r(sqlsrv_errors(),true));
}
/* Connect using SQL Server Authentication. */  








?>