<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/header.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/util/CheckUserUtil.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/util/LibraryFile.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/leftbar.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/util/LibraryFile.php';
	$objFile = new LibraryFile();
?>
<script>
    document.title = 'Edit Story | VinaEnter Edu';   
</script>
<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2>Sửa truyện</h2>
            </div>
        </div>
        <!-- /. ROW  -->
        <hr />
        <div class="row">
            <div class="col-md-12">
                <!-- Form Elements -->
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
								<?php
									$story_id = $_GET['id'];
									$query2 = "SELECT * FROM story WHERE story_id = {$story_id}";
									$ketqua2 = $mysqli->query($query2);
									$arNew = mysqli_fetch_assoc($ketqua2);
									if(isset($_POST['submit']))
									{
										$name = $_POST['name'];
										$cat_id = $_POST['cat_id'];
										$picture = $_FILES['picture']['name'];
										$preview_text = $_POST['preview_text'];
										$detail_text = $_POST['detail_text'];
										if($picture == '')
										{
											//không thay đổi hình
											$queryNoPic = "UPDATE story	
														   SET name ='{$name}',
														   cat_id ='{$cat_id}',
														   preview_text ='{$preview_text}',
														   detail_text ='{$detail_text}'
														   WHERE story_id = {$story_id}";
											$resultNoPic = $mysqli->query($queryNoPic);
											if($resultNoPic)
											{
												header("location:index.php?msg=Sửa thành công");
											}else
											{
												echo "Có lỗi khi Sửa truyện không thay đổi hình";
											}
										}else
										{
											//có thay đổi hình
											//kiểm tra hình cũ
											if($arNew['picture'] != '')
											{
												//unlink($_SERVER['DOCUMENT_ROOT'].'/files/'.$arNew['picture']);
												echo $objFile->deleteFile($arNew['picture']);
											}
											//upload hình mới
											//$tmp = explode('.', $picture);
											//$duoiFile = end($tmp);
											//$tenFileMoi = 'LĐP-'.time().'.'.$duoiFile;
											//$tmp_name = $_FILES['picture']['tmp_name'];
											//$path_upload = $_SERVER['DOCUMENT_ROOT'].'/files/'.$tenFileMoi;
											//move_uploaded_file($tmp_name, $path_upload);
											$objFile->uploadFile($picture);
											$queryPic = "UPDATE story	
														   SET name ='{$name}',
														   cat_id ='{$cat_id}',
														   preview_text ='{$preview_text}',
														   detail_text ='{$detail_text}',
														   picture ='{$tenFileMoi}'
														   WHERE story_id = {$story_id}";
											$resultPic = $mysqli->query($queryPic);
											if($resultPic)
											{
												header("location:index.php?msg=Sửa thành công");
											}else
											{
												echo "Có lỗi khi Sửa truyện có thay đổi hình";
											}
										}
									}
								?>
								<form action="" method="POST" enctype="multipart/form-data" role="form" class="editstory">
                                    <div class="form-group">
                                        <label>Tên truyện</label>
                                        <input type="text" name="name" value="<?php echo $arNew['name'];?>" class="form-control" />
                                    </div>

                                    <div class="form-group">
                                        <label>Danh mục truyện</label>
                                        <select name="cat_id" class="form-control">
											<?php
												$query = "SELECT * FROM cat";
												$ketqua = $mysqli->query($query);
												while($arCat = mysqli_fetch_assoc($ketqua))
												{
													$selected = '';
													if($arCat['cat_id'] == $arNew['cat_id'])
													{
														$selected = 'selected';
													}
											?>
                                                <option <?php echo $selected;?> value="<?php echo $arCat['cat_id'];?>"><?php echo $arCat['name'];?></option>
                                            <?php
												}
											?>
                                            </select>
                                    </div>
									<?php
										if($arNew['picture'] != '')
										{
									?>
                                    <div class="form-group">
                                        <label>Hình ảnh cũ</label>
                                        <img src="/files/<?php echo $arNew['picture'];?>" width="100px"/>
                                    </div>
									<?php
										}
									?>
									<div class="form-group">
                                        <label>Hình ảnh</label>
                                        <input type="file" name="picture" />
                                    </div>
                                    <div class="form-group">
                                        <label>Mô tả</label>
                                        <textarea id="mota-editstr" class="form-control" rows="3" name="preview_text"><?php echo $arNew['preview_text'];?></textarea>
                                    	<script type="text/javascript">
                                    		CKEDITOR.replace( 'mota-editstr',
											{
											    filebrowserBrowseUrl: '/library/ckfinder/ckfinder.html',
											    filebrowserImageBrowseUrl: '/library/ckfinder/ckfinder.html?type=Images',
											    filebrowserUploadUrl: '/library/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
											    filebrowserImageUploadUrl: '/library/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images'
											});
                                    	</script>                                        
                                    </div>
                                    <div class="form-group">
                                        <label>Chi tiết</label>
                                        <textarea id="chitiet-editstr" class="form-control" rows="5" name="detail_text"><?php echo $arNew['detail_text'];?></textarea>
                                    	<script type="text/javascript">
                                    		CKEDITOR.replace( 'chitiet-editstr',
											{
											    filebrowserBrowseUrl: '/library/ckfinder/ckfinder.html',
											    filebrowserImageBrowseUrl: '/library/ckfinder/ckfinder.html?type=Images',
											    filebrowserUploadUrl: '/library/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
											    filebrowserImageUploadUrl: '/library/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images'
											});
                                    	</script>                                        
                                    </div>

                                    <button type="submit" name="submit" class="btn btn-success btn-md">Sửa</button>
                                </form>

                                <script type="text/javascript">
									$(document).ready(function(){
										$('.editstory').validate({
											rules:{
												name:{
													required: true,
												},
												cat_id:{
													required: true,
												},
												preview_text:{
													required: true,
												},
												detail_text:{
													required: true,
												},
											
											},
											messages:{
												name:{
													required: "vui long nhap ten truyen",
												},
												cat_id:{
													required: "vui long chon danh muc truyen",
												},
												preview_text:{
													required: "vui long nhap mo ta",
												},
												detail_text:{
													required: "vui long nhap chi tiet",
												},
												
											},	
										});
									});
							
							</script>
							<style>
								.error{color:red;}
							</style>

                            </div>

                        </div>
                    </div>
                </div>
                <!-- End Form Elements -->
            </div>
        </div>
        <!-- /. ROW  -->
    </div>
    <!-- /. PAGE INNER  -->
</div>
<!-- /. PAGE WRAPPER  -->
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/footer.php'; ?>