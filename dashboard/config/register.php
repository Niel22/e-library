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
    $department = val($_POST['department']);

    $stmt = $conn->prepare('SELECT * FROM users WHERE email = ?');
    $stmt->bind_param('s', $_POST['email']);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        header('location:../pages-register?exist=This email already exist');
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
            $imageUrl = 'assets/profile/' . $imageName;
            $imgLocation = '../'. $imageUrl;
            $moved = move_uploaded_file($imageTempName, $imgLocation);
            if ($moved) {
                $stmt = $conn->prepare('INSERT INTO users (name, email, password, image, department) VALUE (?, ?, ?, ?, ?)');
                $stmt->bind_param('sssss', $name, $email, $password, $imageUrl, $department);
                $result = $stmt->execute();
                if ($result) {
                    header('location:../pages-login');
                } else {
                    header('location:../pages-register');
                }
            } else{
                echo "Error moving file";
            }
        } else {
            header('location:../pages-register?format= Only image format png, jpg and jpeg are allowed');
        }
    }
} else {
    header('location:../pages-register');
}
