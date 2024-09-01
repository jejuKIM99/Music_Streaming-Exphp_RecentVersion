<?php 
include("includes/includedFiles.php");
?>
<h1 class="pageHeadingBig">Notifications</h1>
<html>
<head> 
<link rel="stylesheet" type="text/css" href="./css/common.css">
<link rel="stylesheet" type="text/css" href="./css/board.css">
</head>
<body> 

<section>
   	<div id="board_box">
	    <h3 class="title">
			Notofication -> Content
		</h3>
<?php
	$id  = $_GET["id"];
	$page  = $_GET["page"];

	$con = mysqli_connect("localhost", "root", "", "music");
	$sql = "select * from notifications where id=$id";
	$result = mysqli_query($con, $sql);

	$row = mysqli_fetch_array($result);
	$id      = $row["id"];
	$name      = $row["name"];
	$regist_day = $row["regist_day"];
	$subject    = $row["subject"];
	$content    = $row["content"];
	$file_name    = $row["file_name"];
	$file_type    = $row["file_type"];
	$file_copied  = $row["file_copied"];
	$hit          = $row["hit"];

	$content = str_replace(" ", "&nbsp;", $content);
	$content = str_replace("\n", "<br>", $content);

	$new_hit = $hit + 1;
	$sql = "update notifications set hit=$new_hit where id=$id";   
	mysqli_query($con, $sql);
?>		
	    <ul id="view_content">
			<li>
				<span class="col1"><b>제목 :</b> <?=$subject?></span>
				<span class="col2"><?=$name?> | <?=$regist_day?></span>
			</li>
			<li>
				<?php
					if($file_name) {
						$real_name = $file_copied;
						$file_path = "./data/".$real_name;
						$file_size = filesize($file_path);

						echo "▷ 첨부파일 : $file_name ($file_size Byte) &nbsp;&nbsp;&nbsp;&nbsp;
			       		<a href='download.php?id=$id&real_name=$real_name&file_name=$file_name&file_type=$file_type'>[저장]</a><br><br>";
			           	}
				?>
				<?=$content?>
			</li>		
	    </ul>
	    <ul class="buttons">
				<li><button role="link" tabindex="0" onclick="openPage('notification_list.php?page=<?=$page?>')">목록</button></li>
				<li><button role="link" tabindex="0" onclick="openPage('notification_modify_form.php?id=<?=$id?>&page=<?=$page?>')">수정</button></li>
				<li><button role="link" tabindex="0" onclick="openPage('notification_delete.php?id=<?=$id?>&page=<?=$page?>')">삭제</button></li>
				<li><button role="link" tabindex="0" onclick="openPage('notification.php')">글쓰기</button></li>
		</ul>
	</div> <!-- board_box -->
</section> 

</body>
</html>
