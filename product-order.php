<?php
session_start();
include("dbconnection.php");

if (isset($_POST['delete_id']) && !empty($_POST['delete_id'])) {
    $delete_id = mysqli_real_escape_string($con, $_POST['delete_id']);
    $quantity = mysqli_real_escape_string($con, $_POST['quan']);
    $prona = $_POST['prona']; // No need to escape, as we'll use prepared statements

    // Delete the record from productlist table
    $delete_query = "DELETE FROM productlist WHERE ProductNames = ?";

    if ($stmt = mysqli_prepare($con, $delete_query)) {
        mysqli_stmt_bind_param($stmt, "i", $delete_id); // Assuming ProductListID is an integer
        if (mysqli_stmt_execute($stmt)) {
            echo "Record deleted successfully.";
        } else {
            echo "Error deleting record: " . mysqli_error($con);
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "Error preparing delete statement: " . mysqli_error($con);
    }

    // Update the quantity in products table
    $update_query = "UPDATE products SET Quantity = ? WHERE Name = ?";

    if ($stmt = mysqli_prepare($con, $update_query)) {
        mysqli_stmt_bind_param($stmt, "is", $quantity, $prona);
        if (mysqli_stmt_execute($stmt)) {
            // You can perform further actions if needed
        } else {
            echo "Error updating quantity: " . mysqli_error($con);
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "Error preparing update statement: " . mysqli_error($con);
    }
}
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
<style>
    .btn-danger{
padding-left:14px;
    }
    .btn-primary{
padding-left:15px;
    }
</style>
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
											<a href="product-order-regist.php"  class="config"></a>
											<a href="javascript:;" class="remove"></a>
                                        </div>
                                    </div>
                                    <div class="grid-body no-border">

                                            <table class="table table-hover no-more-tables" id="dataTable">
                                                <thead>
                                                    <tr>
                                                        <th>Барааны дугаар</th>
                                                        <th>Захиалгын дугаар</th>
                                                        <th>Бараануудын нэр</th>
                                                        <th>Ажилтан</th>

                                                        <th>Огноо</th>
                                                        <th>Тоо</th>
                                                        <th>Нийт үнэ</th>
                                                        <?php if($_SESSION['Roll'] != "reseption"){?>
                                                        <th>Үйлдэл</th>
                                                        <?php } ?>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php $ret=mysqli_query($con,"select * from productlist");
												while($row=mysqli_fetch_array($ret))
												{
													$_SESSION['ids']=$row['ProductListID'];
												?>
                                                    <tr>

                                                        <td><?php echo $row['ProductListID'];?></td>
                                                        <td><?php echo $row['OrderID'];?></td>
                                                        <td><?php echo $row['ProductNames'];?></td>
                                                        <td><?php echo $row['WorkerName'];?></td>
                                                        <td><?php echo $row['ProductDate'];?></td>
                                                        <td><?php echo $row['Quantity'];?></td>
                                                        <td><?php echo $row['Amount'];?></td> <?php $_SESSION['ProductAmount'] = $row['Amount']; ?>
                                                        <?php
                                                        $query_pay = "SELECT OrderID FROM payment";
                                                        $stmt_room = mysqli_prepare($con, $query_pay);
                                                        mysqli_stmt_execute($stmt_room);
                                                        mysqli_stmt_bind_result($stmt_room, $Order);
                                                        mysqli_stmt_fetch($stmt_room);
                                                        mysqli_stmt_close($stmt_room);
                                                    
                                        if($row['OrderID'] != $Order){    
                                                        if($_SESSION['Roll'] != "reseption"){?>
                                                        <td>
    <form name="abc" action="" method="post">
        <input type="hidden" name="delete_id" value="<?php echo $row['ProductListID']; ?>"/>
        <input type="hidden" name="prona" value="<?php echo $row['ProductNames']; ?>"/>
        <input type="hidden" name="quan" value="<?php echo $row['Quantity']; ?>"/>
        <button type="submit" class="btn btn-danger btn-xs btn-mini" onclick="return confirm('Are you sure you want to delete this record?')">Устгах</button>
    </form>
    <form name="abc" action="" method="post">
        <a href="edit-product-order.php?id=<?php echo $row['ProductListID'];?>" class="btn btn-primary btn-xs btn-mini">Засах</a>
    </form>
    
</td>
<?php }} ?>

                                                    </tr>
                                                    <?php  }?>
                                                </tbody>
                                            </table>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <button id="exportButton">Тайлан гаргах</button> -->

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
<script src="assets/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<script src="assets/js/support_ticket.js" type="text/javascript"></script>
<!-- BEGIN CORE TEMPLATE JS -->
<script src="assets/js/core.js" type="text/javascript"></script>
<script src="assets/js/chat.js" type="text/javascript"></script>
<script src="assets/js/demo.js" type="text/javascript"></script>
<!-- END CORE TEMPLATE JS -->
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
</body>
</html>