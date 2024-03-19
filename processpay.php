<?php
session_start();
require_once 'dbconnection.php'; 
$status_options = array("Амжилттай", "Цуцалсан"); 
if(isset($_POST['payit'])) {
    $order_id = isset($_POST['order_id']) ? $_POST['order_id'] : null;
    $product_id = isset($_POST['productid']) ? $_POST['productid'] : null;
    $amount = isset($_POST['amount']) ? $_POST['amount'] : null;
    $room = isset($_POST['room']) ? $_POST['room'] : null;
    $status = isset($_POST['status']) ? $_POST['status'] : null;
    $worker_name = isset($_SESSION['Name']) ? $_SESSION['Name'] : null;
    if($order_id !== null && $product_id !== null && $amount !== null && $status !== null && $worker_name !== null) {
        $sql = "INSERT INTO payment (OrderID, WorkerName, Amount, PaymentDate, Status) VALUES (?, ?, ?, NOW(), ?)";
        $stmt = mysqli_prepare($con, $sql);
        if($stmt) {
            mysqli_stmt_bind_param($stmt, "isds", $order_id, $worker_name, $amount, $status);
            if(mysqli_stmt_execute($stmt)) {
                echo "Төлсөн.";
                $order_status_query = "UPDATE orders SET type = 2 WHERE OrderID = ?";
                $stmt_order_status = mysqli_prepare($con, $order_status_query);
                mysqli_stmt_bind_param($stmt_order_status, "i", $order_id);
                if($stmt_order_status) {
                    if(mysqli_stmt_execute($stmt_order_status)) {
                        echo "Order status updated successfully.";
                        mysqli_stmt_close($stmt_order_status);
            
                        // Update room status
                        $room_status_query = "UPDATE room SET Status = 1 WHERE RoomNumber = ?";
                        $stmt_room_status = mysqli_prepare($con, $room_status_query);
                        mysqli_stmt_bind_param($stmt_room_status, "i", $room);
            
                        if($stmt_room_status) {
                            // Bind room number parameter
            
                            // Execute the statement
                            if(mysqli_stmt_execute($stmt_room_status)) {
                                echo "Room status updated successfully.";
                            } else {
                                echo "Error updating room record: " . mysqli_error($con);
                            }
                            mysqli_stmt_close($stmt_room_status);
                        } else {
                            echo "Error: Unable to prepare room status update SQL statement.";
                        }
                    } else {
                        echo "Error updating order record: " . mysqli_error($con);
                    }
                } else {
                    echo "Error: Unable to prepare order status update SQL statement.";
                }
            
                header("Location: processpay.php");
            } else {
                echo "Error executing statement: " . mysqli_error($con);
            }
            

            // Close payment statement
            mysqli_stmt_close($stmt);
        } else {
            echo "Error: Unable to prepare payment SQL statement.";
        }
    } else {
        echo "Error: Some form data is missing.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<meta charset="utf-8" />
<title>Karaoke</title>
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
        <li><a href="#" class="active">Төлбөр</a></li>
      </ul>
      <div class="page-title"> <i class="icon-custom-left"></i>
        <h3>Төлбөр төлөх</h3>
      </div>
      <div class="clearfix"></div>
      <br>
      <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="grid simple ">
                                    <div class="grid-title no-border">
                                        	<h4>Бүх төлбөрын дэлгэрэнгүй мэдээлэл</h4>
                                        <div class="tools">	<a href="javascript:;" class="collapse"></a>
											<a href="product-regist.php"  class="config"></a>
											<a href="javascript:;" class="remove"></a>
                                        </div>
                                    </div>
                                    <div class="grid-body no-border">
                                    <form method="get" action="">
    <input type="text" name="search" placeholder="Захиалга хайх">
    <input type="submit" value="хайх">
</form>
<?php

$sql1 = "SELECT * FROM payment";
$result = mysqli_query($con, $sql1);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    if (isset($_GET['search']) && $_GET['search'] != $row['OrderID']) {
        $search = $_GET['search'];
  // Prepare a SQL statement to search for orders and their associated product list items
  $sql = "SELECT *, SUM(Amount) AS Amount
          FROM orders
          INNER JOIN productlist ON orders.OrderID = productlist.OrderID
          WHERE orders.OrderID LIKE '%$search%' OR productlist.ProductNames LIKE '%$search%'
          GROUP BY orders.OrderID";

  // Execute the SQL statement
  $result = $con->query($sql);

  // Display the search results
  if ($result->num_rows > 0) {
      echo "<h2>Search Results:</h2>";
      while($row = $result->fetch_assoc()) {
          // Calculate the total amount to be paid
          if($search !=  $row["OrderID"] ){

          
          $allpay = $row["TotalAmount"] + $row["Amount"];

          echo "<p><strong>Захиалгын дугаар:</strong> " . $row["OrderID"] .
           "<br><strong>Авсан цаг:</strong> " . $row["time"] .
           "<br><strong>Үйлчилгээ үнэ:</strong> " . $row["TotalAmount"] .
           "<br><strong>Барааны үнэ:</strong> " . $row["Amount"] .
           "<br><strong>Нийт:</strong> " . $allpay .
           "</p>";
        } 
        // else {
        //     echo "<h1 style='color : red; background-color : black;'>Tulugdsun tulbur</h1>";
        // }
?>
<form action="" method="post">
    <input type="hidden" name="order_id" value="<?= $row["OrderID"] ?>">
    <input type="hidden" name="room" value="<?= $row["RoomNumber"] ?>">
    <input type="hidden" name="productid" value="<?= $row['ProductListID'] ?>">
    <input type="hidden" name="amount" value="<?= $allpay ?>">
    <label for="status">Төлөв:</label>
    <select name="status" id="status">
        <?php foreach($status_options as $status_option): ?>
            <option value="<?= $status_option ?>"><?= $status_option ?></option>
        <?php endforeach; ?>
    </select>
    <input type="submit" name="payit" value="Төлсөн">
</form>
          <?php

      }
  } else {
      echo "Хайсан захиалга алга.";
  }
}
}
?>


                                    </div>
                                </div>
                    </div>
                    <!-- <button id="exportButton">Хэвлэх</button> -->
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
<!-- BEGIN CORE TEMPLATE JS -->
<script src="assets/js/core.js" type="text/javascript"></script>
<script src="assets/js/chat.js" type="text/javascript"></script>
<script src="assets/js/demo.js" type="text/javascript"></script>
<!-- END CORE TEMPLATE JS -->
</body>
</html>