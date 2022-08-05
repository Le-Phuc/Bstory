<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/header.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/util/CheckUserUtil.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/leftbar.php'; ?>
<script>
    document.title = 'Edit Cat | VinaEnter Edu';   
</script>
<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2>Sửa danh mục</h2>
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
								$cat_id = $_GET['id'];
								$sql = "SELECT * FROM cat WHERE cat_id = {$cat_id}";
								$ketqua2 = $mysqli->query($sql);
								$arCat = mysqli_fetch_assoc($ketqua2);
								if(isset($_POST['submit']))
								{
									$name = $_POST['name'];
									$query = "UPDATE cat SET name='{$name}' WHERE cat_id = {$cat_id}";
									$ketqua = $mysqli->query($query);
									if($ketqua)
									{
										header("location:index.php?msg=Sửa thành công");
										die();
									}else
									{
										echo "Có lỗi khi sửa danh mục";
										die();
									}
								}
							?>
                                <form action="" method="post" role="form" class="editcat">
                                    <div class="form-group">
                                        <label>Tên danh mục</label>
                                        <input type="text" name="name" value="<?php echo $arCat['name']; ?>" class="form-control" />
                                    </div>

                                    <button type="submit" name="submit" class="btn btn-success btn-md">Sửa</button>
                                </form>

                                <script type="text/javascript">
                                    $(document).ready(function(){
                                        $('.editcat').validate({
                                            rules:{
                                                name:{
                                                    required: true,
                                                },
                                            },
                                            messages:{
                                                name:{
                                                    required: "vui long nhap ten danh mục",
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