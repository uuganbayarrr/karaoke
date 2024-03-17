<?php
session_start();
include("dbconnection.php");

if(isset($_POST['update'])) {
    $room = mysqli_real_escape_string($con, $_POST['room']);
    $service = mysqli_real_escape_string($con, trim($_POST['service']));
    $time =  mysqli_real_escape_string($con, $_POST['time']);
    $worker = $_SESSION['Name'];
    $type = 0;
    $orderDate = date('Y-m-d H:i:s');

    // 1. Use prepared statement to prevent SQL injection
    $sql_check = "SELECT * FROM Orders WHERE RoomNumber = ? AND OrderDate = ? AND type = ?";
    $stmt_check = mysqli_prepare($con, $sql_check);
    mysqli_stmt_bind_param($stmt_check, "sss", $room, $orderDate, $type);
    mysqli_stmt_execute($stmt_check);
    mysqli_stmt_store_result($stmt_check);
    $num_rows = mysqli_stmt_num_rows($stmt_check);
    mysqli_stmt_close($stmt_check);

    if($num_rows > 0) {
        echo "<script>alert('Энэ өрөөнд энэ цаг дээр хүлээлт байна.');</script>";
    } else {
        $query_service = "SELECT Description, Price FROM service WHERE ServiceID = ?";
        $stmt_service = mysqli_prepare($con, $query_service);
        mysqli_stmt_bind_param($stmt_service, "s", $service);
        mysqli_stmt_execute($stmt_service);
        mysqli_stmt_bind_result($stmt_service, $service_name, $service_price);
        mysqli_stmt_fetch($stmt_service);
        mysqli_stmt_close($stmt_service);
        
    
        // Fetch room price
        $query_room = "SELECT RoomPrice FROM room WHERE RoomNumber = ?";
        $stmt_room = mysqli_prepare($con, $query_room);
        mysqli_stmt_bind_param($stmt_room, "s", $room);
        mysqli_stmt_execute($stmt_room);
        mysqli_stmt_bind_result($stmt_room, $room_price);
        mysqli_stmt_fetch($stmt_room);
        mysqli_stmt_close($stmt_room);

        $total_price = ($room_price * $time) + $service_price;

        // 2. Use prepared statement for INSERT query
        $query = "INSERT INTO Orders (WorkerName, RoomNumber, ServiceName, OrderDate, Qua, Time, TotalAmount, type) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, "ssssdddi", $worker, $room, $service_name, $orderDate, $room_price, $time, $total_price, $type);

        // Execute the statement
        $ret = mysqli_stmt_execute($stmt);

        if($ret) {
            // 3. Update room status using prepared statement
            $status_query = "UPDATE room SET Status = 0 WHERE RoomNumber = ?";
            $stmt_status = mysqli_prepare($con, $status_query);
            mysqli_stmt_bind_param($stmt_status, "s", $room);
            if(mysqli_stmt_execute($stmt_status)) {
                echo "Status updated successfully.";
            } else {
                echo "Error updating record: " . mysqli_error($con);
            }

            echo "<script>alert('Data Inserted');</script>";
            header("location: dashboard.php");
            exit;
        } else {
            echo "<script>alert('Failed to insert data: " . mysqli_error($con) . "');</script>";
        }

        mysqli_stmt_close($stmt);
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

            <?php
// Fetch data from the database for rooms
$sql_room = "SELECT * FROM room WHERE Status=1"; // Change 'room' to your actual table name
$result_room = mysqli_query($con, $sql_room);

// Fetch data from the database for services
$sql_service = "SELECT * FROM service"; // Change 'service' to your actual table name
$result_service = mysqli_query($con, $sql_service);
?>

<form method="post" action="">
    <table width="100%" border="0">
        <!-- Room dropdown select input -->
        <tr>
            <td height="42">Өрөөны дугаар</td>
            <td>
                <select name="room" class="form-control">
                    <?php
                    while ($row = mysqli_fetch_assoc($result_room)) {
                        $Roomnumber = $row['RoomNumber'];
                        $_SESSION['RoomPrice'] = $row['RoomPrice'];
                        echo '<option value="' . $Roomnumber . '">' . $row['RoomNumber'] . '</option>';
                    }
                    ?>
                </select>
            </td>
        </tr>

        <!-- Service dropdown select input -->
        <tr>
            <td height="42">Үйлчилгээ</td>
            <td>
                <select name="service" class="form-control">
                    <?php
                    while ($row = mysqli_fetch_assoc($result_service)) {
                        echo '<option value="' . $row['ServiceID'] . '">' . $row['Description'] . '</option>';
                    }
                    ?>
                </select>
            </td>
        </tr>

        <!-- Number input field -->
        <tr>
            <td height="42">Цаг</td>
            <td><input type="number" name="time" class="form-control"></td>
        </tr>

        <!-- Submit button -->
        <tr>
            <td>&nbsp;</td>
            <td height="42"><button type="submit" name="update" class="btn btn-primary">Бүртгэх</button></td>
        </tr>
    </table>
</form>


<?php
// Close the database connection
mysqli_close($con);
?>

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
