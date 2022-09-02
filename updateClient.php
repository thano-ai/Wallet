<?php include('partials/menu.php') ?>

<div class="container">
        <div class="wrapper">
               <h1>Update Client</h1>
               <br><br>

                <?php

                 // get the id of the selected admin
                 $id = $_GET['ClientId'] ;

                 // creat sql
                 $sql = "SELECT * FROM clients WHERE ClientId = $id";

                 //execute sql
                 $res = sqlsrv_query($con,$sql) ;

                 // check if the query executed or not
                 if($res==true){
                     //check the data
                     $count = sqlsrv_has_rows($res) ;
                     if($count==1){
                         //get the details
                        //  echo "Admin Available" ; 
                        $row = sqlsrv_fetch_array($res) ;
                        $firstname = $row['firstName'] ;
                        $lastname = $row['lastName'] ;
                        // $bithdate = $row['birthDate'] ;
                        $gender = $row['gender'] ;
                        $status = $row['status'] ;
                        $phone = $row['phone'] ;
                        $type = $row['type'] ;
                        // $photo = $row['photo'] ;


                     }
                     else{
                        $_SESSION['no-admin-found'] = "<div class='error'>client not found</div>" ;
                         // return to the manage admin
                         $script = "<script>
                         window.location = 'http://localhost:8080/Wallet/manageCleints.php';</script>";
                         echo $script;
                     }
                 }
                
                ?>

               <form action="" method="POST">
                   <table class="table table-hover">
                       <tr>
                       <td>First Name</td>
                       <td><input class="form-control" type="text" name="firstName" value="<?php echo $firstname ;?>"></td>
                       </tr>

                       <tr>
                       <td>Last Name</td>
                       <td><input class="form-control" type="text" name="lastname" value="<?php echo $lastname ;?>"></td>
                       </tr>

                       <!-- <tr>
                       <td>Birthdate</td>
                       <td><input class="form-control" type="text" name="bithdate" value=""></td>
                       </tr> -->

                       <tr>
                       <td>Gender</td>
                       <td><input class="form-control" type="text" name="gender" value="<?php echo $gender ;?>"></td>
                       </tr>


                       <tr>
                       <td>Status</td>
                       <td><input class="form-control" type="text" name="status" value="<?php echo $status ;?>"></td>
                       </tr>

                       <tr>
                       <td>Phone</td>
                       <td><input class="form-control" type="text" name="phone" value="<?php echo $phone ;?>"></td>
                       </tr>

                       <tr>
                       <td>Type</td>
                       <td><input class="form-control" type="text" name="type" value="<?php echo $type ;?>"></td>
                       </tr>

                       <!-- <tr>
                       <td>Photo</td>
                       <td><input class="form-control" type="text" name="photo" value="<?php echo $photo ;?>"></td>
                       </tr> -->

                   </table>
                   <div class="form-group">
                   <input type="hidden" name="ClientId" value="<?php echo $id ;?>">
                        <input id="submit" type="submit" name="submit" value="Update" class="btn btn-secondary">
                    <div>


               </form>

    </div>
</div>

<?php


// check the submit button 
if(isset($_POST['submit'])){
    //get the values from the form to update
    $id = $_POST['ClientId'] ;
    $firstname = $_POST['firstName'] ;
    $lastname = $_POST['lastname'] ;
    // $bithdate = $_POST['bithdate'] ;
    $gender = $_POST['gender'] ;
    $status = $_POST['status'] ;
    $phone = $_POST['phone'] ;
    $type = $_POST['type'] ;
    // $photo = $_POST['photo'] ;

    // create the query h
    $sql2 = "UPDATE clients SET
    firstName = '$firstname',
    lastName = '$lastname',
    gender = '$gender',
    status = '$status',
    phone = '$phone',
    type = '$type'
    WHERE ClientId =$id
    ";


    //execute query
    $res2 = sqlsrv_query($con ,$sql2);

    // check the query
    if($res2==true){
        // data updated 
        // creat session 
        $_SESSION['update'] = "<div class='text-success'>Client Updated Successfully</div>" ;
        //RETURN TO MANAGE ADMIN PAGE 
        $script = "<script>
        window.location = 'http://localhost:8080/Wallet/manageCleints.php';</script>";
        echo $script;
    }
    else{
        // failed 
        // creat session 
        $_SESSION['not-update'] = "<div class='text-danger'>Failed To Update Client</div>" ;
        //RETURN TO MANAGE ADMIN PAGE 
        // header("location:".SITEURL.'manageCleints.php') ;
     echo "Error in statement execution.\n";  
     die( print_r( sqlsrv_errors(), true)); 
    }

}

?>

<?php include('partials/footer.php') ?>