<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/header.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/util/CheckUserUtil.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/util/LibraryFile.php';
	$objFile = new LibraryFile();
?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/leftbar.php'; ?>
<script>
    document.title = 'Add Story | VinaEnter Edu';   
</script>
<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2>Thêm truyện</h2>
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
									if(isset($_POST['submit']))
									{
										$name = $_POST['name'];
										$cat_id = $_POST['cat_id'];
										$picture = $_FILES['picture']['name'];
										$preview_text = $_POST['preview_text'];
										$detail_text = $_POST['detail_text'];
										if($picture == '')
										{
											//thêm truyện không hình
											$queryNoPic = "INSERT INTO story(name,cat_id,preview_text,detail_text)
														   VALUES ('{$name}','{$cat_id}','{$preview_text}','{$detail_text}')";
											$resultNoPic = $mysqli->query($queryNoPic);
											if($resultNoPic)
											{
												header("location:index.php?msg=Thêm thành công");
											}else
											{
												echo "Có lỗi khi thêm truyện không hình";
											}
										}else
										{
											// thêm truyện có hình
											// upload hình
											$tmp = explode('.', $picture);
											$duoiFile = end($tmp);
											$tenFileMoi = 'LĐP-'.time().'.'.$duoiFile;
											$tmp_name = $_FILES['picture']['tmp_name'];
											$path_upload = $_SERVER['DOCUMENT_ROOT'].'/files/'.$tenFileMoi;
											move_uploaded_file($tmp_name, $path_upload);
											$objFile->uploadFile($picture);
											$queryPic = "INSERT INTO story(name,cat_id,preview_text,detail_text,picture)
														   VALUES ('{$name}','{$cat_id}','{$preview_text}','{$detail_text}','{$tenFileMoi}')";
											$resultPic = $mysqli->query($queryPic);
											if($resultPic)
											{
												header("location:index.php?msg=Thêm thành công");
											}else
											{
												echo "Có lỗi khi thêm truyện có hình";
											}
										}
									}
								?>
								<form action="" method="POST" enctype="multipart/form-data" role="form" class="addstory">
                                    <div class="form-group">
                                        <label>Tên truyện</label>
                                        <input type="text" name="name" class="form-control" />
                                    </div>

                                    <div class="form-group">
                                        <label>Danh mục truyện</label>
                                        <select name="cat_id" class="form-control">
											<?php
												$query = "SELECT * FROM cat";
												$ketqua = $mysqli->query($query);
												while($arCat = mysqli_fetch_assoc($ketqua))
												{
											?>
                                                <option value="<?php echo $arCat['cat_id'];?>"><?php echo $arCat['name'];?></option>
                                            <?php
												}
											?>
                                            </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Hình ảnh</label>
                                        <input type="file" name="picture" />
                                    </div>
                                    <div class="form-group">
                                        <label>Mô tả</label>
                                        <textarea id="mota-addstr" class="form-control" rows="3" name="preview_text"></textarea>
                                    	<script type="text/javascript">
                                    		 CKEDITOR.replace( 'mota-addstr',
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
                                        <textarea id="chitiet-addstr" class="form-control" rows="5" name="detail_text"></textarea>
                                    	<script type="text/javascript">
                                    		CKEDITOR.replace( 'chitiet-addstr',
											{
											    filebrowserBrowseUrl: '/library/ckfinder/ckfinder.html',
											    filebrowserImageBrowseUrl: '/library/ckfinder/ckfinder.html?type=Images',
												filebrowserUploadUrl: '/library/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
											    filebrowserImageUploadUrl: '/library/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images'
											});
                                    	</script>
                                    </div>


                                    <button type="submit" name="submit" class="btn btn-success btn-md">Thêm</button>
                                </form>

                                <script type="text/javascript">
									$(document).ready(function(){
										$('.addstory').validate({
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