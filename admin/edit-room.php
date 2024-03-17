<?php
session_start();
include("dbconnection.php");

if(isset($_POST['update'])) {
    $number = mysqli_real_escape_string($con, $_POST['number']);
    $capacity = mysqli_real_escape_string($con, $_POST['capacity']);
    $type = isset($_POST['roomtype']) ? mysqli_real_escape_string($con, $_POST['roomtype']) : ''; // Check if 'roomtype' is set
    $state = isset($_POST['state']) ? mysqli_real_escape_string($con, $_POST['state']) : ''; // Check if 'state' is set
    $status = isset($_POST['state']) ? mysqli_real_escape_string($con, $_POST['status']) : ''; // Check if 'state' is set

    $query = "UPDATE room SET RoomNumber='$number', Capacity='$capacity', RoomType='$type', RoomPrice='$state',Status='$status' WHERE RoomID='".$_GET['id']."'";
    $ret = mysqli_query($con, $query);

    if($ret) {
        echo "<script>alert('Data Updated');</script>";
    } else {
        echo "<script>alert('Failed to update data: " . mysqli_error($con) . "');</script>";
    }
}

$room_id = $_GET['id'];
$rt = mysqli_query($con, "SELECT * FROM room WHERE RoomID='$room_id'");
$rw = mysqli_fetch_array($rt);
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
          <?php $rt=mysqli_query($con,"select * from room where RoomID='".$_GET['id']."'");
			  while($rw=mysqli_fetch_array($rt))
			  {?>
			<h2><span style="color: black; background:orange;">
      <?php echo $rw['RoomNumber'];?>
      </span> дугаартай өрөөны мэдээлэл</h2>

                        <form name="muser" method="post" action="" enctype="multipart/form-data">

                     <table width="100%" border="0">
                     <tr>
    <td height="42">Өрөөны дугаар</td>
    <td><input type="text" name="number" id="name" value="<?php echo $rw['RoomNumber'];?>" class="form-control"></td>
  </tr>
  <tr>
    <td height="42">Өрөөны багтаамж</td>
    <td><input type="text" name="capacity" id="name" value="<?php echo $rw['Capacity'];?>" class="form-control"></td>
  </tr>
  <tr>
    <td height="42">Өрөөны төрөл</td>
    <td><input type="text" name="roomtype" class="form-control" value="<?php echo $rw['RoomType'];?>"></td>
  </tr>
  <tr>
    <td height="42">Өрөөны үнэ</td>
    <td><input type="text" name="state" id="altemail" value="<?php echo $rw['RoomPrice'];?>" class="form-control"></td>
  </tr>
  <tr>
    <td height="42">Өрөөны төлөв</td>
    <td><input type="text" name="status" id="altemail" value="<?php echo $rw['Status'];?>" class="form-control"></td>
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