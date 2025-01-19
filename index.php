<?php
include 'koneksi.php';

// Cek apakah ada keyword pencarian
$keyword = isset($_GET['search']) ? $_GET['search'] : '';

// Jumlah data per halaman
$limit = 5;

// Halaman aktif (default: 1)
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Query untuk menghitung total data
if (!empty($keyword)) {
    $query_count = "SELECT COUNT(*) as total FROM tb_mahasiswa 
                    WHERE nim LIKE '%$keyword%' 
                    OR nama LIKE '%$keyword%' 
                    OR prodi LIKE '%$keyword%' 
                    OR angkatan LIKE '%$keyword%' 
                    OR hobi LIKE '%$keyword%' 
                    OR cita_cita LIKE '%$keyword%' 
                    OR makanan_kesukaan LIKE '%$keyword%'";
} else {
    $query_count = "SELECT COUNT(*) as total FROM tb_mahasiswa";
}

$result_count = mysqli_query($koneksi, $query_count);
$row_count = mysqli_fetch_assoc($result_count);
$total_data = $row_count['total'];

// Hitung total halaman
$total_pages = ceil($total_data / $limit);

// Query untuk menampilkan data dengan pagination
if (!empty($keyword)) {
    $query = "SELECT * FROM tb_mahasiswa 
              WHERE nim LIKE '%$keyword%' 
              OR nama LIKE '%$keyword%' 
              OR prodi LIKE '%$keyword%' 
              OR angkatan LIKE '%$keyword%' 
              OR hobi LIKE '%$keyword%' 
              OR cita_cita LIKE '%$keyword%' 
              OR makanan_kesukaan LIKE '%$keyword%' 
              LIMIT $limit OFFSET $offset";
} else {
    $query = "SELECT * FROM tb_mahasiswa LIMIT $limit OFFSET $offset";
}

$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Mahasiswa</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Daftar Mahasiswa</h1>

        <!-- Form Pencarian -->
        <form method="GET" action="" class="mb-4 flex items-center">
            <input type="text" name="search" placeholder="Cari mahasiswa..." value="<?php echo htmlspecialchars($keyword); ?>" 
                   class="w-full px-4 py-2 border border-gray-300 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-r-lg hover:bg-blue-600 transition duration-300">
                <i class="fas fa-search"></i> <!-- Ikon Search -->
            </button>
        </form>

        <!-- Tombol Tambah Data -->
        <a href="tambah.php" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Tambah Data</a>

        <!-- Tabel Data Mahasiswa -->
        <table class="min-w-full bg-white border border-gray-300 rounded-lg overflow-hidden">
            <thead class="bg-gray-200">
                <tr>
                    <th class="py-3 px-4 border-b border-gray-300 text-left">NIM</th>
                    <th class="py-3 px-4 border-b border-gray-300 text-left">Nama</th>
                    <th class="py-3 px-4 border-b border-gray-300 text-left">Program Studi</th>
                    <th class="py-3 px-4 border-b border-gray-300 text-left">Angkatan</th>
                    <th class="py-3 px-4 border-b border-gray-300 text-left">Hobi</th>
                    <th class="py-3 px-4 border-b border-gray-300 text-left">Cita-Cita</th>
                    <th class="py-3 px-4 border-b border-gray-300 text-left">Makanan Kesukaan</th>
                    <th class="py-3 px-4 border-b border-gray-300 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr class="hover:bg-gray-50 transition duration-200">
                        <td class="py-3 px-4 border-b border-gray-300"><?php echo $row['nim']; ?></td>
                        <td class="py-3 px-4 border-b border-gray-300"><?php echo $row['nama']; ?></td>
                        <td class="py-3 px-4 border-b border-gray-300"><?php echo $row['prodi']; ?></td>
                        <td class="py-3 px-4 border-b border-gray-300"><?php echo $row['angkatan']; ?></td>
                        <td class="py-3 px-4 border-b border-gray-300"><?php echo $row['hobi']; ?></td>
                        <td class="py-3 px-4 border-b border-gray-300"><?php echo $row['cita_cita']; ?></td>
                        <td class="py-3 px-4 border-b border-gray-300"><?php echo $row['makanan_kesukaan']; ?></td>
                        <td class="py-3 px-4 border-b border-gray-300">
                            <div class="flex items-center space-x-2">
                                <!-- Tombol Edit -->
                                <a href="edit.php?id=<?php echo $row['id']; ?>" class="bg-yellow-500 text-white px-3 py-2 rounded hover:bg-yellow-600 transition duration-300">
                                    <i class="fas fa-pen-to-square"></i>
                                </a>

                                <!-- Tombol Hapus -->
                                <a href="hapus.php?id=<?php echo $row['id']; ?>" class="bg-red-500 text-white px-3 py-2 rounded hover:bg-red-600 transition duration-300" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="flex justify-center mt-6">
            <nav class="inline-flex rounded-md shadow-sm">
                <?php if ($page > 1): ?>
                    <a href="?page=<?php echo $page - 1; ?>&search=<?php echo urlencode($keyword); ?>" class="px-4 py-2 border border-gray-300 rounded-l-lg bg-white text-gray-700 hover:bg-gray-50">
                        Sebelumnya
                    </a>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <a href="?page=<?php echo $i; ?>&search=<?php echo urlencode($keyword); ?>" class="px-4 py-2 border border-gray-300 bg-white text-gray-700 hover:bg-gray-50 <?php echo ($i == $page) ? 'bg-blue-500 text-white' : ''; ?>">
                        <?php echo $i; ?>
                    </a>
                <?php endfor; ?>

                <?php if ($page < $total_pages): ?>
                    <a href="?page=<?php echo $page + 1; ?>&search=<?php echo urlencode($keyword); ?>" class="px-4 py-2 border border-gray-300 rounded-r-lg bg-white text-gray-700 hover:bg-gray-50">
                        Selanjutnya
                    </a>
                <?php endif; ?>
            </nav>
        </div>
    </div>
</body>

</html>