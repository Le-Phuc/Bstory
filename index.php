<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/bstory/inc/header.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/util/LibraryString.php';
	$objSTR = new LibraryString();
?>
<?php
	//tổng số dòng
	$queryTSD = "SELECT COUNT(*) AS TSD FROM story";
	$resultTSD = $mysqli->query($queryTSD);
	$arTmp = mysqli_fetch_assoc($resultTSD);
	$TSD = $arTmp['TSD'];
	//số truyện trên 1 trang
	$row_count = ROW_COUNT;
	//tổng số trang
	$TST = ceil($TSD/$row_count);
	//trang hiện tại
	$current_page = 1;
	if(isset($_GET['page']))
	{
		$current_page = $_GET['page'];
	}
	//offset
	$offset = ($current_page - 1) * $row_count;
?>
<div class="content_resize">
  <div class="mainbar">
    <?php
		$query = "SELECT * FROM story ORDER BY story_id DESC LIMIT {$offset}, {$row_count}";
		$ketqua = $mysqli->query($query);
		while($arStory = mysqli_fetch_assoc($ketqua))
		{
			$story_id = $arStory['story_id'];
			$name = $arStory['name'];
			$created_at = $arStory['created_at'];
			$counter = $arStory['counter'];
			$picture = $arStory['picture'];
			$preview_text = $arStory['preview_text'];
			
			$nameReplaceStory = utf8ToLatin($name);
			$url = '/' .$nameReplaceStory . '-' .$story_id . '.html';
	?>
    <div class="article">
      <h2><a href="<?php echo $url;?>"><?php echo $objSTR->convertUtf8ToLatin($name);?></a></h2>
      <p class="infopost"><?php echo $created_at;?>. Lượt đọc: <?php echo $counter;?></p>
      <div class="clr"></div>
      <div class="img">
		<?php
			if($picture != '')
			{
		?>
		<a href="<?php echo $url;?>">
		<img src="/files/<?php echo $picture;?>" width="161" height="192" alt="" class="fl" />
		</a>
	  <?php
			}
	  ?>
	  </div>
      <div class="post_content">
        <p><?php echo $objSTR->cutString($preview_text);?></p>
        <p class="spec"><a href="<?php echo $url;?>" class="rm">Chi tiết</a></p>
      </div>
      <div class="clr"></div>
    </div>
    <?php
		}
	?>

    <p class="pages">
	<small>Trang <?php echo $current_page;?> của <?php echo $TST;?></small>
	<?php
		for($i = 1; $i <= $TST; $i++)
		{
			$url = '/' . 'page-' .$i;
			
	?>
		<?php
			if($i == $current_page)
			{
		?>
				<span><?php echo $current_page;?></span> 
		<?php
			}else
			{
		?>
				<a href="<?php echo $url;?>"><?php echo $i;?></a>
		<?php
			}
		?>
	<?php
		}
	?>
	</p>
  </div>
  <div class="sidebar">
  <?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/bstory/inc/leftbar.php'; ?>
  </div>
  <div class="clr"></div>
</div>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/bstory/inc/footer.php'; ?>
