<?php include('partials/menu.php') ?>

<div class="container">
        <div class="wrapper">
               <h1>Update Commission</h1>
               <br><br>

                <?php

                 // get the id of the selected admin
                 $id = $_GET['comissionId'] ;
                //  $TransactionId = $_GET['Transactionid'] ;

                 // creat sql
                 $sql = "SELECT * FROM Comission WHERE comissionId = $id";

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
                        $comissionsForAccount = $row['comissionsForAccount'] ;
                        $comissionsForName = $row['comissionsForName'] ;
                        $comissionsForCurrency = $row['comissionsForCurrency'] ;
                        $comissionsForYemenMooblie = $row['comissionsForYemenMooblie'] ;
                        $comissionsForElectricity = $row['comissionsForElectricity'] ;
                        $comissionsForPhone = $row['comissionsForPhone'] ;

                        


                     }
                     else{
                        $_SESSION['no-admin-found'] = "<div class='error'>Commission not found</div>" ;
                         // return to the manage admin
                         $script = "<script>
                         window.location = 'http://localhost:8080/Wallet/mamageCommissions.php';</script>";
                         echo $script;
                     }
                 }
                
                ?>

               <form action="" method="POST">
                   <table class="table table-hover">
                   <tr>
                       <td>Account</td>
                       <td><input class="form-control" type="text" name="forAccount" value="<?php echo $comissionsForAccount ;?>"></td>
                       </tr>

                       <tr>
                       <td>Name</td>
                       <td><input class="form-control" type="text" name="forName" value="<?php echo $comissionsForName ;?>"></td>
                       </tr>

                       <tr>
                       <td>Currency</td>
                       <td><input class="form-control" type="text" name="forCurrency" value="<?php echo $comissionsForCurrency ;?>"></td>
                       </tr>

                       <tr>
                       <td>YemenMobile</td>
                       <td><input class="form-control" type="text" name="forYemenMobile" value="<?php echo $comissionsForYemenMooblie ;?>"></td>
                       </tr>

                       <tr>
                       <td>Electricity</td>
                       <td><input class="form-control" type="text" name="forElectricity" value="<?php echo $comissionsForElectricity ;?>"></td>
                       </tr>

                       <tr>
                       <td>Phone</td>
                       <td><input class="form-control" type="text" name="forPhone" value="<?php echo $comissionsForPhone ;?>"></td>
                       </tr>

                   </table>
                   <div class="form-group">
                   <!-- <input type="hidden" name="id" value="<?php echo $id ;?>"> -->
                        <input id="submit" type="submit" name="submit" value="Update" class=" btn btn-secondary">
                       <div>


               </form>

    </div>
</div>

<?php


// check the submit button 
if(isset($_POST['submit'])){
    //get the values from the form to update
    $id = $_GET['comissionId'] ;
    // $TransactionId = $_GET['Transactionid'] ;
    
    $comissionsForAccount = $_POST['forAccount'] ;
    $comissionsForName = $_POST['forName'] ;
    $comissionsForCurrency = $_POST['forCurrency'] ;
    $comissionsForYemenMooblie = $_POST['forYemenMobile'] ;
    $comissionsForElectricity = $_POST['forElectricity'] ;
    $comissionsForPhone = $_POST['forPhone'] ;

    // create the query h
    $sql2 = "UPDATE Comission SET
    comissionsForAccount = $comissionsForAccount,
    comissionsForName = $comissionsForName,
    comissionsForCurrency = $comissionsForCurrency,
    comissionsForYemenMooblie = $comissionsForYemenMooblie,
    comissionsForElectricity = $comissionsForElectricity,
    comissionsForPhone = $comissionsForPhone
    WHERE comissionId = $id
    ";


    //execute query
    $res2 = sqlsrv_query($con ,$sql2);

    // check the query
    if($res2==true){
        // data updated 
        // creat session 
        $_SESSION['update'] = "<div class='text-success'>Commission Updated Successfully</div>" ;
        //RETURN TO MANAGE ADMIN PAGE 
        $script = "<script>
        window.location = 'http://localhost:8080/Wallet/manageCommissions.php';</script>";
        echo $script;        
    }
    else{
        // failed 
        // creat session 
        $_SESSION['not-update'] = "<div class='text-danger'>Failed To Update Commission</div>" ;
        $script = "<script>
        window.location = 'http://localhost:8080/Wallet/manageCommissions.php';</script>";
        echo $script;
        //RETURN TO MANAGE ADMIN PAGE 
        // header("location:".SITEURL.'mamageCurrencies.php') ;
     echo "Error in statement execution.\n";  
     die( print_r( sqlsrv_errors(), true)); 
    }

}

?>

<?php include('partials/footer.php') ?>