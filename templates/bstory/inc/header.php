<?php
	ob_start();
	require_once $_SERVER['DOCUMENT_ROOT'].'/util/DatabaseConnectUtil.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/util/ConstantUtil.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/util/Utf8ToLatinUtil.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>BStory | VinaEnter Edu</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/templates/bstory/css/style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="/templates/bstory/css/coin-slider.css" />
<script src="/templates/admin/assets/js/jquery-1.10.2.js"></script>
<script src="/library/jquery.validate.js"></script>
<script type="text/javascript" src="/templates/bstory/js/script.js"></script>
<script type="text/javascript" src="/templates/bstory/js/coin-slider.min.js"></script>
</head>
<body>
<div class="main">
  <div class="header">
    <div class="header_resize">
      <div class="menu_nav">
        <ul>
            <li><a href="/"><span>Trang chủ</span></a></li>
            <li><a href="lien-he"><span>Liên hệ</span></a></li>
            <li><a href="/admin/auth/logout.php"><span>Đăng nhập Admin</span></a></li>
        </ul>
      </div>
      <div class="logo">
        <h1><a href="/">BStory <small>Dự án khóa PHP tại VinaEnter Edu</small></a></h1>
      </div>
      <div class="clr"></div>
      <div class="slider">
        <div id="coin-slider"> <a href="#"><img src="/templates/bstory/images/slide1.jpg" width="940" height="310" alt="" /> </a> <a href="#"><img src="/bstory/templates/bstory/images/slide2.jpg" width="940" height="310" alt="" /> </a> <a href="#"><img src="/bstory/templates/bstory/images/slide3.jpg" width="940" height="310" alt="" /> </a> </div>
        <div class="clr"></div>
      </div>
      <div class="clr"></div>
    </div>
  </div>
  <div class="content">