<?php
session_start();
include("dbconnection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    try {
        // Retrieve form data
        $name = $_POST['name'];
        $price = $_POST['price'];
        $proid = $_POST['proid'];
        $quantity = $_POST['quantity'];
        $workerName = $_SESSION['Name'];
        $orderid = $_GET['id'];

        // Update product quantity
        $ret1 = mysqli_query($con, "SELECT * FROM products WHERE ProductID = '$proid'");
        while ($row = mysqli_fetch_array($ret1)) {
            $rq = $row['Quantity'];
            $rq = $rq - $quantity;
            $query = "UPDATE products SET Quantity='$rq' WHERE ProductID ='$proid'";
            mysqli_query($con, $query);
        }

        // Calculate total price
        $price = $price * $quantity;

        // Insert into productlist table
        $sql = "INSERT INTO productlist (ProductNames, OrderID, WorkerName, ProductDate, Quantity, Amount) VALUES ('$name','$orderid', '$workerName', NOW(), '$quantity', '$price')";
        if (mysqli_query($con, $sql)) {
            header("location:product-order.php");
            echo "Record inserted successfully";
        } else {
            throw new Exception("Error inserting record: " . mysqli_error($con));
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    } finally {
        // Close the database connection
        mysqli_close($con);
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
<body class="">
<?php include("header.php");?>
<div class="page-container row">
  <?php include("leftbar.php");?>
    <div class="clearfix"></div>
    </div>
  </div>
  <div class="page-content">
    <div class="content">
        <ul class="breadcrumb">
            <li>
                <p>Ажилтан</p>
            </li>
            <li><a href="#" class="active">Захиалга</a></li>
            <li><a href="#" class="active">Үйлчилгээ захиалга</a></li>
        </ul>
        <div class="clearfix"></div>
        <div class="page-title">
            <h1>Үйлчилгээ захиалга</h1>
<div class="container-fluid mt-3">
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <?php
                $query1 = "SELECT * FROM products";
$result1 = mysqli_query($con, $query1);

while ($row = mysqli_fetch_array($result1)) {
?>
    <div class="col-md-4 mb-3">
        <form method="post" action="">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><?= $row['Name']; ?></h5>
                    <p class="card-text"><?= number_format($row['Price'],2); ?>₮</p>
                    <input type="hidden" name="name" value="<?= $row['Name'] ?>">
                    <input type="hidden" name="proid" value="<?= $row['ProductID'] ?>">
                    <input type="hidden" name="price" value="<?= $row['Price'] ?>">
                    <input type="number" name="quantity" value="1" class="form-control mb-2" max="<?= $row['Quantity'] ?>">
                    <button type="submit" name="submit" class="btn btn-warning btn-block">Бараа захиалах</button>
                </div>
            </div>
        </form>
    </div>
<?php
}
// Close the database connection
mysqli_close($con);
?>
                </div>
            </div>
    </div>
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
