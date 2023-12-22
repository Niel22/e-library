<?php
include 'config/server.php';

if (isset($_POST['submit'])) {
    function val($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    $email = val($_POST['email']);

    $stmt = $conn->prepare('SELECT * FROM users WHERE email = ?');
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        while ($rows = $result->fetch_assoc()) {
            $id = $rows['user_id'];
            session_start();
            $_SESSION['id'] = $id;
            header("location:./password-reset");
        }
    } else {
        header('location:./forgotten-password?error=Email does not exist');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<?php include 'includes/head.php' ?>

<body class="bg-light">

    <main>
        <div class="container">

            <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center bg-white p-4 rounded shadow">

                            <div class="d-flex justify-content-center mb-4">
                                <a href="index.php" class="logo d-flex align-items-center w-auto text-dark text-decoration-none">
                                    <span class="d-lg-block">FPI E-LIBRARY</span>
                                </a>
                            </div><!-- End Logo -->

                            <div class="card">

                                <div class="card-body p-3">
                                    <div class="mb-3">
                                        <h5 class="card-title text-center pb-0 fs-4">Reset Your Password</h5>
                                        <p class="text-center small">Enter your email address to reset your password</p>
                                    </div>

                                    <form action="./forgotten-password" method="post">

                                        <div class="mb-3">
                                            <label for="newPassword" class="form-label">Email Address</label>
                                            <input name="email" type="email" class="form-control" id="newPassword" required>
                                        </div>
                                        <?php
                                        if (isset($_GET['error'])) {
                                        ?>
                                            <div id="error-alert" style="font-size: 12px;" class="mb-3 text-danger">
                                                <?= $_GET['error']; ?>
                                            </div>
                                            <script>
                                                // Close the alert after 3 seconds (adjust as needed)
                                                setTimeout(function() {
                                                    document.getElementById('error-alert').style.display = 'none';
                                                }, 3000);
                                            </script>
                                        <?php
                                        }
                                        ?>
                                        <div class="text-center">
                                            <button type="submit" name="submit" class="btn btn-success w-100">Reset Password</button>
                                        </div>

                                    </form>

                                    <div class=" mt-3">
                                        <a href="./pages-login" class="">Back to Log In Page</a>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <?php include 'includes/foot.php' ?>
</body>

</html>