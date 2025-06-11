<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>RENT N RIDE | About Us</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Tailwind CSS CDN (retained for body content styling) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Google Fonts - Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <!-- Google Fonts - Montserrat for Logo -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&display=swap" rel="stylesheet">
    <style>
        /* General Resets */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif; /* Using Inter font */
            background-color: #1a1e28; /* Dark blue-black background color */
            color: #f0f0f0; /* Light white general text color */
            line-height: 1.6;
            overflow-x: hidden;
            margin: 0;
            padding: 0;
        }

        /* Custom gradient for hero and cards (re-added as they were in the original Tailwind-based code) */
        .gradient-hero {
            background-image: linear-gradient(90deg, #00CED1 0%, #008B8B 100%);
        }
        .gradient-card {
            background-image: linear-gradient(135deg, #00CED1 0%, #008B8B 100%);
        }

        /* Header/Navbar Styles (from previous custom CSS) */
        .header {
            background-color: #1a1e28; /* Navbar background color same as body */
            padding: 18px 0; /* Reduced vertical padding for a smaller navbar */
            border-bottom: 1px solid #2a303d; /* Darker border */
        }

        .navbar-container {
            display: flex;
            justify-content: space-between; /* Distributes items with space between them */
            align-items: center; /* Vertically aligns items */
            padding: 0 60px; /* Horizontal padding for spacing from edges */
            max-width: 1920px; /* Optional: limit maximum navbar width */
            margin: 0 auto;
            height: 60px; /* Reduced height for a more compact navbar */
        }

        .logo {
            /* No absolute positioning for better flex flow and responsiveness */
        }

        .logo a {
            color: #00d0e0; /* Bright bluish-green color for logo */
            font-family: 'Montserrat', sans-serif; /* Using Montserrat font for logo */
            font-size: 35px;
            font-weight: 700; /* Bolder font weight */
            text-decoration: none;
            letter-spacing: 1px;
        }

        .main-menu {
            /* This element will take available space and center its content (the ul) */
            flex-grow: 1; /* Allows the main menu to take up available horizontal space */
            display: flex; /* Activates Flexbox for the main-menu itself */
            justify-content: center; /* Centers the ul (list of links) inside the main-menu's available space */
        }

        .main-menu ul {
            display: flex;
            list-style: none;
            margin: 0; /* Ensures no default margin */
            padding: 0; /* Ensures no default padding */
            align-items: center; /* Vertically centers list items */
        }

        .main-menu ul li {
            margin: 0 25px; /* Adjusts spacing between menu items for balance */
        }

        .main-menu ul li a {
            text-decoration: none;
            color: #ccc; /* Light grey text color for menu items */
            font-weight: 500; /* Font weight */
            font-size: 16px;
            transition: 0.3s ease; /* Smooth transition for hover effects */
            text-transform: capitalize; /* Capitalize the first letter */
        }

        .main-menu ul li a:hover,
        .main-menu ul li a.active {
            color: #00d0e0; /* Bright bluish-green color on hover/active */
        }

        /* Spacer to balance the layout for perfect menu centering */
        /* Its width should match the effective width of the .logo element */
        .navbar-spacer {
            /* Approximate width of the "Rent N Ride" logo text + left padding/margin */
            /* This value might need slight adjustment based on actual font rendering and spacing */
            width: 250px; /* Adjust this value if the menu is not perfectly centered visually */
            height: 1px; /* Minimal height */
        }

        /* --- Hero Section Styles (from previous custom CSS, adjusted for content) --- */
        .hero-section {
            position: relative;
            width: 100%;
            height: 500px; /* Adjust height to match image */
            background-image: url('aset/hh.jpg'); /* Placeholder for your image */
            background-size: cover; /* Ensures image covers the entire area */
            background-position: center; /* Centers the image */
            background-repeat: no-repeat; /* Prevents image repetition */
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
            text-align: center;
            margin-bottom: 0;
        }

        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.4); /* Semi-transparent black overlay */
            display: flex;
            flex-direction: column; /* To arrange text in the center */
            justify-content: center;
            align-items: center;
        }

        .hero-overlay h2 {
            font-family: 'Montserrat', sans-serif;
            font-size: 65px; /* Larger font size */
            font-weight: 700;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.6);
            color: #fff;
            margin-bottom: 10px; /* Space between title and subtitle */
        }
        .hero-overlay p { /* Styles for the subtitle */
            font-size: 24px;
            color: #f0f0f0;
            font-weight: 400;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.5);
        }

        /* Styles for About Section, Character Section, and Footer (mainly Tailwind, but included here for completeness) */
        /* Note: Most of these sections rely on Tailwind classes directly in HTML. */
        /* These custom styles are primarily for consistency and responsive adjustments. */

        /* Responsive Adjustments */
        @media (max-width: 1024px) {
            .navbar-container {
                padding: 0 25px;
            }
            .main-menu ul li {
                margin: 0 20px;
            }
            .hero-section {
                height: 400px;
            }
            .hero-overlay h2 {
                font-size: 55px;
            }
            .hero-overlay p {
                font-size: 20px;
            }
        }

        @media (max-width: 768px) {
            .navbar-container {
                flex-direction: column; /* Revert to column layout for mobile */
                justify-content: flex-start;
                align-items: center;
                padding: 15px 15px;
                height: auto;
            }
            .logo {
                position: static; /* On mobile, remove absolute positioning and allow it to flow normally */
                transform: none;
                margin-bottom: 15px;
            }
            .main-menu {
                flex-grow: 0; /* No need to grow on mobile */
                width: 100%; /* Take full width on mobile */
                justify-content: center;
                margin-bottom: 15px;
            }
            .main-menu ul {
                flex-wrap: wrap;
                justify-content: center;
                gap: 15px;
            }
            .main-menu ul li {
                margin: 0;
            }
            .navbar-spacer { /* Hide spacer on mobile */
                display: none;
            }
            .hero-section {
                height: 350px;
            }
            .hero-overlay h2 {
                font-size: 45px;
            }
            .hero-overlay p {
                font-size: 18px;
            }
        }

        @media (max-width: 480px) {
            .logo a {
                font-size: 30px;
            }
            .main-menu ul li a {
                font-size: 14px;
            }
            .navbar-container {
                padding: 0 10px; /* Maintain slight padding on mobile */
            }
            .hero-section {
                height: 250px;
            }
            .hero-overlay h2 {
                font-size: 35px;
            }
            .hero-overlay p {
                font-size: 16px;
            }
        }
    </style>
</head>
<body class="font-inter antialiased">
    <!-- Navbar -->
    <header class="header">
        <div class="navbar-container">
            <!-- Logo -->
            <div class="logo">
                <a href="#">Rent N Ride</a>
            </div>
            <!-- Main Menu (Navigation Links) -->
            <nav class="main-menu">
                <ul>
                    <li><a href="home.php" class="nav-link">HOME</a></li>
                    <li><a href="cardetails.php" class="nav-link active">RENT CAR</a></li>
                    <li><a href="aboutus2.php" class="nav-link">ABOUT</a></li>
                    <li><a href="contactus2.html" class="nav-link">CONTACT</a></li>
                    <li><a href="feedback/Feedbacks.php" class="nav-link">FEEDBACK</a></li>
                </ul>
            </nav>
            <!-- Spacer to balance the layout and center the menu -->
            <!-- The width of this spacer should match the logo's effective width + its margin/padding on the left -->
            <div class="navbar-spacer"></div>
        </div>
    </header>

    <!-- Hero Section -->
    <!-- The hero-section uses custom CSS for background and centering -->
    <header class="hero-section">
        <div class="hero-overlay">
            <h2>ABOUT US</h2>
            <p>RENT N RIDE</p>
        </div>
    </header>

    <!-- About Section (Uses Tailwind classes for structure and styling) -->
    <section class="bg-white py-16 text-gray-800">
        <div class="container mx-auto px-4 max-w-4xl text-justify">
            <p class="mb-6 leading-relaxed text-lg">
                Selamat Datang Di <strong class="text-[#008B8B]">Rent N Ride</strong>, Solusi Terbaik Untuk Kebutuhan Sewa Mobil Anda! Kami Adalah Penyedia Layanan Rental Mobil Terpercaya Yang Siap Memberikan Pengalaman Berkendara Yang Nyaman, Aman, Dan Menyenangkan.
            </p>
            <p class="mb-6 leading-relaxed text-lg">
                Dengan Berbagai Pilihan Kendaraan, Mulai Dari Mobil Keluarga, SUV, Hingga Mobil Mewah, Kami Memastikan Setiap Pelanggan Mendapatkan Kendaraan Yang Sesuai Dengan Kebutuhan Mereka. Layanan Kami Tersedia Untuk Perjalanan Bisnis, Wisata, Acara Khusus, Hingga Sewa Jangka Panjang Dengan Harga Kompetitif Dan Pelayanan Profesional.
            </p>
            <p class="mb-6 leading-relaxed text-lg">
                Kami Berkomitmen Untuk Memberikan Kendaraan Dalam Kondisi Prima Dengan Perawatan Rutin Serta Opsi Layanan Dengan Atau Tanpa Sopir. Kepuasan Dan Kenyamanan Pelanggan Adalah Prioritas Utama Kami.
            </p>
            <p class="leading-relaxed text-lg">
                Percayakan Perjalanan Anda Kepada <strong class="text-[#008B8B]">Rent N Ride</strong>, Karena Kami Selalu Siap Menemani Perjalanan Anda Dengan Layanan Terbaik!
            </p>

            <!-- Contact Info -->
            <div class="bg-gray-100 p-8 mt-12 rounded-xl shadow-lg border border-gray-200">
                <h3 class="text-3xl font-bold text-gray-900 mb-6 border-b-2 border-[#00CED1] pb-2">
                    Silahkan Hubungi Kami
                </h3>
                <div class="space-y-4">
                    <div class="flex items-center text-gray-700">
                        <i class="fas fa-phone text-[#00CED1] text-2xl mr-4"></i>
                        <p class="text-xl">0825 8999 0865</p>
                    </div>
                    <div class="flex items-start text-gray-700">
                        <i class="fas fa-map-marker-alt text-[#00CED1] text-2xl mr-4 mt-1"></i>
                        <p class="text-xl">Jl. Drip Sumoharjo No.3, RW.5, Klitren, Kec. Gondokusuman, Kota Yogyakarta, Daerah Istimewa Yogyakarta 55222</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Character Section (Uses Tailwind classes for structure and styling) -->
    <section class="bg-[#1a1e28] py-16">
        <div class="container mx-auto px-4 flex flex-wrap justify-center gap-10">
            <!-- Character Card 1 (Upin) -->
            <div class="character-card gradient-card rounded-3xl shadow-2xl p-8 w-full md:w-5/12 lg:w-1/3 flex flex-col items-center text-center text-white transform hover:scale-105 transition duration-300 ease-in-out">
                <div class="text-5xl font-extrabold mb-6 tracking-wide uppercase">UPIN</div>
                <img src="aset/tkm2" alt="Upin Character" class="w-48 h-48 rounded-full border-8 border-white shadow-lg mb-6 object-cover">
                <p class="text-lg leading-relaxed opacity-90">
                    Upin Adalah Karakter Utama Dalam Serial Animasi Upin & Ipin. Ia Adalah Seorang Anak Laki-Laki Dan Anak Kembar Dari Upin Dan Ipin. Upin Memiliki Rambut Pendek Dan Baju Kuning Berlogo "U". Upin Lebih Sering Tampil Sebagai Sosok Yang Sabar, Baik Hati, Dan Sebagai Pemimpin Bagi Adiknya, Ipin. Bersama Ipin, Upin Senang Menjalani Berbagai Petualangan Seru Dan Mempelajari Makna Moral Dan Nilai-Nilai Keluarga.
                </p>
            </div>
            <!-- Character Card 2 (Ipin) -->
            <div class="character-card gradient-card rounded-3xl shadow-2xl p-8 w-full md:w-5/12 lg:w-1/3 flex flex-col items-center text-center text-white transform hover:scale-105 transition duration-300 ease-in-out">
                <div class="text-5xl font-extrabold mb-6 tracking-wide uppercase">IPIN</div>
                <img src="https://i.ibb.co/3Mzq721/ipin.png" alt="Ipin Character" class="w-48 h-48 rounded-full border-8 border-white shadow-lg mb-6 object-cover">
                <p class="text-lg leading-relaxed opacity-90">
                    Ipin Adalah Karakter Dalam Serial Animasi Upin & Ipin. Ia Adalah Adik Kembar Dari Upin. Ipin Dikenal Dengan Kepala Plontos Dan Baju Biru Berlogo "I". Ipin Adalah Sosok Yang Ceria, Polos, Dan Suka Makan Ayam Goreng. Seringkali Mengucapkan Kata Khasnya "Betul, Betul, Betul". Bersama Upin Dan Teman-Temannya, Ipin Selalu Menemukan Hal Seru Yang Penuh Nilai-Nilai Kehidupan.
                </p>
            </div>
        </div>
    </section>

    <!-- Footer (Uses Tailwind classes for structure and styling) -->
    <footer class="bg-[#0A1C2E] py-10 text-center">
        <div class="container mx-auto px-4">
            <div class="brand-logos flex flex-wrap justify-center items-center gap-x-10 gap-y-6">
                <!-- Fallback images added for robustness -->
                <h1> RENT N RIDE </h1>
            </div>
        </div>
    </footer>

    <script>
        // JavaScript to apply active class based on current page URL
        document.addEventListener('DOMContentLoaded', () => {
            const navLinks = document.querySelectorAll('.main-menu .nav-link'); // Targeting nav-links within main-menu
            const currentPath = window.location.pathname.split('/').pop(); // Get filename from URL

            navLinks.forEach(link => {
                // Get filename from href
                const linkPath = link.getAttribute('href').split('/').pop();

                // Compare filenames (excluding PHP extension if present)
                if (linkPath.split('.')[0] === currentPath.split('.')[0]) {
                    link.classList.add('active');
                } else {
                    link.classList.remove('active');
                }
            });
        });
    </script>
</body>
</html>
