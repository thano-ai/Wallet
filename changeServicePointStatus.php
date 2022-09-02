<?php

//connect to the constants page 
include('config/constants.php') ;

// get the id of the admin
 $id = $_GET['ServicePointId'] ;
 $status = $_GET['status'] ;

 $newDate = date('Y-M-d h:i:s');

 // create the sql query 
 $sql = "UPDATE servicePoints SET 
 status = $status ,
 modifiedDate = '$newDate'
  WHERE ServicePointId = $id";
 //execute the query 
 $res = sqlsrv_query($con,$sql) ;
 // check if the query executed or not
 if($res==true){
     // admin deleted 
    //  echo "Admin deleted successfuly " ;
    // create session to display message
    $_SESSION['disactive'] = "<div class='text-success'>successfull</div>";
    //RETURN TO MANAGE ADMIN PAGE 
    $script = "<script>
    window.location = 'http://localhost:8080/Wallet/manageServicePoint.php';</script>";
    echo $script; }
 else{
     // admin not deleted
    //  echo "Admin not deleted " ; 
    $_SESSION['disactive'] = "<div class='text-danger'>Failed</div> ";
    //RETURN TO MANAGE ADMIN PAGE 
    $script = "<script>
    window.location = 'http://localhost:8080/Wallet/manageServicePoint.php';</script>";
    echo $script;   
     
 }



// return to the manage-admin page 



?>