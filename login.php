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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $phone = $_POST['phone']; 
    $password = $_POST['password']; 

    $stmt = $conn->prepare("SELECT * FROM user WHERE phone = ? AND password = ?");
    $stmt->bind_param("ss", $phone, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['loggedin'] = true;
        $_SESSION['phone'] = $phone;
        $_SESSION['Name'] = $row['Name']; 

        echo "<script>alert('ورود با موفقیت انجام شد ! خوش آمدید " . htmlspecialchars($row['Name']) . "'); window.location.href = 'index.html';</script>";
    } else {
        echo "<script>alert('شماره تلفن یا رمز عبور شما اشتباه است!'); window.location.href = 'login.php';</script>";
    }

    $stmt->close();
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
    <title>ورود</title>
</head>
<body dir="rtl" style="height: 700px;">
    <nav class="navbar">
        <div class="container-fluid shadow border" style="background-color:#89cabf;">
            <div style="height: 80px;">
                <button class="btn text-center px-2 fs-5 mt-3 " style="background-color: #FFA459; margin-right: 40px;" onclick="alerting();">
                    <a href="login.php" class="link-underline link-underline-opacity-0 text-light">ثبت نام/ ورود</a>
                </button>
            </div> 
            <div style="margin-left: 50px;">
                <button class="btn text-center px-2 fs-5 mt-1 " style="background-color: #74bdb1; margin-right: 70px;" onclick="alerting();">
                    <a href="index.html" class="link-underline link-underline-opacity-0 text-light"> صفحه اصلی</a>
                </button> 
                <button class="btn text-center px-2 fs-5 mt-1 " style="background-color: #74bdb1; margin-right: 70px;" onclick="alerting();">
                    <a href="articles.html" class="link-underline link-underline-opacity-0 text-light">مقالات</a>
                </button>
                <button class="btn text-center px-2 fs-5 mt-1 " style="background-color: #74bdb1; margin-right: 70px;" onclick="alerting();">
                    <a href="Services.html" class="link-underline link-underline-opacity-0 text-light">خدمات</a>
                </button>
                <button class="btn text-center px-2 fs-5 mt-1 " style="background-color: #74bdb1; margin-right: 70px;" onclick="alerting();">
                    <a href="about.html" class="link-underline link-underline-opacity-0 text-light">درباره ما</a>
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
                <h2 class="text-center">ورود</h2>
                <img src="./pic/favicon.png" alt="" style="width: 100px;height: auto; margin-right: 320px;">

                <form action="" method="post">
                    <label for="phone"><h5>تلفن همراه</h5></label><br>
                    <input type="tel" class="form-control" id="phone" name="phone" placeholder="09xxxxxxxxx" required style="direction: rtl;">
                    <br>
                    <div class="form-group">
                        <input type="password" class="form-control" id="password" name="password" placeholder="گذرواژه خود را وارد کنید" required>
                    </div>
                    <button style="background-color: #FFA459;" class="buttun-sign" type="submit"> <h4 style="margin-top: 2px;">ورود</h4></button>
                    <br>
                    <br>
                    <a href="./signin.html" style="margin-right: 220px; text-decoration: none;" class="text-center">آیا ثبت نام نکردید؟ پس همین الان ثبت نام کنید</a>
                </form>
            </div>
        </div>
    </div>
    
    <footer class="text-light text-center p-3 shadow border" style="margin-top: 120px; background-color: #74bdb1;">
        <div class="container">
            <p style="text-align: center;">&copy; کلیه حقوق این سایت مربوط به دانشجویان دانشکده فنی شهید شمسی پور می‌باشد</p>
        </div>
    </footer>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
