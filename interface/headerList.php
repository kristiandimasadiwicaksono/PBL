<?php
    include('../koneksi.php');
    session_start();
    if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
        header('Location: index.html?notification=1'); // Redirect ke halaman utama dengan query parameter
        exit();
    }
    
    // Ambil data mahasiswa, kelas, dan prodi
    $query = "SELECT m.id_mhs, m.nama_mhs, m.npm, m.alamat, k.nama_kelas, k.thn_akademik, p.nama_prodi FROM mahasiswa m
        JOIN kelas k ON m.id_mhs = k.id_mhs
        JOIN prodi p ON k.id_kls = p.id_kls";

    $result = mysqli_query($connection, $query);
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Data Mahasiswa</title>
    <style>
        .hidden{
            display: none;
        }
    </style>
    <script>
        function togglePopup(popupId) {
            const popup = document.getElementById(popupId);
            popup.classList.toggle('hidden');
        }

        function openEditPopup(id, nama, npm, alamat, nama_kelas, thn_akademik, nama_prodi) {
            togglePopup('editPopup');
            document.getElementById('edit_id_mhs').value = id;
            document.getElementById('edit_nama_mhs').value = nama;
            document.getElementById('edit_npm').value = npm;
            document.getElementById('edit_alamat').value = alamat;
            document.getElementById('edit_nama_kelas').value = nama_kelas;
            document.getElementById('edit_thn_akademik').value = thn_akademik;
            document.getElementById('edit_nama_prodi').value = nama_prodi;
        }
    </script>
</head>
<body class="bg-gray-500">

    <!-- Navbar -->
    <nav class="fixed top-0 z-40 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
        <div class="px-3 py-3 lg:px-5 lg:pl-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center justify-start rtl:justify-end">
                    <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button" class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                        <span class="sr-only">Open sidebar</span>
                        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
                        </svg>
                    </button>
                    <a href="headerList.php" class="px-4 self-center text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-white">Data Mahasiswa</a>
                </div>
            </div>
        </div>
    </nav>
    
    <!-- Sidebar -->
    <aside id="logo-sidebar" class="fixed top-0 left-0 z-30 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700" aria-label="Sidebar">
        <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
            <ul class="space-y-2 font-medium">
                <li>
                    <a href="" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                            <path d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z"/>
                        </svg>
                        <span class="ms-3">Data Mahasiswa</span>
                    </a>
                </li>
                <li>
                    <a href="Header.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 16">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 8h11m0 0L8 4m4 4-4 4m4-11h3a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-3"/>
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap">Kembali</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>

    <!-- Tambah Data -->
    <div id="tambahPopup" class="hidden fixed inset-0 bg-gray-900 bg-opacity-75 flex justify-center items-center z-50 overflow-y-auto max-h-screen">
        <div class="relative bg-white p-6 rounded-lg shadow-md w-full max-w-md">
            <img src="https://iconape.com/wp-content/files/rz/10500/png/close.png" class="absolute top-2 right-2 w-10 rounded-full cursor-pointer" onclick="togglePopup('tambahPopup')">
                <i class="fas fa-times"></i>
            <form method="POST" action="../proses/simpan.php">
                <h2 class="text-2xl font-bold text-center">Daftar</h2>
                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-700">Nama</label>
                    <input type="text" name="nama_mhs" id="nama_mhs" class="mt-1 block w-full px-3 py-2 text-sm text-gray-700 border border-gray-300 rounded-md" required>
                </div>
                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-700">NPM</label>
                    <input type="number" name="npm" id="npm" class="mt-1 block w-full px-3 py-2 text-sm text-gray-700 border border-gray-300 rounded-md" required>
                </div>
                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-700">Alamat</label>
                    <textarea name="alamat" id="alamat" class="mt-1 block w-full px-3 py-2 text-sm text-gray-700 border border-gray-300 rounded-md" rows="4" required></textarea>
                </div>
                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-700">Program Studi</label>
                    <select name="nama_prodi" id="nama_prodi" class="mt-1 block w-full px-3 py-2 text-sm text-gray-700 border border-gray-300 rounded-md required">
                        <option value="">Pilih Prodi</option>
                        <option value="D3 Teknik Informatika">D3 Teknik Informatika</option>
                        <option value="D3 Teknik Mesin">D3 Teknik Mesin</option>
                        <option value="D3 Teknik Elektronika">D3 Teknik Elektronika</option>
                        <option value="D3 Teknik Listrik">D3 Teknik Listrik</option>
                        <option value="D4 Rekayasa Keamanan Siber">D4 Rekayasa Keamanan Siber</option>
                        <option value="D4 Teknologi Rekayasa Multimedia">D4 Teknologi Rekayasa Multimedia</option>
                        <option value="D4 Akuntansi Lembaga Keuangan Syariah">D4 Akuntansi Lembaga Keuangan Syariah</option>
                        <option value="D4 Teknik Pengendalian Pencemaran Lingkungan">D4 Teknik Pengendalian Pencemaran Lingkungan</option>
                        <option value="D4 Teknologi Rekayasa Energi Terbarukan">D4 Teknologi Rekayasa Energi Terbarukan</option>
                        <option value="D4 Teknologi Rekayasa Mekatronika">D4 Teknologi Rekayasa Mekatronika</option>
                        <option value="D4 Pengembangan Produk Agroindustri">D4 Pengembangan Produk Agroindustri</option>
                    </select>
                </div>
                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-700">Kelas</label>
                    <select name="nama_kelas" id="nama_kelas" class="mt-1 block w-full px-3 py-2 text-sm text-gray-700 border border-gray-300 rounded-md ">
                        <option value="">Pilih Kelas</option>
                        <option value="1A">1A</option>
                        <option value="1B">1B</option>
                        <option value="1C">1C</option>
                        <option value="1D">1D</option>
                        <option value="2A">2A</option>
                        <option value="2B">2B</option>
                        <option value="2C">2C</option>
                        <option value="2D">2D</option>
                        <option value="3A">3A</option>
                        <option value="3B">3B</option>
                        <option value="3C">3C</option>
                        <option value="3D">3D</option>
                    </select>
                </div>
                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-700">Tahun Akademik</label>
                    <select name="thn_akademik" id="thn_akademik" class="mt-1 block w-full px-3 py-2 text-sm text-gray-700 border border-gray-300 rounded-md required">
                        <option value="">Pilih Tahun</option>
                        <option value="2024">2024</option>
                        <option value="2023">2023</option>
                        <option value="2022">2022</option>
                        <option value="2021">2021</option>
                        <option value="2020">2020</option>
                        <option value="2019">2019</option>
                        <option value="2018">2018</option>
                        <option value="2017">2017</option>
                        <option value="2016">2016</option>
                        <option value="2015">2015</option>
                        <option value="2014">2014</option>
                    </select>
                </div>
                <div class="mt-6">
                    <button type="submit" class="w-full px-4 py-2 text-white bg-blue-500 border border-transparent rounded-md hover:bg-blue-600">Daftar</button>
                    <label>Sudah punya akun? <a href="#" class="mt-2 text-sm text-blue-500" onclick="togglePopup('registerPopup'); togglePopup('loginPopup')">Masuk</a></label>
                </div>
            </form>
        </div>
    </div>

    <!-- Main Content -->

    <div class="flex flex-col items-center justify-center min-h-screen pt-20 sm:ml-64">
        <div class="w-[90%] mb-4 flex justify-start">
            <a href="javascript:void(0)" onclick="togglePopup('tambahPopup')" class="bg-blue-500 hover:bg-blue-700 text-white font-bold px-4 py-2 rounded z-30">Tambah Data</a>
        </div>
        <table class="bg-white shadow-md rounded w-[90%]">
            <thead>
                <tr>
                    <th class="px-4 py-2">No</th>
                    <th class="px-2 py-1">Nama</th>
                    <th class="px-4 py-2">NPM</th>
                    <th class="px-4 py-2">Alamat</th>
                    <th class="px-4 py-2">Kelas</th>
                    <th class="px-4 py-2">Tahun Akademik</th>
                    <th class="px-4 py-2">Program Studi</th>
                    <th class="px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($data as $row):    
                ?>
                <tr class="text-center">
                    <td class="px-4 py-4"><?php echo $no++; ?></td>
                    <td class="px-4 py-4 text-sm"><?php echo $row['nama_mhs'] ?></td>
                    <td class="px-4 py-4 text-sm"><?php echo $row['npm'] ?></td>
                    <td class="px-4 py-4 text-sm"><?php echo $row['alamat'] ?></td>
                    <td class="px-4 py-4 text-sm"><?php echo $row['nama_kelas'] ?></td>
                    <td class="px-4 py-4 text-sm"><?php echo $row['thn_akademik'] ?></td>
                    <td class="px-4 py-4 text-sm"><?php echo $row['nama_prodi'] ?></td>
                    <td class="px-1 py-1 ">
                        <a href="../proses/hapusData.php?id=<?php echo $row['id_mhs']; ?>" class="bg-red-600 text-white font-semibold py-1 px-2 rounded text-sm">HAPUS</a>
                        <a href="javascript:void(0)" onclick="openEditPopup('<?php echo $row['id_mhs']; ?>', '<?php echo $row['nama_mhs']; ?>', '<?php echo $row['npm']; ?>', '<?php echo $row['alamat']; ?>', '<?php echo $row['nama_kelas']; ?>', '<?php echo $row['thn_akademik']; ?>', '<?php echo $row['nama_prodi']; ?>')" class="bg-blue-500 text-white font-semibold py-1 px-2 rounded text-sm">EDIT</a>
                    </td>
                </tr>
                <?php
                endforeach;
                ?>
            </tbody>
        </table>
    </div>

    <!-- Popup Edit Form -->
    <div id="editPopup" class="hidden fixed inset-0 bg-gray-900 bg-opacity-75 flex justify-center items-center z-50 overflow-y-auto max-h-screen">
        <div class="relative bg-white p-6 rounded-lg shadow-md w-full max-w-md">
            <img src="https://iconape.com/wp-content/files/rz/10500/png/close.png" class="absolute top-2 right-2 w-10 rounded-full cursor-pointer" onclick="togglePopup('editPopup')">
            <form method="POST" action="../proses/updateData.php">
                <h2 class="text-2xl font-bold text-center">Edit Data Mahasiswa</h2>
                <input type="hidden" name="id_mhs" id="edit_id_mhs">
                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-700">Nama</label>
                    <input type="text" name="nama_mhs" id="edit_nama_mhs" class="mt-1 block w-full px-3 py-2 text-sm text-gray-700 border border-gray-300 rounded-md" required>
                </div>
                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-700">NPM</label>
                    <input type="number" name="npm" id="edit_npm" class="mt-1 block w-full px-3 py-2 text-sm text-gray-700 border border-gray-300 rounded-md" required>
                </div>
                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-700">Alamat</label>
                    <textarea name="alamat" id="edit_alamat" class="mt-1 block w-full px-3 py-2 text-sm text-gray-700 border border-gray-300 rounded-md" rows="4" required></textarea>
                </div>
                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-700">Program Studi</label>
                    <select name="nama_prodi" id="edit_nama_prodi" class="mt-1 block w-full px-3 py-2 text-sm text-gray-700 border border-gray-300 rounded-md" required>
                    <option value="">Pilih Prodi</option>
                        <option value="D3 Teknik Informatika">D3 Teknik Informatika</option>
                        <option value="D3 Teknik Mesin">D3 Teknik Mesin</option>
                        <option value="D3 Teknik Elektronika">D3 Teknik Elektronika</option>
                        <option value="D3 Teknik Listrik">D3 Teknik Listrik</option>
                        <option value="D4 Rekayasa Keamanan Siber">D4 Rekayasa Keamanan Siber</option>
                        <option value="D4 Teknologi Rekayasa Multimedia">D4 Teknologi Rekayasa Multimedia</option>
                        <option value="D4 Akuntansi Lembaga Keuangan Syariah">D4 Akuntansi Lembaga Keuangan Syariah</option>
                        <option value="D4 Teknik Pengendalian Pencemaran Lingkungan">D4 Teknik Pengendalian Pencemaran Lingkungan</option>
                        <option value="D4 Teknologi Rekayasa Energi Terbarukan">D4 Teknologi Rekayasa Energi Terbarukan</option>
                        <option value="D4 Teknologi Rekayasa Mekatronika">D4 Teknologi Rekayasa Mekatronika</option>
                        <option value="D4 Pengembangan Produk Agroindustri">D4 Pengembangan Produk Agroindustri</option>
                    </select>
                </div>
                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-700">Kelas</label>
                    <select name="nama_kelas" id="edit_nama_kelas" class="mt-1 block w-full px-3 py-2 text-sm text-gray-700 border border-gray-300 rounded-md" required>
                        <option value="">Pilih Kelas</option>
                        <option value="1A">1A</option>
                        <option value="1B">1B</option>
                        <option value="1C">1C</option>
                        <option value="1D">1D</option>
                        <option value="2A">2A</option>
                        <option value="2B">2B</option>
                        <option value="2C">2C</option>
                        <option value="2D">2D</option>
                        <option value="3A">3A</option>
                        <option value="3B">3B</option>
                        <option value="3C">3C</option>
                        <option value="3D">3D</option>
                    </select>
                </div>
                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-700">Tahun Akademik</label>
                    <select name="thn_akademik" id="edit_thn_akademik" class="mt-1 block w-full px-3 py-2 text-sm text-gray-700 border border-gray-300 rounded-md" required>
                        <option value="">Pilih Tahun</option>
                        <option value="2024">2024</option>
                        <option value="2023">2023</option>
                        <option value="2022">2022</option>
                        <option value="2021">2021</option>
                        <option value="2020">2020</option>
                        <option value="2019">2019</option>
                        <option value="2018">2018</option>
                        <option value="2017">2017</option>
                        <option value="2016">2016</option>
                        <option value="2015">2015</option>
                        <option value="2014">2014</option>
                    </select>
                </div>
                <div class="mt-6">
                    <button type="submit" class="w-full px-4 py-2 text-white bg-blue-500 border border-transparent rounded-md hover:bg-blue-600">Update</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
