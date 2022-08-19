<?php include('partials/menu.php') ?>


<div class="container">
        <div style="width:90% ;" class="wrapper">
               <h1>Manage Service Points</h1>
               <br> <br>
               <?php
               if(isset($_SESSION['add'])){
                  echo $_SESSION['add'] ;
                  unset($_SESSION['add']) ; //display just one time 
               }
               if(isset($_SESSION['delete'])){
                  echo $_SESSION['delete'] ;
                  unset($_SESSION['delete']) ; //display just one time 
               }
               if(isset($_SESSION['update'])){
                  echo $_SESSION['update'] ;
                  unset($_SESSION['update']) ; //display just one time 
               }
               if(isset($_SESSION['noUser'])){
                  echo $_SESSION['noUser'] ;
                  unset($_SESSION['noUser']) ; //display just one time 
               }
               if(isset($_SESSION['change'])){
                  echo $_SESSION['change'] ;
                  unset($_SESSION['change']) ; //display just one time 
               }
               if(isset($_SESSION['noMatch'])){
                  echo $_SESSION['noMatch'] ;
                  unset($_SESSION['noMatch']) ; //display just one time 
               }

               if(isset($_SESSION['no-admin-found'])){
                  echo $_SESSION['no-admin-found'] ;
                  unset($_SESSION['no-admin-found']) ; //display just one time 
               }


               ?>
               <!-- <br><br> -->

               <!-- button to add admin -->
               <a style="background-color:#1565C0FF ;" href="<?php echo  SITEURL; ?>addServicePoint.php" class="btn btn-primary">Add Service Point</a>
               <br> <br> 

               <table class="table table-hover">
                  <tr class="table-active">
                      <th>ID</th>
                      <th>Name</th>
                      <th>Phone</th>
                      <th>Email</th>
                      <th>Address</th>
                      <th>Join Date</th>
                      <th>Username</th>
                      
                      <th>Process</th>
                      
                  </tr>

                  <?php
                      // display from database
                      $sql = "SELECT * from servicePoints" ;
                      $res = sqlsrv_query($con,$sql) ;

                      if($res==true){
                            $count = sqlsrv_has_rows($res) ;
                          $sn=1;
                          if($count>0){
                            // we have data in db
                            while($rows = sqlsrv_fetch_array($res)){
                              // get the data 
                              $id = $rows['ServicePointId'] ; 
                              $name = $rows['Name'] ;
                              $phone = $rows['phone'] ;
                              $email = $rows['email'] ;
                              $Address = $rows['Address'] ;
                              $joinDate = $rows['JoinDate'] ;
                              $username = $rows['username'] ;
                              
                              $convertedDate = $joinDate->format('Y-m-d ');

                              // display in the table 
                              ?>

                              <tr >
                                <td><?php echo $sn++?></td>
                                <td><?php echo $name?></td>
                                <td><?php echo $phone?></td>
                                <td><?php echo $email?></td>
                                <td><?php echo $Address?></td>
                                <td><?php echo $convertedDate?></td>
                                <td><?php echo $username?></td>
                                
                                <td>   
                                <a  href="<?php echo  SITEURL; ?>ServicePoint-changePassword.php?ServicePointId=<?php echo $id; ?>" class="btn btn-info" role="group">change password</a>
                                    <a href="<?php echo  SITEURL; ?>updateServicePoint.php?ServicePointId=<?php echo $id; ?>" class="btn btn-warning" role="group">Update</a> 
                                    <a href="<?php echo  SITEURL; ?>deleteServicePoint.php?ServicePointId=<?php echo $id; ?>" class="btn btn-danger" role="group">Delete</a> 
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
                              <td colspan="6"><div class="text-danger">No Service Point Added</div></td>
                            </tr>

                            <?php 
                          }
                      }
                  
                  
                  ?>

                 
               </table>

               
            </div>
        </div>

<?php include('partials/footer.php') ?>