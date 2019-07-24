<?php 

require_once ('dbconnection.php');


class User extends dbconnection{
 

	/******************************************* 
	  
	  to access the constructor of parent class

	 *******************************************/
	public function __construct(){

		parent::__construct();
	}

	/******************************************* 
	  
	  	Function to register the new user

	 *******************************************/

	public function registration($data){
       



       // restrict if fields are empty
       
		if($data['fname']=="" || $data['lname']=="" || $data['email']=="" || $data['password']==""){

			$_SESSION['message'] = "Please fill out these fields";
			$_SESSION['msg_type'] = "danger";

		 	// validata the email format

		}elseif(!preg_match("/^[a-zA-Z ]*$/",$data['fname'])) {

			  $_SESSION['message'] = "Only letters and white space allowed for names";
			  $_SESSION['msg_type'] = "warning";
 
			}

		elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)){

			$_SESSION['message'] = "Email Format is not valid";
			 $_SESSION['msg_type'] = "danger";
 

		}elseif(strlen($data['password'])<8){

			$_SESSION['message'] = "Password must contain 8 letters";
			 $_SESSION['msg_type'] = "danger";
 

		}elseif(!preg_match("/^[a-zA-Z0-9%@#$]+$/", $data['password'])){

			$_SESSION['message'] = "Password must contain special characters";
			 $_SESSION['msg_type'] = "info";
 

		}
		else{
        
               	// check the email if already exit in database

		$q = "SELECT * FROM user_table WHERE email='$data[email]'";
		
		$result = $this->connection->query($q);

		if($result->num_rows > 0){

			$_SESSION['message'] = "Email already exist";
			 $_SESSION['msg_type'] = "danger";
 
			return; 

		}
	    else{


		// Insert data in database using mysqli query

		$q = "INSERT INTO user_table (fname, lname, email, password ) VALUES('$data[fname]', '$data[lname]', '$data[email]', '$data[password]') ";

		$result = $this->connection->query($q);

		if($result){

			$_SESSION['message'] = "Registered Successfuly";
			 $_SESSION['msg_type'] = "success";
 
		}

		

	}

	}
}
 
 	/******************************************* 
	  			
	  			Function to Sign in

	 *******************************************/
	
 public function login($data){



		$q = "SELECT * FROM user_table WHERE email='$data[email]' AND password='$data[password]'";

		$result = $this->connection->query($q);

		if($result->num_rows>0){

			/* To get ID of current user from database*/

			$row = mysqli_fetch_assoc($result);

             $_SESSION['id'] = $row['id'];
             
			 if ($result) {

			 	if(!empty($data['remember'])){


			 		setcookie("email", $data['email'], time()+3600);
			 		setcookie("password", $data['password'], time()+3600);

			 	}else{


			 		setcookie("email","");
					setcookie("password","");
			 	}
                    
                 	$_SESSION['email'] =$data['email'];   
                    header("Location: index.php");   
                   
            }
		}else{

            	$_SESSION['message'] = "Please enter valid email or password";
            	$_SESSION['msg_type'] = "danger";
  
            }

	}

	/******************************************* 
	 		
	 		Function to logout the user

	 *******************************************/

	 public  function logout() {  
        
        session_destroy();  
    } 


    /******************************************* 
	  		
	  		Function to Reset Password

	 *******************************************/

    public function password($data){


    	$q = "SELECT password FROM user_table WHERE password='$data[current_pass]'";

    	$result = $this->connection->query($q);

    	 // check if current password is correct

    	if($result->num_rows >0){

 
    		$id = $_SESSION['id'];

	   		if($data['new_pass']==$data['re_pass'])
	   		{

	   			if(strlen($data['new_pass'])<8){

				$_SESSION['message'] = "Password must contain 8 letters";
				 $_SESSION['msg_type'] = "danger";
				}else{

	    		$q="UPDATE user_table SET password='$data[new_pass]' WHERE id='$id'";

	    		$result = $this->connection->query($q);

	    		$_SESSION['message'] = "Successfully changed";
	    		$_SESSION['msg_type'] = "success";

		    	}
	 

	    	}
	    	else
	    	{

	    		$_SESSION['message'] = "New password does not match";
	    		$_SESSION['msg_type'] = "warning";
 
	    	}
	    }
	    else
	    {

	    	$_SESSION['message']= "Invalid current password";
	    	$_SESSION['msg_type'] = "danger";
 
	    }
     }
    

     /******************************************* 
	  		
	  		Function to Forget Password

	 *******************************************/

     public function forgetpass($data){


     		$q = "SELECT * FROM user_table WHERE email='$data[email]'";


     		$result = $this->connection->query($q);

     		if($result->num_rows>0){

      			/* to access the email and password from database */

     			$r = $result->fetch_assoc();
				$password = $r['password'];
				$to = $r['email'];
				$subject = "Your Recovered Password";

				$message = "Please use this password to login " . $password;
				$headers = "From : ali.ahmad@sixlogics.com";

				if(mail($to, $subject, $message, $headers)){

     			$_SESSION['sent'] = "Password sent to email";

     		}
     	}
     		else{

     			$_SESSION['sent_err'] = "Email does not exist";
     		}

     
 }

 	/******************************************* 
	  		
	    Function to Update the user profile 

	 *******************************************/


 	public function updateprofile($data){

 		$id = $_SESSION['id'];

 		$language= $_REQUEST['language'];

 		/*$q =  "SELECT * FROM user_table WHERE id='$id' ";
		$result = $this->connection->query($q);*/


		$q = "UPDATE user_table SET fname= '$data[fname]' , lname='$data[lname]', email='$data[email]', lang_id='$language' WHERE id=$id";

		$result = $this->connection->query($q);

				$_SESSION['message'] = "Updated Successfully";
				$_SESSION['msg_type'] = "success";

 	}

 	 /******************************************* 
	  		
	  		Function to Show updated values

	 *******************************************/

 	public function getUserData($id){

 		
 		$q = "SELECT * FROM user_table WHERE id='$id' ";

 		$result = $this->connection->query($q);

 		if($result->num_rows > 0){

 			$row = mysqli_fetch_assoc($result);

 		}

 		return $row;

 	}

 	/******************************************* 
	  		
	    Function to Show interested Languages 

	 *******************************************/


 	public function showInterestedLanguages($id){

 		
 		$q = "SELECT * FROM
 			 (SELECT interested.u_id,languages.name, languages.lang_id
			  FROM languages
			  INNER JOIN interested ON interested.lang_id= languages.lang_id) AS I
			  WHERE u_id=$id";

 		$result = $this->connection->query($q);

 		return $result;

 	}

 	/***************************************************** 
	  		
	   Function to Show All Languages in the user Profile 

	 *****************************************************/

 		public function showLanguages(){

 		
 		$q = "SELECT * FROM languages";

 		$result = $this->connection->query($q);

 		return $result;

 	}
 

 	/***************************************************************** 
	  		
	  	 Function to search the user according interested languages

	 *****************************************************************/

 	public function search($id,$data){

 		// $lang_id= $_REQUEST['lang'];
 		
 		if(empty($data['lang'])){

 			header('location: index.php');

 		}else{

 		foreach($data['lang'] as $value){

 		$q = "SELECT * FROM (

 		/*SELECT user_table.fname,user_table.lname, languages.name,languages.lang_id
		FROM interested
		INNER JOIN user_table ,languages WHERE interested.u_id = user_table.id 
		AND interested.lang_id = languages.lang_id AND NOT interested.u_id='$id'*/

		SELECT user_table.fname,user_table.lname,user_table.email, languages.name,languages.lang_id
		FROM interested
		INNER JOIN user_table ON interested.u_id = user_table.id 
    	INNER JOIN languages ON interested.lang_id = languages.lang_id
		WHERE NOT user_table.id='$id'
	
 		) AS I WHERE I.lang_id='$value'  ";

 		$result[] = $this->connection->query($q);
 		// print_r($result);
 		}
 	
 	}	
 
 	/*	if($result->num_rows > 0){

 			$_SESSION['message'] = "Searched Successfully";
			$_SESSION['msg_type'] = "success";
			

 		}else{

 			$_SESSION['message'] = "Sorry! There is no any user with this language";
			$_SESSION['msg_type'] = "danger";
			
 		}
 	*/

 		return $result;
 	}

 	 /********************************************************* 
	  		
	  	  Function to add interested lang into user edit Profile 

	 ***********************************************************/


 	public function interested_lang($data){
	
	$id = $_SESSION['id'];

		$q = "SELECT * FROM interested";
		$result = $this->connection->query($q);

		if($result->num_rows > 0){


			$q = "DELETE FROM interested WHERE u_id='$id'";
			$result = $this->connection->query($q);

			foreach ($data['interested'] as $value) 
		 {

		  $q = "INSERT INTO interested (u_id, lang_id) VALUES ($id, $value)";
		   $result = $this->connection->query($q);

		 }

		}else{

        foreach ($data['interested'] as $value) 
		 {

		  $q = "INSERT INTO interested (u_id, lang_id) VALUES ($id, $value)";
		   $result = $this->connection->query($q);

		 }
		}
    }

    /*public function showAllusers(){


    	$q= "SELECT * FROM (

 		SELECT user_table.fname,user_table.lname, languages.name,languages.lang_id
		FROM interested
		INNER JOIN user_table ON interested.u_id = user_table.id 
    	INNER JOIN languages ON interested.lang_id = languages.lang_id
		

 		) AS I ";

 		$result = $this->connection->query($q);

 		return $result;
    }
*/
}



 ?>