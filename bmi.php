<?php
session_start();

$server_name = "localhost";
$username = "root";
$password = "";
$databasename = "Salamat_db";

$conn = new mysqli($server_name, $username, $password, $databasename);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin'] || !isset($_SESSION['phone'])) {
    echo "<script>alert('ابتدا وارد حساب کاربری خود شوید!'); window.location.href = 'login.php';</script>";
    exit;
}

 $phone = $_SESSION['phone'];

    $print_bmi = ""; 
    $bmi_status = ""; 
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $height = floatval($_POST['height']); 
        $weight = floatval($_POST['weight']); 

    $bmi = $weight / (($height / 100) ** 2);

            if ($bmi < 18.5) {
                $bmi_status = "کمبود وزن";
            } elseif ($bmi >= 18.5 && $bmi <= 24.9) {
                $bmi_status = "وزن نرمال";
            } elseif ($bmi >= 25.0 && $bmi <= 29.9) {
                $bmi_status = "اضافه وزن";
            } elseif ($bmi >= 30.0 && $bmi <= 34.9) {
                $bmi_status = "چاقی درجه 1";
            } elseif ($bmi >= 35.0 && $bmi <= 39.9) {
                $bmi_status = "چاقی درجه 2";
            } else {
                $bmi_status = "چاقی بیش از حد";
            }

    $stmt = $conn->prepare("UPDATE user SET bmi = ?, May = ?, Weight = ? WHERE Phone = ?");
    if ($stmt) {
        $stmt->bind_param("ddds", $bmi, $height, $weight, $phone);
        $stmt->execute();
        $stmt->close();
    } else {
        echo "خطا در تغییر اطلاعات.";
    }

    $print_bmi = "شاخص توده بدنی (BMI) شما: " . round($bmi, 2) . " - وضعیت: " . $bmi_status;
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
    <title>تست BMI</title>
</head>
<body dir="rtl">
    <nav class="navbar ">
        <div class="container-fluid shadow border" style="background-color:#89cabf;">
            <div style="height: 80px;">
                <button class="btn text-center px-2 fs-5 mt-3" style="background-color: #FFA459; margin-right: 40px;" onclick="alerting();">
                    <a href="./login.php" class="link-underline link-underline-opacity-0 text-light">ثبت نام/ ورود</a>
                </button>
            </div>
            <div style="margin-left: 50px;">
                <button class="btn text-center px-2 fs-5 mt-1" style="background-color: #74bdb1; margin-right: 70px;" onclick="alerting();">
                    <a href="./index.html" class="link-underline link-underline-opacity-0 text-light">صفحه اصلی</a>
                </button>
                <button class="btn text-center px-2 fs-5 mt-1" style="background-color: #74bdb1; margin-right: 70px;" onclick="alerting();">
                    <a href="./articles.html" class="link-underline link-underline-opacity-0 text-light">مقالات</a>
                </button>
                <button class="btn text-center px-2 fs-5 mt-1" style="background-color: #74bdb1; margin-right: 70px;" onclick="alerting();">
                    <a href="./Services.html" class="link-underline link-underline-opacity-0 text-light">خدمات</a>
                </button>
                <button class="btn text-center px-2 fs-5 mt-1" style="background-color: #74bdb1; margin-right: 70px;" onclick="alerting();">
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
                <h2 class="text-center">تست BMI</h2>
                <img src="./pic/bmi-color.png" alt="" style="width: 100px;height: auto; margin-right: 320px;">

                <form method="POST" action="">
                    <div class="container" style="margin-top: 30px;">
                        <div class="row">
                            <div class="col">
                                <label for="weight"><h5>وزن</h5></label><br>
                                <input type="number" class="form-control" id="weight" name="weight" placeholder="70kg" required style="direction: rtl;">
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="height"><h5>قد</h5></label>
                                    <input type="number" class="form-control" id="height" name="height" placeholder="150CM" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button style="background-color: #FFA459;" class="buttun-sign" type="submit"> <h4 style="margin-top: 2px;">نشون بده!</h4></button>
                    <br>
                    <br>
                </form>

                <?php if (!empty($print_bmi)) : ?>
                    <h3 class="text-center"><?php echo $print_bmi; ?></h3>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <footer class="text-light text-center p-3 shadow border" style="margin-top: 100px; background-color: #74bdb1;">
        <div class="container">
            <p style="text-align: center;">&copy; کلیه حقوق این سایت مربوط به دانشجویان دانشکده فنی شهید شمسی پور می باشد</p>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
