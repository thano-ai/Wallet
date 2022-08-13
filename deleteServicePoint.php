<?php

//connect to the constants page 
include('config/constants.php') ;

// get the id of the admin
 $id = $_GET['ServicePointId'] ;
 // create the sql query 
 $sql = "DELETE FROM servicePoints WHERE ServicePointId = $id";
 //execute the query 
 $res = sqlsrv_query($con,$sql) ;
 // check if the query executed or not
 if($res==true){
     // admin deleted 
    //  echo "Admin deleted successfuly " ;
    // create session to display message
    $_SESSION['delete'] = "<div class='text-success'>Service Point deleted successfully</div>";
    //RETURN TO MANAGE ADMIN PAGE 
    header("location:".SITEURL.'manageServicePoint.php') ;
 }
 else{
     // admin not deleted
    //  echo "Admin not deleted " ; 
    $_SESSION['delete'] = "<div class='text-danger'>Service Point is not deleted</div> ";
    //RETURN TO MANAGE ADMIN PAGE 
    header("location:".SITEURL.'manageServicePoint.php') ;
   
     
 }



// return to the manage-admin page 



?>