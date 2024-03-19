<?php
session_start();
include("dbconnection.php");
if(isset($_POST['delete_id']) && !empty($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];
    $room = mysqli_real_escape_string($con, $_POST['room']);

    $delete_query = "DELETE FROM orders WHERE OrderID = '$delete_id'";

    $status_query = "UPDATE room SET Status = '1' WHERE RoomNumber = '$room'";
    if(mysqli_query($con, $delete_query)) {
        if(mysqli_query($con, $status_query)) {
            echo "Record deleted successfully. Status updated successfully.";
            header("Location:dashboard.php");
        } else {
            echo "Error updating room status: " . mysqli_error($con);
        }
    } else {
        echo "Error deleting record: " . mysqli_error($con);
    }
}

//add time
if(isset($_POST['add_time']) && !empty($_POST['add_time'])) {
    $add_time_input = mysqli_real_escape_string($con, $_POST['add_time']);
    $time = mysqli_real_escape_string($con, $_POST['time']);
    $time2 = mysqli_real_escape_string($con, $_POST['timee']);
    $price = mysqli_real_escape_string($con, $_POST['qua']);
    $amount = mysqli_real_escape_string($con, $_POST['totalamount']);
    $time = (int)$time;
    $time2 = (int)$time2;
    $price = (float)$price;
    $amount = (float)$amount;

    $add_time = $time + $time2;
    $new_amount = ($price * $time) + $amount;

    $add_query = "UPDATE orders SET time = $add_time, TotalAmount = $new_amount WHERE OrderID = $add_time_input and type=0";
    if(mysqli_query($con, $add_query)) {
        echo "Record updated successfully.";
    } else {
        echo "Error updating record: " . mysqli_error($con);
    }
}

// Check if pay_success is set and not empty
if(isset($_POST['pay_success']) && !empty($_POST['pay_success'])) {
  try {
      $pay_success = mysqli_real_escape_string($con, $_POST['pay_success']);
      $room = mysqli_real_escape_string($con, $_POST['room']);

      // Insert query
      $query = "INSERT INTO payment (orderID, OrderType, WorkerName, Amount, PaymentDate, Status)
                VALUES ('".$pay_success."','Үйлчилгээ', '".$_SESSION['Name']."', '".$_SESSION['TotalAmount']."', Now(), 'success')";

      // Execute query
      // Execute query
      if(mysqli_query($con, $query)) {
        $status_query = "UPDATE room SET Status = 1 WHERE RoomNumber = $room";
        if(mysqli_query($con, $status_query)) {
            echo "Status updated successfully.";
        } else {
            echo "Error updating record: " . mysqli_error($con);
        }
        $type_query = "UPDATE orders SET type = 2 WHERE  OrderID = $pay_success";
        if(mysqli_query($con, $type_query)) {
            echo "Status updated successfully.";
        } else {
            echo "Error updating record: " . mysqli_error($con);
        }
          echo "Inserted successfully.";
      } else {
          throw new Exception("Error executing query: " . mysqli_error($con));
      }
  } catch (Exception $e) {
      echo "Алдаа: " . $e->getMessage();
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
											<a href="order-regist.php"  class="config"></a>
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
                                                        <th>Үйлчилгээ</th>
                                                        <th>Авсан цаг</th>
                                                        <th>Огноо</th>
                                                        <th>Нийт үнэ</th>
                                                        <th>Төлөв</th>
                                                        <th>Үйлдэл</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php $ret=mysqli_query($con,"SELECT * FROM orders WHERE type = 0 OR type = 2");
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
                                                        <form name="abc" action="" method="post">
    <input type="hidden" name="pay_success" value="<?php echo $row['OrderID']; ?>"/>
    <input type="hidden" name="room" value="<?php echo $row['RoomNumber']; ?>"/>
<?php
if($row["type"]==0)
{
?>
        </form>
    <form name="abc" action="" method="post">
        <input type="hidden" name="delete_id" value="<?php echo $row['OrderID']; ?>"/>
    <input type="hidden" name="room" value="<?php echo $row['RoomNumber']; ?>"/>
        <button type="submit" class="btn btn-danger btn-xs btn-mini" onclick="return confirm('Are you sure you want to delete this record?')">Устгах</button>
    </form>
    <form name="abc" action="" method="post">

<input type="hidden" name="add_time" value="<?php echo $row['OrderID']; ?>"/>
<input type="hidden" name="totalamount" value="<?php  echo $row['TotalAmount']; ?>"/>
<input type="hidden" name="timee" value="<?php echo  $row['time']; ?>"/>
<input type="hidden" name="qua" value="<?php  echo $row['Qua']; ?>"/>
<input type="number" name="time"/>
<button type="submit" class="btn btn-primary btn-xs btn-mini">Цаг сунгах</button>
</form>
</td>

                                                    </tr>
                                                    <?php }  } ?>
                                                </tbody>
                                            </table>

                                    </div>  <button id="exportButton">Хэвлэх</button>
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
<script src="assets/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<script src="assets/js/support_ticket.js" type="text/javascript"></script>
<!-- BEGIN CORE TEMPLATE JS -->
<script src="assets/js/core.js" type="text/javascript"></script>
<script src="assets/js/chat.js" type="text/javascript"></script>
<script src="assets/js/demo.js" type="text/javascript"></script>
<script>
	//Too Small for new file - Helps the to tick all options in the table
	$('table .checkbox input').click( function() {
		if($(this).is(':checked')){
			$(this).parent().parent().parent().toggleClass('row_selected');
		}
		else{
		$(this).parent().parent().parent().toggleClass('row_selected');
		}
	});
	// Demo charts - not required
	$('.customer-sparkline').each(function () {
		$(this).sparkline('html', { type:$(this).attr("data-sparkline-type"), barColor:$(this).attr("data-sparkline-color") , enableTagOptions: true  });
	});
</script>
<!-- END CORE TEMPLATE JS -->
</body>
</html>