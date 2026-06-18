<?php
session_start();
if (!isset($_SESSION['login'])) { header("Location: index.php"); exit; }
include "koneksi.php";

if (isset($_POST['simpan'])) {
    $tanggal    = mysqli_real_escape_string($conn, $_POST['tanggal']);
    $keterangan = mysqli_real_escape_string($conn, $_POST['keterangan']);
    $jumlah     = (int) $_POST['jumlah'];

    mysqli_query($conn,
        "INSERT INTO pemasukan (tanggal, keterangan, jumlah)
         VALUES ('$tanggal', '$keterangan', '$jumlah')"
    );
    header("Location: pemasukan.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pemasukan — Sistem Keuangan</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="page">
    <div class="page-header">
        <h2>Tambah Pemasukan</h2>
        <p>Isi formulir di bawah untuk menambah data pemasukan baru</p>
    </div>

    <div class="card" style="max-width:520px;">
        <form method="POST">
            <div class="form-grid">
                <div class="form-group">
                    <label for="tanggal">Tanggal</label>
                    <input type="date" id="tanggal" name="tanggal"
                           value="<?= date('Y-m-d') ?>" required>
                </div>
                <div class="form-group">
                    <label for="keterangan">Keterangan</label>
                    <input type="text" id="keterangan" name="keterangan"
                           placeholder="Contoh: Gaji bulan ini" required>
                </div>
                <div class="form-group">
                    <label for="jumlah">Jumlah (Rp)</label>
                    <input type="number" id="jumlah" name="jumlah"
                           placeholder="Contoh: 3000000" min="0" required>
                </div>
                <div class="form-actions">
                    <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                    <a href="pemasukan.php" class="btn btn-outline">Batal</a>
                </div>
            </div>
        </form>
    </div>
</div>

</body>
</html>
