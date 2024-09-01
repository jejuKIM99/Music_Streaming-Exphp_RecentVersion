<?php
    $id = $_GET["id"];
    $page = $_GET["page"];

    $subject = $_POST["subject"];
    $content = $_POST["content"];
          
    $con = mysqli_connect("localhost", "root", "", "music");
    
    $sql = "update notifications set subject='$subject', content='$content' ";
    $sql .= " where id=$id";
    mysqli_query($con, $sql);

    mysqli_close($con);     

    echo "
	      <script>
	          location.href = 'notification_list.php?page=$page';
	      </script>
	  ";
?>

   
