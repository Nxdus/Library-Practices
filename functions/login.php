<?php

    session_start();

    if (isset($_POST['login-username'])) {

        include_once("db_config.php");
        $conn = new connection;

        $username = $_POST['login-username'];
        $password = $_POST['login-password'];
        $passwordenc = md5($password);

        $result = $conn->query("SELECT * FROM accounts WHERE username = '$username' AND password = '$passwordenc'");

        if (mysqli_num_rows($result) == 1) {
            $row = $conn->fetch($result);

            $_SESSION['userID'] = $row['id'];
            $_SESSION['userName'] = $row['firstname']." ".$row['lastname'];
            $_SESSION['userLevel'] = $row['level'];

            if ($_SESSION['userLevel'] == 'admin') {
                header('location: ../admin_pages.php?manage=users');
            }

            if ($_SESSION['userLevel'] == 'user') {
                header('location: ../user_pages.php');
            }

            if ($_SESSION['userLevel'] != 'user' && $_SESSION['userLevel'] != 'admin') {
                header('location: ../');
            }
        } else {
            header('location: ../');
        }
    }

?>