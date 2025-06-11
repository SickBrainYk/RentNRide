<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CAR RENTAL</title>
    <script type="text/javascript">
        window.history.forward();
        function noBack() {
            window.history.forward();
        }
    </script>
    <link rel="stylesheet" href="css/style.css">
    <script type="text/javascript">
        function preventBack() {
            window.history.forward();
        }

        setTimeout("preventBack()", 0);

        window.onunload = function () { null };
    </script>
</head>
<body>

<?php
require_once('connection.php');
    if(isset($_POST['login']))
    {
        $email=$_POST['email'];
        $pass=$_POST['pass'];


        if(empty($email)|| empty($pass))
        {
            echo '<script>alert("please fill the blanks")</script>';
        }

        else{
            $query="select *from users where EMAIL='$email'";
            $res=mysqli_query($con,$query);
            if($row=mysqli_fetch_assoc($res)){
                $db_password = $row['PASSWORD'];
                if(md5($pass)  == $db_password)
                {
                    header("location: home.php");
                    session_start();
                    $_SESSION['email'] = $email;

                }
                else{
                    echo '<script>alert("Enter a proper password")</script>';
                }



            }
            else{
                echo '<script>alert("enter a proper email")</script>';
            }
        }
    }
?>

    <div class="main">
        <div class="content-wrapper">
            <div class="left-content">
                <h1 class="left-logo-title">RENT N RIDE</h1>
                <p class="description-text">
                    Tempat terbaik buat lo yang cari mobil sewaan dengan performa tinggi dan desain yang kece abis. Di sini, mobil bukan cuma alat transportasi tapi juga statement gaya hidup lo<br><br>

Pengen tampil beda waktu nongkrong? Atau butuh mobil buat event, jalan-jalan, atau sekadar tampil elegan di jalanan? Tenang, semua bisa lo dapetin di sini
Koleksi mobil kami dijamin mantul mesin bertenaga, tampilan stylish, dan pastinya bikin semua mata tertuju.<br><br>

Bawa mobil dari Rent N Ride, dan rasain sensasi berkendara yang bikin lo makin percaya diri.
Mau cruising santai atau show off di tempat hits? Serahin aja ke kita.
Karena di Rent N Ride, lo gak cuma nyewa mobil lo nyewa experience
                </p>
                <p class="instruction-text">
                    Langsung Saja Lakukan Login Dan Jika Tidak Ada Akun Langsung Saja SIGN IN
                </p>
            </div>
            <div class="login-form-area">
                <h2 class="form-area-title">RENT N RIDE</h2> <div class="form-box">
                    <form method="POST">
                        <input type="text" name="email" placeholder="Email Or Username">
                        <input type="password" name="pass" placeholder="Password">
                        <div class="social-icons">
                            <a href="#"><img src="aset/fb.png" alt="Facebook"></a>
                            <a href="#"><img src="aset/gg.png" alt="Google"></a>
                        </div>
                        <button type="submit" name="login" class="login-btn">Log in</button>
                    </form>

                    <p class="dont-have-account">Don't have an account?<br>
                        <a href="register.php">Sign up here</a>
                    </p>
                </div>
                <div class="admin-link">
                    <a href="adminlogin.php">ADMIN <img src="aset/adm.png" alt="Admin"></a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
</body>
</html>