<?php
    session_start();
    if (isset($_SESSION["Admin_num"])) $Admin_num = $_SESSION["Admin_num"];
    else $Admin_num = "";

    if ( $Admin_num != 1 )
    {
        echo("
            <script>
            alert('관리자가 아닙니다! 회원 삭제는 관리자만 가능합니다!');
            history.go(-1)
            </script>
        ");
                exit;
    }

    $id   = $_GET["id"];

    $con = mysqli_connect("localhost", "root", "", "music");
    $sql = "delete from users where id = $id";
    mysqli_query($con, $sql);

    mysqli_close($con);

    echo "
	     <script>
	         location.href = 'admin.php';
	     </script>
	   ";
?>

