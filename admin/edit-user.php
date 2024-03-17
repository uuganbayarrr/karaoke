<?php
session_start();
include("dbconnection.php");
if(isset($_POST['update'])) {
    // Prepare and bind
    $stmt = $con->prepare("UPDATE worker SET name=?, email=?, register=?, address=?, phone=?, roll=?, password=? WHERE workerid = '2'");
    $stmt->bind_param("sssssss", $name, $email, $register, $address, $phone, $roll, $password);

    // Escape user inputs for security to prevent SQL injection
    $name = $_POST['name'];
    $register = $_POST['register'];
    $phone = $_POST['contact'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $roll = $_POST['roll'];
    $password = $_POST['password'];

    // Attempt update query execution
    if($stmt->execute()) {
        echo "<script>alert('Data Updated');</script>";
    } else {
        // If update fails, display the MySQL error message for debugging
        echo "<script>alert('Failed to update data: " . $stmt->error . "');</script>";
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
            <div class="content">
		<div class="page-title">
          <?php $rt=mysqli_query($con,"select * from worker where WorkerID='".$_GET['id']."'");
			  while($rw=mysqli_fetch_array($rt))
			  {?>
			<h3><?php echo $rw['Name'];?>'s Profile</h3>

                        <form name="muser" method="post" action="" enctype="multipart/form-data">

                     <table width="100%" border="0">
  <tr>
    <td height="42">Овог Нэр</td>
    <td><input type="text" name="name" id="name" value="<?php echo $rw['Name'];?>" class="form-control"></td>
  </tr>
  <tr>
    <td height="42">Регистерын дугаар</td>
    <td><input type="text" name="register" id="email" value="<?php echo $rw['Register'];?>" class="form-control" readonly></td>
  </tr>
  <tr>
    <td height="42">Email хаяг</td>
    <td><input type="text" name="email" id="altemail" value="<?php echo $rw['Email'];?>" class="form-control"></td>
  </tr>
  <tr>
    <td height="42">Гар утас</td>
    <td><input type="text" name="contact" id="contact" value="<?php echo $rw['Phone'];?>" class="form-control"></td>
  </tr>
  <tr>
    <td height="42">Нууц үг</td>
    <td><input type="text" name="password" id="contact" value="<?php echo $rw['Password'];?>" class="form-control"></td>
  </tr>
  <tr>
    <td height="42">Үүрэг</td>
    <td><select name="roll" class="form-control">
    <option value="<?php echo $rw['Roll'];?>"><?php echo $rw['Roll'];?></option>
    <option value="reseption">reseption</option>
    <option value="service">service</option>
    </select>

    </td>
  </tr>


  <tr>
    <td height="42">Гэрын хаяг</td>
    <td><textarea name="address" cols="64" rows="4"><?php echo $rw['Address'];?></textarea></td>
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
