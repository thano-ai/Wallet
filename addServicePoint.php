<?php include('partials/menu.php') ?>



<div class="main-content">
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

               <table class="tbl-30"> 
                   <tr>
                       <td>Full Name</td>
                       <td><input type="text" name="full_name" placeholder="enter the service point name"></td>
                       
                   </tr>
                   <tr>
                       <td>Phone</td>
                       <td><input type="text" name="phone" placeholder="enter the service point phone"></td>
                       
                   </tr>
                   <tr>
                       <td>Email</td>
                       <td><input type="text" name="email" placeholder="enter the service point email"></td>
                       
                   </tr>
                   <tr>
                       <td>Address</td>
                       <td><input type="text" name="address" placeholder="enter the service point address"></td>
                       
                   </tr>
                   <tr>
                       <td>Username</td>
                       <td><input type="text" name="username" placeholder="enter the username"></td>
                       
                   </tr>
                   <tr>
                       <td>Password</td>
                       <td><input type="password" name="password" placeholder="enter the password"></td>
                       
                   </tr>
                   <tr>
                       <td colspan="2">
                        <input id="submit" type="submit" name="submit" value="Add" class="btn-secondary">
                       </td>
                   </tr>
               </table>
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
    $password = md5($_POST['password']); //password encreption bt md5 ;

    // save tha data in the database by sql query
    $sql2 = "";
    $sql = "INSERT INTO servicePoints (Name,phone,email,Address,JoinDate,username,password)
      VALUES(?,?,?,?,?,?,?)";

    $params= array($full_name,$phone,$email,$address,$joinDate,$username,$password);

    // executing query and saving the data in database
    $res = sqlsrv_query($con ,$sql,$params);

    //check the data is inserted or not and display message 

  if($res==true){
        // data inserted 
        // creat session value for display the message
        $_SESSION['add'] = "<div class='success'>Service Point Added Successfully</div>" ;
        
        //RETURN TO MANAGE PAGE 
        header("location:".SITEURL.'manageServicePoint.php') ;
        echo" '<div class='success'>Service Point Added Successfully</div>' ";
    }
    else{
        echo "Error in statement execution.\n";  
        die( print_r( sqlsrv_errors(), true));  
        echo 'Failed';
        // failed 
        // creat session value for display the message
        $_SESSION['add'] = "<div class='error'>Failed To Add Service Point</div>" ;
        //RETURN TO MANAGE ADMIN PAGE 
       // header("location:".SITEURL.'manageServicePoint.php') ;
    }

}

?>


<?php include('partials/footer.php') ?>

