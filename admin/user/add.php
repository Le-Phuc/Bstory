<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/header.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/util/CheckUserUtil.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/leftbar.php'; ?>
<script>
    document.title = 'Add User | VinaEnter Edu';   
</script>
<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2>Thêm người dùng</h2>
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
									$username = $_POST['username'];
									$password = md5($_POST['password']);
									$fullname = $_POST['fullname'];
									$query = "INSERT INTO users(username, password, fullname)
											  VALUES('{$username}', '{$password}', '{$fullname}')";
									$ketqua = $mysqli->query($query);
									if($ketqua)
									{
										header("location:index.php?msg=Thêm thành công");
										die();
									}else
									{
										echo "Có lỗi khi thêm danh mục";
										die();
									}
								}
							?>
                                <form action="" method="post" role="form" class="adduser">
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input type="text" name="username" class="form-control" />
                                    </div>
									
									<div class="form-group">
                                        <label>Password</label>
                                        <input type="password" name="password" class="form-control" />
                                    </div>
									
									<div class="form-group">
                                        <label>Fullname</label>
                                        <input type="text" name="fullname" class="form-control" />
                                    </div>

                                    <button type="submit" name="submit" class="btn btn-success btn-md">Thêm</button>
                                </form>
                                <script type="text/javascript">
                                    $(document).ready(function(){
                                        $('.adduser').validate({
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