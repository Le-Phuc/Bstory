<?php include_once $_SERVER['DOCUMENT_ROOT'].'/templates/bstory/inc/header.php'; ?>
<div class="content_resize">
  <div class="mainbar">
    <div class="article">
      <h2><span>Liên hệ</span></h2>
      <div class="clr"></div>
      <p>Nếu có thắc mắc hoặc góp ý, vui lòng liên hệ với chúng tôi theo thông tin dưới đây.</p>
    </div>
    <div class="article">
      <h2>Form liên hệ</h2>
      <div class="clr"></div>
      <?php
		if(isset($_GET['msg']))
		{
			echo $_GET['msg'];
		}
		if(isset($_POST['submit']))
		{
			$name = $_POST['name'];
			$email = $_POST['email'];
			$website = $_POST['website'];
			$message = $_POST['message'];
			$query = "INSERT INTO contact(name, email, website, content)
					  VALUES ('{$name}','{$email}','{$website}','{$message}')";
			$ketqua = $mysqli->query($query);
			if($ketqua)
			{
				header("location:contact.php?msg=Gửi liên hệ thành công");
			}else
			{
				echo "Có lỗi khi gửi liên hệ";
			}
		}
	  ?>
      <form action="" method="post" id="sendemail" class="contact-form">
        <ol>
          <li>
            <label for="name">Họ tên</label>
            <input id="name" name="name" class="text"/>
          </li>
          <li>
            <label for="email">Email</label>
            <input id="email" name="email" class="text" />
          </li>
          <li>
            <label for="website">Website</label>
            <input id="website" name="website" class="text" />
          </li>
          <li>
            <label for="message">Nội dung</label>
            <textarea id="message" name="message" rows="8" cols="50"></textarea>
          </li>
          <li>
            <input type="submit" name="submit" id="imageField" src="" class="send" value="Gửi" />
            <div class="clr"></div>
          </li>
        </ol>
      </form>
      <script type="text/javascript">
        $(document).ready(function(){
          $('.contact-form').validate({
            rules:{
              name:{
                required: true,
              },
              email:{
                required: true,
              },
              website:{
                required: true,
              },
              message:{
                required: true,
              },
                      
            },
            messages:{
              name:{
                required: "vui long nhap ho ten",
              },
              email:{
                required: "vui long nhap email",
              },
              website:{
                required: "vui long nhap website",
              },
              message:{
                required: "vui long nhap noi dung",
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
  <div class="clr"></div>
</div>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/bstory/inc/footer.php'; ?>
