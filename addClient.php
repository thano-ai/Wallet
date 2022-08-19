<?php include('partials/menu.php') ?>



<div class="container">
        <div class="wrapper">
               <h1>Add Client</h1>
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
                       <td>First Name</td>
                       <td><input class="form-control" type="text" name="first-name" placeholder="enter client first name"></td>
                       
                   </tr>
                   <tr>
                       <td>Middle Name</td>
                       <td><input class="form-control" type="text" name="mid-name" placeholder="enter client middle name"></td>
                       
                   </tr>
                   <tr>
                       <td>Third Name</td>
                       <td><input class="form-control" type="text" name="third-name" placeholder="enter client third name"></td>
                       
                   </tr>
                   <tr>
                       <td>Last Name</td>
                       <td><input class="form-control" type="text" name="last-name" placeholder="enter client last name"></td>
                       
                   </tr>
                   <!-- <tr>
                       <td>Birthdate</td>
                       <td><input class="form-control" type="text" name="birthdate" placeholder="enter client birthdate"></td>
                       
                   </tr> -->
                   <tr>
                       <td>Gender</td>
                       <td><input class="form-control" type="text" name="gender" placeholder="enter client gender"></td>
                       
                   </tr>
                   <tr>
                       <td>Birthdate</td>
                       <td><input class="form-control" type="date" name="birthdate" placeholder="Pick a date"></td>
                       
                   </tr>
                   <tr>
                       <td>Status</td>
                       <td><input class="form-control" type="text" name="status" placeholder="enter status"></td>
                       
                   </tr>
                   <tr>
                       <td>Phone</td>
                       <td><input class="form-control" type="text" name="phone" placeholder="enter client phone"></td>
                       
                   </tr>
                   <tr>
                       <td>Type</td>
                       <td><input class="form-control" type="text" name="type" placeholder="enter client type"></td>
                       
                   </tr>
                   <!-- <tr>
                       <td>Photo</td>
                       <td><input class="form-control" type="text" name="photo" placeholder="enter client photo"></td>
                       
                   </tr> -->
               </table>
               <div class="form-group">
                        <input id="submit" type="submit" name="submit" value="Add" class="btn btn-secondary">

                        
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
    $firstName = $_POST['first-name'] ;
    $midName = $_POST['mid-name'] ;
    $thirdName = $_POST['third-name'] ;
    $lastName = $_POST['last-name'] ;
    // $birthdate = $_POST['birthdate'] ;
    $status = $_POST['status'] ;
    $gender = $_POST['gender'] ;
    $phone = $_POST['phone'] ;
    $type = $_POST['type'] ;
    $birthdate = $_POST['birthdate'] ;
    // $photo = $_POST['photo']; 
    $date = str_replace('/"', '-', $birthdate);  
    $convertedBirthdate = date("Y-m-d", strtotime($date)); 
    

    // save tha data in the database by sql query
    $sql = "INSERT INTO clients (firstName,midName,thirdName,lastName,birthDate,gender,status,phone,type)
      VALUES(?,?,?,?,?,?,?,?,?)";


// $newDate = date('Y-M-d h:i:s');

 
    $params= array($firstName,$midName,$thirdName,$lastName,$convertedBirthdate,$status,$gender,$phone,$type);

    // executing query and saving the data in database
    $res = sqlsrv_query($con ,$sql,$params);

    //check the data is inserted or not and display message 

  if($res==true){
        // data inserted 
        // creat session value for display the message
        $_SESSION['add'] = "<div class='text-success'>Client Added Successfully</div>" ;
        
        //RETURN TO MANAGE PAGE 
        ob_start();

        $script = "<script>
        window.location = 'http://localhost:8080/Wallet/manageCleints.php';</script>";
        echo $script;
        
    }
    else{
        // echo "Error in statement execution.\n";  
        // die( print_r( sqlsrv_errors(), true));  
        // echo 'Failed';
        // failed 
        // creat session value for display the message
        $_SESSION['add'] = "<div class='text-danger'>Failed To Add Client</div>" ;
       // RETURN TO MANAGE ADMIN PAGE 
       $script = "<script>
       window.location = 'http://localhost:8080/Wallet/manageCleints.php';</script>";
       echo $script;    }

}

?>


<?php include('partials/footer.php') ?>

