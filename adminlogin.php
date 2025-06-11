<?php
// PASTIKAN TIDAK ADA SPASI, BARIS KOSONG, ATAU KARAKTER LAIN SEBELUM TAG <?php INI
// JIKA ADA WARNING "headers already sent" PADA LINE 1,
// MAKA KEMUNGKINAN BESAR ADA SPASI/BARIS KOSONG DI ATAS TAG INI.
// PASTIKAN FILE DISIMPAN SEBAGAI UTF-8 TANPA BOM (Byte Order Mark).

require_once('connection.php');

if(isset($_POST['adlog'])){
    $id=$_POST['adid'];
    $pass=$_POST['adpass'];

    if(empty($id) || empty($pass)) {
        echo '<script>alert("please fill the blanks")</script>';
    } else {
        $query="SELECT * FROM admin WHERE ADMIN_ID='$id'";
        $res=mysqli_query($con,$query);

        if($row=mysqli_fetch_assoc($res)){
            if($pass == $row['ADMIN_PASSWORD']) {
                // Hapus alert JavaScript di sini agar header() bisa berfungsi
                header("location: admindash.php");
                exit(); // Sangat penting: menghentikan eksekusi skrip setelah redirect
            } else {
                echo '<script>alert("Enter a proper password")</script>';
            }
        } else {
            echo '<script>alert("Enter a proper email")</script>';
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
    <title>ADMIN LOGIN</title>
    <script type="text/javascript">
        function preventBack() {
            window.history.forward(); 
        }
        setTimeout("preventBack()", 0);
        window.onunload = function () { null };
    </script>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: sans-serif;
            background-color: #222222; /* Dark grey background */
            display: flex;
            flex-direction: column; /* Allow stacking elements vertically */
            justify-content: center;
            align-items: center;
            min-height: 100vh; /* Ensure it takes full viewport height */
            color: #fff; /* Default text color for the page */
            position: relative;
        }

        /* --- Sapaan Admin di atas tengah card --- */
        .admin-header {
            margin-bottom: 20px; /* Space between "Admin" and the login container */
            color: #fff;
            font-size: 28px; /* Slightly larger for prominence */
            font-weight: bold;
            text-align: center; /* Center the text */
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); /* Add a subtle shadow */
            z-index: 4; /* Ensure it's above the card but doesn't interfere */
        }

        .login-container {
            width: 800px; /* Adjust as needed */
            height: 550px; /* Adjust as needed */
            background-color: #999999; /* Lighter grey for the form container */
            border-radius: 20px; /* Rounded corners */
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
            display: flex;
            flex-direction: column;
            justify-content: flex-start; /* Align content to the top */
            align-items: center;
            padding: 20px;
            position: relative;
            overflow: hidden; /* Hide overflowing car image */
            z-index: 3; /* Ensure the container is above main body background */
        }

        .login-container::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 100px; /* Height of the turquoise wave */
            background-color: #29b1b8; /* Turquoise color for the wave */
            border-bottom-left-radius: 20px;
            border-bottom-right-radius: 20px;
            z-index: 2; /* Place it above the car image */
            clip-path: ellipse(50% 50% at 50% 100%); /* Create the wave shape */
        }

        .login-container::after {
            content: '';
            position: absolute;
            bottom: -50px; /* Adjust to position the car correctly */
            left: 50%;
            transform: translateX(-50%);
            width: 700px; /* Adjust car size */
            height: 400px; /* Adjust car size */
            background-image: url('images/blue_car.png'); /* Replace with your car image path */
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center bottom;
            z-index: 1; /* Place it behind the inputs */
        }

        h1.title {
            color: #38e1e9; /* Turquoise-like color */
            font-size: 40px;
            font-weight: bold;
            margin-bottom: 5px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3); /* Subtle shadow for text */
            z-index: 3; /* Ensure text is above everything */
        }

        p.subtitle {
            color: #f0f0f0; /* Light grey */
            font-size: 18px;
            margin-bottom: 40px; /* Space between subtitle and form */
            z-index: 3; /* Ensure text is above everything */
        }

        .form-content {
            display: flex;
            flex-direction: column;
            width: 60%; /* Adjust width of form elements */
            gap: 20px; /* Space between input fields */
            z-index: 3; /* Ensure form elements are above images */
        }

        .input-field {
            width: 100%;
            padding: 15px 20px;
            border: none;
            border-radius: 5px;
            background-color: rgba(255, 255, 255, 0.8); /* Slightly transparent white */
            color: #333; /* Dark text for input */
            font-size: 16px;
            box-sizing: border-box; /* Include padding in width */
            text-align: center; /* Center placeholder text */
        }

        .input-field::placeholder {
            color: #666; /* Darker placeholder text */
        }

        .login-button {
            width: 50%; /* Adjust button width */
            padding: 15px 0;
            background-color: #29b1b8; /* Turquoise-like color for button */
            color: white;
            border: none;
            border-radius: 25px; /* More rounded button */
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
            align-self: center; /* Center the button horizontally */
            margin-top: 20px; /* Space above button */
            margin-bottom: 20px; /* Add space below login button before other buttons */
        }

        .login-button:hover {
            background-color: #208e94; /* Darker turquoise on hover */
        }

        /* --- Tombol di dalam card, di bawah form --- */
        .utility-buttons-inside-card {
            display: flex;
            flex-direction: column; /* Stack vertically if desired, or use row for horizontal */
            gap: 10px; /* Space between buttons */
            width: 60%; /* Match form width */
            align-items: center; /* Center buttons horizontally */
            z-index: 3; /* Ensure they are above the car image */
        }

        .utility-button {
            width: 80%; /* Adjust width relative to its container */
            padding: 12px 25px; 
            background-color: #ff7200; /* Original orange color */
            border: none;
            border-radius: 25px; /* Rounded corners for buttons */
            font-size: 16px;
            cursor: pointer;
            color: #fff;
            text-decoration: none; /* For the anchor tag */
            font-weight: bold;
            display: inline-block; /* To apply padding properly to anchor */
            transition: background-color 0.3s ease, color 0.3s ease;
            text-align: center; /* Center text within the button */
        }

        .utility-button:hover {
            background-color: #fff;
            color: #ff7200;
        }
        
        .utility-button a {
            text-decoration: none;
            color: inherit; /* Inherit color from parent button */
            display: block; /* Make the whole button clickable */
        }
    </style>
</head>
<body>

<div class="admin-header">
    <h1>ADMIN</h1> 
</div>

<div class="login-container">
    <h1 class="title">RENT N RIDE</h1>
    <p class="subtitle">ADMIN ONLY</p>
    
    <form class="form-content" method="POST">
        <input class="input-field" type="text" name="adid" placeholder="Email: Or Username">
        <input class="input-field" type="password" name="adpass" placeholder="Password">
        <input type="submit" class="login-button" value="Log In" name="adlog">
    </form>

    <div class="utility-buttons-inside-card">
        <button class="utility-button"><a href="index.php">Go To Home</a></button>
        <button class="utility-button"><a href="pemiliklogin.php">Login Pemilik</a></button>
    </div>
</div>

</body>
</html>