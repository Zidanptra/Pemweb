<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Artikel</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="d-flex">
    <?php include 'sidebar.php'; ?>
    <div class="container mt-4">
        <h2>Tambah Artikel</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <input type="text" name="judul" class="form-control mb-2" placeholder="Judul" required>
            <textarea name="isi" class="form-control mb-2" rows="5" placeholder="Isi artikel" required></textarea>
            <input type="file" name="gambar" class="form-control mb-2">
            <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
        </form>
        <?php
        if (isset($_POST['submit'])) {
            $judul = $_POST['judul'];
            $isi = $_POST['isi'];
            $gambar = $_FILES['gambar']['name'];
            $tmp = $_FILES['gambar']['tmp_name'];
            if ($gambar) {
                move_uploaded_file($tmp, "uploads/$gambar");
            }
            $conn->query("INSERT INTO artikel (judul, isi, gambar) VALUES ('$judul', '$isi', '$gambar')");
            header("Location: index.php");
        }
        ?>
    </div>
</div>
</body>
</html>
