<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rent N Ride - Car Details</title>
    <link rel="stylesheet" href="css/car_detail.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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

    // Fetch ALL cars, not just available ones
    $sql2 = "SELECT * FROM cars";
    $cars = mysqli_query($con, $sql2);

    // Fetch a "special" car - for demonstration, let's just get the first one from the full list
    // This data is no longer directly used in the HTML for the 'hero-special-car' section,
    // as that section now uses a static background image and text.
    // However, keeping this fetch in case it's used elsewhere or for future features.
    mysqli_data_seek($cars, 0); // Reset pointer to get the first car again for special section
    $special_car = mysqli_fetch_assoc($cars);
    mysqli_data_seek($cars, 0); // Reset pointer for the main car listing loop
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
                    <li><a href="#" class="active">RENT CAR</a></li>
                     <li><a href="aboutus2.php">ABOUT</a></li>
                    <li><a href="contactus2.html">CONTACT</a></li>
                    <li><a href="feedback/Feedbacks.php">FEEDBACK</a></li>
                </ul>
            </nav>
           
        </div>
        </header>

    <section class="hero-section">
        <div class="hero-overlay">
            <h2>RENT N RIDE</h2>
            <p>Temukan mobil impian Anda</p> </div>
    </section>

   
    </div>

  

    <section class="cars-overview-section">
        <h1 class="section-title">OUR CARS OVERVIEW</h1>
        <div class="car-grid">
            <?php
                // Reset pointer to ensure the loop starts from the beginning if needed
                mysqli_data_seek($cars, 0);
                while($result = mysqli_fetch_array($cars)) {
                    $res = $result['CAR_ID'];
            ?>
            <div class="car-card">
                <div class="car-img-container">
                    <img src="images/<?php echo $result['CAR_IMG']?>" alt="<?php echo $result['CAR_NAME']?>">
                    <span class="car-image-name"><?php echo $result['CAR_NAME']?></span>
                </div>
                <div class="car-info">
                    <h3><?php echo $result['CAR_NAME']?></h3>
                    <div class="car-rating-location">
                        <div class="car-rating">
                            <i class="fas fa-star"></i>
                            <span>4.8 (4500 Reviews)</span>
                        </div>
                        <div class="car-location">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>Yogyakarta</span>
                        </div>
                    </div>
                    <div class="car-specs">
                        <div class="spec-item">
                            <i class="fas fa-chair"></i>
                            <span><?php echo $result['CAPACITY']?> seats</span>
                        </div>
                        <div class="spec-item">
                            <i class="fas fa-gas-pump"></i>
                            <span><?php echo $result['FUEL_TYPE']?></span>
                        </div>
                        <div class="spec-item">
                            <i class="fas fa-cogs"></i> <span>Manual</span>
                        </div>
                    </div>
                    <div class="car-price-booking">
                        <p class="rent-price"><span>Rp <?php echo number_format($result['PRICE'], 0, ',', '.');?></span> / day</p>
                        <a href="booking.php?id=<?php echo $res;?>" class="book-now-btn">Booking</a>
                    </div>
                </div>
            </div>
            <?php
                }
            ?>
        </div>
    </section>

    <section class="hero-special-car">
         <div>
        <h1 class="hero-special-car-title">SPECIAL CAR Rent N RIde</h1>

        </div>
    </section>

    <section class="facts-in-numbers">
        <div>
        <h1 class="section-title">Facts in Numbers</h1>
        <p> Ingin mobil yang bagus dan best perform?. Rent N Ride memiliki  mobil yang bagus dan memiliki perfoma yang tinggi,<br> kalian bisa mengendarainnya hanya dengan membayar 1.2 jt . Dalam Sehari anda bisa menyewa mobil performa tinggi milik kami <p>
            </div>
        <div class="facts-grid">
            <div class="fact-item">
                <span class="fact-number">80+</span>
                <span class="fact-text">Vehicles Available</span>
            </div>
            <div class="fact-item">
                <span class="fact-number">1000+</span>
                <span class="fact-text">Happy Customers</span>
            </div>
            <div class="fact-item">
                <span class="fact-number">10+</span>
                <span class="fact-text">Locations</span>
            </div>
            <div class="fact-item">
                <span class="fact-number">24/7</span>
                <span class="fact-text">Support</span>
            </div>
        </div>
    </section>

</div>

</body>
</html>