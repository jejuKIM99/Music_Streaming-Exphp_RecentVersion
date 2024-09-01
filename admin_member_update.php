<?php
    session_start();

    $id   = $_GET["id"];
    $firstName  = $_POST['firstName'];
    $lastName  = $_POST['lastName'];
    $Admin_num = $_POST['Admin_num'];

    $con = mysqli_connect("localhost", "root", "", "music");
    $sql = "update users set firstName=$firstName, lastName=$lastName, Admin_num=$Admin_num where id=$id";
    mysqli_query($con, $sql);

    mysqli_close($con);

    echo "
	     <script>
	         location.href = 'admin.php';
	     </script>
	   ";
?>

