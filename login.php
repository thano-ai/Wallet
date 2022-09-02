<?php include('./config/constants.php') ?>


<!DOCTYPE html>
<html>

<head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="style.css">
	<meta charset="utf-8">
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


	<title>Login</title>
</head>


<body>

	<?php
	
if(isset($_COOKIE['agent'])){
	unset($_COOKIE);
	setcookie('user',NULL,time()-186400,'/');
  }
  
if(isset($_SESSION['admin_id'])){
	unset($_SESSION['admin_id']) ; //display just one time 
  
  }

  
if(isset($_SESSION['agent_id'])){
	unset($_SESSION['agent_id']) ; //display just one time 
  }
if(isset($_SESSION['super'])){
	unset($_SESSION['super']) ; //display just one time 
  }




	if (isset($_POST['login'])) {
		$username = $_POST['username'];
		$password = $_POST['password'];
		

         $sql ="SELECT * FROM admins WHERE username='$username' AND password='$password'";
		 $res = sqlsrv_query($con , $sql) ;

		if($res){
			$rows = sqlsrv_has_rows( $res );
			if ($rows == true){

			   while($row = sqlsrv_fetch_array($res)){
				   // get the data 
				   $id =$row['id'];
				   
				   $permission =$row['permission'];
				   echo $id;
				   setcookie('admin',$id,time()+1886400,'/');
				   $_SESSION['admin_id'] = $id;

				   if($permission==1){
					$_SESSION['super'] =true;
				   }

   
				 }
				 
				 
			   $_SESSION['login'] ="<div class='success'>Login Successfull</div>";
			   $_SESSION['user'] = $username;
			   
			   $_SESSION['admin_id'] = $id;

			   //RETURN TO index.php PAGE 
			   header("location:index.php") ;
	   
		   }
		}
		else{
	
		//2 sql to check the username and password
	
  		
		$tsql = "SELECT * FROM servicePoints WHERE username='$username' AND password='$password' ";  

		/* Execute the query. */  
		
		$stmt = sqlsrv_query( $con, $tsql);  
		
		if ( $stmt )  
		{  
			 $rows = sqlsrv_has_rows( $stmt );
			 if ($rows == true){

				while($row = sqlsrv_fetch_array($stmt)){
					// get the data 
					$id =$row['ServicePointId'];
					echo $id;
					setcookie('agent',$id,time()+1886400,'/');
					$_SESSION['agent_id'] = $id;

	
				  }
				

				  
				$_SESSION['login'] ="<div class='success'>Login Successfull</div>";
				$_SESSION['user'] = $username;
				
				$_SESSION['agent_id'] = $id;

				//RETURN TO index.php PAGE 
				header("location:agent/index.php") ;
		
			}else {
				
				
				$_SESSION['login'] ="<div class='error text-center'>username or password did not match</div>";
				header("location:login.php") ;
		
			}   }
		else   
		{  
			 echo "Error in statement execution.\n";  
			 die( print_r( sqlsrv_errors(), true));  
		}  


	}
}











	?>


	<div style="margin-top: 10%" class="container" id="container">

		<div class="form-container sign-in-container">
			<form action="#" method="Post">
				<h1>Login</h1>
				<?php

        if(isset($_SESSION['login'])){
            echo $_SESSION['login'] ;
            unset($_SESSION['login']) ; //display just one time 
        }
        if(isset($_SESSION['nologin-message'])){
            echo $_SESSION['nologin-message'] ;
            unset($_SESSION['nologin-message']) ; //display just one time 
        }
      
      ?>

				<input type="name" name="username" placeholder="Enter username" />
				<input type="password" name="password" placeholder="Enter password" />
				<a href="#"></a>
				<button name="login" style="background-color:#278abd ;" style="margin-top: 15px;">Login</button>

			</form>
		</div>
		<div class="overlay-container">
			<div class="overlay">
				<div class="overlay-panel overlay-left" >
					<h1>Welcome Back</h1>
					<!-- <p>للبقاء على اتصال معنا ، يرجى تسجيل الدخول باستخدام معلوماتك الشخصية</p> -->
					<button class="ghost" id="signIn">نقل</button>
				</div>
				<div class="overlay-panel overlay-right" style="background-color:#278abd ;">
				<h1>Welcome</h1>
					<p>YCb Wallet Admin Panel , enter your data and start working!</p>
				</div>
			</div>
		</div>
	</div>











	<script>
		const signUpButton = document.getElementById('signUp');
		const signInButton = document.getElementById('signIn');
		const container = document.getElementById('container');

		signUpButton.addEventListener('click', () => {
			container.classList.add("right-panel-active");
		});

		signInButton.addEventListener('click', () => {
			container.classList.remove("right-panel-active");
		});
	</script>
</body>

</html>