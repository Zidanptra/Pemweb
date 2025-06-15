<?php
include 'db.php';
$id = $_GET['id'];
$conn->query("DELETE FROM artikel WHERE id=$id");
header("Location: index.php");
?>
