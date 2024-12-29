<?php
session_start();

if (!isset($_SESSION['phone'])) {

    header("Location: login.php");
    exit();
}

$server_name = "localhost";
$username = "root";
$password = "";
$databasename = "Salamat_db";

$conn = new mysqli($server_name, $username, $password, $databasename);

if ($conn->connect_error) {
    die("Connect error: " . $conn->connect_error);
}

$phone = $_SESSION['phone'];

$sql = "SELECT Name, Email, may, Weight, Age, Blooddia, Bloodsis, Blood, SugarTst, Bmi 
        FROM user WHERE Phone = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $phone); 
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    echo "کاربری پیدا نشد.";
    exit();
}

$stmt->close();
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
    <title> حساب کاربری</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body dir="rtl" style="background-color: #f8f9fa;">
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
</div>

</nav>
    <div class="container" style="margin-top: 110px;">
        
        <h1 class="text-center">اطلاعات حساب کاربری</h1>
        <div class="card mt-4" style="background-color:#89cabf;">
            <div class="card-body">
                <h5 class="card-title">نام: <?php echo htmlspecialchars($user['Name']); ?></h5>
                <p class="card-text">ایمیل: <?php echo htmlspecialchars($user['Email']); ?></p>
                <p class="card-text">قد: <?php echo htmlspecialchars($user['may']); ?> سانتی‌متر</p>
                <p class="card-text">وزن: <?php echo htmlspecialchars($user['Weight']); ?> کیلوگرم</p>
                <p class="card-text">سن: <?php echo htmlspecialchars($user['Age']); ?> سال</p>
                <p class="card-text">فشار خون سیستولیک: <?php echo htmlspecialchars($user['Bloodsis']); ?></p>
                <p class="card-text">فشار خون دیاستولیک: <?php echo htmlspecialchars($user['Blooddia']); ?></p>
                <p class="card-text">قند خون: <?php echo htmlspecialchars($user['SugarTst']); ?></p>
                <p class="card-text">شاخص توده بدنی (BMI): <?php echo htmlspecialchars($user['Bmi']); ?></p>
            </div>
        </div>
        <div class="text-center mt-4">
            <a href="logout.php" class="btn btn-danger">خروج از حساب</a>
        </div>
    </div>
    <footer class=" text-light text-center p-3 shadow border" style="margin-top: 100px; background-color: #74bdb1;">
            <div class="container">
                <p style="text-align: center;">&copy;کلیه حقوق این سایت مربوط به دانشجویان دانشکده فنی شهید شمسی پور می باشد</p>
            </div>
        </footer>
</body>
</html>
