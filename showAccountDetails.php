<?php include('partials/menu.php') ?>

<div class="container">
        <div class="wrapper">
        <h1>Cleint Details</h1>
               <br> <br>

            <table class="table table-hover">
            <tr class="table-active">
                      <th>ID</th>
                      <th>Currency Type</th>
                      <th>Cridet</th>
                      <th>Depit</th>
                      <th>Status</th>
                      <th>Description</th>
                      <th>Creation Date</th>
                      <th>Activation Date</th>
                      <th>Last Modifided</th>
                  </tr>

            <?php
            $id = $_GET['AccountId'] ;
            $sql = "SELECT * FROM subAccounts 
            WHERE AccountID = $id";
            $res = sqlsrv_query($con,$sql) ;
            if($res==true){
                $count = sqlsrv_has_rows($res) ;
                if($count>0){
                  // we have data in db
                  while($rows = sqlsrv_fetch_array($res))
                  {
                    // get the data 
                    $id = $rows['id'] ; 
                    $currencyType = $rows['currencyType'] ;
                    $credit = $rows['credit'] ;
                    $debit = $rows['debit'] ;
                    $status = $rows['status'] ;
                    $description = $rows['description'] ;
                    $creationDate = $rows['creationDate'] ;
                    $activationDate = $rows['activationDate'] ;
                    $lastModifiedDate = $rows['lastModifiedDate'] ;
                    // echo $creationDate;
                    
                    
                   
                    if(isset($creationDate)){
                      $convertedCreationDate = $creationDate->format('Y-m-d');
                      }
                      else{
                        $convertedCreationDate = " ";
                      }
  

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
            ?>
                            <tr>
                                <td><?php echo $id?></td>
                                <td><?php echo $currencyType?></td>
                                <td><?php echo $credit?></td>
                                <td><?php echo $status?></td>
                                <td><?php echo $debit?></td>
                                <td><?php echo $description?></td>
                                <td><?php echo $convertedCreationDate?></td>
                                <td><?php echo $convertedActivationDate?></td>
                                <td><?php echo $convertedModificationDate?></td>
                              </tr>

                              <?php
                            }   

                          }
                          else{
                            //there is no data 
                            //display message 
                            ?>
                            <tr>
                              <td colspan="6"><div class="text-danger">not found</div></td>
                            </tr>

                            <?php 
                          }
                      }
                  
                  
                  ?>

                </table>
                    <a href="<?php echo  SITEURL; ?>manageAccounts.php" class="btn btn-secondary">Go Back</a>



            
        </div>
</div>

<?php include('partials/footer.php') ?>