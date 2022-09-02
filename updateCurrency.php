<?php include('partials/menu.php') ?>

<div class="container">
        <div class="wrapper">
               <h1>Update Currency</h1>
               <br><br>

                <?php

                 // get the id of the selected admin
                 $id = $_GET['id'] ;

                 // creat sql
                 $sql = "SELECT * FROM currencies WHERE id = $id";

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
                        $currencyType = $row['currencyType'] ;
                              $sellingPrice = $row['sellingPrice'] ;
                              $buyingPrice = $row['buyingPrice'] ;
                        


                     }
                     else{
                        $_SESSION['no-admin-found'] = "<div class='error'>currency not found</div>" ;
                         // return to the manage admin
                         $script = "<script>
                         window.location = 'http://localhost:8080/Wallet/mamageCurrencies.php';</script>";
                         echo $script;
                     }
                 }
                
                ?>

               <form action="" method="POST">
                   <table class="table table-hover">
                   <tr>
                       <td>Currency Type</td>
                       <td><input class="form-control" readonly type="text" name="currencyType" value="<?php echo $currencyType ;?>"></td>
                       </tr>

                       <tr>
                       <td>Selling Price</td>
                       <td><input class="form-control" type="text" name="sellingPrice" value="<?php echo $sellingPrice ;?>"></td>
                       </tr>

                       <tr>
                       <td>Buying Price</td>
                       <td><input class="form-control" type="text" name="buyingPrice" value="<?php echo $buyingPrice ;?>"></td>
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
    $id = $_GET['id'] ;
    $currencyType = $_POST['currencyType'] ;
    $sellingPrice = $_POST['sellingPrice'] ;
    $buyingPrice = $_POST['buyingPrice'] ;

    // create the query h
    $sql2 = "UPDATE currencies SET
    sellingPrice = $sellingPrice,
    buyingPrice = $buyingPrice
    WHERE id = $id
    ";


    //execute query
    $res2 = sqlsrv_query($con ,$sql2);

    // check the query
    if($res2==true){
        // data updated 
        // creat session 
        $_SESSION['update'] = "<div class='text-success'>Currency Updated Successfully</div>" ;
        //RETURN TO MANAGE ADMIN PAGE 
        $script = "<script>
        window.location = 'http://localhost:8080/Wallet/manageCurrencies.php';</script>";
        echo $script;        
    }
    else{
        // failed 
        // creat session 
        $_SESSION['not-update'] = "<div class='text-danger'>Failed To Update Currency</div>" ;
        $script = "<script>
        window.location = 'http://localhost:8080/Wallet/manageCurrencies.php';</script>";
        echo $script;     
        //RETURN TO MANAGE ADMIN PAGE 
        // header("location:".SITEURL.'mamageCurrencies.php') ;
     echo "Error in statement execution.\n";  
     die( print_r( sqlsrv_errors(), true)); 
    }

}

?>

<?php include('partials/footer.php') ?>