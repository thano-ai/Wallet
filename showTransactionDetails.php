<?php include('partials/menu.php') ?>

<div class="container">
        <div class="wrapper">
               <h1>Transaction Details</h1>
<<<<<<< HEAD
               <br> <br>
               <?php
            //    if(isset($_SESSION['add'])){
            //       echo $_SESSION['add'] ;
            //       unset($_SESSION['add']) ; //display just one time 
            //    }
            //    if(isset($_SESSION['delete'])){
            //       echo $_SESSION['delete'] ;
            //       unset($_SESSION['delete']) ; //display just one time 
            //    }
        //        if(isset($_SESSION['update'])){
        //           echo $_SESSION['update'] ;
        //           unset($_SESSION['update']) ; //display just one time 
        //        }
            //    if(isset($_SESSION['noUser'])){
            //       echo $_SESSION['noUser'] ;
            //       unset($_SESSION['noUser']) ; //display just one time 
            //    }
            //    if(isset($_SESSION['change'])){
            //       echo $_SESSION['change'] ;
            //       unset($_SESSION['change']) ; //display just one time 
            //    }
            //    if(isset($_SESSION['noMatch'])){
            //       echo $_SESSION['noMatch'] ;
            //       unset($_SESSION['noMatch']) ; //display just one time 
            //    }

            //    if(isset($_SESSION['no-admin-found'])){
            //       echo $_SESSION['no-admin-found'] ;
            //       unset($_SESSION['no-admin-found']) ; //display just one time 
            //    }


               ?>
               <!-- <br><br> -->

               <!-- button to add admin -->
               <!-- <a href="<?php echo  SITEURL; ?>addServicePoint.php" class="btn-primary">Add Service Point</a> -->
               <br> <br> <br>
=======
               <br> <br><br>
               
>>>>>>> c882d4c (init2)

               <table class="table table-hover">
                  <tr class="table-active">
                      <th>ID</th>
                      <th>Start Date</th>
                      <th>Type</th>
                      <th>Description</th>
                      <th>Status</th>
                      <th>Amount</th>
                      <th>Affected Id</th>
                      <th>Account Id</th>
                      <th>Service Point Id</th>

                      
                  </tr>

                  <?php
<<<<<<< HEAD
                      // display from database
                      $sql = "SELECT * from transactions" ;
=======
                  $id = $_GET['id'] ;
                      // display from database
                      $sql = "SELECT * from transactions
                      WHERE id = $id" ;
>>>>>>> c882d4c (init2)
                      $res = sqlsrv_query($con,$sql) ;

                      if($res==true){
                            $count = sqlsrv_has_rows($res) ;
                          if($count>0){
                            // we have data in db
                            while($rows = sqlsrv_fetch_array($res)){
                              // get the data 
                              $id = $rows['id'] ; 
                              $startdate = $rows['startdate'] ;
                              $type = $rows['type'] ;
                              $description = $rows['description'] ;
                              $status = $rows['status'] ;
                              $amount = $rows['amount'] ;
                              $affectedId = $rows['affectedId'] ;
                              $AccountId = $rows['AccountId'] ;
                              $ServicePointId = $rows['ServicePointId'] ;
                              
                              
                              $convertedDate = $startdate->format('Y-m-d ');

                              // display in the table 
                              ?>

                              <tr>
                                <td><?php echo $id?></td>
                                <td><?php echo $convertedDate?></td>
                                <td><?php echo $type?></td>
                                <td><?php echo $description?></td>
                                <td><?php echo $status?></td>
                                <td><?php echo $amount?></td>
                                <td><?php echo $affectedId?></td>
                                <td><?php echo $AccountId?></td>
                                <td><?php echo $ServicePointId?></td>
                                
                              </tr>
                              <?php
                            }   

                          }
                          else{
                            //there is no data 
                            //display message 
                            ?>
                            <tr>
                              <td colspan="6"><div class="text-danger">No Transactions Added</div></td>
                            </tr>

                            <?php 
                          }
                      }
                  
                  
                  ?>

                 
               </table>
               <a href="<?php echo  SITEURL; ?>manageTransactions.php" class="btn btn-secondary">Go Back</a>

        </div>
</div>

<?php include('partials/footer.php') ?>