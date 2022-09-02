<?php include('partials/menu.php') ?>

<div class="container">
        <div class="wrapper">
               <h1>Manage Commissions</h1>
               <br> <br>
               <?php
 
 if(isset($_SESSION['update'])){
  echo '<script type="text/javascript">
  swal("", "Commission Updated Successfully", "success");
  </script>';
    unset($_SESSION['update']) ; //display just one time 
 }

 if(isset($_SESSION['not-update'])){
  echo '<script type="text/javascript">
swal("", "Failed to Update Commission", "error");
</script>';
  unset($_SESSION['not-update']) ; //display just one time 
}

               ?>
               <br>

               <table class="table table-hover">
                  <tr class="table-active">
                      <th>ID</th>
                      <th>Account</th>
                      <th>Name</th>
                      <th>Currency</th>
                      <th>YemenMobile</th>
                      <th>Electricity</th>
                      <th>Phone</th>

                      <th>Process</th>
                      
                  </tr>

                  <?php
                      // display from database
                      $sql = "SELECT * from Comission" ;
                      $res = sqlsrv_query($con,$sql) ;

                      if($res==true){
                            $count = sqlsrv_has_rows($res) ;
                            $sn=1;
                          if($count>0){
                            // we have data in db
                            while($rows = sqlsrv_fetch_array($res)){
                              // get the data 
                              
                              $id = $rows['comissionId'] ; 
                              $TransactionId = $rows['Transactionsid'] ;
                              $comissionsForAccount = $rows['comissionsForAccount'] ;
                              $comissionsForName = $rows['comissionsForName'] ;
                              $comissionsForCurrency = $rows['comissionsForCurrency'] ;
                              $comissionsForYemenMooblie = $rows['comissionsForYemenMooblie'] ;
                              $comissionsForElectricity = $rows['comissionsForElectricity'] ;
                              $comissionsForPhone = $rows['comissionsForPhone'] ;

                              // display in the table 
                              ?>

                              <tr>
                                <td><?php echo $sn++?></td>
                                <td><?php echo $comissionsForAccount?></td>
                                <td><?php echo $comissionsForName?></td>
                                <td><?php echo $comissionsForCurrency?></td>
                                <td><?php echo $comissionsForYemenMooblie?></td>
                                <td><?php echo $comissionsForElectricity?></td>
                                <td><?php echo $comissionsForElectricity?></td>
                                
                                
                                <td>   
                                    <!-- <a href="<?php echo  SITEURL; ?>updateCommission.php?id=<?php echo $id; ?>" class="btn btn-warning">Update</a>  -->
                                    <?Php
                                      echo "<a href='updateCommission.php?comissionId=$id&Transactionsid=$TransactionId' class='btn btn-warning'>Update</a>"
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
                              <td colspan="6"><div class="text-danger">No Transaction Added</div></td>
                            </tr>

                            <?php 
                          }

                        }
                  
                  
                  ?>

                 
               </table>
        </div>
</div>

<?php include('partials/footer.php') ?>