<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $prodi = $_POST['prodi'];
    $angkatan = $_POST['angkatan'];
    $hobi = $_POST['hobi'];
    $cita_cita = $_POST['cita_cita'];
    $makanan_kesukaan = $_POST['makanan_kesukaan'];

    $query = "UPDATE tb_mahasiswa SET nim='$nim', nama='$nama', prodi='$prodi', angkatan='$angkatan', hobi='$hobi', cita_cita='$cita_cita', makanan_kesukaan='$makanan_kesukaan' WHERE id=$id";
    mysqli_query($koneksi, $query);

    header('Location: index.php');
    exit();
}

$id = $_GET['id'];
$query = "SELECT * FROM tb_mahasiswa WHERE id=$id";
$result = mysqli_query($koneksi, $query);
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Edit Data Mahasiswa</h1>
        <form method="POST" action="">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <div class="mb-4">
                <label class="block text-gray-700">NIM</label>
                <input type="text" name="nim" class="w-full px-4 py-2 border rounded" value="<?php echo $row['nim']; ?>" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Nama</label>
                <input type="text" name="nama" class="w-full px-4 py-2 border rounded" value="<?php echo $row['nama']; ?>" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Program Studi</label>
                <input type="text" name="prodi" class="w-full px-4 py-2 border rounded" value="<?php echo $row['prodi']; ?>" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Angkatan</label>
                <input type="text" name="angkatan" class="w-full px-4 py-2 border rounded" value="<?php echo $row['angkatan']; ?>" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Hobi</label>
                <input type="text" name="hobi" class="w-full px-4 py-2 border rounded" value="<?php echo $row['hobi']; ?>" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Cita-Cita</label>
                <input type="text" name="cita_cita" class="w-full px-4 py-2 border rounded" value="<?php echo $row['cita_cita']; ?>" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Makanan Kesukaan</label>
                <input type="text" name="makanan_kesukaan" class="w-full px-4 py-2 border rounded" value="<?php echo $row['makanan_kesukaan']; ?>" required>
            </div>
            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Simpan</button>
            <a href="index.php" class="bg-gray-500 text-white px-4 py-2 rounded ml-2">Kembali</a>
        </form>
    </div>
</body>
</html>