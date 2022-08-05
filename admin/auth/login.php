<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/header.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/leftbar.php'; ?>
<script>
	document.title = 'Login | VinaEnter Edu';	
</script>
<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2>Đăng nhập</h2>
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
									//$chucnang = $_POST['chucnag];
									$query = "SELECT * FROM users WHERE username = '{$username}' AND password = '{$password}'";
									$ketqua = $mysqli->query($query);
									$arUser = mysqli_fetch_assoc($ketqua);
									if($arUser)
									{
										$_SESSION['arUser'] = $arUser;
										header("location:../index.php");
									}else
									{
										echo "<span style='color:red'>Sai username hoặc password</span>";
									}
								}
							?>
                                <form action="" method="post" role="form" class="form">
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input type="text" name="username" class="form-control" />
                                    </div>
									
									<div class="form-group">
                                        <label>Password</label>
                                        <input type="password" name="password" class="form-control" />
                                    </div>

                                    <button type="submit" name="submit" class="btn btn-success btn-md">Đăng nhập</button>
                                    <a href="/" class="btn btn-danger square-btn-adjust">Back Bstory</a>
                                </form>
								<script type="text/javascript">
									$(document).ready(function(){
										$('.form').validate({
											rules:{
												username:{
													required: true,
												},
												password:{
													required: true,
													minlength: 6,
													maxlength: 15,
												},
											
											},
											messages:{
												username:{
													required: "vui long nhap username",
												},
												password:{
													required: "vui long nhap password",
													minlength: 6,
													maxlength: 15,
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