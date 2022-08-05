<div class="gadget">
  <h2 class="star">Danh mục truyện</h2>
  <div class="clr"></div>
  <ul class="sb_menu">
	<?php
		$query = "SELECT * FROM cat";
		$ketqua = $mysqli->query($query);
		while($arCat = mysqli_fetch_assoc($ketqua))
		{
			$cat_id = $arCat['cat_id'];
			$name = $arCat['name'];
			$nameReplace = utf8ToLatin($name);
			$url = '/' . $nameReplace . '-' .$cat_id;

	?>
    <li><a href="<?php echo $url?>"><?php echo $arCat['name'];?></a></li>
	<?php
		}
	?>
  </ul>
</div>

<div class="gadget">
  <h2 class="star"><span>Truyện mới</span></h2>
  <div class="clr"></div>
  <ul class="ex_menu">
	<?php
		$query2 = "SELECT * FROM story ORDER BY story_id DESC LIMIT 3";
		$ketqua2 = $mysqli->query($query2);
		while($arStory = mysqli_fetch_assoc($ketqua2))
		{
			$nameReplaceStory = utf8ToLatin($arStory['name']);
			$url = '/' .$nameReplaceStory . '-' .$arStory['story_id'] . '.html';
	?>
    <li><a href="<?php echo $url;?>"><?php echo $arStory['name'];?></a><br />
    <?php echo $arStory['preview_text'];?>
	</li>
	<?php
		}
	?>
  </ul>
</div>