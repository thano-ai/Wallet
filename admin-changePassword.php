<?php include('partials/menu.php') ?>

<div class="container">
        <div class="wrapper">
               <h1>Change Password</h1>
               <br><br>

               <?php
               
                   $id = $_GET['id'] ;
               
               
               ?>

               <form action=""  method="POST" >
               <fieldset>
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="form-label mt-4">Current password</label>
                        <input type="password" class="form-control" id="exampleInputEmail1" name="current_pass" placeholder="enter current password">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="form-label mt-4">New password</label>
                        <input type="password" class="form-control" id="exampleInputEmail1" name="new_pass" placeholder="enter new password">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="form-label mt-4">Confirm password</label>
                        <input type="password" class="form-control" id="exampleInputEmail1" name="confirm_pass" placeholder="confirm the password">
                    </div>
                    <br>
                    <div class="form-group">
                        <input type="hidden" name="ServicePointId" value="<?php echo $id ;?>">
                        <input id="submit" type="submit" name="submit" value="Change Password" class="btn btn-secondary">
                       
                    <div>
                   <!-- <table class="form-group row">
                       <tr class="form-group">
                           <td>Current password</td>
                           <td>
                               <input type="password" name="current_pass" placeholder="enter current password">
                           </td>
                       </tr>

                       <tr>
                           <td>New password</td>
                           <td>
                               <input type="password" name="new_pass" placeholder="enter new password">
                           </td>
                       </tr>

                       <tr>
                           <td>Confirm password</td>
                           <td>
                               <input type="password" name="confirm_pass" placeholder="confirm the password">
                           </td>
                       </tr>

                       <td colspan="2">
                       <input type="hidden" name="ServicePointId" value="<?php echo $id ;?>">
                        <input id="submit" type="submit" name="submit" value="Change Password" class="btn-secondary">
                       </td>
                   </tr>

                   </table> -->
            </fieldset>
               </form>

    </div>
</div>

<?php
if(isset($_POST['submit'])){
    // get the data from the form
    // $id= $_POST['id'] ;
    $current_pass= $_POST['current_pass'];
    $new_pass= $_POST['new_pass'] ;
    $confirm_pass=$_POST['confirm_pass'];

    //create sql query
    $sql ="SELECT * FROM admins WHERE id=$id AND password='$current_pass'" ;

    //execute query
    $res = sqlsrv_query($con ,$sql);

    // check the query
    if($res==true){
        //check the data
        $count = sqlsrv_has_rows($res) ;

        if($count==1){
            // confirm password
            if($new_pass==$confirm_pass){
            //update the pass
            $sql2 = "UPDATE admins SET password = '$new_pass' WHERE id = $id" ;

             //execute sql
             $res2 = sqlsrv_query($con,$sql2) ;

             // check the query
              if($res2==true){
                $_SESSION['change'] = "<div class='text-success'>password changes successfully</div>" ;
                // return to the manage admin
                $script = "<script>
                window.location = 'http://localhost:8080/Wallet/manageAdmins.php';</script>";
                echo $script;
              }
              else{
                $_SESSION['no-change'] = "<div class='text-danger'>failed to change password</div>" ;
                // return to the manage admin
                $script = "<script>
                window.location = 'http://localhost:8080/Wallet/manageAdmins.php';</script>";
                echo $script;              }
        }

        else{
                $_SESSION['noMatch'] = "<div class='text-danger'>password not match</div>" ;
                // return to the manage admin
                $script = "<script>
                window.location = 'http://localhost:8080/Wallet/manageAdmins.php';</script>";
                echo $script;            //return to manage admin
        }
            
        
        }

        else{
            $_SESSION['noUser'] = "<div class='text-danger'>user not found. </div>" ;
            // return to the manage admin
            $script = "<script>
            window.location = 'http://localhost:8080/Wallet/manageAdmins.php';</script>";
            echo $script;        }
    }
}



?>

<?php include('partials/footer.php') ?>