<?php 

	require_once('../classes/user.php');

	session_start();

	$user = new User();
 
 	if(isset($_POST['login'])){


		$user->login($_POST);


	}		

 ?>


<!DOCTYPE html>
<html>
<head>
	<title>User Authentication</title>


  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</head><br>
<body>

	<div class="card container col-lg-6 col-md-6 col-12">
		
		<div class="card-header text-center bg-dark">
			
			<h1 class="text-warning">Login</h1>
		</div><br>

		<!-- To show Relevent Message -->

	<!-- 	<?php 

			// if(isset($_SESSION['login'])){

			// 	echo '<div class="alert alert-danger">';
			// 	echo $_SESSION['login'];
			// 	echo '</div>';
			// 	unset($_SESSION['login']);
			// }



		 ?> -->

		 <?php if(isset($_SESSION['message'])){ ?>

		 	<div class="alert alert-<?php echo $_SESSION['msg_type'] ?>">
		 		
		 		<?php 

		 			echo $_SESSION['message'];
		 			unset($_SESSION['message']);
		 		 ?>

		 	</div>
		 <?php } ?>


		 <!-- Login form start from here -->

		<div class="card-body">
			<form class="form-group" method="POST" >

				<label>Email</label>
				<input required type="text" name="email" class="form-control" placeholder="Enter email" 
				value="<?php if(isset($_COOKIE["email"])) { echo $_COOKIE["email"]; } ?>"><br>

				<label>Password</label>
				<input required type="password" name="password" class="form-control" placeholder="Enter Password" value=<?php if(isset($_COOKIE["password"])) { echo $_COOKIE["password"]; } ?>><br>

				<label>Remember me</label>
				<input type="checkbox" name="remember" checked="checked">

				<a href="forget.php" class="text-info float-right">Forget Password</a><br><br>

				<input type="submit" name="login" class="btn btn-success w-100" value="Login"><br><br>

				<a href="signup.php" class="btn btn-info w-100">Register New User</a>


			</form>

			</div>


	</div>


</body>
</html>