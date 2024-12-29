<?php
// اتصال به دیتابیس
$server_name = "localhost";
$username = "root";
$password = "";
$databasename = "Salamat_db";

$conn = new mysqli($server_name, $username, $password, $databasename);

if ($conn->connect_error) {
    die("Connect erorr: " . $conn->connect_error);
}

        session_start();
        if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin'] || !isset($_SESSION['phone'])) {
            echo "<script>alert('لطفا وارد حساب کاربری خود شوید!'); window.location.href = 'login.php';</script>";
            exit;
        }

        $phone = $_SESSION['phone'];

        $message = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $fasting_sugar = floatval($_POST['fasting_sugar']);

            $sugar_status = '';
            $sugar_value = 0;

            if ($fasting_sugar < 70) {
                $sugar_status = 'down'; 
                $message = 'قند خون  شما پایین است. لطفاً مراقب وضعیت سلامت خود باشید.';
                $sugar_value = $fasting_sugar;
            } elseif ($fasting_sugar >= 70 && $fasting_sugar <= 100) {
                $sugar_status = 'normal'; 
                $message = 'قند خون شما نرمال است.';
                $sugar_value = $fasting_sugar;
            } elseif ($fasting_sugar > 100) {
                $sugar_status = 'up'; 
                $message = 'قند خون  شما بالا است. لطفاً مراقب وضعیت سلامت خود باشید.';
                $sugar_value = $fasting_sugar;
            }

            

            $stmt = $conn->prepare("UPDATE user SET sugartst = ?, sugar = ? WHERE Phone = ?");
            if ($stmt) {
                $stmt->bind_param("dss", $sugar_value, $sugar_status, $phone);
                $stmt->execute();
                $stmt->close();
            } else {
                echo "خطا در تغییر اطلاعات.";
            }

            $fasting_sugar = '';
            $post_meal_sugar = '';
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
    <title>تست قند خون</title>
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
                <h2 class="text-center">تحلیلگر تست قند خون</h2>
                <img src="./pic/sugar-test.png" alt="" style="width: 100px;height: auto; margin-right: 320px;margin-top: 15px;">

                <form method="POST">
                    <div class="container" style="margin-top: 30px;">
                        <div class="row">
                            <div class="col">
                                <label for="fasting_sugar"><h5>قند خون ناشتا </h5></label><br>
                                <input type="number" class="form-control" id="fasting_sugar" name="fasting_sugar" value="<?php echo isset($fasting_sugar) ? $fasting_sugar : ''; ?>" placeholder="  140mg/dL" required style="direction: rtl;">
                            </div>
                           
                        </div>
                    </div>

                    <button style="background-color: #FFA459;" class="buttun-sign" type="submit">
                        <h4>نشون بده!</h4>
                    </button>
                    <br><br>

                    <?php if ($message != ''): ?>
                        <h3 style="color: red;"><?php echo $message; ?></h3>
                    <?php endif; ?>
                    <br>
                    <br>
                    <h5 style="color: crimson;">راهنمای استفاده از تحلیلگر:</h5>
                    <p> ابتدا با دستگاه قند خون سطح قند خون خود را به دست آورده و مقدار هر کدام (ناشتا و بعد غذا) را وارد کنید تا تحلیل سایت برای شما نشان داده شود. </p>
                </form>
            </div>
        </div>
    </div>

    <footer class="text-light text-center p-3 shadow border" style="margin-top: 100px; background-color: #74bdb1;">
        <div class="container">
            <p style="text-align: center;">&copy; کلیه حقوق این سایت مربوط به دانشجویان دانشکده فنی شهید شمسی پور می‌باشد</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
