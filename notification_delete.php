<?php
    session_start();
    $Admin_num = $_SESSION['Admin_num'];
    $id   = $_GET["id"];
    $page   = $_GET["page"];

    if ( $Admin_num != 1 )
    {
        echo("
            <script>
            alert('관리자가 아닙니다! 삭제는 관리자만 가능합니다!');
            openPage('notification_list.php?page=$page');
            </script>
        ");
                exit;
    }
    $con = mysqli_connect("localhost", "root", "", "music");
    $sql = "select * from notifications where id = $id";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);

    $copied_name = $row["file_copied"];

	if ($copied_name)
	{
		$file_path = "./data/".$copied_name;
		unlink($file_path);
    }

    $sql = "delete from notifications where id = $id";
    mysqli_query($con, $sql);
    mysqli_close($con);

    echo "
	     <script>
	         location.href = 'notification_list.php?page=$page';
	     </script>
	   ";
?>

