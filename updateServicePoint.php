<?php include('partials/menu.php') ?>

<div class="container">
        <div class="wrapper">
               <h1>Update Service Point</h1>
               <br><br>

                <?php


                 // get the id of the selected admin
                 $id = $_GET['ServicePointId'] ;

                 // creat sql
                 $sql = "SELECT * FROM servicePoints WHERE ServicePointId = $id";

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
                        $full_name= $row['Name'] ;
                        $phone= $row['phone'] ;
                        $email= $row['email'] ;
                        $address= $row['Address'] ;
                        $username= $row['username'] ;


                     }
                     else{
                        $_SESSION['no-admin-found'] = "<div class='error'>admin not found</div>" ;
                         // return to the manage admin
                         $script = "<script>
                         window.location = 'http://localhost:8080/Wallet/manageServicePoint.php';</script>";
                         echo $script;

                     }
                 }
                
                ?>

               <form action="" method="POST">
                   <table class="table table-hover">
                       <tr>
                       <td>Name</td>
                       <td><input class="form-control" type="text" name="Name" value="<?php echo $full_name ;?>"></td>
                       </tr>

                       <tr>
                       <td>Phone</td>
                       <td><input class="form-control" type="text" name="phone" value="<?php echo $phone ;?>"></td>
                       </tr>

                       <tr>
                       <td>Email</td>
                       <td><input class="form-control" type="text" name="email" value="<?php echo $email ;?>"></td>
                       </tr>

                       <tr>
                       <td>Address</td>
                       <td><input class="form-control" type="text" name="Address" value="<?php echo $address ;?>"></td>
                       </tr>

                       <tr>
                       <td>username</td>
                       <td><input class="form-control" type="text" name="username" value="<?php echo $username ;?>"></td>
                       </tr>

                   </table>
                   <div class="form-group">
                   <input type="hidden" name="ServicePointId" value="<?php echo $id ;?>">
                        <input id="submit" type="submit" name="submit" value="Update" class="btn btn-secondary">
                       <div>


               </form>

    </div>
</div>

<?php


// check the submit button 
if(isset($_POST['submit'])){
    //get the values from the form to update
    $id = $_POST['ServicePointId'] ;
    $full_name= $_POST['Name'] ;
        $phone= $_POST['phone'] ;
        $email= $_POST['email'] ;
        $address= $_POST['Address'] ;
        $username= $_POST['username'] ;

    // create the query h
    $sql2 = "UPDATE servicePoints SET
    Name = '$full_name',
    phone = '$phone',
    email = '$email',
    Address = '$address',
    username = '$username'
    WHERE ServicePointId =$id
    ";


    //execute query
    $res2 = sqlsrv_query($con ,$sql2);

    // check the query
    if($res2==true){
        // data updated 
        // creat session 
        $_SESSION['update'] = "<div class='text-success'>Service Point Updated Successfully</div>" ;
        //RETURN TO MANAGE ADMIN PAGE 
       
        $script = "<script>
        window.location = 'http://localhost:8080/Wallet/manageServicePoint.php';</script>";
        echo $script;
    
    }
    else{
        // failed 
        // creat session 
        $_SESSION['update'] = "<div class='text-danger'>Failed To Update Service Point</div>" ;
        //RETURN TO MANAGE ADMIN PAGE 
        $script = "<script>
        window.location = 'http://localhost:8080/Wallet/manageServicePoint.php';</script>";
        echo $script;    //  echo "Error in statement execution.\n";  
    //  die( print_r( sqlsrv_errors(), true)); 
    }

}

?>

<?php include('partials/footer.php') ?>