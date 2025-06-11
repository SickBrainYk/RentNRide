<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BOOKING STATUS</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet"></head>
<body>
<style>
/* --- General Styling --- */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}
body {
    background: url("aset/lambo.jpg") no-repeat center center fixed;
    background-size: cover;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    padding: 20px;
}
/* --- Header Section (Go to Home button and User Name) --- */
.header-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    width: 100%;
    max-width: 900px; /* Adjust as needed */
    margin-bottom: 40px;
    padding: 0 20px;
}
.button-home {
    width: 180px;
    height: 45px;
    background: #007bff; /* A nice blue color */
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: background 0.3s ease, transform 0.2s ease;
    box-shadow: 0 4px 10px rgba(0, 123, 255, 0.3);
}
.button-home:hover {
    background: #0056b3; /* Darker blue on hover */
    transform: translateY(-2px);
}
.button-home a {
    text-decoration: none;
    color: white;
    font-weight: 600;
    font-size: 16px;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100%;
}
.user-greeting {
    font-size: 2.2em; /* Larger font for greeting */
    color: #fff; /* White text for contrast on background */
    font-weight: 700;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.4);
}
/* --- Box Containing Booking Details --- */
.box {
    background: rgba(255, 255, 255, 0.95); /* Slightly transparent white for a modern look */
    border-radius: 12px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    padding: 30px 40px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: flex-start;
    width: 100%;
    max-width: 750px; /* Optimal width for content */
    margin-bottom: 20px; /* Add margin to separate multiple boxes */
    text-align: left;
}
.box .content {
    color: #333; /* Darker text for readability */
    font-size: 1.1em;
    line-height: 1.8; /* Improve line spacing */
}
.box .content h1 {
    font-size: 1.8em; /* Adjusted font size for headings */
    margin-bottom: 15px; /* Spacing between lines */
    color: #2c3e50; /* A darker, more professional color */
    font-weight: 600;
}
.box .content h1:last-child {
    margin-bottom: 0; /* No margin after the last h1 */
}
/* --- Responsive Adjustments --- */
@media (max-width: 768px) {
    .header-container {
        flex-direction: column;
        margin-bottom: 30px;
        align-items: center;
    }

    .user-greeting {
        margin-top: 20px;
        font-size: 1.8em;
        text-align: center;
    }

    .box {
        padding: 25px 30px;
        max-width: 90%;
    }

    .box .content h1 {
        font-size: 1.5em;
        margin-bottom: 10px;
    }

    .button-home {
        width: 160px;
        height: 40px;
    }
}
@media (max-width: 480px) {
    body {
        padding: 15px;
    }

    .user-greeting {
        font-size: 1.5em;
    }

    .box {
        padding: 20px 25px;
    }

    .box .content h1 {
        font-size: 1.3em;
    }

    .button-home {
        width: 140px;
        height: 38px;
    }
    .button-home a {
        font-size: 14px;
    }
}
</style>

<?php
    require_once('connection.php');
    session_start();

    // Check if the user is logged in
    if (!isset($_SESSION['email'])) {
        echo '<script>alert("Please log in to view your bookings.");</script>';
        echo '<script>window.location.href = "login.php";</script>'; // Redirect to login page
        exit();
    }

    $email = $_SESSION['email'];

    // Fetch user details once
    $sql2 = "SELECT * FROM users WHERE EMAIL = '$email'";
    $name2 = mysqli_query($con, $sql2);
    $rows2 = mysqli_fetch_assoc($name2);

    // Fetch all bookings for the user, ordered by most recent
    $sql = "SELECT * FROM booking WHERE EMAIL = '$email' ORDER BY BOOK_ID DESC";
    $bookings_result = mysqli_query($con, $sql);

    // Check if there are any bookings
    if (mysqli_num_rows($bookings_result) == 0) {
        echo '<script>alert("Anda belum memiliki booking.");</script>';
        echo '<script>window.location.href = "cardetails.php";</script>';
        exit();
    }
?>

    <div class="header-container">
        <button class="button-home"><a href="cardetails.php">Go to Home</a></button>
        <div class="user-greeting">HELLO! <?php echo $rows2['FNAME']." ".$rows2['LNAME']?></div>
    </div>

<?php
    // Loop through each booking and display its details
    while ($booking = mysqli_fetch_assoc($bookings_result)) {
        $car_id = $booking['CAR_ID'];
        $sql3 = "SELECT * FROM cars WHERE CAR_ID = '$car_id'";
        $car_details_result = mysqli_query($con, $sql3);
        $car_details = mysqli_fetch_assoc($car_details_result);
?>
    <div class="box">
        <div class="content">
            <h1>BOOKING ID : <?php echo $booking['BOOK_ID']?></h1><br>
            <h1>CAR NAME : <?php echo $car_details['CAR_NAME']?></h1><br>
            <h1>NO OF DAYS : <?php echo $booking['DURATION']?></h1><br>
            <h1>BOOKING STATUS : <?php echo $booking['BOOK_STATUS']?></h1><br>
        </div>
    </div>
<?php
    } // End of while loop
?>

</body>
</html>