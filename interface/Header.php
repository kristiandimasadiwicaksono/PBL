<?php
include ('../koneksi.php');
session_start();
if (!isset($_SESSION['nama_lengkap'])) {
    // Jika belum login, arahkan ke halaman login
    header('Location: index.html?' . urlencode($_SERVER['REQUEST_URI']));
    exit();
}
$nama_lengkap = isset($_SESSION['nama_lengkap']) ? $_SESSION['nama_lengkap'] : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
    <title>Perkuliahan Politeknik Negeri Cilacap</title>
</head>
    <style>
        body{
            font-family: 'Rubik', sans-serif;
            
        }
        .hidden {
            display: none;
        }
        .fixed {
            position: fixed;
        }
    </style>
<body class="scroll-smooth">
    <div class="navbar fixed top-0 bg-gray-400 w-full z-10 bg-opacity-40">
        <nav class="flex justify-between w-[90%] mx-auto">
            <div class="flex justify-items-start">  
                <a href="index.html"><img class="w-20 py-2" src="https://1.bp.blogspot.com/-1zqGVJ340HU/XJSy4wgCRkI/AAAAAAAAQC0/flSsSZ4v7IssnGCLG4UYFEPzQrnxKpWpwCLcBGAs/s72-c/logoPNC.png"> </a>
            </div>
            <div class="flex">
                <ul class="flex items-center gap-7">
                    <li><a class="hover:text-blue-50 hover:bg-slate-600 rounded-full px-5 py-2 " href="Header.php#home" >Home</a></li>
                    <li><a class="hover:text-blue-50 hover:bg-slate-600 rounded-full px-5 py-2" href="Header.php#about" >Tentang</a></li>
                    <li><a class="hover:text-blue-50 hover:bg-slate-600 rounded-full px-5 py-2" href="headerList.php" >Data Mahasiswa</a></li>
                    <li><a class=" bg-emerald-900 rounded-full px-5 py-2 text-white cursor-pointer" onclick="document.getElementById('logout').submit()">Keluar</a></li>
                </ul>
            </div>
        </nav>
    </div>
    <div id="home" class="bg-black bg-[url('https://pnc.ac.id/wp-content/uploads/2022/01/GDG-PNC-1-scaled.jpg')] bg-cover bg-center opacity-80">
        <div class="flex flex-col items-center justify-center h-screen backdrop-blur-md">
        <p class="text-2xl font-medium text-white mb-4">Hai, <?php echo htmlspecialchars($nama_lengkap); ?></p>
        <h1 class="text-5xl font-bold text-black">Selamat Datang di Politeknik Negeri Cilacap</h1>
            <p class="text-lg pt-2 text-gray-900">Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore, in?</p>
        </div>
    </div>

    <div id="about" class="bg-gray-600 h-screen">
        <div class="flex flex-col items-center justify-center h-screen">
            <h1 class="text-4xl font-bold text-white text-left ">Tentang Politeknik Negeri Cilacap</h1>
            <p class="text-lg text-blue-100 text-center"> Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quibusdam aperiam vero expedita repudiandae, officia dicta voluptas optio accusantium omnis neque!</p>
        </div>
    </div>

    <form id="logout" action="../proses/logout.php" method="POST" class="hidden"></form>
</body>
</html>