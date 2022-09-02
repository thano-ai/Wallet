<?php include('partials/menu.php') ?>


<div class="container">
        <div class="wrapper">
               <h1>Manage Service Points</h1>
               <br> <br>
               <?php
               if(isset($_SESSION['add'])){
                echo '<script type="text/javascript">
                swal("", "Service Point Added Successfully", "success");
                </script>';
                  unset($_SESSION['add']) ; //display just one time 
               }

               if(isset($_SESSION['not-add'])){
                echo '<script type="text/javascript">
						swal("", "Failed to Add Service Point", "error");
						</script>'; 
                unset($_SESSION['not-add']) ; //display just one time 
             }
               
               if(isset($_SESSION['disactive'])){
                echo '<script type="text/javascript">
                swal("", "Successfull", "success");
                </script>';
                  unset($_SESSION['disactive']) ; //display just one time 
               }
               if(isset($_SESSION['exist'])){
                echo '<script type="text/javascript">
            swal("", "Service Point already exist", "error");
            </script>'; 
                unset($_SESSION['exist']) ; //display just one time 
             }
               // if(isset($_SESSION['delete'])){
               //    echo $_SESSION['delete'] ;
               //    unset($_SESSION['delete']) ; //display just one time 
               // }
               if(isset($_SESSION['update'])){
                echo '<script type="text/javascript">
                swal("", "Service Point Updated Successfully", "success");
                </script>';
                  unset($_SESSION['update']) ; //display just one time 
               }
              
               if(isset($_SESSION['not-update'])){
                echo '<script type="text/javascript">
              swal("", "Failed to Update Service Point", "error");
              </script>';
                unset($_SESSION['not-update']) ; //display just one time 
              }
               if(isset($_SESSION['noUser'])){
                echo '<script type="text/javascript">
                swal("", "user not found", "error");
                </script>';
                  unset($_SESSION['noUser']) ; //display just one time 
               }
               if(isset($_SESSION['change'])){
                echo '<script type="text/javascript">
                swal("", "password changed successfully", "success");
                </script>';
                unset($_SESSION['change']) ; //display just one time
               }
                if(isset($_SESSION['no-change'])){
                  echo '<script type="text/javascript">
                  swal("", "failed to change password", "error");
                  </script>';
                  unset($_SESSION['change']) ; //display just one time 
               }
               if(isset($_SESSION['noMatch'])){
                echo '<script type="text/javascript">
                swal("", "password dont mache", "error");
                </script>';
                  unset($_SESSION['noMatch']) ; //display just one time 
               }

              //  if(isset($_SESSION['no-admin-found'])){
              //     echo $_SESSION['no-admin-found'] ;
              //     unset($_SESSION['no-admin-found']) ; //display just one time 
              //  }


               ?>

               <!-- button to add admin -->
               <a style="background-color:#278abd ;" href="<?php echo  SITEURL; ?>addServicePoint.php" class="btn btn-primary">Add Service Point</a>
               <br> <br> 

               <table class="table table-hover">
                  <tr class="table-active">
                      <th>ID</th>
                      <th>Name</th>
                      <th>Phone</th>
                      <th>Email</th>
                      <th>Address</th>
                      <th>Status</th>
                      <th>Join Date</th>
                      <th>Last Modifiation</th>
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
                              $name = $rows['fullName'] ;
                              $phone = $rows['phone'] ;
                              $email = $rows['email'] ;
                              $Address = $rows['address'] ;
                              $joinDate = $rows['joinDate'] ;
                              $username = $rows['username'] ;
                              $modifiedDate = $rows['modifiedDate'] ;
                              $status = $rows['status'] ;
                              
                              // $convertedDate = $joinDate->format('Y-m-d ');
                              // $convertedDate2 = $modifiedDate->format('Y-m-d ');
                              if($status ==0){
                                 $statusMessage ="Disactive";
                               }
 
                               else{
                                 $statusMessage ="Active";
                               }

                               if(isset($joinDate)){
                                 $convertedJoinDate = $joinDate->format('Y-m-d');
                                 }
                                 else{
                                   $convertedJoinDate = " ";
                                 }
   
                                 if(isset($modifiedDate)){
                                   $convertedModifitionDate = $modifiedDate->format('Y-m-d');
                                 }
                                   else{
                                     $convertedModifitionDate = " ";
                                   }

                              // display in the table 
                              ?>

                              <tr >
                                <td><?php echo $sn++?></td>
                                <td><?php echo $name?></td>
                                <td><?php echo $phone?></td>
                                <td><?php echo $email?></td>
                                <td><?php echo $Address?></td>
                                <td><?php echo $statusMessage?></td>
                                <td><?php echo $convertedJoinDate?></td>
                                <td><?php echo $convertedModifitionDate?></td>
                                <td><?php echo $username?></td>
                                
                                <td>   
                                <a  href="<?php echo  SITEURL; ?>ServicePoint-changePassword.php?ServicePointId=<?php echo $id; ?>" class="btn btn-info" >change PW</a>
                                    <a href="<?php echo  SITEURL; ?>updateServicePoint.php?ServicePointId=<?php echo $id; ?>" class="btn btn-warning">Update</a> 
                                    <?php
                                if($status==1){
                                        echo " <a href='changeServicePointStatus.php?ServicePointId=$id&status=0' class='btn btn-danger'>Disactivate</a>";
                                  
                                }

                                else{
                                        echo " <a href='changeServicePointStatus.php?ServicePointId=$id&status=1' style='padding: 6px 7%' class='btn btn-success'>Activate</a>";
                                    
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