<?php
session_start();
error_reporting(0);
include("dbconnection.php");

if(isset($_POST['login'])) {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $query = "SELECT * FROM worker WHERE name='$email' AND password='$password' AND roll='admin'";
    $result = mysqli_query($con, $query);
    $num = mysqli_num_rows($result);

    if($num > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['alogin'] = $row['name'];
        $_SESSION['id'] = $row['id'];
        $extra = "home.php";
        echo "<script>window.location.href='".$extra."'</script>";
        exit();
    } else {
        $_SESSION['action1'] = "*Invalid username or password";
        $extra = "index.php";
        echo "<script>window.location.href='".$extra."'</script>";
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<meta charset="utf-8" />
<title>CRM | Admin Login</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<meta content="" name="description" />
<meta content="" name="author" />
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
<style>
  body {
    font-family: 'Roboto', sans-serif;
    background-color: #f9f9f9;
  }
  .login-container {
    margin-top: 50px;
    border-radius: 10px;
    background-color: #fff;
    box-shadow: 0px 0px 20px 0px rgba(0,0,0,0.1);
  }
  .login-container h2 {
    color: #333;
    font-weight: 450;
    font-size: 34px;
    margin-top: 20px;
    text-align: center;
  }
  .login-form {
    padding: 20px;
  }
  .form-label {
    color: #333;
    font-weight: 500;
  }
  .form-control {
    border-radius: 20px;
  }
  .input-with-icon {
    position: relative;
  }
  .input-with-icon i {
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
    color: #ccc;
  }
  .btn-login {
    background-color: #007bff;
    border: none;
    border-radius: 20px;
    color: #fff;
    font-weight: 500;
    transition: background-color 0.3s ease;
  }
  .btn-login:hover {
    background-color: #0056b3;
  }
</style>
</head>
<body>
<div class="container">
  <div class="row justify-content-center login-container">
    <div class="col-md-6">
      <h2>Караокены газрын үйлчилгээний программ</h2>
      <form id="login-form" class="login-form" action="" method="post">
        <p style="color: #F00"><?php echo $_SESSION['action1'];?><?php echo $_SESSION['action1']="";?></p>
        <div class="form-group">
          <label class="form-label"> Хэрэглэгчийн нэр</label>
          <div class="input-with-icon">
            <input type="text" name="email" id="txtusername" class="form-control">
            <i class="fas fa-user"></i>
          </div>
        </div>
        <div class="form-group">
          <label class="form-label">Нууц үг</label>
          <div class="input-with-icon">
            <input type="password" name="password" id="txtpassword" class="form-control">
            <i class="fas fa-lock"></i>
          </div>
        </div>
        <div class="form-group">
          <button class="btn btn-primary btn-login btn-block" name="login" type="submit">Нэвтрэх</button>
        </div>
      </form>
    </div>
  </div>
</div>
<footer class="footer">
  <div class="container">
    <span>&copy; 2024 CRM Admin Panel</span>
  </div>
</footer>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
