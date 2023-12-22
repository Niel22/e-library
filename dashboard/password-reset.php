<?php

include 'config/server.php';
session_start();

if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];

    if (isset($_POST['submit'])) {
        $newpassword = $_POST['newpassword'];
        $confirmpassword = $_POST['confirmpassword'];

        if ($newpassword === $confirmpassword) {
            $updatepassword = password_hash($newpassword, PASSWORD_DEFAULT);
            $stmt = $conn->prepare('UPDATE users SET password = ? WHERE user_id = ?');
            $stmt->bind_param('si', $updatepassword, $id);
            $result = $stmt->execute();

            if ($result) {
                header('location:password-reset.php?reset=Password Reset Successfully. You can now proceed to Login');
                exit;
            } else {
                header('location:password-reset.php?error=Error Resetting Password');
                exit;
            }
        } else {
            header('location:password-reset.php?error=The password does not match');
            exit;
        }
    }

?>

    <!DOCTYPE html>
    <html lang="en">

    <?php include 'includes/head.php' ?>

    <body>

        <main>
            <div class="container">

                <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                                <div class="d-flex justify-content-center py-4">
                                    <a href="../" class="logo d-flex align-items-center w-auto">
                                        <span class=" d-lg-block">FPI E-LIBRARY</span>
                                    </a>
                                </div><!-- End Logo -->

                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="pt-4 pb-2">
                                            <h5 class="card-title text-center pb-0 fs-4">Reset Your Password</h5>
                                        </div>
                                        <?php
                                        if (isset($_GET['reset'])) {
                                        ?>
                                            <div id="reset" style="font-size: 12px;" class=" text-success">
                                                <?= $_GET['reset']; ?>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                        <?php
                                        if (isset($_GET['error'])) {
                                        ?>
                                            <div id="error" style="font-size: 12px;" class=" text-danger">
                                                <?= $_GET['error']; ?>
                                            </div>
                                            
                                        <?php
                                        }
                                        ?>

                                        <form class="row g-3 needs-validation" action="password-reset.php" method="post">

                                            <div class="col-12">
                                                <label for="newPassword" class="form-label">New Password</label>
                                                <input name="newpassword" type="password" class="form-control" id="newPassword" required>
                                            </div>

                                            <div class="col-12">
                                                <label for="renewPassword" class="form-label">Re-enter New Password</label>
                                                <input name="confirmpassword" type="password" class="form-control" id="renewPassword" required>
                                            </div>

                                            <div class="col-12">
                                                <div class="text-center">
                                                    <button type="submit" name="submit" class="btn btn-success w-100">Change Password</button>
                                                </div>
                                            </div>

                                        </form>
                                        <div class=" mt-3">
                                            <a href="pages-login.php" class="">Back to Log In Page</a>
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
<?php
}
?>