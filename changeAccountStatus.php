<?php

//connect to the constants page 
include('config/constants.php') ;

// get the id of the admin
 $id = $_GET['AccountId'] ;

 
 $status = $_GET['status'] ;
 // create the sql query 
 $sql = "UPDATE accounts SET 
 status = $status
  WHERE AccountId = $id";
 //execute the query 
 $res = sqlsrv_query($con,$sql) ;
 // check if the query executed or not
 if($res==true){
     // admin deleted 
    //  echo "Admin deleted successfuly " ;
    // create session to display message
    $_SESSION['disactive'] = "<div class='text-success'>Account dis activated successfully</div>";
    //RETURN TO MANAGE ADMIN PAGE 
    $script = "<script>
    window.location = 'http://localhost:8080/Wallet/manageAccounts.php';</script>";
    echo $script; }
 else{
     // admin not deleted
    //  echo "Admin not deleted " ; 
    $_SESSION['disactive'] = "<div class='text-danger'>Account is not dis active</div> ";
    //RETURN TO MANAGE ADMIN PAGE 
    $script = "<script>
    window.location = 'http://localhost:8080/Wallet/manageAccounts.php';</script>";
    echo $script;   
     
 }



// return to the manage-admin page 



?>