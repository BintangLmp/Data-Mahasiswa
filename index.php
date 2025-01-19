<?php
include 'koneksi.php';

$query = "SELECT * FROM tb_mahasiswa";
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
        <a href="tambah.php" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Tambah Data</a>
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
                                <a href="edit.php?id=<?php echo $row['id']; ?>" class="bg-yellow-500 text-white px-3 py-2 rounded hover:bg-yellow-600 transition duration-300">
                                    <i class="fas fa-pen-to-square"></i>
                                </a>
                                <a href="hapus.php?id=<?php echo $row['id']; ?>" class="bg-red-500 text-white px-3 py-2 rounded hover:bg-red-600 transition duration-300" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>

</html>