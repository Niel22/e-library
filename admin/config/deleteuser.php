<?php

include 'server.php';
session_start();

if (isset($_SESSION['admin_id'])) {
    $admin_id = $_SESSION['admin_id'];

    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $stmt = $conn->prepare('SELECT * FROM users WHERE user_id = ?');
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            while ($rows = $result->fetch_assoc()) {
                $user_id = $rows['user_id'];
                $name = $rows['name'];
                $email = $rows['email'];
                $password = $rows['password'];
                $image = $rows['image'];
                $contributions = $rows['contributions'];
            }
        }

        $stmt = $conn->prepare('INSERT INTO deleted_users (user_id,name, email, password, image, contributions, admin_id) VALUES (?, ?, ?, ?, ?,  ?, ?)');
        $stmt->bind_param('sssssss', $user_id, $name, $email, $password, $image, $contributions, $admin_id);
        $result = $stmt->execute();

        $stmt = $conn->prepare('DELETE FROM users WHERE user_id = ?');
        $stmt->bind_param('i', $id);
        $result = $stmt->execute();
        if($result){
            header('location:'. $_SERVER['HTTP_REFERER']);
        }
    }
}
