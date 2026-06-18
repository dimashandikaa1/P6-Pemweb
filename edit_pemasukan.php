<?php
session_start();
if (!isset($_SESSION['login'])) { header("Location: index.php"); exit; }
include "koneksi.php";

$id = (int) $_GET['id'];

$data = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT * FROM pemasukan WHERE id='$id'")
);

if (!$data) { header("Location: pemasukan.php"); exit; }

if (isset($_POST['update'])) {
    $tanggal    = mysqli_real_escape_string($conn, $_POST['tanggal']);
    $keterangan = mysqli_real_escape_string($conn, $_POST['keterangan']);
    $jumlah     = (int) $_POST['jumlah'];

    mysqli_query($conn,
        "UPDATE pemasukan SET
         tanggal='$tanggal', keterangan='$keterangan', jumlah='$jumlah'
         WHERE id='$id'"
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
    <title>Edit Pemasukan — Sistem Keuangan</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="page">
    <div class="page-header">
        <h2>Edit Pemasukan</h2>
        <p>Perbarui data pemasukan yang dipilih</p>
    </div>

    <div class="card" style="max-width:520px;">
        <form method="POST">
            <div class="form-grid">
                <div class="form-group">
                    <label for="tanggal">Tanggal</label>
                    <input type="date" id="tanggal" name="tanggal"
                           value="<?= htmlspecialchars($data['tanggal']) ?>" required>
                </div>
                <div class="form-group">
                    <label for="keterangan">Keterangan</label>
                    <input type="text" id="keterangan" name="keterangan"
                           value="<?= htmlspecialchars($data['keterangan']) ?>" required>
                </div>
                <div class="form-group">
                    <label for="jumlah">Jumlah (Rp)</label>
                    <input type="number" id="jumlah" name="jumlah"
                           value="<?= htmlspecialchars($data['jumlah']) ?>" min="0" required>
                </div>
                <div class="form-actions">
                    <button type="submit" name="update" class="btn btn-primary">Update</button>
                    <a href="pemasukan.php" class="btn btn-outline">Batal</a>
                </div>
            </div>
        </form>
    </div>
</div>

</body>
</html>
