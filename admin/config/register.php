<?php

include 'server.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    function val($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $name = val($_POST['name']);

    $stmt = $conn->prepare('SELECT * FROM admin_register WHERE email = ?');
    $stmt->bind_param('s', $_POST['email']);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        header('location:../register.php?exist=This email already exist');
    } else {
        $email = val($_POST['email']);
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $image = $_FILES['image'];

        $imageName = $image['name'];
        $imageTempName = $image['tmp_name'];

        $extension = explode('.', $imageName);
        $imageExtension = strtolower(end($extension));

        $extList = array('jpg', 'png', 'jpeg');
        if (in_array($imageExtension, $extList)) {
            $imageUrl = 'assets/adminprofile/' . $imageName;
            $imgLocation = '../'. $imageUrl;
            $moved = move_uploaded_file($imageTempName, $imgLocation);
            if ($moved) {
                $stmt = $conn->prepare('INSERT INTO admin_register (name, email, password, image) VALUE (?, ?, ?, ?)');
                $stmt->bind_param('ssss', $name, $email, $password, $imageUrl);
                $result = $stmt->execute();
                if ($result) {
                    header('location:../../index.php');
                } else {
                    header('location:../register.php');
                }
            } else{
                echo "Error moving file";
            }
        } else {
            header('location:../register.php?format= Only image format png, jpg and jpeg are allowed');
        }
    }
} else {
    header('location:../register.php');
}
