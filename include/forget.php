
<?php 

	require_once('../classes/user.php');

	session_start();

	$user = new User();


	if(isset($_POST['forget'])){

		$user->forgetpass($_POST);
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

</head><br><br>
<body>


	<div class="card container col-lg-6 col-md-6 col-12">
		
		<div class="card-header text-center bg-dark">
			
			<h1 class="text-warning">Forget Password</h1>
		</div><br>

		<!-- To show Relevent Message -->

		<?php 

			if(isset($_SESSION['sent'])){

				echo '<div class="alert alert-success">';
				echo $_SESSION['sent'];
				echo '</div>';
				unset($_SESSION['sent']);

			}

			if(isset($_SESSION['sent_err'])){

				echo '<div class= "alert alert-danger">';
				echo $_SESSION['sent_err'];
				echo '</div>';
				unset($_SESSION['sent_err']);

			}

		 ?>

		 <!-- Forget Form start from here -->

		<div class="card-body">
			<form class="form-group" method="POST">

				<label>Email</label>
				<input required type="text" name="email" class="form-control" ><br>

				<input type="submit" name="forget" class="btn btn-success w-100" value="Send"><br><br>

				<a href="login.php" class="btn btn-info w-100">Login</a>


			</form>

			</div>


	</div>

</body>
</html>