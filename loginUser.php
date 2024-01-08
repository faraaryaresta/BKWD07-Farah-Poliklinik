<?php
if (!isset($_SESSION)) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM user WHERE username = '$username'";
    $result = $mysqli->query($query);

    if (!$result) {
        die("Query error: " . $mysqli->error);
    }

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $username;
            header("Location: index.php");
        } else {
            $error = "Password salah";
        }
    } else {
        $error = "User tidak ditemukan";
    }
}
?>

<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="row border rounded-5 p-3 bg-white shadow ">
<!-------------------- ------ Right Box ---------------------------->
        <div class="col-md-10 right-box align-items-center">
            <div class="row align-items-center">
                <div class="header-text mb-4">
                    <h2>Hello, Admin</h2>
                    <p>We are happy to have you back.</p>
                </div>
                <form method="POST" action="index.php?page=loginUser">
                    <?php
                        if (isset($error)) {
                            echo '<div class="alert alert-danger">' . $error . '
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>';
                        }
                    ?>
                    <div class="form-group mb-3">
                        <label for="username">Username</label> 
                        <input type="text" name="username" class="form-control form-control-lg bg-light fs-6" placeholder="Masukkan username anda" required>
                    </div>
                    <div class="form-group mb-5 ">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control form-control-lg bg-light fs-6" placeholder="Masukkan password anda" required>
                    </div>
                    
                    <div class="form-group mb-3">
                        <button class="btn btn-lg btn-success w-100 fs-6" type="submit">Login</button>
                    </div>
                </form>
                <!-- <div class="row">
                    <small>Don't have account? <a href="index.php?page=registerUser">Register</a></small>
                </div> -->
            </div>
        </div> 
    </div>
</div>
