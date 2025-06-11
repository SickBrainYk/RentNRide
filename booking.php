<?php
// Aktifkan error reporting penuh untuk debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Pastikan file connection.php ada dan konfigurasi database benar
require_once('connection.php');
session_start();

// Ambil CAR_ID dari URL
$carid = isset($_GET['id']) ? $_GET['id'] : null;

$email_car = null; // Inisialisasi

if ($carid) {
    // Menggunakan prepared statement untuk keamanan
    $sql_car = "SELECT * FROM cars WHERE CAR_ID = ?";
    $stmt_car = mysqli_prepare($con, $sql_car);
    if ($stmt_car) {
        mysqli_stmt_bind_param($stmt_car, "i", $carid);
        mysqli_stmt_execute($stmt_car);
        $result_car = mysqli_stmt_get_result($stmt_car);
        $email_car = mysqli_fetch_assoc($result_car);
        mysqli_stmt_close($stmt_car);

        // Pastikan $email_car tidak null sebelum mencoba mengaksesnya
        if (!$email_car) {
            echo '<script>alert("Car not found with the provided ID."); window.location.href="cardetails.php";</script>';
            exit();
        }
    } else {
        error_log("Error preparing car details statement: " . mysqli_error($con));
        echo '<script>alert("Error preparing car details. Please try again."); window.location.href="cardetails.php";</script>';
        exit();
    }
} else {
    echo '<script>alert("Car ID is missing in the URL."); window.location.href="cardetails.php";</script>';
    exit();
}

// Ambil detail user dari sesi
$uemail = null;
$fname = "";
$lname = "";
if (isset($_SESSION['email'])) {
    $value_email = $_SESSION['email'];
    $sql_user = "SELECT * FROM users WHERE EMAIL = ?";
    $stmt_user = mysqli_prepare($con, $sql_user);
    if ($stmt_user) {
        mysqli_stmt_bind_param($stmt_user, "s", $value_email);
        mysqli_stmt_execute($stmt_user);
        $result_user = mysqli_stmt_get_result($stmt_user);
        $rows_user = mysqli_fetch_assoc($result_user);
        mysqli_stmt_close($stmt_user);

        if ($rows_user) {
            $uemail = $rows_user['EMAIL'];
            $fname = $rows_user['FNAME'];
            $lname = $rows_user['LNAME'];
        } else {
            echo '<script>alert("User data not found. Please re-login."); window.location.href="login.php";</script>';
            exit();
        }
    } else {
        error_log("Error preparing user details statement: " . mysqli_error($con));
        echo '<script>alert("Error preparing user details. Please re-login."); window.location.href="login.php";</script>';
        exit();
    }
} else {
    echo '<script>alert("You are not logged in. Please log in first."); window.location.href="login.php";</script>';
    exit();
}

$carprice = $email_car ? $email_car['PRICE'] : 0; // Ambil harga mobil

if (isset($_POST['book'])) {
    $bplace = mysqli_real_escape_string($con, $_POST['place']);
    $bdate = date('Y-m-d', strtotime($_POST['date']));
    $dur = mysqli_real_escape_string($con, $_POST['dur']);
    $phno = mysqli_real_escape_string($con, $_POST['ph']);
    $des = mysqli_real_escape_string($con, $_POST['des']);
    $rdate = date('Y-m-d', strtotime($_POST['rdate']));
    $pickup_car_date = date('Y-m-d', strtotime($_POST['pickup_car_date']));

    if (empty($bplace) || empty($bdate) || empty($dur) || empty($phno) || empty($des) || empty($rdate) || empty($pickup_car_date)) {
        echo '<script>alert("Please fill all the required fields (Name, Booking Date, Duration, Phone Number, Destination, Return Date, Pickup Car Date)!");</script>';
    } else {
        if ($bdate <= $rdate) {
            $price = ($dur * $carprice);

            $sql_booking = "INSERT INTO booking (CAR_ID, EMAIL, BOOK_PLACE, BOOK_DATE, DURATION, PHONE_NUMBER, DESTINATION, PRICE, RETURN_DATE, PICKUP_CAR_DATE) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt_booking = mysqli_prepare($con, $sql_booking);

            if ($stmt_booking) {
                mysqli_stmt_bind_param($stmt_booking, "ississsdss", $carid, $uemail, $bplace, $bdate, $dur, $phno, $des, $price, $rdate, $pickup_car_date);
                $result_booking = mysqli_stmt_execute($stmt_booking);

                if ($result_booking) {
                    $_SESSION['email'] = $uemail;
                    echo '<script>alert("Booking successful!"); window.location.href="payment.php";</script>';
                    exit();
                } else {
                    error_log("Booking error: " . mysqli_error($con));
                    echo '<script>alert("Booking failed. Please check the connection or data. (Error: ' . mysqli_error($con) . ')");</script>';
                }
                mysqli_stmt_close($stmt_booking);
            } else {
                error_log("Error preparing booking statement: " . mysqli_error($con));
                echo '<script>alert("Error preparing booking. Please try again.");</script>';
            }
        } else {
            echo '<script>alert("Return date must be on or after the booking date.");</script>';
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
    <title>CAR BOOKING</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        /* Reset dan Dasar */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            height: 100%;
            font-family: 'Poppins', sans-serif;
            overflow-x: hidden;
        }

        /* Container Utama Halaman */
        .page-container {
            display: flex;
            height: 100vh;
            background: url('images/.jpg') no-repeat center center fixed;
            background-size: cover;
            position: relative;
        }

        /* Overlay Latar Belakang */
        .page-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.4);
            z-index: 0;
        }

        /* Panel Kiri (Gambar Mobil Dinamis) - DIUBAH */
        .left-panel {
            flex: 1;
            background-color: #212121; /* Fallback color */
            display: flex; /* Gunakan flexbox */
            flex-direction: column; /* Item akan ditumpuk secara vertikal */
            justify-content: flex-end; /* Dorong item ke bawah */
            align-items: center; /* Pusatkan item secara horizontal */
            position: relative;
            z-index: 1;
            padding-bottom: 30px; /* Jaga padding agar teks tidak terlalu mepet */
            overflow: hidden; /* **SANGAT PENTING: Memastikan konten yang meluap dipotong** */
        }

        .left-panel-border {
            border: 5px solid #00FFFF;
            position: absolute;
            top: 1px;
            left: 1px;
            right: 1px;
            bottom: 1px;
            z-index: 0; /* Tetap di bawah gambar */
        }

        /* Styling untuk Gambar di Left Panel - DIUBAH */
        .left-panel img {
            position: absolute; /* Posisikan gambar secara absolut */
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover; /* Membuat gambar menutupi area tanpa terdistorsi */
            object-position: center; /* Pusatkan gambar dalam container */
            display: block;
            z-index: -2; /* Pastikan di paling belakang, di bawah border */
        }

        .left-panel .brand-text {
            color: #00FFFF;
            font-size: 1.5em;
            font-weight: 700;
            text-shadow: 1px 1px 3px rgba(0,0,0,0.5);
            z-index: 1; /* Pastikan di atas gambar dan border */
        }

        /* Styling untuk car-image-name jika ingin ditampilkan di atas gambar */
        /* Biarkan display: none jika tidak ingin ditampilkan */
        .car-image-name {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: #fff;
            font-size: 1.8em;
            font-weight: 700;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.7);
            background-color: rgba(0, 0, 0, 0.4);
            padding: 10px 20px;
            border-radius: 8px;
            z-index: 2;
            display: none; /* Sembunyikan jika tidak ingin ditampilkan di gambar */
        }


        /* Panel Kanan (Form Booking) */
        .right-panel {
            flex: 1;
            background-color: #212121;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            position: relative;
            z-index: 1;
        }

        .booking-form-container {
            background-color: #2D3E4E;
            padding: 40px;
            border-radius: 15px;
            width: 100%;
            max-width: 450px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
        }

        .booking-form-container h2 {
            color: #00FFFF;
            font-size: 2.2em;
            font-weight: 600;
            text-align: center;
            margin-bottom: 30px;
            letter-spacing: 1px;
        }

        .form-group {
            position: relative;
            margin-bottom: 25px;
        }

        .form-group i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #929292;
            font-size: 1.1em;
            pointer-events: none;
            z-index: 2;
        }

        .form-group input {
            width: 100%;
            padding: 12px 12px 12px 45px;
            border: none;
            border-radius: 8px;
            background-color: #3C5061;
            color: #E0E0E0;
            font-size: 1em;
            outline: none;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }

        .form-group input::placeholder {
            color: #929292;
            font-weight: 300;
            opacity: 1;
        }

        .form-group input:focus {
            background-color: #4A5F72;
            box-shadow: 0 0 0 3px rgba(0, 255, 255, 0.3);
        }

        input[type="date"] {
            position: relative;
        }
        input[type="date"]::-webkit-calendar-picker-indicator {
            filter: invert(1);
            opacity: 0;
            cursor: pointer;
            width: calc(100% - 45px);
            position: absolute;
            right: 0;
            top: 0;
            height: 100%;
            z-index: 3;
        }
        input[type="date"]::before {
            content: attr(placeholder);
            color: #929292;
            position: absolute;
            left: 45px;
            top: 50%;
            transform: translateY(-50%);
            pointer-events: none;
            display: block;
            z-index: 1;
        }
        input[type="date"]:not([value=""])::before {
            content: '';
            display: none;
        }

        .btn-book {
            width: 100%;
            padding: 15px;
            background-color: #FF9800;
            color: #212121;
            border: none;
            border-radius: 8px;
            font-size: 1.2em;
            font-weight: 700;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease, box-shadow 0.3s ease;
            margin-top: 20px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }

        .btn-book:hover {
            background-color: #FFA726;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.4);
        }

        .btn-book:active {
            transform: translateY(0);
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.2);
        }

        @media (max-width: 768px) {
            .page-container {
                flex-direction: column;
            }

            .left-panel, .right-panel {
                flex: none;
                width: 100%;
                height: 50vh;
            }

            .left-panel .brand-text {
                font-size: 1.2em;
                margin-bottom: 20px;
            }

            .booking-form-container {
                padding: 30px;
            }

            .booking-form-container h2 {
                font-size: 1.8em;
                margin-bottom: 20px;
            }

            .form-group input {
                padding: 10px 10px 10px 40px;
            }
        }

        .booking-form-container .car-name-display {
            color: #00FFFF;
            font-size: 1.2em;
            font-weight: 600;
            margin-bottom: 25px;
            text-align: center;
        }

        /* Sembunyikan elemen-elemen dari kode lama yang tidak relevan dengan desain baru */
        .hai, .navbar, .main .register h2:first-of-type, .main {
            display: none !important;
        }
    </style>
</head>
<body>
    <script type="text/javascript">
        function preventBack() {
            window.history.forward();
        }
        setTimeout("preventBack()", 0);
        window.onunload = function () { null };

        document.addEventListener('DOMContentLoaded', function() {
            var today = new Date();
            var dd = String(today.getDate()).padStart(2, '0');
            var mm = String(today.getMonth() + 1).padStart(2, '0');
            var yyyy = today.getFullYear();

            var todayFormatted = yyyy + '-' + mm + '-' + dd;

            var bookingDateField = document.getElementById("booking-date-field");
            if (bookingDateField) {
                bookingDateField.setAttribute("min", todayFormatted);
                bookingDateField.value = todayFormatted;
            }

            var returnDateField = document.getElementById("return-date-field");
            if (returnDateField) {
                returnDateField.setAttribute("min", todayFormatted);
            }

            var pickupCarDateField = document.getElementById("pickup-car-date-field");
            if (pickupCarDateField) {
                pickupCarDateField.setAttribute("min", todayFormatted);
            }
        });
    </script>

    <div class="page-container">
        <div class="left-panel">
            <div class="left-panel-border"></div>
            <?php if ($email_car): // Pastikan $email_car sudah terisi ?>
                <img src="images/<?php echo htmlspecialchars($email_car['CAR_IMG']); // Ubah 'CAR_IMAGE' menjadi 'CAR_IMG' ?>" alt="<?php echo htmlspecialchars($email_car['CAR_NAME']);?>">
            <?php endif; ?>
            <div class="brand-text">RENT N RIDE</div>
        </div>

        <div class="right-panel">
            <div class="booking-form-container">
                <h2>BOOKING</h2>
                <form id="register" method="POST">
                    <?php if ($email_car): ?>
                        <div class="car-name-display">
                            CAR NAME : <?php echo htmlspecialchars($email_car['CAR_NAME']); ?>
                        </div>
                    <?php endif; ?>

                    <div class="form-group">
                        <i class="fas fa-user"></i>
                        <input type="text" name="place" placeholder="Name" value="<?php echo htmlspecialchars($fname . " " . $lname); ?>" readonly>
                    </div>

                    <div class="form-group">
                        <i class="fas fa-calendar-alt"></i>
                        <input type="date" name="date" id="booking-date-field" placeholder="Booking Date" required>
                    </div>

                    <div class="form-group">
                        <i class="fas fa-calendar-alt"></i>
                        <input type="date" name="rdate" id="return-date-field" placeholder="Return Date" required>
                    </div>

                    <div class="form-group">
                        <i class="fas fa-phone"></i>
                        <input type="tel" name="ph" maxlength="10" placeholder="Phone Number" required>
                    </div>

                    <div class="form-group">
                        <i class="fas fa-calendar-alt"></i>
                        <input type="date" name="pickup_car_date" id="pickup-car-date-field" placeholder="Pickup Car Date" required>
                    </div>

                    <div class="form-group">
                        <i class="fas fa-clock"></i>
                        <input type="number" name="dur" min="1" max="30" placeholder="Rent Period (in days)" required>
                    </div>

                    <div class="form-group">
                        <i class="fas fa-map-marker-alt"></i>
                        <input type="text" name="des" placeholder="Destination" required>
                    </div>

                    <button type="submit" class="btn-book" name="book">Book now</button>
                </form>
            </div>
        </div>
    </div>

</body>
</html>