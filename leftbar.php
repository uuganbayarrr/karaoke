 <!-- BEGIN SIDEBAR -->
  <div class="page-sidebar" id="main-menu">
    <!-- BEGIN MINI-PROFILE -->
    <div class="page-sidebar-wrapper scrollbar-dynamic" id="main-menu-wrapper">
      <div class="user-info-wrapper">
        <div class="profile-wrapper"> <img src="assets/img/user.png"  alt="" data-src="assets/img/user.png" data-src-retina="assets/img/user.png" width="69" height="69" /> </div>
        <div class="user-info">
          <div class="greeting" style="font-size:14px;">Сайн уу?</div>
          <div class="username" style="font-size:12px;">
          <?php echo $_SESSION['Name'];?>

        </div>
          <div class="status" style="font-size:10px;"><a href="#">
            <div class="status-icon green"></div>
            <?php echo $_SESSION['Roll'];?>
            </a></div>
        </div>
      </div>
      <p class="menu-title">REFRESH <span class="pull-right"><a href="javascript:;"><i class="fa fa-refresh"></i></a></span></p>

    <ul>
      <?php
      if($_SESSION['Roll'] == 'reseption'){ ?>

      <li> <a href="dashboard.php"> <i class="icon-custom-home"></i></span>  Захиалга </a>
		    </li>
      <li> <a href="advance.php"><span>
      <i class="fa fa-tasks"></i>
      </span>  Урьдчилсан захиалга </a> </li>

      
      <li><a href="product-order.php"><span class="fa fa-ticket "></span> Захиалга хийх</a></li>
      <li><a href="product.php"><span class="fa fa-user "></span> Бараа</a></li>
      <li><a href="processpay.php"><span class="fa fa-user "></span> Төлөх</a></li>
        <li ><a href="service.php"> <span class="fa fa-tasks"></span> Үйлчилгээ</a></li>
        <li ><a href="room.php"><span class="fa fa-ticket"></span> Өрөө</a></li>
        <li ><a href="pay.php"><span class="fa fa-ticket"></span> Төлбөр</a></li>
		    </li>
        <?php } else {
?>
        <li><a href="orderservice.php"><span class="fa fa-user "></span> Бараа захиалга</a></li>
        <li><a href="product-order.php"><span class="fa fa-mobile "></span> Захиалга хийх</a></li>
        <li><a href="product.php"><span class="fa fa-user "></span> Бараа</a></li>
        <li ><a href="service.php"> <span class="fa fa-tasks"></span> Үйлчилгээ</a></li>
        <li ><a href="room.php"><span class="fa fa-check-circle-o"></span> Өрөө</a></li>
        <!-- <li ><a href="pay.php"><span class="fa fa-ticket"></span> Төлбөр</a></li> -->

    </ul>

    <?php }
?>