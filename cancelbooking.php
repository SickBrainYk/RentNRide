<?php
    // Pastikan session_start() adalah baris pertama yang dieksekusi.
    // Tidak boleh ada spasi, baris kosong, atau HTML sebelum ini.
    session_start(); 

    require_once('connection.php');

    // Pastikan $bid sudah diset sebelum digunakan
    $bid = isset($_SESSION['bid']) ? $_SESSION['bid'] : null;

    if (isset($_POST['cancel_confirmed']) && $_POST['cancel_confirmed'] === 'true' && $bid) {
        $del = mysqli_query($con, "DELETE FROM booking WHERE BOOK_ID = '$bid' ORDER BY BOOK_ID DESC LIMIT 1");
        if ($del) {
            unset($_SESSION['bid']);
            echo "<script>alert('Booking berhasil dibatalkan!'); window.location.href='cardetails.php';</script>";
        } else {
            echo "<script>alert('Gagal membatalkan booking. Silakan coba lagi.'); window.location.href='cancel_booking.php';</script>";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CANCEL BOOKING</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --color-light-blue: #00d0e0; /* Biru terang */
            --color-dark-grey-1: #3d4554; /* Abu-abu gelap 1 */
            --color-dark-grey-2: #1a1e28; /* Abu-abu gelap 2 (hampir hitam) */
            --color-dark-grey-3: #2a303d; /* Abu-abu gelap 3 */
            --button-cancel: #FF6347; /* Merah untuk tombol batal */
            --button-cancel-hover: #E55337; /* Merah gelap untuk hover */
        }

        body {
            font-family: 'Poppins', sans-serif;
            display: flex;
            flex-direction: column; /* Mengubah arah flex menjadi kolom */
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            /* Gradasi warna latar belakang */
            background: linear-gradient(to right, var(--color-dark-grey-2), var(--color-dark-grey-3));
            color: var(--color-light-blue); /* Warna teks umum */
            box-sizing: border-box;
            overflow: hidden; /* Mencegah scrollbar saat animasi */
        }

        .container {
            background-color: var(--color-dark-grey-1); /* Latar belakang container */
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.4); /* Shadow lebih gelap */
            text-align: center;
            max-width: 500px;
            width: 90%;
            opacity: 0;
            transform: translateY(20px);
            animation: fadeInSlideUp 0.7s ease-out forwards; /* Animasi baru */
        }

        @keyframes fadeInSlideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        h1 {
            color: var(--color-light-blue); /* Judul warna biru terang */
            margin-bottom: 30px; /* Kembali ke margin default */
            font-size: 1.8em;
            line-height: 1.4;
            animation: textGlow 2s infinite alternate; /* Animasi cahaya teks */
        }

        .tagline {
            color: var(--color-light-blue); /* Warna biru terang untuk tagline */
            font-size: 1.2em; /* Sedikit lebih besar agar menonjol */
            margin-top: 20px; /* Jarak dari bawah card */
            margin-bottom: 0;
            font-weight: 600; /* Lebih tebal */
            text-shadow: 0 0 5px var(--color-light-blue); /* Sedikit glow */
            opacity: 0; /* Awalnya tersembunyi */
            animation: fadeIn 1s ease-out 0.8s forwards; /* Animasi muncul setelah card */
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes textGlow {
            from { text-shadow: 0 0 5px var(--color-light-blue); }
            to { text-shadow: 0 0 15px var(--color-light-blue), 0 0 25px var(--color-light-blue); }
        }

        .button-group {
            display: flex;
            flex-direction: column;
            gap: 15px;
            margin-top: 30px;
        }

        .button {
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: 5px;
            font-size: 1em;
            cursor: pointer;
            transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out, background-color 0.3s ease;
            text-decoration: none;
            display: inline-block;
            font-weight: 600;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2); /* Shadow default tombol */
            text-align: center; /* Memastikan teks di tengah untuk semua tombol */
        }

        .button:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.35);
        }

        .button.cancel-now {
            background-color: var(--button-cancel); /* Merah untuk tombol batal */
            color: white; /* Warna teks menjadi putih */
            animation: pulse 2s infinite alternate;
        }

        .button.cancel-now:hover {
            background-color: var(--button-cancel-hover);
        }

        @keyframes pulse {
            from { transform: scale(1); }
            to { transform: scale(1.05); }
        }

        .button.go-to-payment {
            background-color: var(--color-light-blue); /* Biru terang untuk tombol pembayaran */
            color: var(--color-dark-grey-2); /* Teks gelap pada tombol terang */
        }

        .button.go-to-payment:hover {
            background-color: #00A9B0; /* Sedikit lebih gelap dari biru terang */
        }

        .button a {
            color: inherit;
            text-decoration: none;
        }

        @media (min-width: 600px) {
            .button-group {
                flex-direction: row;
                justify-content: center;
            }
            .button {
                width: 200px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>APAKAH ANDA YAKIN INGIN MEMBATALKAN PESANAN ANDA?</h1>
        <form id="cancelForm" method="POST">
            <input type="hidden" name="cancel_confirmed" id="cancelConfirmed">
            <div class="button-group">
                <input type="submit" class="button cancel-now" value="BATALKAN SEKARANG" name="cancelnow">
                <a href="payment.php" class="button go-to-payment">LANJUT KE PEMBAYARAN</a>
            </div>
        </form>
    </div>
    
    <p class="tagline">Rent N Ride</p> <script>
        const cancelForm = document.getElementById('cancelForm');
        const cancelButton = document.querySelector('.button.cancel-now');
        const cancelConfirmedInput = document.getElementById('cancelConfirmed');

        cancelButton.addEventListener('click', function(event) {
            event.preventDefault();

            const confirmCancel = confirm('Apakah Anda benar-benar yakin ingin membatalkan pesanan ini? Tindakan ini tidak bisa dibatalkan.');
            if (confirmCancel) {
                cancelConfirmedInput.value = 'true';
                cancelForm.submit();
            }
        });
    </script>
</body>
</html>