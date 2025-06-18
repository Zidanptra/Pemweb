<?php 
include 'db.php';
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CRUD Artikel</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .sidebar {
      width: 220px;
      height: 100vh;
      background: linear-gradient(180deg, #343a40, #212529);
      color: white;
      padding: 20px;
      position: fixed;
    }
    .sidebar h4 {
      margin-bottom: 30px;
    }
    .sidebar a {
      color: #f8f9fa;
      display: block;
      margin-bottom: 10px;
      text-decoration: none;
    }
    .sidebar a:hover {
      color: #ffc107;
    }
    .content {
      margin-left: 240px;
      padding: 30px;
    }
    .card {
      border-radius: 16px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    .card img {
      max-height: 150px;
      object-fit: cover;
    }
  </style>
</head>
<body>
  <div class="sidebar">
    <h4>Manajemen Artikel</h4>
    <a href="index.php">🏠 Dashboard</a>
    <a href="create.php">📝 Tambah Artikel</a>
    <a href="index.php">📄 Daftar Artikel</a>
    <a href="#">⚙️ Pengaturan</a>
    <a href="logout.php">🚪 Logout</a>
  </div>
  <div class="content">
    <div class="container">
      <h2 class="mb-4">Daftar Artikel</h2>
      
      <!-- Form Pencarian -->
      <form method="GET" class="mb-4">
        <div class="input-group" style="max-width: 400px;">
          <input type="text" name="q" class="form-control" placeholder="Cari artikel..." value="<?= isset($_GET['q']) ? htmlspecialchars($_GET['q']) : '' ?>">
          <button class="btn btn-outline-secondary" type="submit">Cari</button>
          <?php if (isset($_GET['q']) && $_GET['q'] != ''): ?>
            <a href="index.php" class="btn btn-outline-danger">Reset</a>
          <?php endif; ?>
        </div>
      </form>

      <div class="row">
        <?php
        $q = isset($_GET['q']) ? $conn->real_escape_string($_GET['q']) : '';
        if ($q != '') {
            $result = $conn->query("SELECT * FROM artikel WHERE judul LIKE '%$q%' OR isi LIKE '%$q%' ORDER BY id DESC");
        } else {
            $result = $conn->query("SELECT * FROM artikel ORDER BY id DESC");
        }

        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
        ?>
        <div class="col-md-4 mb-4">
          <div class="card">
            <img src="uploads/<?= htmlspecialchars($row['gambar']) ?>" class="card-img-top" alt="Gambar Artikel">
            <div class="card-body">
              <h5 class="card-title"><?= htmlspecialchars($row['judul']) ?></h5>
              <p class="card-text"><?= htmlspecialchars(substr($row['isi'], 0, 100)) ?>...</p>
              <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-primary btn-sm">Edit</a>
              <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus artikel ini?')">Hapus</a>
            </div>
          </div>
        </div>
        <?php 
          }
        } else {
        ?>
        <p class="text-muted">Tidak ada artikel yang ditemukan.</p>
        <?php
        }
        ?>
      </div>
    </div>
  </div>
</body>
</html>
