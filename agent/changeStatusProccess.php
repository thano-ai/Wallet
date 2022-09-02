<?php
include('../config/constants.php') ;

$transactionId = $_GET['id'] ;

$servicePointId = $_GET['servicePointId'] ;
   

    // create the query h
    $sql2 = "UPDATE transactions SET
    status = 1,
    ServicePointId= $servicePointId
    WHERE id = $transactionId
    ";

    //execute query
    $res2 = sqlsrv_query($con ,$sql2);

    // check the query
    if($res2==true){
        // data updated 
        // creat session 
        $_SESSION['update'] = "<div class='text-success'>Transaction Received Successfully</div>" ;
        //RETURN TO MANAGE ADMIN PAGE 
        header("location:index.php") ;
    }

    else{
        // failed 
        // creat session 
        $_SESSION['update'] = "<div class='text-danger'>Failed To Update Recive Transaction</div>" ;
        //RETURN TO MANAGE ADMIN PAGE 
        // header("location:".SITEURL.'mamageCurrencies.php') ;
     echo "Error in statement execution.\n";  
     die( print_r( sqlsrv_errors(), true)); 
    }


?>