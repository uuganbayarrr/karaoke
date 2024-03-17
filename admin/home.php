<?php
session_start();
include("dbconnection.php");
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
    <link href="../assets/plugins/jquery-metrojs/MetroJs.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="../assets/plugins/shape-hover/css/demo.css" />
    <link rel="stylesheet" type="text/css" href="../assets/plugins/shape-hover/css/component.css" />
    <link rel="stylesheet" type="text/css" href="../assets/plugins/owl-carousel/owl.carousel.css" />
    <link rel="stylesheet" type="text/css" href="../assets/plugins/owl-carousel/owl.theme.css" />
    <link href="../assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" media="screen"/>
    <link href="../assets/plugins/jquery-slider/css/jquery.sidr.light.css" rel="stylesheet" type="text/css" media="screen"/>
    <link rel="stylesheet" href="../assets/plugins/jquery-ricksaw-chart/css/rickshaw.css" type="text/css" media="screen" >
    <link rel="stylesheet" href="../assets/plugins/Mapplic/mapplic/mapplic.css" type="text/css" media="screen" >
    <link href="../assets/plugins/boostrapv3/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="../assets/plugins/boostrapv3/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
    <link href="../assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
    <link href="../assets/css/animate.min.css" rel="stylesheet" type="text/css"/>
    <link href="../assets/plugins/jquery-scrollbar/jquery.scrollbar.css" rel="stylesheet" type="text/css"/>
    <link href="../assets/css/style.css" rel="stylesheet" type="text/css"/>
    <link href="../assets/css/responsive.css" rel="stylesheet" type="text/css"/>
    <link href="../assets/css/custom-icon-set.css" rel="stylesheet" type="text/css"/>
    <link href="../assets/css/magic_space.css" rel="stylesheet" type="text/css"/>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/plugins/morris.css" rel="stylesheet">

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
</head>
<body class="">
<?php include("header.php");?>
<div class="page-container row">

    <?php include("leftbar.php");?>

    <div class="clearfix"></div>
    <!-- END SIDEBAR MENU -->
</div>
</div>
<!-- BEGIN PAGE CONTAINER-->
<div class="page-content">
    <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
    <div id="portlet-config" class="modal hide">
        <div class="modal-header">
            <button data-dismiss="modal" class="close" type="button"></button>
            <h3>Widget Settings</h3>
        </div>
        <div class="modal-body"> Widget settings form goes here </div>
    </div>
    <div class="clearfix"></div>
    <div class="content sm-gutter">
        <div class="page-title">
        </div>
        <!-- BEGIN DASHBOARD TILES -->
        <div class="row">
            <div class="col-md-3 col-vlg-3 col-sm-6">
                <div class="tiles green m-b-10">
                    <div class="tiles-body">
                        <div class="controller"> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
                        <div class="tiles-title text-black">Өрөөны тоо</div>
                        <div class="widget-stats">
                            <div class="wrapper transparent">
                                <?php
                                $ov=mysqli_query($con,"select * from room");
                                $num=mysqli_num_rows($ov);
                                $ov1=mysqli_query($con,"select * from room where status=1");
                                $num1=mysqli_num_rows($ov1);
                                ?>
                                <span class="item-title">Нийт өрөө</span> <span class="item-count animate-number semi-bold" data-value="<?php echo $num;?>" data-animation-duration="700">0</span>
                            </div>
                        </div>
                        <div class="widget-stats ">
                            <div class="wrapper last">
                                <?php
                                // Assuming $num11 is defined somewhere else
                                ?>
                                <span class="item-title">Сул өрөө</span> <span class="item-count animate-number semi-bold" data-value="<?php echo $num1;?>" data-animation-duration="700">0</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-vlg-3 col-sm-6">
                <div class="tiles blue m-b-10">
                    <div class="tiles-body">
                        <div class="controller"> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
                        <div class="tiles-title text-black">Бүртгэлтэй ажилчид</div>
                        <div class="widget-stats">
                            <div class="wrapper transparent">
                                <?php
                                $rt=mysqli_query($con,"select * from worker where roll='service'");
                                $rw=mysqli_num_rows($rt);
                                ?>
                                <span class="item-title">Үйлчилгээ</span> <span class="item-count animate-number semi-bold" data-value="<?php echo $rw;?>" data-animation-duration="700">0</span>
                            </div>
                        </div>
                        <div class="widget-stats ">
                            <div class="wrapper last">
                                <?php
                                $utd=date('Y-m-d');
                                $rt1=mysqli_query($con,"select * from worker where roll='reseption'");
                                $rw1=mysqli_num_rows($rt1);
                                ?>
                                <span class="item-title">Угтах</span> <span class="item-count animate-number semi-bold" data-value="<?php echo $rw1;?>" data-animation-duration="700">0</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-vlg-3 col-sm-6">
                <div class="tiles purple m-b-10">
                    <div class="tiles-body">
                        <div class="controller"> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
                        <div class="tiles-title text-black">Захиалга</div>
                        <div class="widget-stats">
                            <div class="wrapper transparent">
                                <?php
                                $qr=mysqli_query($con,"select * from orders");
                                $oq=mysqli_num_rows($qr);
                                ?>
                                <span class="item-title">Нийт</span> <span class="item-count animate-number semi-bold" data-value="<?php echo $oq?>" data-animation-duration="700">0</span>
                            </div>
                        </div>
                        <div class="widget-stats">
                            <div class="wrapper transparent">
                                <?php
                                $qr1=mysqli_query($con,"select * from orders where type=1");
                                $oq1=mysqli_num_rows($qr1);
                                ?>
                                <span class="item-title">Урьдчилсан</span> <span class="item-count animate-number semi-bold" data-value="<?php echo $oq1;?>" data-animation-duration="700">0</span>
                            </div>
                        </div>
                        <div class="widget-stats ">
                            <div class="wrapper last">
                                <?php
                                $qr2=mysqli_query($con,"select * from payment  ");
                                $oq2=mysqli_num_rows($qr2);
                                ?>
                                <span class="item-title">Төлсөн</span> <span class="item-count animate-number semi-bold" data-value="<?php echo $oq2;?>" data-animation-duration="700">0</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


	<!-- Захиалга -->
	<div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="grid simple ">
                                    <div class="grid-title no-border">
                                        	<h4>Бүх захиалга дэлгэрэнгүй мэдээлэл</h4>
                                        <div class="tools">	<a href="javascript:;" class="collapse"></a>
											<a href=""  class="config"></a>
											<a href="javascript:;" class="remove"></a>
                                        </div>
                                    </div>
                                    <div class="grid-body no-border">

                                            <table class="table table-hover no-more-tables" id="dataTable">
                                                <thead>
                                                    <tr>
                                                        <th>Захиалга дугаар</th>
                                                        <th>Захиалга ажилтан</th>
                                                        <th>Захиалсан өрөө</th>
                                                        <th>Захиалга үйлчилгээ үнэ</th>
                                                        <th>Огноо</th>
                                                        <th>Нийт төлбөр</th>
                                                        <th>Төлөв</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php $ret=mysqli_query($con,"select * from orders");
												$cnt=1;
												while($row=mysqli_fetch_array($ret))
												{
													$_SESSION['ids']=$row['OrderID'];
												?>
                                                    <tr>

                                                        <td><?php echo $row['OrderID'];?></td>
                                                        <td><?php echo $row['WorkerName'];?></td>
                                                          <td><?php echo $row['RoomNumber'];?></td>
                                                          <td><?php echo $row['ServiceName'];?></td>
                                                          <td><?php echo $row['OrderDate'];?></td>
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
                                                    </tr>
                                                    <?php  } ?>
                                                </tbody>


                                            </table>
                                            <button id="exportButton">Хэвлэх</button>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
<!-- Захиалга -->
<div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="grid simple ">
                                    <div class="grid-title no-border">
                                        	<h4>   Бүх төлбөрын дэлгэрэнгүй мэдээлэл</h4>
                                        <div class="tools">	<a href="javascript:;" class="collapse"></a>
											<a href=""  class="config"></a>
											<a href="javascript:;" class="remove"></a>
                                        </div>
                                    </div>
                                    <div class="grid-body no-border">

                                            <table class="table table-hover no-more-tables" id="dataTable1">
                                                <thead>
                                                    <tr>
                                                        <th>Төлбөр дугаар</th>
                                                        <th>Захиалга дугаар</th>
                                                        <th>Үнэ</th>
                                                        <th>Огноо</th>
                                                        <th>Төлөв</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php $ret=mysqli_query($con,"select * from payment");
												$cnt=1;
												while($row=mysqli_fetch_array($ret))
												{
													$_SESSION['ids']=$row['PaymentID'];
												?>
                                                    <tr>

                                                        <td><?php echo $row['PaymentID'];?></td>
                                                        <td><?php echo $row['OrderID'];?></td>
                                                        <td><?php echo $row['Amount'];?></td>
                                                          <td><?php echo $row['PaymentDate'];?></td>
                                                          <td><?php echo $row['Status'];?></td>

                                                    </tr>
                                                    <?php  } ?>
                                                </tbody>
                                            </table>
                                            <button id="exportButton1">Хэвлэх</button>

                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>

                </div>

            </div>
				<!-- ЗАХИАЛГА -->
					</div>
                </div>
				<!-- ЗАХИАЛГА -->


</div>










<!-- END CHAT -->
<!-- Scripts -->
<script src="../assets/plugins/jquery-1.8.3.min.js" type="text/javascript"></script>
<script src="../assets/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
<script src="../assets/plugins/boostrapv3/js/bootstrap.min.js" type="text/javascript"></script>
<script src="../assets/plugins/breakpoints.js" type="text/javascript"></script>
<script src="../assets/plugins/jquery-unveil/jquery.unveil.min.js" type="text/javascript"></script>
<script src="../assets/plugins/jquery-block-ui/jqueryblockui.js" type="text/javascript"></script>
<script src="../assets/plugins/jquery-lazyload/jquery.lazyload.min.js" type="text/javascript"></script>
<script src="../assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js" type="text/javascript"></script>
<script src="../assets/plugins/jquery-slider/jquery.sidr.min.js" type="text/javascript"></script>
<script src="../assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="../assets/plugins/pace/pace.min.js" type="text/javascript"></script>
<script src="../assets/plugins/jquery-numberAnimate/jquery.animateNumbers.js" type="text/javascript"></script>
<script src="../assets/plugins/jquery-ricksaw-chart/js/raphael-min.js"></script>
<script src="../assets/plugins/jquery-ricksaw-chart/js/d3.v2.js"></script>
<script src="../assets/plugins/jquery-ricksaw-chart/js/rickshaw.min.js"></script>
<script src="../assets/plugins/jquery-sparkline/jquery-sparkline.js"></script>
<script src="../assets/plugins/skycons/skycons.js"></script>
<script src="../assets/plugins/owl-carousel/owl.carousel.min.js" type="text/javascript"></script>
<script type="../text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
<script src="../assets/plugins/jquery-gmap/gmaps.js" type="text/javascript"></script>
<script src="../assets/plugins/Mapplic/js/jquery.easing.js" type="text/javascript"></script>
<script src="../assets/plugins/Mapplic/js/jquery.mousewheel.js" type="text/javascript"></script>
<script src="../assets/plugins/Mapplic/js/hammer.js" type="text/javascript"></script>
<script src="../assets/plugins/Mapplic/mapplic/mapplic.js" type="text/javascript"></script>
<script src="../assets/plugins/jquery-flot/jquery.flot.js" type="text/javascript"></script>
<script src="../assets/plugins/jquery-flot/jquery.flot.resize.min.js" type="text/javascript"></script>
<script src="../assets/plugins/jquery-metrojs/MetroJs.min.js" type="text/javascript" ></script>
<script src="../assets/js/core.js" type="text/javascript"></script>
<script src="../assets/js/chat.js" type="text/javascript"></script>
<script src="../assets/js/demo.js" type="text/javascript"></script>
<script src="../assets/js/dashboard_v2.js" type="text/javascript"></script>
<script type="text/javascript" src="js/highcharts.js"></script>
<script type="text/javascript" src="js/exporting.js"></script>
<script>
        document.getElementById('exportButton').addEventListener('click', function () {
            var table = document.getElementById('dataTable');
            var html = table.outerHTML.replace(/ /g, '%20');

            // Generate download link
            var downloadLink = document.createElement("a");
            document.body.appendChild(downloadLink);

            downloadLink.href = 'data:application/vnd.ms-excel,' + html;
            downloadLink.download = 'reportorder.xls';
            downloadLink.click();
        });
    </script>
    <script>
        document.getElementById('exportButton1').addEventListener('click', function () {
            var table = document.getElementById('dataTable1');
            var html = table.outerHTML.replace(/ /g, '%20');

            // Generate download link
            var downloadLink = document.createElement("a");
            document.body.appendChild(downloadLink);

            downloadLink.href = 'data:application/vnd.ms-excel,' + html;
            downloadLink.download = 'reportpayment.xls';
            downloadLink.click();
        });
    </script>
<script>
    function printPage() {
        window.print(); // This will open the print dialog of the browser
    }
</script>
</body>
</html>
