<?php

include 'server.php';
session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    if (isset($_POST['submit'])) {
        $password = $_POST['password'];
        $newpassword = $_POST['newpassword'];
        $confirmpassword = $_POST['confirmpassword'];

        $stmt = $conn->prepare('SELECT * FROM users WHERE user_id = ?');
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows == 1) {
            while ($rows = $result->fetch_assoc()) {
                if (password_verify($password, $rows['password'])) {
                    if ($newpassword === $confirmpassword) {
                        $updatedpassword = password_hash($newpassword, PASSWORD_DEFAULT);
                        $stmt = $conn->prepare('UPDATE users SET password = ? WHERE user_id = ?');
                        $stmt->bind_param('si', $updatedpassword, $user_id);
                        $result = $stmt->execute();

                        if($result){
                            header('location:../users-profile.php?success=Password Changed Successfully');
                        }else{
                            header('location:../users-profile.php?errorp=PRoblem Occured while changing password. Retry');
                        }
                    }else{
                        header('location:../users-profile.php?errorp=Your new passowrds does not match');
                    }
                }else{
                    header('location:../users-profile.php?errorp=Your current password is not correct');
                }
            }
        }
    }
}else{
    header('location:../pages-register.php');
}
