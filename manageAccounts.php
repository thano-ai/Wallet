<?php include('partials/menu.php') ?>

<div class="container">
<div style="width:90%" class="wrapper">
               <h1>Manage Accounts</h1>

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
                      <th>Client</th>
                      <th>Type</th>
                      <th>Status</th>
                      <th>Creation Date</th>
                      <th>Activation Date</th>
                      <th>Last Modifided</th>
                      <th>Process</th>
                      
                  </tr>

                  <?php

$sql = "SELECT * FROM clients ";
$res = sqlsrv_query($con,$sql) ;

if($res==true){
      $count = sqlsrv_has_rows($res) ;
    if($count>0){
      // we have data in db
      while($row = sqlsrv_fetch_array($res)){
        // get the data 
        $clientsArray[$row[0]] = $row[1] . " " . $row[4];
       
        // 145555=> Mohammed hasan and so on

      }
  }}

                      // display from database
                      $sql = "SELECT * from accounts" ;
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
                              $dbClientId = $rows['clientId'] ;
                              
                              foreach ($clientsArray as $ClientId => $clientName) {
                                if($ClientId==$dbClientId){
                                   $fullName = $clientName;
                                }}



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
                              // display in the table 
                              ?>

                              <tr>
                                <td><?php echo $id?></td>
                                <td><?php echo $fullName?></td>
                                <td><?php echo $type?></td>
                                <td><?php echo $statusMessage?></td>
                                <td><?php echo $convertedCreationDate?></td>
                                <td><?php echo $convertedActivationDate?></td>
                                <td><?php echo $convertedModificationDate?></td>
                                <!-- <td><?php echo $clientId?></td> -->
                                <td>   
                                <a href="showAccountDetails.php?AccountId=<?php echo $id; ?>" class="btn btn-info">Show Details</a>
                               
                               
                               <?php
                                if($status==1){
                                        echo " <a href='changeAccountStatus.php?AccountId=$id&status=0' class='btn btn-danger'>Disactivate</a>";
                                  
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
        </div>
</div>

<?php include('partials/footer.php') ?>