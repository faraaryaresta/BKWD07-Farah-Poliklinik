<?php
if (!isset($_SESSION)) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $no_hp = $_POST['no_hp'];

    $query = "SELECT * FROM dokter WHERE nama = '$nama'";
    $result = $mysqli->query($query);

    if (!$result) {
        die("Query error: " . $mysqli->error);
    }

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (($no_hp == $row['no_hp'])) {
            $_SESSION['nama'] = $nama;
            header("Location: berandaDokter.php");
        } else {
            $error = "Password salah";
        }
    } else {
        $error = "Dokter tidak ditemukan";
    }
}
?>

<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="row border rounded-5 p-3 bg-white shadow box-area">
        <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box loginpage">
            <div class="featured-image mb-3">
            <img src="img/loginpage.png" class="img-fluid" style="width: 250px;">
            </div>
            <p class="text-white fs-2" style="font-family: 'Courier New', Courier, monospace; font-weight: 600;">Be Verified</p>
            <small class="text-white text-wrap text-center" style="width: 17rem;font-family: 'Courier New', Courier, monospace;">Join experienced Designers on this platform.</small>
        </div> 
<!-------------------- ------ Right Box ---------------------------->
        <div class="col-md-6 right-box">
            <div class="row align-items-center">
                <div class="header-text mb-4">
                    <h2>Hello, Dokter</h2>
                    <p>We are happy to have you back.</p>
                </div>
                <form method="POST" action="index.php?page=loginDokter">
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
                        <label for="nama">Nama</label> 
                        <input type="text" name="nama" class="form-control form-control-lg bg-light fs-6" placeholder="Enter your name" required>
                    </div>
                    <div class="form-group mb-5 ">
                        <label for="no_hp">Password</label>
                        <input type="password" name="no_hp" class="form-control form-control-lg bg-light fs-6" placeholder="Enter your password" required>
                    </div>
                    
                    <div class="form-group mb-3">
                        <button class="btn btn-lg btn-success w-100 fs-6" type="submit">Login</button>
                    </div>
                </form>
            </div>
        </div> 
    </div>
</div>
