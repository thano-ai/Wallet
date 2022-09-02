<?php include('partials/menu.php') ?>



<div class="container">
        <div class="wrapper">
               <h1>Add Admin</h1>
               <br>  <br>

                <?php 
               if(isset($_SESSION['add'])){
                  echo $_SESSION['add'] ;
                  unset($_SESSION['add']) ; //display just one time 
               }

               if(isset($_SESSION['not-add'])){
                echo $_SESSION['not-add'] ;
                unset($_SESSION['not-add']) ; //display just one time 
             }
               ?> 
               <br>
                <!-- add admin form starts -->

               <form action="" method="POST">

               <table class="table table-hover"> 
                   <tr>
                       <td>Full Name</td>
                       <td><input class="form-control" type="text" name="full_name" placeholder="enter the admin name" required></td>
                       
                   </tr>
                   <tr>
                       <td>Username</td>
                       <td><input class="form-control" type="text" name="username" placeholder="enter the username" required></td>
                       
                   </tr> 
                   <tr>
                       <td>Password</td>
                       <td><input class="form-control" type="password" name="password" placeholder="enter the password" required></td>
                       
                   </tr>
               </table>
               <div class="form-group">
                        <input id="submit" type="submit" name="submit" value="Add" class="btn btn-secondary"required >
                    <div>
               </form>
                <!-- add admin form ends -->
        </div>
</div>




<?php

//process the data from form to the database

// check the submit button 
if(isset($_POST['submit']))
{
    // button clicked 
    // get the data 
    $full_name = $_POST['full_name'] ;
//     $creationDate = date('d-m-y h:i:s') ;
    $username = $_POST['username'] ;
    $password = $_POST['password']; //password encreption bt md5 ;

    // save tha data in the database by sql query

    /*$sql2 = "SELECT phone FROM admins WHERE phone='$phone'" ;
    $res2 = sqlsrv_query($con ,$sql2);
    if($res2==true){
        $count2 = sqlsrv_has_rows($res2) ;
    if($count2>0)
     {
        $_SESSION['add'] = "<div class='text-danger'>Service Point alreazdy exist.</div>" ;
    $script = "<script>
    window.location = 'http://localhost:8080/Wallet/manageServicePoint.php';</script>";
        echo $script;      
      }


     */
        $sql = "INSERT INTO admins (name,username,password,status,creationDate,permission)
      VALUES(?,?,?,?,?,?)";


$newDate = date('Y-M-d h:i:s');
// $modDate = date('Y-M-d h:i:s');
$status = true;
$permission = 0 ;

 
    $params= array($full_name,$username,$password,$status,$newDate,$permission);

    // executing query and saving the data in database
    $res = sqlsrv_query($con ,$sql,$params);

    //check the data is inserted or not and display message 

  if($res==true){
        // data inserted 
        // creat session value for display the message
       
        $_SESSION['add'] = "<div class='text-success'>Admin Added Successfully</div>" ;
        
        //RETURN TO MANAGE PAGE 
        ob_start();

        $script = "<script>
        window.location = 'http://localhost:8080/Wallet/manageAdmins.php';</script>";
        echo $script;
        
    }
    else{
        echo "Error in statement execution.\n";  
        die( print_r( sqlsrv_errors(), true));  
        // echo 'Failed';
        // failed 
        // creat session value for display the message
        
        $_SESSION['not-add'] = "<div class='text-danger'>Failed To Add Admin</div>" ;
       // RETURN TO MANAGE ADMIN PAGE 
       $script = "<script>
       window.location = 'http://localhost:8080/Wallet/manageAdmins.php';</script>";
       echo $script;    }

}
 

?>


<?php include('partials/footer.php') ?>

