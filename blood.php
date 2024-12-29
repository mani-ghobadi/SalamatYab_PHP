<?php
session_start();

$server_name = "localhost";
$username = "root";
$password = "";
$databasename = "Salamat_db";

$conn = new mysqli($server_name, $username, $password, $databasename);
if ($conn->connect_error) {
    die("Connect error: " . $conn->connect_error);
}
if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin'] || !isset($_SESSION['phone'])) {
    echo "<script>alert('ابتدا وارد حساب کاربری خود شوید!'); window.location.href = 'login.php';</script>";
    exit;
}

$phone = $_SESSION['phone'];

$message = '';  
$systolic = null; 
$diastolic = null; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['systolic']) && $_POST['systolic'] !== '') {
        $systolic = intval($_POST['systolic']);
    }
    if (isset($_POST['diastolic']) && $_POST['diastolic'] !== '') {
        $diastolic = intval($_POST['diastolic']); 
    }

    $blood_status = '';
    $message = '';
        if ($systolic !== null) {
            if ($systolic < 90) {
                $blood_status = 'down'; 
                $message = 'فشار خون سیستولیک شما پایین است. لطفاً مراقب وضعیت خود باشید.';
            } elseif ($systolic >= 90 && $systolic <= 120) {
                $blood_status = 'normal'; 
                $message = 'فشار خون سیستولیک شما نرمال است.';
            } elseif ($systolic > 120) {
                $blood_status = 'up'; 
                $message = 'فشار خون سیستولیک شما بالا است. لطفاً مراقب وضعیت خود باشید.';
            }
        }

        if ($diastolic !== null) {
            if ($diastolic < 60) {
                $blood_status = 'down'; 
                $message = 'فشار خون دیاستولیک شما پایین است. لطفاً مراقب وضعیت خود باشید.';
            } elseif ($diastolic >= 60 && $diastolic <= 80) {
                $blood_status = 'normal'; 
                $message = 'فشار خون دیاستولیک شما نرمال است.';
            } elseif ($diastolic > 80) {
                $blood_status = 'up'; 
                $message = 'فشار خون دیاستولیک شما بالا است. لطفاً مراقب وضعیت خود باشید.';
            }
        }

 $stmt = $conn->prepare("UPDATE user SET Bloodsis = ?, Blooddia = ?, Blood = ? WHERE Phone = ?");
  if ($stmt) {
    $stmt->bind_param("ddss", $systolic, $diastolic, $blood_status, $phone);
     $stmt->execute();
    $stmt->close();
  } else {
     echo "خطا در تغییر اطلاعات.";
 }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./pic/health.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./style.css">
    <title>تست فشار خون</title>
</head>

<body dir="rtl">
    <nav class="navbar ">
        <div class="container-fluid shadow border" style="background-color:#89cabf;">
            <div style="height: 80px;">
                <button class="btn text-center px-2 fs-5 mt-3 " style="background-color: #FFA459; margin-right: 40px;" onclick="alerting();"> 
                    <a href="./login.html" class="link-underline link-underline-opacity-0 text-light">ثبت نام/ ورود</a>
                </button>
            </div> 
            <div style="margin-left: 50px;">
                <button class="btn text-center px-2 fs-5 mt-1 " style="background-color: #74bdb1; margin-right: 70px;" onclick="alerting();"> 
                    <a href="./index.html" class="link-underline link-underline-opacity-0 text-light"> صفحه اصلی</a>
                </button> 
                <button class="btn text-center px-2 fs-5 mt-1 " style="background-color: #74bdb1; margin-right: 70px;" onclick="alerting();"> 
                    <a href="./articles.html" class="link-underline link-underline-opacity-0 text-light">مقالات</a>
                </button>                
                <button class="btn text-center px-2 fs-5 mt-1 " style="background-color: #74bdb1; margin-right: 70px;" onclick="alerting();"> 
                    <a href="./Services.html" class="link-underline link-underline-opacity-0 text-light">خدمات</a>
                </button>                
                <button class="btn text-center px-2 fs-5 mt-1 " style="background-color: #74bdb1; margin-right: 70px;" onclick="alerting();"> 
                    <a href="./about.html" class="link-underline link-underline-opacity-0 text-light">درباره ما</a>
                </button> 
                <button class="btn text-center px-2 fs-5 mt-1 " style="background-color: #74bdb1; margin-right: 70px;" onclick="alerting();"> 
                 <a href="accont.php" class="link-underline link-underline-opacity-0 text-light"> حساب کاربری</a>
                </button> 
                
            </div>
            <img src="./pic/health.png" alt="" class="img-fluid">
        </div>
    </nav>

    <div class="container" style="margin-top: 120px; height: auto; width: 800px;">
        <div class="card" style="background-color: #89cabf;">
            <div class="card-body" style="background-color: #89cabf;">
                <h2 class="text-center">تحلیل گر تست فشار خون</h2>
                <img src="./pic/blood-test.png" alt="" style="width: 100px;height: auto; margin-right: 320px;margin-top: 30px;">

                <form method="POST">
                    <div class="container" style="margin-top: 30px;">
                        <div class="row">
                            <div class="col">
                                <label for="systolic"><h5>سیستولیک</h5></label><br>
                                <input type="number" class="form-control" id="systolic" name="systolic" placeholder="100 MMHG" style="direction: rtl;">
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="diastolic"><h5>دیاستولیک</h5></label>
                                    <input type="number" class="form-control" id="diastolic" name="diastolic" placeholder="60 MMHG" style="direction: rtl;">
                                </div>
                            </div>
                        </div>
                    </div>

                    <button style="background-color: #FFA459;" class="buttun-sign" type="submit">
                        <h4 style="margin-top: 0px;">نشون بده!</h4>
                    </button>
                    <br><br>

                    <?php if ($message != ''): ?>
                        <h3 style="color: crimson;"><?php echo $message; ?></h3>
                    <?php endif; ?>
                     <br>
                     <br>
                    <h5 style="color: crimson;">راهنمای استفاده از تحلیلگر:</h5>
                    <p>ابتدا با دستگاه فشار خون سطح فشار خون خود را به دست آورده و مقدار هر کدام (دیاستولیک و سیستولیک) را وارد کنید تا تحلیل سایت برای شما نشان داده شود.</p>
                </form>
            </div>
        </div>
    </div>

    <footer class="text-light text-center p-3 shadow border" style="margin-top: 100px; background-color: #74bdb1;">
        <div class="container">
            <p style="text-align: center;">&copy
