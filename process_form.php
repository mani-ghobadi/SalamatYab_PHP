<?php
// اطلاعات اتصال به دیتابیس
$server_name = "localhost";
$username = "root";
$password = "";
$databasename = "Salamat_db";

$conn = new mysqli($server_name, $username, $password, $databasename);
 if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

     if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = htmlspecialchars($_POST["Name"]);
            $email = htmlspecialchars($_POST["email"]);
            $phone = htmlspecialchars($_POST["mobile"]);
            $password = htmlspecialchars($_POST["Password"]);
            $gender = htmlspecialchars($_POST["Gender"]);
            $age = htmlspecialchars($_POST["Age"]);

            $checkQuery = "SELECT COUNT(*) as count FROM user WHERE Phone = ?";
            $stmt = $conn->prepare($checkQuery);
            $stmt->bind_param("s", $phone);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();

            if ($row['count'] > 0) {
                echo '<script>
                alert("این شماره تلفن قبلاً ثبت شده است. لطفاً شماره دیگری وارد کنید.");
                window.location.href = "signin.html";
                </script>';
          } else {
                $sql = "INSERT INTO user (Name, Email, Phone, Password, Gender, Age) VALUES (?, ?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssssss", $name, $email, $phone, $password, $gender, $age);

       if ($stmt->execute()) {
                    echo '<script>
                    alert("شما با موفقیت در سایت ثبت نام شدید.");
                    window.location.href = "signin.html";
                    </script>';
         } else {
                    echo '<script>
                    alert("خطا در ثبت اطلاعات: ' . $conn->error . '");
                    </script>';
                }
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
    <title>ثبت نام</title>
</head>

    <body dir="rtl" style=" height: 900px;">
        
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
                    <a href="#" class="link-underline link-underline-opacity-0 text-light">درباره ما</a>
                </button> 
                <button class="btn text-center px-2 fs-5 mt-1 " style="background-color: #74bdb1; margin-right: 70px;" onclick="alerting();"> 
                 <a href="accont.php" class="link-underline link-underline-opacity-0 text-light"> حساب کاربری</a>
                 </button> 
               </div>
               <img src="./pic/health.png" alt="" class="img-fluid">

              </div>
            </div>
        
        </nav>

            <div class="container">
              <div class="row" >
                <div class="col text-center" style="margin-top: 170px;">
                    <h1>   سایت سلامت، همراه همیشگی شما  </h1><br>
                    <p>در سایت ما، هدف اصلی این است که شما را در مسیر دستیابی به سلامت و بهبود کیفیت زندگی‌تان یاری کنیم. تیم ما از متخصصان مجرب و کارشناسان حوزه سلامت، با استفاده از اطلاعات علمی و آخرین تحقیقات پزشکی، به شما کمک می‌کند تا مشکلات و چالش‌های بهداشتی‌تان را شناسایی کرده و راهکارهای مؤثر برای پیشگیری و درمان را ارائه دهد. از مشاوره‌های آنلاین تا برنامه‌های جامع مراقبت از سلامت، ما در هر مرحله از سفر سلامت شما در کنار شما خواهیم بود تا زندگی‌ای سالم‌تر، شادتر و با انرژی بیشتر داشته باشید.</p>                </div>
                <div class="col text-center">
                    <img src="./pic/favicon.png" alt="image" id="img-index1">   
                </div>
              </div>
            </div>
            
            <div class="container mt-5">
              <div class="row text-center">
                <div class="col">
                <div class="card" style="background-color: #89cabf;">
                    
                    <div class="card-body">
                        <img src="./pic/doctor.png" alt="" style="width: 40px; height: auto;">
                        <h3 class="card-title mt-3"> خدمات</h3>
                        <p class="card-text">سایت ما خدمات نظارت بر سلامت  به شما ارائه می‌دهد تا زندگی سالم‌تری داشته باشید. با استفاده از خدمات ما می‌توانید تست BMI، تست قند خون و تست فشار خون خود را انجام دهید. این تست‌ها به شما کمک می‌کنند تا وضعیت سلامت خود را بهتر بشناسید و از بیماری‌های احتمالی پیشگیری کنید.</p>
                        <a href="Services.html" class="btn text-light"style="background-color:#FFA459"">کلیک کنید</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card" style="background-color: #89cabf;" >
                    
                    <div class="card-body">
                        <img src="./pic/health-article.png" alt="" style="width: 40px; height: auto;">
                        <h3 class="card-title mt-3">مقالات </h3>
                        <p class="card-text">سایت ما منابع معتبر و مقالات علمی در زمینه سلامت را ارائه می‌دهد. هدف ما ارتقاء آگاهی عمومی در خصوص مسائل بهداشتی است. در این سایت، می‌توانید مقالات به‌روز و کاربردی در مورد بیماری‌ها، پیشگیری، تغذیه و سبک زندگی سالم پیدا کنید. ما به شما کمک می‌کنیم تا به تصمیمات بهداشتی هوشمندانه‌تری دست یابید.</p>
                        <a href="articles.html" class="btn text-light"style="background-color:#FFA459">کلیک کنید</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card" style="background-color: #89cabf;">
                    
                    <div class="card-body">
                        <img src="./pic/about.png" alt="" style="width: 40px; height: auto;">

                        <h3 class="card-title mt-3"> درباره ما</h3>
                        <p class="card-text">سایت ما با تیم متخصص و کارشناسان سلامت، به شما کمک می‌کند تا مشکلات بهداشتی خود را شناسایی و راهکارهای مؤثر برای پیشگیری و درمان را دریافت کنید. از مشاوره‌های آنلاین تا برنامه‌های مراقبتی جامع، ما در هر مرحله از مسیر سلامت شما همراه شما هستیم تا زندگی سالم‌تر، شادتر و پرانرژی‌تری داشته باشید.</p>
                        <a href="about.html" class="btn text-light"style="background-color:#FFA459">کلیک کنید</a>
                    </div>
                </div>
            </div>
              </div>
            </div>
            
        
        <footer class=" text-light text-center p-3 shadow border" style="margin-top: 120px; background-color: #74bdb1;">
            <div class="container">
                <p style="text-align: center;">&copy;کلیه حقوق این سایت مربوط به دانشجویان دانشکده فنی شهید شمسی پور می باشد</p>
            </div>
        </footer>
       <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>