
<?php 
	
	session_start();

	if(!isset($_SESSION['email'])){

			header('location: login.php');
		}

	require_once('../classes/user.php');
			
	
	$user = new User();


	if(isset($_POST['logout'])){

		$user->logout($_POST);

		header('location: login.php');
	}

	if(isset($_POST['search'])){


		$getuser = $user->search($_SESSION['id'],$_POST);
	

	}

		/*This variable store all interested languages for the current user*/

	$getlang =$user->showInterestedLanguages($_SESSION['id']);
	

 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Home</title>

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</head>
<body>

	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
	  <a class="navbar-brand" href="#">Dashboard</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>


	  <div class="collapse navbar-collapse" id="navbarSupportedContent">
	    <ul class="navbar-nav mr-auto">
	     
	    </ul>

	 
	    <form class="form-inline my-2 my-lg-0" method="post">

	      <a class="btn btn-outline-info mx-0 my-sm-0 float-left" href="password.php">Change Password</a>

	      <a class="btn btn-outline-info mx-2 my-sm-0" href="update.php">Update Profile</a>

		  <select class="selectpicker btn btn-outline-light mx-0" data-width="fit" name="lang[]" multiple="">
			
			<?php while($row = $getlang->fetch_assoc()):; ?>
		    <option value="<?php echo $row['lang_id']; ?>">
			 
			   <?php echo $row['name']; ?>
			    <?php endwhile ?>
		    </option>

		  </select>

	       <button class="btn btn-outline-primary mx-2 my-sm-1" type="submit" name="search">Search</button> 

	      <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="logout">Logout</button>
	      
	    </form>
	  </div>
	</nav><br><br><br><br><br>

	<div class="container text-center">
			
			<h1 class="font-weight-bold">Welcome to Home</h1>
			<p class="text-success">
				
			<?php if(isset($_SESSION['email'])) {?>

				You are logged in as <mark class="font-weight-bold text-success">
				<?php echo $_SESSION['email']; ?></mark></p>
			<?php }?>

	</div><br>

		<?php if(isset($_POST['search'])) { ?>

		<div class="container text-center col-lg-6 col-md-6 col-12">
			
			<div class="card-header text-center bg-dark">
			
			<h1 class="text-warning">Recommended Users</h1>

			</div><br>
		
			<table class="table table-striped table-bordered">
				<thead class="bg-dark">
					<tr class="text-white">
						<th>First Name</th>
						<th>Last Name</th>
						<th>Interested Languages</th>
					</tr>
				</thead>

				<?php foreach ($getuser as $value) {?>
				
				<?php  while($row = $value->fetch_assoc()) { ?>
				<tr>
					<td><?php echo $row ['fname']; ?></td>
					<td><?php echo $row ['lname']; ?></td>
					<td><?php echo $row ['name']; ?></td>
				</tr>
			<?php }}} ?>
			
			</table>


			<?php 

	
            
            if(isset($_SESSION['message'])){
        ?>
        
        <div class="alert alert-<?php echo $_SESSION['msg_type']?>">
            
            <?php 
            
                echo $_SESSION['message'];
                unset($_SESSION['message']);
            ?>
        </div>
        <?php } ?>

	

	</div>

</body>
</html>