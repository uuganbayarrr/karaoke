<?php
session_start();
include("dbconnection.php");

if(isset($_POST['update'])) {
    // Escape user inputs for security to prevent SQL injection
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $register = mysqli_real_escape_string($con, $_POST['register']);
    $contact = mysqli_real_escape_string($con, $_POST['contact']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $address = mysqli_real_escape_string($con, $_POST['address']);
    $roll = mysqli_real_escape_string($con, $_POST['roll']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    // Attempt insert query execution
    $query = "INSERT INTO worker (name, email, register, address, phone, roll, password)
              VALUES ('$name', '$email', '$register', '$address', '$contact', '$roll', '$password')";
    $ret = mysqli_query($con, $query);

    if($ret) {
      header("manage-user.php");
        echo "<script>alert('Data Inserted');</script>";
    } else {
        // If insertion fails, display the MySQL error message for debugging
        echo "<script>alert('Failed to insert data: " . mysqli_error($con) . "');</script>";
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



                        <form name="muser" method="post" action="" enctype="multipart/form-data">

                     <table width="100%" border="0">
  <tr>
    <td height="42">Овог нэр</td>
    <td><input type="text" name="name" id="name" class="form-control"></td>
  </tr>
  <tr>
    <td height="42">Регистерийн дугаар</td>
    <td><input type="text" name="register" id="email"  class="form-control"></td>
  </tr>
  <tr>
    <td height="42">И-мейл</td>
    <td><input type="text" name="email" id="altemail"  class="form-control"></td>
  </tr>
  <tr>
    <td height="42">Гар утас</td>
    <td><input type="text" name="contact" id="contact"  class="form-control"></td>
  </tr>
  <tr>
  <tr>
    <td height="42">Нууц үг</td>
    <td><input type="text" name="password" id="contact"  class="form-control"></td>
  </tr>
  <tr>
    <td height="42">Үүрэг</td>
    <td><select name="roll" class="form-control">
      <option value="reseption">Угтах</option>
      <option value="service">Үйлчилгээ</option>
    </select>
    </td>
  </tr>
  <tr>
    <td height="42">Гэрын хаяг</td>
    <td><textarea name="address" cols="64" rows="4"></textarea></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td height="42">
                          <button type="submit" name="update" class="btn btn-primary">Бүртгэх</button></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

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