<?php
    require_once('connection.php');
    session_start(); // Start session to use session variables

    if(isset($_POST['adlog'])){
        $id = $_POST['adid'];
        $pass = $_POST['adpass'];
        
        if(empty($id) || empty($pass)){
            echo '<script>alert("Please fill in all the blanks.");</script>';
        } else {
            $query = "SELECT * FROM pemilik WHERE id_pemilik='$id'";
            $res = mysqli_query($con, $query);

            if($row = mysqli_fetch_assoc($res)){
                $db_password = $row['password_pemilik'];
                if($pass == $db_password){
                    $_SESSION['owner_id'] = $id; // Store owner ID in session
                    echo '<script>alert("Welcome, OWNER!");</script>';
                    header("location: pemilikdash.php");
                    exit(); // Always exit after a header redirect
                } else {
                    echo '<script>alert("Incorrect password. Please try again.");</script>';
                }
            } else {
                echo '<script>alert("Owner ID not found. Please check your ID.");</script>';
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OWNER LOGIN</title>
    <script type="text/javascript">
        function preventBack() {
            window.history.forward(); 
        }
        setTimeout("preventBack()", 0);
        window.onunload = function () { null };
    </script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            /* Gradient background with your chosen colors */
            background: linear-gradient(to right, #1a1e28, #2a303d); 
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
            box-sizing: border-box;
            color: #ecf0f1;
            
            /* Background image properties */
            background-image: url('aset/1.jpg'); /* Ganti dengan path atau URL gambar Anda */
            background-size: cover; /* Menutupi seluruh area */
            background-position: center; /* Posisi gambar di tengah */
            background-repeat: no-repeat; /* Tidak mengulang gambar */
            background-attachment: fixed; /* Gambar tetap saat discroll */
        }

        .owner-title {
            color: #ecf0f1;
            font-size: 48px;
            margin-bottom: 50px;
            text-align: center;
            font-weight: 700;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .login-container {
            background-color: rgba(42, 48, 61, 0.9); /* #2a303d dengan sedikit transparansi */
            border-radius: 15px;
            padding: 50px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.4);
            width: 100%;
            max-width: 550px; /* Melebarkan card */
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .login-container::before {
            content: '';
            position: absolute;
            top: -30px;
            left: -10%;
            width: 120%;
            height: 80px;
            background: linear-gradient(45deg, #00d0e0, #1a1e28); /* Menggunakan warna gradasi baru */
            border-radius: 0 0 50% 50%;
            transform: rotate(3deg);
            z-index: 0;
            opacity: 0.8;
        }

        .login-container::after {
            content: '';
            position: absolute;
            bottom: -30px;
            right: -10%;
            width: 120%;
            height: 80px;
            background: linear-gradient(45deg, #1a1e28, #00d0e0); /* Menggunakan warna gradasi baru */
            border-radius: 50% 50% 0 0;
            transform: rotate(-3deg);
            z-index: 0;
            opacity: 0.8;
        }

        .rent-n-ride {
            color: #00d0e0; /* Warna teal cerah dari gradasi baru */
            font-size: 32px;
            font-weight: bold;
            margin-bottom: 5px;
            position: relative;
            z-index: 1;
            letter-spacing: 1px;
        }

        .owner-only {
            color: #bdc3c7;
            font-size: 16px;
            margin-bottom: 40px;
            position: relative;
            z-index: 1;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .form-group {
            width: 100%;
            margin-bottom: 25px;
            position: relative;
            z-index: 1;
        }

        .form-control {
            width: 100%;
            padding: 15px 20px;
            border: none;
            border-radius: 8px;
            font-size: 17px;
            background-color: #ecf0f1;
            color: #34495e;
            box-sizing: border-box;
            transition: all 0.3s ease;
        }

        .form-control::placeholder {
            color: #95a5a6;
        }

        .form-control:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(0, 208, 224, 0.5); /* Glow menggunakan warna teal baru */
        }

        .btn {
            width: 100%;
            padding: 16px;
            border: none;
            border-radius: 8px;
            font-size: 19px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 20px;
            position: relative;
            z-index: 1;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .btn-primary {
            background-color: #00d0e0; /* Warna teal baru */
            color: white;
            box-shadow: 0 5px 15px rgba(0, 208, 224, 0.4);
        }

        .btn-primary:hover {
            background-color: #00aebf; /* Sedikit lebih gelap saat hover */
            transform: translateY(-2px);
        }

        .btn-secondary {
            background-color: #e67e22; /* Tetap orange untuk Go To Home */
            color: white;
            box-shadow: 0 5px 15px rgba(230, 126, 34, 0.4);
        }

        .btn-secondary:hover {
            background-color: #d35400;
            transform: translateY(-2px);
        }
    </style>
</head>
<body>

<div class="owner-title">OWNER</div>

<div class="login-container">
    <div class="rent-n-ride">RENT N RIDE</div>
    <div class="owner-only">OWNER ONLY</div>
    
    <form method="POST" style="width: 100%;">
        <div class="form-group">
            <input class="form-control" type="text" name="adid" placeholder="Owner ID or Username">
        </div>
        <div class="form-group">
            <input class="form-control" type="password" name="adpass" placeholder="Password">
        </div>
        <input type="submit" class="btn btn-primary" value="Log In" name="adlog">
    </form>
    
    <button class="btn btn-secondary" onclick="window.location.href='index.php'">Go To Home</button>
</div>

</body>
</html>