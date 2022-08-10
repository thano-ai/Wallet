<?php include('partials/menu.php') ?>

<div class="main-content">
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
                         header("location:".SITEURL.'manageServicePoint.php') ;
                     }
                 }
                
                ?>

               <form action="" method="POST">
                   <table class="tbl-30">
                       <tr>
                       <td>Name</td>
                       <td><input type="text" name="full_name" value="<?php echo $full_name ;?>"></td>
                       </tr>

                       <tr>
                       <td>Phone</td>
                       <td><input type="text" name="phone" value="<?php echo $phone ;?>"></td>
                       </tr>

                       <tr>
                       <td>Email</td>
                       <td><input type="text" name="email" value="<?php echo $email ;?>"></td>
                       </tr>

                       <tr>
                       <td>Address</td>
                       <td><input type="text" name="address" value="<?php echo $address ;?>"></td>
                       </tr>

                       <tr>
                       <td>username</td>
                       <td><input type="text" name="username" value="<?php echo $username ;?>"></td>
                       </tr>

                       <tr>
                       <td colspan="2">
                           <input type="hidden" name="id" value="<?php echo $id ;?>">
                        <input id="submit" type="submit" name="submit" value="Update Admin" class="btn-secondary">
                       </td>
                   </tr>
                   </table>


               </form>

    </div>
</div>

<?php


// check the submit button 
if(isset($_POST['submit'])){
    //get the values from the form to update
    $id = $_POST['ServicePointId'] ;
    $full_name= $row['Name'] ;
        $phone= $row['phone'] ;
        $email= $row['email'] ;
        $address= $row['Address'] ;
        $username= $row['username'] ;

    // create the query 
    $sql2 = "UPDATE servicePoints SET
    Name = '$full_name',
    phone = '$phone',
    email = '$email',
    Address = '$full_name',
    username = '$address'
    WHERE ServicePointId ='$id'
    ";

    //execute query
    $res = sqlsrv_query($con ,$sql2);

    // check the query
    if($res==true){
        // data updated 
        // creat session 
        $_SESSION['update'] = "<div class='success'>Admin Updated Successfully</div>" ;
        //RETURN TO MANAGE ADMIN PAGE 
        header("location:".SITEURL.'manageServicePoint.php') ;
    }
    else{
        // failed 
        // creat session 
        $_SESSION['update'] = "<div class='error'>Failed To Update Admin</div>" ;
        //RETURN TO MANAGE ADMIN PAGE 
      //  header("location:".SITEURL.'manageServicePoint.php') ;
      
     echo "Error in statement execution.\n";  
     die( print_r( sqlsrv_errors(), true)); 
    }

}

?>

<?php include('partials/footer.php') ?>