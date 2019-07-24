
	<!-- create a user object to accesss a class and function -->

<?php 

			require_once('../classes/user.php');

			session_start();

			$user = new User();

			if(isset($_POST['signup'])){

				 $user->registration($_POST);
				
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
			
			<h1 class="text-warning">Register Here!</h1>
			<p class="text-white">Please fill the form to register yourself!</p>
		</div><br>
 
		<!-- To show Relevent Message -->



		 <?php 
            
            if(isset($_SESSION['message'])){
        ?>
        
        <div class="alert alert-<?php echo $_SESSION['msg_type']?> text-center">
            
            <?php 
            
                echo $_SESSION['message'];
                unset($_SESSION['message']);
            ?>
        </div>
        <?php } ?>


		 <!-- Signup form start from here -->


		<div class="card-body">
			<form class="form-group" method="POST">
				
				<label>First Name</label>
				<input type="text" name="fname" class="form-control" placeholder="Enter first name"><br>

				<label>Last Name</label>
				<input type="text" name="lname" class="form-control" placeholder="Enter last name"><br>

				<label>Email</label>
				<input type="text" name="email" class="form-control" placeholder="Enter email"><br>

				<label>Password</label>
				<input type="password" name="password" class="form-control" placeholder="Enter Password"><br>

				<input type="submit" name="signup" class="btn btn-success w-100" value="Sign up"><br><br>

				<a href="login.php" class="btn btn-info w-100">Login</a>


			</form>

			</div>

		<!-- Signup form end here -->

	</div>


</body>
</html>