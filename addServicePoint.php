<?php include('partials/menu.php') ?>



<div class="container">
        <div class="wrapper">
               <h1>Add Service Point</h1>
               <br>  <br>

                <?php 
               if(isset($_SESSION['add'])){
                  echo $_SESSION['add'] ;
                  unset($_SESSION['add']) ; //display just one time 
               }
               ?> 
               <br><br>
                <!-- add admin form starts -->

               <form action="" method="POST">

               <table class="table table-hover"> 
                   <tr>
                       <td>Full Name</td>
                       <td><input class="form-control" type="text" name="full_name" placeholder="enter the service point name" required></td>
                       
                   </tr>
                   <tr>
                       <td>Phone</td>
                       <td><input class="form-control" type="text" name="phone" placeholder="enter the service point phone" required></td>
                       
                   </tr>
                   <tr>
                       <td>Email</td>
                       <td><input class="form-control" type="text" name="email" placeholder="enter the service point email" required></td>
                       
                   </tr>
                   <tr>
                       <td>Address</td>
                       <td><input class="form-control" type="text" name="address" placeholder="enter the service point address" required></td>
                       
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
    $phone = $_POST['phone'] ;
    $email = $_POST['email'] ;
    $joinDate = date('d-m-y h:i:s') ;
    $address = $_POST['address'] ;
    $username = $_POST['username'] ;
    $password = $_POST['password']; //password encreption bt md5 ;

    // save tha data in the database by sql query

    $sql2 = "SELECT phone FROM servicePoints WHERE phone='$phone'" ;
    $res2 = sqlsrv_query($con ,$sql2);
    if($res2==true){
        $count2 = sqlsrv_has_rows($res2) ;
    if($count2>0)
     {
        $_SESSION['exist'] = "<div class='text-danger'>Service Point already exist.</div>" ;
    $script = "<script>
    window.location = 'http://localhost:8080/Wallet/manageServicePoint.php';</script>";
        echo $script;      
      }


     else{
        $sql = "INSERT INTO servicePoints (fullName,phone,email,Address,JoinDate,modifiedDate,username,password,status)
      VALUES(?,?,?,?,?,?,?,?,?)";


$newDate = date('Y-M-d h:i:s');
$modDate = date('Y-M-d h:i:s');
$status = true;

 
    $params= array($full_name,$phone,$email,$address,$newDate,$modDate,$username,$password,$status);

    // executing query and saving the data in database
    $res = sqlsrv_query($con ,$sql,$params);

    //check the data is inserted or not and display message 

  if($res==true){
        // data inserted 
        // creat session value for display the message
        $_SESSION['add'] = "<div class='text-success'>Service Point Added Successfully</div>" ;
        
        //RETURN TO MANAGE PAGE 
        ob_start();

        $script = "<script>
        window.location = 'http://localhost:8080/Wallet/manageServicePoint.php';</script>";
        echo $script;
        
    }
    else{
        echo "Error in statement execution.\n";  
        die( print_r( sqlsrv_errors(), true));  
        // echo 'Failed';
        // failed 
        // creat session value for display the message
        $_SESSION['not-add'] = "<div class='text-danger'>Failed To Add Service Point</div>" ;
       // RETURN TO MANAGE ADMIN PAGE 
       $script = "<script>
       window.location = 'http://localhost:8080/Wallet/manageServicePoint.php';</script>";
       echo $script;    }

}
 }

    
    }

?>


<?php include('partials/footer.php') ?>

