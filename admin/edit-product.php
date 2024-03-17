<?php
session_start();
include("dbconnection.php");

if(isset($_POST['update'])) {
    if(isset($_POST['quantity'])) { // Check if 'quantity' index is set
        $name = mysqli_real_escape_string($con, $_POST['name']);
        $price = mysqli_real_escape_string($con, $_POST['price']);
        $quantity = mysqli_real_escape_string($con, $_POST['quantity']);
        $id = intval($_GET['id']); // Sanitize the ID

        $query = "UPDATE products SET Name='$name', Price='$price', Quantity='$quantity' WHERE ProductID='$id'";
        $ret = mysqli_query($con, $query);
        if($ret) {
            echo "<script>alert('Data Updated');</script>";
        } else {
            echo "<script>alert('Failed to update data: " . mysqli_error($con) . "');</script>";
        }
    } else {
        echo "<script>alert('Quantity not set');</script>";
    }
}
?>


<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<meta charset="utf-8" />
<title> Караокены газрын үйлчилгээний программ</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<meta content="" name="description" />
<meta content="" name="author" />
<link href="../assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" media="screen"/>
<link href="../assets/plugins/boostrapv3/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="../assets/plugins/boostrapv3/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
<link href="../assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
<link href="../assets/css/animate.min.css" rel="stylesheet" type="text/css"/>
<link href="../assets/plugins/jquery-scrollbar/jquery.scrollbar.css" rel="stylesheet" type="text/css"/>
<link href="../assets/css/style.css" rel="stylesheet" type="text/css"/>
<link href="../assets/css/responsive.css" rel="stylesheet" type="text/css"/>
<link href="../assets/css/custom-icon-set.css" rel="stylesheet" type="text/css"/>
</head>
<body class="">
<?php include("header.php");?>
<div class="page-container row">

      <?php include("leftbar.php");?>

      <div class="clearfix"></div>
      <!-- END SIDEBAR MENU -->
    </div>
  </div>
    <div class="page-content">
        <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
            <div id="portlet-config" class="modal hide">
                <div class="modal-header">
                    <button data-dismiss="modal" class="close" type="button"></button>
                     <h3>Widget Settings</h3>

                </div>
                <div class="modal-body">Widget settings form goes here</div>
            </div>
            <div class="clearfix"></div>
            <div class="content">
		<div class="page-title">
          <?php $rt=mysqli_query($con,"select * from products where ProductID='".$_GET['id']."'");
			  while($rw=mysqli_fetch_array($rt))
			  {?>
			<h2><span style="color: black; background:orange;">
      <?php echo htmlspecialchars($rw['Name']);?>
      </span>  барааны мэдээлэл</h2>

                        <form name="muser" method="post" action="" enctype="multipart/form-data">

                     <table width="100%" border="0">


  <tr>
    <td height="42">Барааны нэр</td>
    <td><input type="text" name="name" id="altemail" value="<?php echo htmlspecialchars($rw['Name']);?>" class="form-control"></td>
  </tr>
  <tr>
    <td height="42">Барааны үнэ</td>
    <td><input type="text" name="price" id="altemail" value="<?php echo htmlspecialchars($rw['Price']);?>" class="form-control"></td>
  </tr>
  <tr>
    <td height="42">Барааны тоо</td>
    <td><input type="text" name="quantity" id="altemail" value="<?php echo htmlspecialchars($rw['Quantity']);?>" class="form-control"></td>

  </tr>
  <tr>
    <td>&nbsp;</td>
    <td height="42">
                          <button type="submit" name="update" class="btn btn-primary">Өөрчлөх</button></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<?php } ?>
</form>
</div>
  </div>
  </div>
</div>
 </div>
<script src="../assets/plugins/jquery-1.8.3.min.js" type="text/javascript"></script>
<script src="../assets/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
<script src="../assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="../assets/plugins/breakpoints.js" type="text/javascript"></script>
<script src="../assets/plugins/jquery-unveil/jquery.unveil.min.js" type="text/javascript"></script>
<script src="../assets/plugins/jquery-block-ui/jqueryblockui.js" type="text/javascript"></script>
<script src="../assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js" type="text/javascript"></script>
<script src="../assets/plugins/pace/pace.min.js" type="text/javascript"></script>
<script src="../assets/plugins/jquery-numberAnimate/jquery.animateNumbers.js" type="text/javascript"></script>
<script src="../assets/js/core.js" type="text/javascript"></script>
<script src="../assets/js/chat.js" type="text/javascript"></script>
<script src="../assets/js/demo.js" type="text/javascript"></script>

</body>
</html>
