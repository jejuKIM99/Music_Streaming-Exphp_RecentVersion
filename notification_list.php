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
    <h3>
            
    </h3>
        <ul id = "board_list">
            <li>
                    <span class="col1">번호</span>
                    <span class="col1">글쓴이</span>
                    <span class="col2">제목</span>
                    <span class="col5">등록일</span>
                    <span class="col6">조회</span>
            </li>

    <?php

        if (isset($_GET["page"]))
            $page = (int)$_GET["page"];
        else
            $page = 1;

    $con = mysqli_connect("localhost", "root", "", "music");
    $sql = "select * from notifications order by id desc";
    $result = mysqli_query($con, $sql);
    $total_record = mysqli_num_rows($result); // 전체 글 수

    $scale = 10;

    // 전체 페이지 수($total_page) 계산 
    if ($total_record % $scale == 0)     
        $total_page = floor($total_record/$scale);      
    else
        $total_page = floor($total_record/$scale) + 1; 
 
    // 표시할 페이지($page)에 따라 $start 계산  
    $start = ($page - 1) * $scale;      

    $number = $total_record - $start;

        $notificationQuery = mysqli_query($con, "SELECT * FROM notifications ORDER BY regist_day desc");
    for ($i=$start; $i<$start+$scale && $i < $total_record; $i++)
   {
      mysqli_data_seek($result, $i);
        $row = mysqli_fetch_array($notificationQuery);
        $id          = $row["id"];
        $name        = $row["name"];
        $subject     = $row["subject"];
        $regist_day  = $row["regist_day"];
        $hit         = $row["hit"];
   
    ?>
    <li>
                    <span class="col1"><?=$number?></span>
                    <span class="col1"><?=$name?></span>
                    <span class="col2"><a role="link" tabindex="0" onclick="openPage('notification_view.php?id=<?=$id?>&page=<?=$page?>')"style="color: royalblue;"><?=$subject?></a></span>
                    <span class="col5"><?=$regist_day?></span>
                    <span class="col6"><?=$hit?></span>
    </li>   

<?php
       $number--;
   }
   mysqli_close($con);

?>

</ul>
<ul id="page_num">
<?php

for ($i=1; $i<=$total_page; $i++)
    {
        if ($page == $i)     // 현재 페이지 번호 링크 안함
        {
            echo "<li><b> $i </b></li>";
        }
        else
        {
            echo "<li><a href='notification_list.php?page=$i'> $i </a><li>";
        }
    }
    if ($total_page>=2 && $page != $total_page)     
    {
        $new_page = $page+1;    
        echo "<li> <a href='notification_list.php?page=$new_page'>다음 ▶</a> </li>";
    }
    else 
        echo "<li>&nbsp;</li>";
?>
            </ul> <!-- page -->         
            <ul class="buttons">
                <li><button role="link" tabindex="0" onclick="openPage('notification_list.php')">목록</button></li>
                <li>
<?php 
    if($id) {
?>
                    <button role="link" tabindex="0" onclick="openPage('notification.php')">글쓰기</button>
<?php
    } else {
?>
                    <a href="javascript:alert('로그인 후 이용해 주세요!')"><button>글쓰기</button></a>
<?php
    }
?>
                </li>
            </ul>
        </div>
    </section>
</body>
</html>