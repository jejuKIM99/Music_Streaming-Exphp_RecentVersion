<?php 
include("includes/includedFiles.php");
    if (isset($_SESSION["Admin_num"])) $Admin_num = $_SESSION["Admin_num"];
    else $Admin_num = "";

    if ( $Admin_num != 1 )
    {
        echo("
            <script>
            alert('관리자가 아닙니다! Admin page는 관리자만 가능합니다!');
            openPage('browse.php');
            </script>
        ");
        exit;
    }
?>

<html>
<head> 
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="./css/common.css">
<link rel="stylesheet" type="text/css" href="./css/admin.css">
</head>
<body> 

<section>
   	<div id="admin_box">
	    <h3 id="member_title">
	    	관리자 모드 > 회원 관리
		</h3>
	    <ul id="member_list">
				<li>
					<span class="col7">번호</span>
					<span class="col7">아이디</span>
					<span class="col7">이름</span>
					<span class="col6">email</span>
					<span class="col6">가입일</span>
					<span class="col7">Admin_num</span>
					<span class="col7">수정</span>
					<span class="col7">삭제</span>
				</li>
<?php
	$con = mysqli_connect("localhost", "root", "", "music");
	$sql = "select * from users order by id desc";
	$result = mysqli_query($con, $sql);
	$total_record = mysqli_num_rows($result); // 전체 회원 수

	$number = $total_record;

   while ($row = mysqli_fetch_array($result))
   {
      $id         = $row["id"];
	  $username         = $row["username"];
	  $firstName        = $row["firstName"];
	  $lastName       = $row["lastName"];
      $email      = $row["email"];
      $signUpDate  = $row["signUpDate"];
      $Admin_num = $row["Admin_num"];
?>
			
		<li>
		<form method="post" action="admin_member_update.php?id=<?=$id?>">
			<span class="col7"><?=$id?></span>
			<span class="col7"><?=$username?></a></span>
			<span class="col7"><input type="text" name="firstName" value="<?=$firstName?>"><input type="text" name="lastName" value="<?=$lastName?>"></span>
			<span class="col6"><?=$email?></span>
			<span class="col6"><?=$signUpDate?></span>
			<span class="col7"><input type="text" name="Admin_num" value="<?=$Admin_num?>"></span>
			<span class="col7"><button type="submit">수정</button></span>
			<span class="col7"><button type="button" onclick="location.href='admin_member_delete.php?id=<?=$id?>'">삭제</button></span>
		</form>
		</li>	
			
<?php
   	   $number--;
   }
?>
	    </ul>
	    <h3 id="member_title">
	    	관리자 모드 > 게시판 관리
		</h3>
	    <ul id="board_list">
		<li class="title">
			<span class="col1">선택</span>
			<span class="col2">번호</span>
			<span class="col3">이름</span>
			<span class="col4">제목</span>
			<span class="col5">첨부파일명</span>
			<span class="col6">작성일</span>
		</li>
		<form method="post" action="admin_board_delete.php">
<?php
	$sql = "select * from notifications order by id desc";
	$result = mysqli_query($con, $sql);
	$total_record = mysqli_num_rows($result); // 전체 글의 수

	$number = $total_record;

   while ($row = mysqli_fetch_array($result))
   {
      $id         = $row["id"];
	  $name        = $row["name"];
	  $subject     = $row["subject"];
	  $file_name   = $row["file_name"];
      $regist_day  = $row["regist_day"];
      $regist_day  = substr($regist_day, 0, 10)
?>
		<li>
			<span class="col1"><input type="checkbox" name="item[]" value="<?=$id?>"></span>
			<span class="col2"><?=$id?></span>
			<span class="col3"><?=$name?></span>
			<span class="col4"><?=$subject?></span>
			<span class="col5"><?=$file_name?></span>
			<span class="col6"><?=$regist_day?></span>
		</li>	
<?php
   	   $number--;
   }
   
?>
				<button type="submit">선택된 글 삭제</button>
			</form>
	    </ul>
	    <h3 id="member_title">
	    	관리자 모드 > 음악 관리
		</h3>
	    <ul id="board_list">
		<li class="title">
			<span class="col1">선택</span>
			<span class="col2">번호</span>
			<span class="col4">타이틀</span>
			<span class="col3">아티스트</span>
			<span class="col5">앨범</span>
			<span class="col6">장르</span>
		</li>
		<form method="post" action="admin_music_delete.php">
<?php
	$sql = "select * from songs order by id asc";
	$result = mysqli_query($con, $sql);
	$total_record = mysqli_num_rows($result); // 전체 글의 수

	$number = $total_record;

   while ($row = mysqli_fetch_array($result))
   {
      $id         = $row["id"];
	  $title        = $row["title"];
	  $artist    = $row["artist"];
	  $album   = $row["album"];
      $genre  = $row["genre"];

?>
	<li>
			<span class="col1"><input type="checkbox" name="item[]" value="<?=$id?>"></span>
			<span class="col2"><?=$id?></span>
			<span class="col4"><?=$title?></span>
			<span class="col3"><?=$artist?></span>
			<span class="col5"><?=$album?></span>
			<span class="col6"><?=$genre?></span>
		</li>	
<?php
   $number--;
   }
   mysqli_close($con);
?>
				<button type="submit">선택된 글 삭제</button>
			</form>
	</ul>
	</div> <!-- admin_box -->

</section> 

</body>
</html>
