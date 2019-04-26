<?php
  session_start();
  define("IN_SITE", true);
    include_once('functions.php');
    include_once('session.php');

?>
<!DOCTYPE html>
<html>
   <head>
     <title>Thu vien dien tu DHBKDN</title>
     <meta name="keyword" content="thu vien dien tu, thu vien online">
     <meta name="author" content="thach">
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" type="text/css" href="css/style.css">
   </head>
<body>
<div class="header">
    <div class="wrapper">
    <div class="header1">
      <img src="<?php echo 'images/logo.png';?>" alt="logo bachkhoa" >
      <h2>Thu vien dien tu bach khoa da nang</h2>
      <div id="user">
      <h3>Xin chao <?php echo get_user_name();?> </h3>
      <a href="logout.php">Logout</a>
    </div><!--end user-->
  </div><!--end header1-->
  <div class="header2">

      <a href="#">Trang chu</a>
      <a href="#">Chuyen Nganh</a>
      <a href="#">Tac gia</a>
      <a href="#">Nha xuat ban</a>
      <a href="#">Tu sach cua ban</a>
      <?php if(is_admin()) {?>
        <a href="#">Thanh vien</a>
        <?php } ?>
    </ul>
  </div><!--end header2-->
  <div id="Search">
 <form method="get" action="#">
   <input id="i-search" type="search" name="search" placeholder="search..." >
   <select name="cars">
     <option value="bookname">Ten sach</option>
     <option value="composer">Tac gia</option>
     <option value="major">Chuyen nganh</option>
   </select>
     </datalist>
   <input type="submit" value="tim kiem" >
 </from>

    </div><!--end s-->
  </div><!--end wrapper-->
</div><!--end header-->
<div class="contain">
  <div class="wrapper">
    <div class="slider_book">
      <h2>this section for slider</h2>
      <embed src="example.pdf">
    </div><!-- this section for new book -->
    <div class="topbook">
      <h3>Sach duoc xem nhieu</h3>
      <?php $tenbook= get_ten_books();
        foreach ($tenbook as $books) {?>
        <div id="topBook">
        <a href="#"><?php echo $book['title'];?>
          <cite><?php echo $book['compser']?></cite>
          <site>
        </div><!--end topbook-->
        <?php } ?>
    </div>

    <div class="showbook">

      <div class="random_books">
      <ul>
        <li><a href="#">KHOA HOC</a></li>
        <li><a href="#">GIAO TRINH</a></li>
        <li><a href="#">TIENG ANH</a></li>
        <li><a href="#">CAC TAI LIEU NEN DOC</a></li>
      </ul>
    </div><!--end random_book-->
  </div><!--end showbook-->
 </div><!--end wrapper-->
</div><!-- end contain-->
  <footer>
    <div class="wrapper">
      <div class="DHBK">
        <h4>Dai hoc bach khoa</h4>
        <ul>
          <li><a href="#">Trang DUT</a></li>
          <li><a href="#">replace anything here</a></li>
          <li><a href="#">replace anything here</a></li>
          <li><a href="#">replace anything here</a></li>
          <li><a href="#">replace anything here</a></li>
        </ul>
      </div><!--end DHBK-->
      <div class="connect">
        <ul>
          <li><a href="#">Facebook</a></li>
          <li><a href="#">twitter</a></li>
          <li><a href="#">Google+</a></li>
          <li><a href="#">wawd</a></li>
          <li><a href="#">awdwd</a></li>
        </ul>
      </div><!--end connect-->
    </div><!--end wrapper-->
  </footer>
</body>

</html>
