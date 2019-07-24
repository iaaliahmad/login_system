
<?php 
	session_start();

		if(!isset($_SESSION['email'])){

			header('location: login.php');
		}

	require_once('../classes/user.php');

	
	$user= new User();

	if(isset($_POST['update'])){

		$user->password($_POST);

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
			
			<h1 class="text-warning">Change Password</h1>
		</div><br>

		<!-- To show Relevent Message -->

		<!-- <?php 

			// if(isset($_SESSION['invalid_pass'])){

			// 	echo '<div class="alert alert-danger">';
			// 	echo $_SESSION['invalid_pass'];
			// 	echo '</div>';
			// 	unset($_SESSION['invalid_pass']);
			// }

			// if(isset($_SESSION['success'])){

			// 	echo '<div class="alert alert-success">';
			// 	echo $_SESSION['success'];
			// 	echo '</div>';
			// 	unset($_SESSION['success']);
			// }

			// 	if(isset($_SESSION['not_match'])){

			// 	echo '<div class="alert alert-warning">';
			// 	echo $_SESSION['not_match'];
			// 	echo '</div>';
			// 	unset($_SESSION['not_match']);
			// }
		 ?> -->

		 <?php if(isset($_SESSION['message'])) { ?>

		 	<div class="alert alert-<?php echo $_SESSION['msg_type']?> text-center">
		 		
		 		<?php 

		 			echo $_SESSION['message'];
		 			unset($_SESSION['message']);
		 		 ?>

		 	</div>
		 <?php } ?>


		 <!-- Change Password form start from here -->

		<div class="card-body">
			<form class="form-group" method="POST" >

				<label>Current Password</label>
				<input required type="password" name="current_pass" class="form-control" ><br>

				<label>New Password</label>
				<input required type="password" name="new_pass" class="form-control"><br>

				<label>Re-Enter New Password</label>
				<input required type="password" name="re_pass" class="form-control"><br>

				<input type="submit" name="update" class="btn btn-success w-100" value="Reset Password"><br><br>

				<a href="index.php" class="btn btn-info w-100">Home</a>

			


			</form>

			</div>


	</div>

</body>
</html>