<?php
    session_start();
    if (isset($_SESSION["Admin_num"])) $Admin_num = $_SESSION["Admin_num"];
    else $Admin_num = "";

    if (isset($_POST["item"]))
        $num_item = count($_POST["item"]); 
    else
        echo("
                    <script>
                    alert('삭제할 게시글을 선택해주세요!');
                    history.go(-1)
                    </script>
        ");

    $con = mysqli_connect("localhost", "root", "", "music");

    for($i=0; $i<count($_POST["item"]); $i++){
        $id = $_POST["item"][$i];

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
    }       

    mysqli_close($con);

    echo "
	     <script>
	         location.href = 'admin.php';
	     </script>
	   ";
?>

