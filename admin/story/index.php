<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/header.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/util/CheckUserUtil.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/leftbar.php'; ?>
<script>
    document.title = 'Story | VinaEnter Edu';   
</script>
<?php
	//tổng số dòng
	$queryTSD = "SELECT COUNT(*) AS TSD FROM story";
	$resultTSD = $mysqli->query($queryTSD);
	$arTmp = mysqli_fetch_assoc($resultTSD);
	$TSD = $arTmp['TSD'];
	//số truyện trên 1 trang
	$row_count = ROW_COUNT;
	//tổng số trang
	$TST = ceil($TSD/$row_count);
	//trang hiện tại
	$current_page = 1;
	if(isset($_GET['page']))
	{
		$current_page = $_GET['page'];
	}
	//offset
	$offset = ($current_page - 1) * $row_count;
?>
<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2>Quản lý truyện</h2>
            </div>
        </div>
        <!-- /. ROW  -->
        <hr />
		<?php
			if(isset($_GET['msg']))
			{
				echo $_GET['msg'];
			}
		?>
        <div class="row">
            <div class="col-md-12">
                <!-- Advanced Tables -->
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <div class="row">
                                <div class="col-sm-6">
                                    <a href="add.php" class="btn btn-success btn-md">Thêm</a>
                                </div>
                                <div class="col-sm-6" style="text-align: right;">
                                    <form method="post" action="">
                                        <input type="submit" name="search" value="Tìm kiếm" class="btn btn-warning btn-sm" style="float:right" />
                                        <input type="search" class="form-control input-sm" placeholder="Nhập tên truyện" style="float:right; width: 300px;" />
                                        <div style="clear:both"></div>
                                    </form><br />
                                </div>
                            </div>

                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tên truyện</th>
                                        <th>Danh mục</th>
                                        <th>Lượt đọc</th>
                                        <th>Hình ảnh</th>
                                        <th width="160px">Chức năng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
											$query = "SELECT s.*, c.name AS cname FROM story AS s
													  INNER JOIN cat AS c
													  ON s.cat_id = c.cat_id
													  ORDER BY s.story_id DESC
													  LIMIT {$offset}, {$row_count}";
											$ketqua = $mysqli->query($query);
											while($arItem = mysqli_fetch_assoc($ketqua))
											{
												$story_id = $arItem['story_id'];
												$name = $arItem['name'];
												$counter = $arItem['counter'];
												$picture = $arItem['picture'];
												$cname = $arItem['cname'];
                                    ?>
                                    <tr class="gradeX">
                                        <td><?php echo $story_id;?></td>
                                        <td><?php echo $name;?></td>
                                        <td><?php echo $cname;?></td>
                                        <td class="center"><?php echo $counter;?></td>
                                        <td class="center">
										<?php
											if($picture == '')
											{
												echo "Không có ảnh";
											}else
											{
										?>
                                            <img src="/files/<?php echo $picture?>" alt="" height="80px" width="100px" />
										<?php
											}
										?>
										</td>
                                        <td class="center">
                                            <a href="edit.php?id=<?php echo $story_id;?>" title="" class="btn btn-primary"><i class="fa fa-edit "></i> Sửa</a>
                                            <a href="del.php?id=<?php echo $story_id;?>" title="" class="btn btn-danger"><i class="fa fa-pencil"></i> Xóa</a>
                                        </td>
                                    </tr>
                                    <?php 
									} 
									?>
                                </tbody>
                            </table>
                            <div>
                                <div style="text-align: right;">
                                    <div class="dataTables_paginate paging_simple_numbers" id="dataTables-example_paginate">
                                        <ul class="pagination">
                                            <?php
												for($i = 1; $i <= $TST; $i++)
												{
													$active = '';
													if($i == $current_page)
													{
														$active = 'active';
													}
											?>
											<li class="paginate_button <?php echo $active;?>"><a href="index.php?page=<?php echo $i;?>"><?php echo $i;?></a></li>
											<?php
												}
											?>
										</ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!--End Advanced Tables -->
            </div>
        </div>
    </div>

</div>
<!-- /. PAGE INNER  -->
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/footer.php'; ?>