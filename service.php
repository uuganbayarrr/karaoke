<?php
session_start();
//echo $_SESSION['id'];
//$_SESSION['msg'];
include("dbconnection.php");

?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<meta charset="utf-8" />
<title>Караокены газрын үйлчилгээний программ</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<meta content="" name="description" />
<meta content="" name="author" />

<link href="assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" media="screen"/>
<link href="assets/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css" rel="stylesheet" type="text/css"/>
<link href="assets/plugins/boostrapv3/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="assets/plugins/boostrapv3/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
<link href="assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
<link href="assets/css/animate.min.css" rel="stylesheet" type="text/css"/>
<link href="assets/plugins/jquery-scrollbar/jquery.scrollbar.css" rel="stylesheet" type="text/css"/>
<link href="assets/css/style.css" rel="stylesheet" type="text/css"/>
<link href="assets/css/responsive.css" rel="stylesheet" type="text/css"/>
<link href="assets/css/custom-icon-set.css" rel="stylesheet" type="text/css"/>
<!-- END CSS TEMPLATE -->
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="">
<?php include("header.php");?>
<div class="page-container row">
  <?php include("leftbar.php");?>
    <div class="clearfix"></div>
    </div>
  </div>
  <div class="page-content">
    <div id="portlet-config" class="modal hide">
      <div class="modal-header">
        <button data-dismiss="modal" class="close" type="button"></button>
        <h3>Widget Settings</h3>
      </div>
      <div class="modal-body"> Widget settings form goes here </div>
    </div>
    <div class="clearfix"></div>
    <div class="content">
      <ul class="breadcrumb">
        <li>
          <p>Ажилтан</p>
        </li>
        <li><a href="#" class="active">Үйлчилгээ</a></li>
      </ul>
      <div class="page-title"> <i class="icon-custom-left"></i>
        <h3>Үйлчилгээ</h3>
      </div>
      <div class="clearfix"></div>

      <br>
      <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="grid simple ">
                                    <div class="grid-title no-border">
                                        	<h4>Бүх үйлчигээ дэлгэрэнгүй мэдээлэл</h4>
                                        <div class="tools">	<a href="javascript:;" class="collapse"></a>
											<a href="service-regist.php"  class="config"></a>
											<a href="javascript:;" class="remove"></a>
                                        </div>
                                    </div>
                                    <div class="grid-body no-border">

                                            <table class="table table-hover no-more-tables">
                                                <thead>
                                                    <tr>
                                                        <th>үйлчигээ дугаар</th>
                                                        <th>үйлчигээ тайлбар</th>
                                                        <th>үйлчигээ үнэ</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php $ret=mysqli_query($con,"select * from service");
												$cnt=1;
												while($row=mysqli_fetch_array($ret))
												{
													$_SESSION['ids']=$row['ServiceID'];
												?>
                                                    <tr>

                                                        <td><?php echo $row['ServiceID'];?></td>
                                                        <td><?php echo $row['Description'];?></td>
                                                        <td><?php echo $row['Price'];?></td>
                                                    </tr>
                                                    <?php  } ?>
                                                </tbody>
                                            </table>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

					</div>
                </div>
            </div>
<!-- BEGIN CHAT -->

</div>
<!-- END CONTAINER -->
<!-- BEGIN CORE JS FRAMEWORK-->
<script src="assets/plugins/jquery-1.8.3.min.js" type="text/javascript"></script>
<script src="assets/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
<script src="assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="assets/plugins/breakpoints.js" type="text/javascript"></script>
<script src="assets/plugins/jquery-unveil/jquery.unveil.min.js" type="text/javascript"></script>
<script src="assets/plugins/jquery-block-ui/jqueryblockui.js" type="text/javascript"></script>
<!-- END CORE JS FRAMEWORK -->
<!-- BEGIN PAGE LEVEL JS -->
<script src="assets/plugins/pace/pace.min.js" type="text/javascript"></script>
<script src="assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js" type="text/javascript"></script>
<script src="assets/plugins/jquery-numberAnimate/jquery.animateNumbers.js" type="text/javascript"></script>
<script src="assets/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js" type="text/javascript"></script>
<script src="assets/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js" type="text/javascript"></script>
<script src="assets/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<script src="assets/js/support_ticket.js" type="text/javascript"></script>
<!-- BEGIN CORE TEMPLATE JS -->
<script src="assets/js/core.js" type="text/javascript"></script>
<script src="assets/js/chat.js" type="text/javascript"></script>
<script src="assets/js/demo.js" type="text/javascript"></script>
<!-- END CORE TEMPLATE JS -->
</body>
</html>