<?php include('partials/menu.php') ?>


<div class="container">
        <div class="wrapper">
               <h1>Manage Admins</h1>
               <br> <br>
               <?php
               if(isset($_SESSION['add'])){
                echo '<script type="text/javascript">
                swal("", "Admin Added Successfully", "success");
                </script>';
                  unset($_SESSION['add']) ; //display just one time 
               }

               if(isset($_SESSION['not-add'])){
                echo '<script type="text/javascript">
						swal("", "Failed to Add Admin", "error");
						</script>'; 
                unset($_SESSION['not-add']) ; //display just one time 
             }
               
               if(isset($_SESSION['disactive'])){
                echo '<script type="text/javascript">
                swal("", "Successfull", "success");
                </script>';
                  unset($_SESSION['disactive']) ; //display just one time 
               }
               
               if(isset($_SESSION['update'])){
                echo '<script type="text/javascript">
                swal("", "Admin Updated Successfully", "success");
                </script>';
                  unset($_SESSION['update']) ; //display just one time 
               }

               if(isset($_SESSION['not-update'])){
                echo '<script type="text/javascript">
						swal("", "Failed to Update Admin", "error");
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

               ?>

               <!-- button to add admin -->
               <a style="background-color:#278abd ;" href="<?php echo  SITEURL; ?>addAdmin.php" class="btn btn-primary">Add Admin</a>
               <br> <br> 

               <table class="table table-hover">
                  <tr class="table-active">
                      <th>ID</th>
                      <th>Name</th>
                      <th>Status</th>
                      <th>Creation Date</th>
                      <th>Username</th>
                      
                      <th>Process</th>
                      
                  </tr>

                  <?php
                      // display from database
                      $sql = "SELECT * from admins" ;
                      $res = sqlsrv_query($con,$sql) ;

                      if($res==true){
                            $count = sqlsrv_has_rows($res) ;
                          $sn=1;
                          if($count>0){
                            // we have data in db
                            while($rows = sqlsrv_fetch_array($res)){
                              // get the data 
                              $id = $rows['id'] ; 
                              $name = $rows['name'] ;
                              $creationDate = $rows['creationDate'] ;
                              $username = $rows['username'] ;
                              $status = $rows['status'] ;
                              
                              // $convertedDate = $joinDate->format('Y-m-d ');
                              // $convertedDate2 = $modifiedDate->format('Y-m-d ');
                              if($status ==0){
                                 $statusMessage ="Disactive";
                               }
 
                               else{
                                 $statusMessage ="Active";
                               }

                               if(isset($creationDate)){
                                 $convertedCreationDate = $creationDate->format('Y-m-d');
                                 }
                                 else{
                                   $convertedCreationDate = " ";
                                 }
   

                              // display in the table 
                              ?>

                              <tr >
                                <td><?php echo $sn++?></td>
                                <td><?php echo $name?></td>
                                <td><?php echo $statusMessage?></td>
                                <td><?php echo $convertedCreationDate?></td>
                                <td><?php echo $username?></td>
                                
                                <td>   
                                <a  href="<?php echo  SITEURL; ?>Admin-changePassword.php?id=<?php echo $id; ?>" class="btn btn-info" >change PW</a>
                                    <a href="<?php echo  SITEURL; ?>updateAdmin.php?id=<?php echo $id; ?>" class="btn btn-warning">Update</a> 
                                    <?php
                                if($status==1){
                                        echo " <a href='changeAdminStatus.php?id=$id&status=0' class='btn btn-danger'>Disactivate</a>";
                                  
                                }

                                else{
                                        echo " <a href='changeAdminStatus.php?id=$id&status=1' style='padding: 6px 4%' class='btn btn-success'>Activate</a>";
                                    
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
                              <td colspan="6"><div class="text-danger">No Admin Added</div></td>
                            </tr>

                            <?php 
                          }
                      }
                  
                  
                  ?>

                 
               </table>

               
            </div>
        </div>

<?php include('partials/footer.php') ?>