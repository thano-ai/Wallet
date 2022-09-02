<?php include('partials/menu.php') ?>

<div class="container">
        <div class="wrapper">
               <h1>Update Admin</h1>
               <br><br>

                <?php


                 // get the id of the selected admin
                 $id = $_GET['id'] ;

                 // creat sql
                 $sql = "SELECT * FROM admins WHERE id = $id";

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
                        $full_name= $row['name'] ;
                        $username= $row['username'] ;


                     }
                     else{
                        $_SESSION['no-admin-found'] = "<div class='error'>admin not found</div>" ;
                         // return to the manage admin
                         $script = "<script>
                         window.location = 'http://localhost:8080/Wallet/manageAdmins.php';</script>";
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
        $username= $_POST['username'] ;

    // create the query h
    $sql2 = "UPDATE admins SET
    name = '$full_name',
    username = '$username'
    WHERE id =$id
    ";


    //execute query
    $res2 = sqlsrv_query($con ,$sql2);

    // check the query
    if($res2==true){
        // data updated 
        // creat session 
        $_SESSION['update'] = "<div class='text-success'>Admin Updated Successfully</div>" ;
        //RETURN TO MANAGE ADMIN PAGE 
       
        $script = "<script>
        window.location = 'http://localhost:8080/Wallet/manageAdmins.php';</script>";
        echo $script;
    
    }
    else{
        // failed 
        // creat session 
        $_SESSION['not-update'] = "<div class='text-danger'>Failed To Update Admin</div>" ;
        //RETURN TO MANAGE ADMIN PAGE 
        $script = "<script>
        window.location = 'http://localhost:8080/Wallet/manageAdmins.php';</script>";
        echo $script;   
          echo "Error in statement execution.\n";  
     die( print_r( sqlsrv_errors(), true)); 
    }

}

?>

<?php include('partials/footer.php') ?>