<?php
include 'koneksi.php';
session_start();

// Check if the user is logged in
if (!isset($_SESSION['pelanggan'])) {
    header('Location: login.php');
    exit();
}

// Get the customer's username from the session
$username = $_SESSION['pelanggan'];

// Check if the user's details are available in the session
if (isset($_SESSION['email']) && isset($_SESSION['hp']) && isset($_SESSION['alamat'])) {
    // User details are available, proceed to display the profile
    $email = $_SESSION['email'];
    $hp = $_SESSION['hp'];
    $alamat = $_SESSION['alamat'];
} else {
    // User details are not available, redirect to the login page
    echo "<script>alert('User not found!');</script>";
    header('Location: login.php');
    exit();
}

// Handle form submission for profile update
if (isset($_POST['update_profile'])) {
    $new_email = $_POST['email'];
    $new_hp = $_POST['hp'];
    $new_alamat = $_POST['alamat'];

    // Update user details in the database (replace with your actual database query)
    $update_query = "UPDATE user SET email='$new_email', hp='$new_hp', alamat='$new_alamat' WHERE username='$username'";
    $update_result = mysqli_query($con, $update_query);

    if ($update_result) {
        // Update successful, refresh the session with new details
        $_SESSION['email'] = $new_email;
        $_SESSION['hp'] = $new_hp;
        $_SESSION['alamat'] = $new_alamat;

        echo "<script>alert('Profile updated successfully!');</script>";
    } else {
        echo "<script>alert('Error updating profile!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .profile-card .form-control-plaintext {
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 0.375rem;
            padding: 10px;
            text-align: center; /* Add text-align: center here */
        }
        body.dark-mode {
            background-color: #333;
            color: #fff;
        }

        .dark-mode .btn-outline-dark {
            border-color: #fff;
            color: #fff;
        }

        .dark-mode .btn-outline-dark:hover {
            background-color: #fff;
            color: #333;
        }

        .dark-mode .fa-sun {
            display: none;
        }

        .dark-mode .fa-moon {
            display: inline-block;
        }

        .dark-mode .avatar {
            border-color: #fff;
        }

        .dark-mode .card-header {
            background-color: #222;
        }

        .dark-mode .form-control-plaintext {
            background-color: #444;
            border-color: #555;
        }

        .dark-mode .btn-primary {
            background-color: #007bff;
            border: none;
        }

        .dark-mode .btn-primary:hover {
            background-color: #0056b3;
        }

        .fa-moon {
            display: none;
        }

        .theme-toggle-container {
            position: fixed; /* Position relative to the viewport */
            bottom: 20px; /* Distance from the bottom */
            right: 20px; /* Distance from the right */
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const themeToggleBtn = document.getElementById('theme-toggle');
            const body = document.body;

            themeToggleBtn.addEventListener('click', () => {
                body.classList.toggle('dark-mode');

                // Update button text and icon
                if (body.classList.contains('dark-mode')) {
                    themeToggleBtn.innerHTML = '<i class="fas fa-moon"></i> Dark Mode';
                } else {
                    themeToggleBtn.innerHTML = '<i class="fas fa-sun"></i> Light Mode';
                }
            });
        });
    </script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <!-- ... (Your existing navbar) ... -->
    </nav>

    <div class="container">
        <div class="profile-card mx-auto" style="max-width: 600px;">
            <div class="card-header">
                <h2>User Profile</h2>
            </div>
            <div class="card-body text-center">
                <img src="img/user1.png" alt="User Avatar" class="avatar">
                <form method="post" action="">
                    <div class="mb-3">
                        <label class="form-label">Name:</label>
                        <input type="text" class="form-control-plaintext" readonly value="<?php echo htmlspecialchars($username); ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email:</label>
                        <input type="email" class="form-control" name="email" value="<?php echo htmlspecialchars($email); ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Phone Number:</label>
                        <input type="text" class="form-control" name="hp" value="<?php echo htmlspecialchars($hp); ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Address:</label>
                        <input type="text" class="form-control" name="alamat" value="<?php echo htmlspecialchars($alamat); ?>">
                    </div>
                    <button type="submit" name="update_profile" class="btn btn-primary">Update Profile</button>
                </form>
                <a href="index.php" class="btn btn-primary">Back to Home</a>
            </div>
        </div>
    </div>
    <div class="theme-toggle-container">
        <button id="theme-toggle" class="btn btn-outline-dark">
            <i class="fas fa-sun"></i> Light Mode
        </button>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>