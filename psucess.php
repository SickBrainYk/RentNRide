<html>
  <head>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;700;900&display=swap" rel="stylesheet">
    <style>
      body {
        text-align: center;
        background-image: url("aset/rr.jpg");
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover;
        min-height: 100vh; /* Pastikan background menutupi seluruh viewport */
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 0;
        font-family: "Nunito Sans", sans-serif;
      }

      h1 {
        color: #4CAF50; /* Warna hijau yang lebih cerah */
        font-weight: 900;
        font-size: 48px; /* Ukuran font lebih besar */
        margin-bottom: 15px;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1); /* Efek bayangan pada teks */
      }

      p {
        color: #555; /* Warna abu-abu gelap untuk kontras */
        font-size: 22px; /* Ukuran font sedikit lebih besar */
        line-height: 1.6; /* Spasi baris untuk keterbacaan */
        margin: 0 0 20px 0; /* Tambahkan margin bawah */
      }

      i.checkmark {
        color: #4CAF50; /* Warna hijau yang sama dengan H1 */
        font-size: 120px; /* Ukuran icon lebih besar */
        line-height: 200px;
        margin-left: 0; /* Hapus margin negatif */
        display: block; /* Agar centered dengan margin auto */
        text-align: center;
      }

      .card {
        background: rgba(255, 255, 255, 0.95); /* Sedikit transparan untuk efek modern */
        padding: 60px 80px; /* Padding lebih besar */
        border-radius: 12px; /* Border radius lebih besar untuk tampilan lembut */
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15); /* Bayangan yang lebih menonjol */
        display: inline-block;
        margin-top: 0; /* Hapus margin-top, gunakan flexbox body untuk centering */
        backdrop-filter: blur(5px); /* Efek blur pada background di belakang card */
        animation: fadeInScale 0.7s ease-out; /* Animasi saat card muncul */
      }

      @keyframes fadeInScale {
        from {
          opacity: 0;
          transform: scale(0.9);
        }
        to {
          opacity: 1;
          transform: scale(1);
        }
      }

      .circle-container {
        border-radius: 50%; /* Membuat lingkaran sempurna */
        height: 200px;
        width: 200px;
        background: #e8f5e9; /* Warna latar belakang lingkaran yang lebih lembut */
        margin: 0 auto 30px auto; /* Margin bawah untuk spasi dari teks */
        display: flex;
        justify-content: center;
        align-items: center;
        box-shadow: inset 0 0 15px rgba(0, 0, 0, 0.05); /* Bayangan dalam untuk kedalaman */
      }

      #back {
        width: 200px; /* Ukuran tombol lebih lebar */
        height: 50px; /* Tinggi tombol lebih besar */
        background: linear-gradient(45deg, #ff9800, #ff5722); /* Gradient warna oranye ke merah */
        border: none;
        border-radius: 8px; /* Border radius pada tombol */
        margin-top: 25px; /* Margin atas lebih besar */
        font-size: 20px; /* Ukuran font tombol lebih besar */
        cursor: pointer;
        transition: all 0.3s ease; /* Transisi untuk hover effect */
        box-shadow: 0 5px 15px rgba(255, 114, 0, 0.4); /* Bayangan tombol */
      }

      #back:hover {
        transform: translateY(-3px); /* Efek angkat saat hover */
        box-shadow: 0 8px 20px rgba(255, 114, 0, 0.6);
      }

      #back a {
        text-decoration: none;
        color: white; /* Warna teks tombol putih */
        font-weight: bold;
        display: block; /* Agar link memenuhi seluruh tombol */
        line-height: 50px; /* Menengah teks di tombol */
      }

      .ba {
        width: auto; /* Hapus width yang tidak perlu */
      }
    </style>
  </head>
  <body>
    <div class="card">
      <div class="circle-container"> <i class="checkmark">✓</i>
      </div>
      <h1>Success</h1>
      <p>We received your rental request;<br/> we'll be in touch shortly!</p>
      <div class="ba"><button id="back"><a href="cardetails.php">Search Cars</a></button></div>
    </div>
  </body>
</html>