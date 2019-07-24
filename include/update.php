<?php 

require_once('../classes/user.php');

	session_start();

	if(!isset($_SESSION['email'])){

			header('location: login.php');
		}

	$user = new User();
 	

 	if(isset($_POST['profile'])){


		$user->updateprofile($_POST);
		
		$user->interested_lang($_POST); 

	}

	/* create a variable to store function data*/

	$user1 = $user->getUserData($_SESSION['id']);

	$getlang =$user->showLanguages();
	$get_ilang = $user->showLanguages();
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
			
			<h1 class="text-warning">Profile</h1>
		</div><br>


		<?php if(isset($_SESSION['message'])){ ?>

			<div class="alert alert-<?php echo $_SESSION['msg_type'] ?> ">
				
				<?php 

					echo $_SESSION['message'];
					unset($_SESSION['message']);
				 

				 ?>

			</div>
		<?php } ?>

	
		 <!-- Change Password form start from here -->

		<div class="card-body">
			<form class="form-group" method="POST" >

				<label>First Name</label>
				<input required type="text" name="fname" class="form-control" value="<?php echo $user1['fname'] ?>" >
				<br>

				<label>Last Name</label>
				<input required type="text" name="lname" class="form-control" value="<?php echo $user1['lname']?>"><br>

				<label>Email</label>
				<input required type="text" name="email" class="form-control" value="<?php echo $user1['email']?>"><br>

				 <label>Languages</label>
			    <select class="form-control" name="language" >
			    	<?php while($row = $getlang->fetch_assoc()):; ?>
			      <option value="<?php echo $row['lang_id']; ?>">
			      	<?php echo $row['name']; ?>
			      	<?php endwhile ?>
			      </option>
			    </select><br>

			    <label>Interested Languages</label>
			    <select class="form-control" name="interested[]" multiple required>
			      <?php while($row = $get_ilang->fetch_assoc()):; ?>
			      <option value="<?php echo $row['lang_id']; ?>" >
			      	<?php echo $row['name'];?>
			      	<?php endwhile ?>
			      </option>
			    </select><br>
				
				<input type="submit" name="profile" class="btn btn-success w-100" value="Update Profile"><br><br>

				<a href="index.php" class="btn btn-info w-100">Home</a>

			


			</form>

			</div>


	</div>

</body>
</html>