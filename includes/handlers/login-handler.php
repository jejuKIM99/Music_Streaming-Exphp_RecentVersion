<?php
if(isset($_POST['loginButton'])) {
	//Login button was pressed
	$username = $_POST['loginUsername'];
	$password = $_POST['loginPassword'];

	$result = $account->login($username, $password);

	if($result == true) {
        $_SESSION['userLoggedIn'] = $username;
		header("Location: index.php");

	}

	$con = mysqli_connect("localhost", "root", "", "music");
	$sql = "select * from users where username='$username'";
	$result1 = mysqli_query($con, $sql);
	$row = mysqli_fetch_array($result1);


	$_SESSION["Admin_num"] = $row["Admin_num"];


}
?>