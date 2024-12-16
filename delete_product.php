<?php
include 'koneksi.php';

// Check if the product ID is provided
if (isset($_GET['id'])) {
  $id = $_GET['id'];

  // Prepare and execute the SQL query to delete data
  $sql = "DELETE FROM produk WHERE id = $id";
  if ($con->query($sql) === TRUE) {
    echo "<script>alert('Product deleted successfully!');</script>";
    header('Location: admin.php');
    exit();
  } else {
    echo "<script>alert('Error deleting product: " . $con->error . "');</script>";
  }
} else {
  echo "<script>alert('Invalid request!');</script>";
  header('Location: admin.php');
  exit();
}
?>