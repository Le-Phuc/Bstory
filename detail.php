<?php include_once $_SERVER['DOCUMENT_ROOT'].'/templates/bstory/inc/header.php'; ?>  
<?php
	$story_id = $_GET['id'];
	$query = "SELECT * FROM story WHERE story_id = {$story_id}";
	$ketqua = $mysqli->query($query);
	$arStory  = mysqli_fetch_assoc($ketqua);
	
?>
<script>
	document.title = '<?php echo $arStory['name'];?>';	
</script>
<div class="content_resize">
  <div class="mainbar">
    <div class="article">
      <h1><?php echo $arStory['name'];?></h1>
      <div class="clr"></div>
      <p>Ngày đăng: <?php echo $arStory['created_at'];?>. Lượt đọc: <?php echo $arStory['counter'];?></p>
      <div class="vnecontent">
          <p><?php echo $arStory['detail_text']?></p>
      </div>
    </div>
    
    <div class="article">
      <h2>Truyện liên quan</h2>
      <div class="clr"></div>
      
      <div class="comment">
		<?php
			$queryLQ = "SELECT * FROM story WHERE story_id != {$story_id} AND cat_id = {$arStory['cat_id']} ORDER BY story_id DESC";
			$ketquaLQ = $mysqli->query($queryLQ);
			while($arStoryLQ = mysqli_fetch_assoc($ketquaLQ))
			{
				$nameReplaceStory = utf8ToLatin($arStoryLQ['name']);
				$url = '/' .$nameReplaceStory . '-' .$arStoryLQ['story_id'] . '.html';
		?>
		<?php
			if($arStoryLQ['picture'] != '')
			{
		?>
		<a href="<?php echo $url;?>">
		<img src="/files/<?php echo $arStoryLQ['picture'];?>" width="40" height="40" alt="" class="userpic" />
		</a>
		<?php
			}
		?>
        <h3><a href="<?php echo $url;?>" title=""><?php echo $arStoryLQ['name'];?></a></h3>
        <p><?php echo $arStoryLQ['preview_text'];?></p>
		
		<div class="clr"></div>
		<?php
			}
		?>
      </div>
	 
    </div>
  </div>
  <div class="sidebar">
  <?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/bstory/inc/leftbar.php'; ?>
  </div>
  <div class="clr"></div>
</div>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/bstory/inc/footer.php'; ?>
  
