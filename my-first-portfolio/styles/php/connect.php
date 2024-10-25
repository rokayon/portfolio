<?php
	$username = $_POST['username'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$password = $_POST['confirmPassword'];

	// Database connection
	$conn = new mysqli('localhost','root','','portfolio_test');
	if($conn->connect_error){
		echo "$conn->connect_error";
		die("Connection Failed : ". $conn->connect_error);
	} else {
		$stmt = $conn->prepare("insert into registration(username, email, password, confirmPassword) values(?, ?, ?, ?)");
		$stmt->bind_param("ssss", $username, $email, $password, $password);
		$execval = $stmt->execute();
		echo $execval;
		echo "Registration successfully...";
		$stmt->close();
		$conn->close();
	}
?>