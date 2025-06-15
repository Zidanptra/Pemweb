<?php include 'db.php'; ?>
<?php
$id = $_GET['id'];
$data = $conn->query("SELECT * FROM artikel WHERE id=$id")->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Artikel</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="d-flex">
    <?php include 'sidebar.php'; ?>
    <div class="container mt-4">
        <h2>Edit Artikel</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <input type="text" name="judul" class="form-control mb-2" value="<?= $data['judul'] ?>" required>
            <textarea name="isi" class="form-control mb-2" rows="5" required><?= $data['isi'] ?></textarea>
            <img src="uploads/<?= $data['gambar'] ?>" width="100"><br>
            <input type="file" name="gambar" class="form-control mb-2">
            <button type="submit" name="submit" class="btn btn-success">Update</button>
        </form>
        <?php
        if (isset($_POST['submit'])) {
            $judul = $_POST['judul'];
            $isi = $_POST['isi'];
            $gambar = $_FILES['gambar']['name'];
            $tmp = $_FILES['gambar']['tmp_name'];

            if ($gambar) {
                move_uploaded_file($tmp, "uploads/$gambar");
                $conn->query("UPDATE artikel SET judul='$judul', isi='$isi', gambar='$gambar' WHERE id=$id");
            } else {
                $conn->query("UPDATE artikel SET judul='$judul', isi='$isi' WHERE id=$id");
            }
            header("Location: index.php");
        }
        ?>
    </div>
</div>
</body>
</html>
