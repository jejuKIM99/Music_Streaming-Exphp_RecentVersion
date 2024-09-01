<?php 
include("includes/includedFiles.php");
    $Admin_num = $_SESSION['Admin_num'];

    if ( $Admin_num != 1 )
    {
        echo("
            <script>
            alert('글 작성은 관리자만 가능합니다.');
            openPage('notification_list.php?');
            </script>
        ");
                exit;
    }
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
	    		게시판 > 글 쓰기
		</h3>
			<?php 
				$username = $userLoggedIn->getUsername();

			?>

	    <form  name="notification" method="post" action="notification_insert.php" enctype="multipart/form-data">
	    	 <ul id="board_form">
				<li>
					<span class="col1">이름 : </span>
					<span class="col2" name = "name"><?=$username?></span>
				</li>		
	    		<li>
	    			<span class="col1">제목 : </span>
	    			<span class="col2"><input name="subject" type="text"></span>
	    		</li>	    	
	    		<li id="text_area">	
	    			<span class="col1">내용 : </span>
	    			<span class="col2">
	    				<textarea name="content"></textarea>
	    			</span>
	    		</li>
	    		<li>
			        <span class="col1"> 첨부 파일</span>
			        <span class="col2"><input type="file" name="upfile"></span>
			    </li>
	    	    </ul>
	    	<ul class="buttons">
				<li><button type="button" onclick="check_input()">완료</button></li>
				<li><button type="button" role="link" tabindex="0" onclick="openPage('notification_list.php')">목록</button></li>
			</ul>
	    </form>
	</div> <!-- board_box -->
</section> 

</body>
</html>
