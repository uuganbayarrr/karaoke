<?php
session_start();
include("dbconnection.php"); // Include database connection script
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<meta charset="utf-8" />
<title>Караоке</title>
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
        <li><a href="#" class="active">Захиалга</a></li>
      </ul>
      <div class="page-title"> <i class="icon-custom-left"></i>
        <h3>Захиалга харах</h3>
      </div>
      <div class="clearfix"></div>
      <br>
      <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="grid simple ">
                                    <div class="grid-title no-border">
                                        	<h4>Бүх захиалга дэлгэрэнгүй мэдээлэл</h4>
                                        <div class="tools">	<a href="javascript:;" class="collapse"></a>
											<!-- <a href="advance-regist.php"  class="config"></a> -->
											<a href="javascript:;" class="remove"></a>
                                        </div>
                                    </div>
                                    <div class="grid-body no-border">

                                            <table class="table table-hover no-more-tables" id="dataTable">
                                                <thead>
                                                    <tr>
                                                        <th>Захиалга дугаар</th>
                                                        <th>Захиалга авсан</th>
                                                        <th>Өрөө</th>
                                                        <th>утас</th>
                                                        <th>Үйлчилгээ</th>
                                                        <th>Авсан цаг</th>
                                                        <th>Огноо</th>
                                                        <th>Нийт үнэ</th>
                                                        <th>Төлөв</th>
                                                        <th>Үйлдэл</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php $ret=mysqli_query($con,"select * from orders where type=0");
												$cnt=1;
												while($row=mysqli_fetch_array($ret))
												{
													$_SESSION['ids']=$row['OrderID'];
												?>
                                                    <tr>

                                                        <td><?php echo $row['OrderID'];?></td>
                                                        <td><?php echo $row['WorkerName'];?></td>
                                                        <td><?php echo $row['RoomNumber'];?></td>
                                                        <td><?php echo $row['userphone'];?></td>
                                                        <td><?php echo $row['ServiceName'];?></td>
                                                        <td><?php echo $row['time'];?></td>
                                                        <td><?php echo $row['OrderDate'];?></td> <?php $_SESSION['TotalAmount'] = $row['TotalAmount']; ?>
                                                        <td><?php echo $row['TotalAmount'];?></td>
                                                        <td>
                                                        <?php
                                                         if($row['type'] == 0){
                                                            echo "Идэвхтэй";
                                                          }elseif ($row['type'] == 1) {
                                                            echo "Урьдчилсан";
                                                         } else {
                                                            echo "Дууссан";
                                                         }
                                                        ?>
                                                    </td>
                                                        <td>
                                                            <!-- form -->
                                                            <form name="abc" action="" method="post">
                                                             <a href="product-order-regist.php?id=<?php echo $row['OrderID'];?>" class="btn btn-primary btn-xs btn-mini">Бараа</a>
                                                            </form>
                                                    </tr>
                                                    <?php  } ?>
                                                </tbody>
                                            </table>
                                    </div>
    <button id="exportButton">Тайлан гаргах</button>

                                </div>
                            </div>
                        </div>
                    </div>

					</div>
                </div>
            </div>
            <!-- END PAGE -->
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
<script src="assets/plugins/jquexry-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<script src="assets/js/support_ticket.js" type="text/javascript"></script>
<!-- BEGIN CORE TEMPLATE JS -->
<script src="assets/js/core.js" type="text/javascript"></script>
<script src="assets/js/chat.js" type="text/javascript"></script>
<script src="assets/js/demo.js" type="text/javascript"></script>
<script>
        document.getElementById('exportButton').addEventListener('click', function () {
            var table = document.getElementById('dataTable');
            var html = table.outerHTML.replace(/ /g, '%20');

            // Generate download link
            var downloadLink = document.createElement("a");
            document.body.appendChild(downloadLink);

            downloadLink.href = 'data:application/vnd.ms-excel,' + html;
            downloadLink.download = 'table.xls';
            downloadLink.click();
        });
    </script>
<!-- END CORE TEMPLATE JS -->
</body>
</html>