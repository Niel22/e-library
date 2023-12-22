<?php

include 'server.php';
session_start();

if (isset($_SESSION['admin_id'])) {
    $admin_id = $_SESSION['admin_id'];

    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $stmt = $conn->prepare('SELECT * FROM admin_register WHERE id = ?');
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            while ($rows = $result->fetch_assoc()) {
                $name = $rows['name'];
                $email = $rows['email'];
                $password = $rows['password'];
                $image = $rows['image'];
            }
        }

        $stmt = $conn->prepare('INSERT INTO admin (name, email, password, image) VALUES (?, ?, ?, ?)');
        $stmt->bind_param('ssss', $name, $email, $password, $image);
        $result = $stmt->execute();

        $stmt = $conn->prepare('DELETE FROM admin_register WHERE id = ?');
        $stmt->bind_param('i', $id);
        $result = $stmt->execute();
        if($result){
            header('location:'. $_SERVER['HTTP_REFERER']);
        }
    }
}
