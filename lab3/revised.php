<?php
	session_start();    
	if (checklogin_mysql($_POST["username"],$_POST["password"])) {
?>
	<h2> Welcome <?php echo htmlentities($_POST['username'], ENT_QUOTES, 'UTF-8'); ?> !</h2>
<?php		
	}else{
		echo "<script>alert('Invalid username/password');window.location='form.php';</script>";
		die();
	}
	
  	function checklogin_mysql($username, $password) {
		$mysqli= new mysqli('localhost',
							'venagaci',
							'Pa$$w0rd',
							'waph');
		if ($mysqli->connect_errno){
			printf("DATABASE COONECTION FAILED: %s\n", $mysqli->connect_error);
			exit();
		} 
		 $prepared_sql ="SELECT * FROM users WHERE username= ? AND password = md5(?);";
		 $stmt = $mysqli->prepare($prepared_sql);
		 $stmt-> bind_param("ss",$username,$password);
		 $stmt->execute();
		  // echo "DEBUG>sql= $sql";
		  $result = $stmt->get_result();
		  if($result->num_rows ==1)
		  	return TRUE;
		  return FALSE;
  	}
?>
