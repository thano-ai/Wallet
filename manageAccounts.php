<?php include('partials/menu.php') ?>

<div class="container">
<<<<<<< HEAD
        <div class="wrapper">
               <h1>Manage Accounts</h1>
<<<<<<< HEAD
=======
=======
<div style="width:90%" class="wrapper">
               <h1>Manage Accounts</h1>

>>>>>>> ece5bf3 (deposite)
               <br> <br><br>
               <?php
               if(isset($_SESSION['disactive'])){
                echo $_SESSION['disactive'] ;
                unset($_SESSION['disactive']) ; //display just one time 
             }
               ?>

               <table class="table table-hover">
                  <tr class="table-active">
                      <th>ID</th>
                      <th>Type</th>
                      <th>Status</th>
                      <th>Creation Date</th>
                      <th>Activation Date</th>
                      <th>Last Modifided</th>
                      <th>Client</th>
                      <th>Process</th>
                      
                  </tr>

                  <?php
                      // display from database
                      $sql = "SELECT * from accounts    " ;
                      $res = sqlsrv_query($con,$sql) ;

                      if($res==true){
                            $count = sqlsrv_has_rows($res) ;
                          if($count>0){
                            // we have data in db
                            while($rows = sqlsrv_fetch_array($res)){
                              // get the data 
                              $id = $rows['AccountId'] ; 
                              $type = $rows['type'] ;
                              $status = $rows['status'] ;
                              $creationDate = $rows['creationDate'] ;
                              $activationDate = $rows['activationDate'] ;
                              $lastModifiedDate = $rows['lastModifiedDate'] ;
                              $clientId = $rows['clientId'] ;
<<<<<<< HEAD
                              
                              
                              $convertedCreationDate = $creationDate->format('Y-m-d ');
                              $convertedActivationDate = $activationDate->format('Y-m-d ');
                              $convertedModificationDate = $lastModifiedDate->format('Y-m-d ');

=======


                              if($status ==0){
                                $statusMessage ="Disactive";
                              }

                              else{
                                $statusMessage ="Active";
                              }
                              
                              
                              $convertedCreationDate = $creationDate->format('Y-m-d');
                              if(isset($lastModifiedDate)){
                              $convertedModificationDate = $lastModifiedDate->format('Y-m-d');
                              }
                              else{
                                $convertedModificationDate = " ";
                              }

                              if(isset($activationDate)){
                                $convertedActivationDate = $activationDate->format('Y-m-d');
                              }
                                else{
                                  $convertedActivationDate = " ";
                                }
>>>>>>> ece5bf3 (deposite)
                              // display in the table 
                              ?>

                              <tr>
                                <td><?php echo $id?></td>
                                <td><?php echo $type?></td>
<<<<<<< HEAD
                                <td><?php echo $status?></td>
=======
                                <td><?php echo $statusMessage?></td>
>>>>>>> ece5bf3 (deposite)
                                <td><?php echo $convertedCreationDate?></td>
                                <td><?php echo $convertedActivationDate?></td>
                                <td><?php echo $convertedModificationDate?></td>
                                <td><?php echo $clientId?></td>
                                <td>   
                                <a href="showAccountDetails.php?AccountId=<?php echo $id; ?>" class="btn btn-info">Show Details</a>
                               
                               
                               <?php
                                if($status==1){
                                        echo " <a href='changeAccountStatus.php?AccountId=$id&status=0' class='btn btn-danger'>Deactivate</a>";
                                  
                                }

                                else{
                                        echo " <a href='changeAccountStatus.php?AccountId=$id&status=1' style='padding: 6px 8%' class='btn btn-success'>Activate    </a>";
                                    
                                }
                                  ?> 
                                  
                                </td>
                              </tr>
                              <?php
                            }   

                          }
                          else{
                            //there is no data 
                            //display message 
                            ?>
                            <tr>
                              <td colspan="6"><div class="text-danger">No Accounts Added</div></td>
                            </tr>

                            <?php 
                          }
                      }
                  
                  
                  ?>

                 
               </table>
<<<<<<< HEAD
>>>>>>> c882d4c (init2)
=======
>>>>>>> ece5bf3 (deposite)
        </div>
</div>

<?php include('partials/footer.php') ?>