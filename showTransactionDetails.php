<?php include('partials/menu.php') ?>

<div class="container">
        <div class="wrapper">
               <h1>Transaction Details</h1>


               <br> <br>
               

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
                      // display from database
                      $sql = "SELECT * from transactions" ;

                  $id = $_GET['id'] ;
                      // display from database
                      $sql = "SELECT * from transactions
                      WHERE id = $id" ;
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