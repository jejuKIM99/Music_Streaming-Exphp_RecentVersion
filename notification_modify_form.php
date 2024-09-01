<?php 
include("includes/includedFiles.php");
?>

<html>
<head> 
<link rel="stylesheet" type="text/css" href="./css/common.css">
<link rel="stylesheet" type="text/css" href="./css/board.css">
<script>
  function check_input() {
      if (!document.notification.subject.value)
      {
          alert("제목을 입력하세요!");
          document.notification.subject.focus();
          return;
      }
      if (!document.notification.content.value)
      {
          alert("내용을 입력하세요!");    
          document.notification.content.focus();
          return;
      }
      document.notification.submit();
   }
</script>
</head>
<body> 

<section>

   	<div id="board_box">
	    <h3 id="board_title">
	    		Notification > 공지
		</h3>
<?php

	$id  = $_GET["id"];
	$page = $_GET["page"];

	$con = mysqli_connect("localhost", "root", "", "music");
	$sql = "select * from notifications where id=$id";
	$result = mysqli_query($con, $sql);
	$row = mysqli_fetch_array($result);
	$name       = $row["name"];
	$subject    = $row["subject"];
	$content    = $row["content"];		
	$file_name  = $row["file_name"];

	if($_SESSION['userLoggedIn'] != $name){
		echo("
           <script>
             alert('작성자가 아닙니다.')
             openPage('notification_list.php?page=$page');
           </script>
         ");
		exit();
	}
?>
	    <form  name="notification" method="post" action="notification_modify.php?id=<?=$id?>&page=<?=$page?>" enctype="multipart/form-data">
	    	 <ul id="board_form">
				<li>
					<span class="col1">이름 : </span>
					<span class="col2"><?=$name?></span>
				</li>		
	    		<li>
	    			<span class="col1">제목 : </span>
	    			<span class="col2"><input name="subject" type="text" value="<?=$subject?>"></span>
	    		</li>	    	
	    		<li id="text_area">	
	    			<span class="col1">내용 : </span>
	    			<span class="col2">
	    				<textarea name="content"><?=$content?></textarea>
	    			</span>
	    		</li>
	    	    </ul>
	    	<ul class="buttons">
				<li><button type="button" role="link" tabindex="0" onclick="check_input()">수정하기</button></li>
				<li><button type="button" role="link" tabindex="0" onclick="openPage('notification_list.php')">목록</button></li>
			</ul>
	    </form>
	</div> <!-- board_box -->
</section> 
</body>
</html>
