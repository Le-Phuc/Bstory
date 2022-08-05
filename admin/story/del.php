<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/header.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/util/CheckUserUtil.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/util/LibraryFile.php';
	$objFile = new LibraryFile();
?>
<?php
	$story_id = $_GET['id'];
	$query = "SELECT picture FROM story WHERE story_id = {$story_id}";
	$ketqua = $mysqli->query($query);
	$arNew = mysqli_fetch_assoc($ketqua);
	if($arNew['picture'] != '')
	{
		//unlink($_SERVER['DOCUMENT_ROOT'].'/files/'.$arNew['picture']);
		echo $objFile->deleteFile($arNew['picture']);
	}
	$queryDel = "DELETE FROM story WHERE story_id = {$story_id}";
	$ketqua2 = $mysqli->query($queryDel);
	if($ketqua2)
	{
		header("location:index.php?msg=Xóa thành công");
	}else
	{
		echo "Có lỗi khi xóa truyện";
	}
?>

<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/leftbar.php'; ?>