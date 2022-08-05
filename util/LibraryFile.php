<?php
	class LibraryFile
	{
		function uploadFile($picture)
		{
			//upload ảnh lên host
			$tmp_name = $_FILES['picture']['tmp_name'];
			//lấy phần mở rộng ảnh
			$tmp = explode('.', $picture);
			$duoiFile = end($tmp);
			//tạo tên ảnh mới khi upload lên host
			$tenFileMoi = 'LĐP-'.time().'.'.$duoiFile;
			//tạo đường dẫn upload ảnh
			$path_upload = $_SERVER['DOCUMENT_ROOT'].'/files/'.$tenFileMoi;
			move_uploaded_file($tmp_name, $path_upload);
			return $tenFileMoi;
		}

		function deleteFile($tenFile)
		{
			return unlink($_SERVER['DOCUMENT_ROOT'] .'/files/'.$tenFile);
		}
	}

?>