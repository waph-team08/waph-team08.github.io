<?php
	session_start();    
	//if (checklogin($_POST["username"],$_POST["password"])) {
	 if (checklogin_mysql($_POST["username"],$_POST["password"])) {
?>
	<h2> Welcome <?php echo $_POST['username']; ?> !</h2>
<?php		
	}else{
		echo "<script>alert('Invalid username/password');window.location='form.php';</script>";
		die();
	}
	// function checklogin($username, $password) {
	// 	$account = array("admin","1234");
	// 	if (($username== $account[0]) and ($password == $account[1])) 
	// 	  return TRUE;
	// 	else 
	// 	  return FALSE;
  	// }
  	function checklogin_mysql($username, $password) {
		$mysqli= new mysqli('localhost',
							'venagaci',
							'Pa$$w0rd',
							'waph');
		if ($mysqli->connect_errno){
			printf("DATABASE COONECTION FAILED: %s\n", $mysqli->connect_error);
			exit();
		} 
		  $sql ="SELECT * FROM users WHERE username='" . $username . "' ";
		  $sql = $sql . " AND password = md5('" . $password . "')";
		  // echo "DEBUG>sql= $sql";
		  $result = $mysqli->query($sql);
		  if($result->num_rows ==1)
		  	return TRUE;
		  return FALSE;
  	}
?>