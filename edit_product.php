<?php
include 'koneksi.php';

// Check if the product ID is provided
if (isset($_GET['id'])) {
  $id = $_GET['id'];

  // Fetch the product details from the database
  $sql = "SELECT * FROM produk WHERE id = $id";
  $result = $con->query($sql);

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
  } else {
    echo "<script>alert('Product not found!');</script>";
    header('Location: dashboard.php');
    exit();
  }
} else {
  echo "<script>alert('Invalid request!');</script>";
  header('Location: dashboard.php');
  exit();
}

// Check if the form is submitted
if (isset($_POST['update'])) {
  // Sanitize input data
  $nmprod = mysqli_real_escape_string($con, $_POST['nmprod']);
  $hrg = mysqli_real_escape_string($con, $_POST['hrg']);
  $stok = mysqli_real_escape_string($con, $_POST['stok']);
  $kategori = mysqli_real_escape_string($con, $_POST['kategori']);
  $desc = mysqli_real_escape_string($con, $_POST['desc']);

  // Prepare and execute the SQL query to update data
  $sql = "UPDATE produk SET nama = '$nmprod', harga = '$hrg', stok = '$stok', kategori = '$kategori', `desc` = '$desc' WHERE id = $id";
  if ($con->query($sql) === TRUE) {
    echo "<script>alert('Product updated successfully!');</script>";
    header('Location: admin.php');
    exit();
  } else {
    echo "<script>alert('Error updating product: " . $con->error . "');</script>";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/dashboard/">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">

    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">Edit Product</h1>
      <!-- ... (Your existing toolbar) ... -->
    </div>

    <form method="POST" action="<?php echo $_SERVER['PHP_SELF'] . '?id=' . $id; ?>">
      <div class="mb-3">
        <label for="nmprod" class="form-label">Product Name:</label>
        <input type="text" class="form-control" id="nmprod" name="nmprod" value="<?php echo $row['nama']; ?>" required>
      </div>
      <div class="mb-3">
        <label for="hrg" class="form-label">Price:</label>
        <input type="text" class="form-control" id="hrg" name="hrg" value="<?php echo $row['harga']; ?>" required>
      </div>
      <div class="mb-3">
        <label for="stok" class="form-label">Stock:</label>
        <input type="text" class="form-control" id="stok" name="stok" value="<?php echo $row['stok']; ?>" required>
      </div>
      <div class="mb-3">
        <label for="kategori" class="form-label">Category:</label>
        <input type="text" class="form-control" id="kategori" name="kategori" value="<?php echo $row['kategori']; ?>" required>
      </div>
      <div class="mb-3">
        <label for="desc" class="form-label">Desc.:</label>
        <input type="text" class="form-control" id="desc" name="desc" value="<?php echo $row['desc']; ?>" required>
      </div>
      <button type="submit" name="update" class="btn btn-primary">Update Product</button>
    </form>
  </main>
  <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.3.2/dist/chart.umd.js" integrity="sha384-eI7PSr3L1XLISH8JdDII5YN/njoSsxfbrkCTnJrzXt+ENP5MOVBxD+l6sEG4zoLp" crossorigin="anonymous"></script>
  </body>
</html>