<!DOCTYPE html>
<html>

<head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="style.css">
	<meta charset="utf-8">



	<title>To Mix</title>
</head>


<body>

	<?php

$serverName = "THANAA"; 
$uid = "";   
$pwd = "";  
$databaseName = "finalWall"; 

$connectionInfo = array( "UID"=>$uid,                            
                         "PWD"=>$pwd,                            
                         "Database"=>$databaseName,
						 "CharacterSet" => "UTF-8"); 

/* Connect using SQL Server Authentication. */  
$conn = sqlsrv_connect( $serverName, $connectionInfo);  



	if (isset($_POST['login'])) {
		$username = $_POST['username'];
		$password = $_POST['password'];

		
$tsql = "SELECT * FROM servicePoints WHERE username='$username'";  

/* Execute the query. */  

$stmt = sqlsrv_query( $conn, $tsql);  

if ( $stmt )  
{  
     echo "Statement executed.<br>\n";  
}   
else   
{  
     echo "Error in statement execution.\n";  
     die( print_r( sqlsrv_errors(), true));  
}  


while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_NUMERIC))  
{  
     echo "Col1: ".$row[0]."\n";  
     echo "Col2: ".$row[1]."\n";  
	 
     echo "Col2: ".$row[2]."\n";  
	 
     echo "Col2: ".$row[3]."\n"; 
     echo "----------------<br>\n";  
}  


}



	?>


	<div style="margin-top: 10%" class="container" id="container">

		<div class="form-container sign-in-container">
			<form action="#" method="Post">
				<h1>تسجيل الدخول </h1>

				<input type="name" name="username" placeholder="اسم المستخدم" />
				<input type="password" name="password" placeholder="كلمة المرور" />
				<a href="#"></a>
				<button name="login" style="margin-top: 15px;">تسجيل الدخول</button>

			</form>
		</div>
		<div class="overlay-container">
			<div class="overlay">
				<div class="overlay-panel overlay-left">
					<h1>مرحبا بعودتك!</h1>
					<p>للبقاء على اتصال معنا ، يرجى تسجيل الدخول باستخدام معلوماتك الشخصية</p>
					<button class="ghost" id="signIn">نقل</button>
				</div>
				<div class="overlay-panel overlay-right">
					<h1>مرحبا صديقي!</h1>
					<p>أدخل بياناتك الشخصية وابدأ التصفح</p>
					<button class="ghost" id="signUp">نقل</button>
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