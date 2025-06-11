<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rent N Ride - Home</title>
    <link rel="stylesheet" href="css/home.css"> <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body>

<?php
    require_once('connection.php');
    session_start();

    // Check if email is set in session, otherwise redirect to login (optional but good practice)
    if (!isset($_SESSION['email'])) {
        header('Location: index.php'); // Redirect to login page
        exit();
    }

    $value = $_SESSION['email'];

    // For user info
    $sql = "SELECT * FROM users WHERE EMAIL='$value'";
    $name = mysqli_query($con, $sql);
    $rows = mysqli_fetch_assoc($name);
?>

<div class="main-wrapper">
    <header class="header">
        <div class="navbar-container">
            <div class="logo">
                <a href="#">Rent N Ride</a>
            </div>
            <nav class="main-menu">
                <ul>
                    <li><a href="home.php" class="<?php echo (basename($_SERVER['PHP_SELF']) == 'index.php') ? 'active' : ''; ?>">HOME</a></li>
                    <li><a href="cardetails.php">RENT CAR</a></li> 
                    <li><a href="aboutus2.php">ABOUT</a></li>
                    <li><a href="contactus2.html">CONTACT</a></li>
                    <li><a href="feedback/Feedbacks.php">FEEDBACK</a></li>
                </ul>
            </nav>
            <div class="user-profile">
                <img src="images/profile.png" class="profile-circle" alt="Profile">
                <span class="user-greeting">HELLO! &nbsp;<?php echo $rows['FNAME']." ".$rows['LNAME']?></span>
                <a class="booking-status-link" href="bookinstatus.php">BOOKING STATUS</a>
                <a href="index.php" class="logout-btn">LOGOUT</a>
            </div>
        </div>
        </header>

    <section class="hero-section">
        <div class="hero-content">
            <h1>RENT N RIDE</h1>
            <p>Sewa mobil, yang memiliki banyak variant mobil, yang <br> dapat anda sewa sekarang juga!</p>
            <div class="stats">
                <div class="stat-item">
                    <span>50+</span>
                    <p>Car brands</p>
                </div>
                <div class="stat-item">
                    <span>10k+</span>
                    <p>Clients</p>
                </div>
            </div>
        </div>
        <div class="hero-image-container">
            </div>
    </section>

    <section class="info-boxes-section">
        <div class="info-box-container">
            <div class="info-box">
                <i class="fas fa-map-marker-alt"></i>
                <h3>Availability</h3>
                <p>Diam tincidunt tincidunt erat at semper fermentum. Id ultricies quis</p>
            </div>
            <div class="info-box">
                <i class="fas fa-couch"></i>
                <h3>Comfort</h3>
                <p>Gravida auctor fermentum morbi vulputate ac egestas ortcilum convallis</p>
            </div>
            <div class="info-box">
                <i class="fas fa-money-bill-wave"></i>
                <h3>Savings</h3>
                <p>Pretium convallis id diam sed commodo vestibulum lobortis volutpat.</p>
            </div>
        </div>
    </section>

</div>

</body>
</html>