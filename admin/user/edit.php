<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/header.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/util/CheckUserUtil.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/leftbar.php'; ?>
<script>
    document.title = 'Edit User | VinaEnter Edu';   
</script>
<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2>Sửa người dùng</h2>
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
								$id = $_GET['id'];
								$query2 = "SELECT * FROM users WHERE id = {$id}";
								$ketqua2 = $mysqli->query($query2);
								$arUser = mysqli_fetch_assoc($ketqua2);
								if($arUser['username'] == 'admin' && $_SESSION['arUser']['username'] != 'admin')
								{
									header("location:index.php?msg=Bạn không có quyền sửa admin");
									die();
								}
								if(isset($_POST['submit']))
								{
									$username = $_POST['username'];
									$password = $_POST['password'];
									$fullname = $_POST['fullname'];
									if($password == '')
									{								
										$query = "UPDATE users SET fullname = '{$fullname}' WHERE id = {$id}";
										$ketqua = $mysqli->query($query);
										if($ketqua)
										{
											header("location:index.php?msg=Sửa thành công");
											die();
										}else
										{
											echo "Có lỗi khi sửa người dùng";
											die();
										}
									}else
									{
										$password = md5($password);
										
										$query3 = "UPDATE users SET fullname = '{$fullname}', password = '{$password}' WHERE id = {$id}";
										$ketqua3 = $mysqli->query($query3);
										if($ketqua3)
										{
											header("location:index.php?msg=Sửa thành công");
											die();
										}else
										{
											echo "Có lỗi khi Sửa người dùng";
											die();
										}
									}
								
								}
							?>
                                <form action="" method="post" role="form" class="edituser">
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input type="text" name="username" value="<?php echo $arUser['username']?>" readonly class="form-control" />
                                    </div>
									
									<div class="form-group">
                                        <label>Password</label>
                                        <input type="password" name="password" class="form-control" />
                                    </div>
									
									<div class="form-group">
                                        <label>Fullname</label>
                                        <input type="text" name="fullname" value="<?php echo $arUser['fullname']?>" class="form-control" />
                                    </div>

                                    <button type="submit" name="submit" class="btn btn-success btn-md">Sửa</button>
                                </form>
                                <script type="text/javascript">
                                    $(document).ready(function(){
                                        $('.edituser').validate({
                                            rules:{
                                                username:{
                                                    required: true,
                                                },
                                                password:{
                                                    required: true,
                                                    minlength: 6,
                                                    maxlength: 15,
                                                },
                                                fullname:{
                                                    required: true,
                                                },
                                            
                                            },
                                            messages:{
                                                username:{
                                                    required: "vui long nhap username",
                                                },
                                                password:{
                                                    required: "vui long nhap password",
                                                },
                                                fullname:{
                                                    required: "vui long nhap fullname",
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