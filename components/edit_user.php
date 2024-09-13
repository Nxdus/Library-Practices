<?php

    session_start();

    include_once("../functions/db_config.php");
    $conn = new connection;

    $userID = '';

    if (isset($_GET["id"])) {
        $userID = $_GET["id"];

        $userData = $conn->query("SELECT * FROM accounts WHERE id = '$userID'");
        $resultUser = $conn->fetch($userData);
    }

    if (isset($_POST['edit-submit'])) {
        $username = $_POST['username'];
        $firstname = $_POST['fname'];
        $lastname = $_POST['lname'];
        $level = $_POST['level'];
        $userID = $_POST['userID'];
    
        $result = $conn->insert("UPDATE accounts SET username = '$username', firstname = '$firstname', lastname = '$lastname', level = '$level' WHERE id = '$userID'");

        if ($result) {
            $_SESSION['success'] = "insert user successfully";
            header("location: ../admin_pages.php?manage=users");
        } else {
            $_SESSION["error"] = "Something went wrong !";
            header("location: ../admin_pages.php?manage=users");
        }
    }
?>



<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard</title>

        <link rel="stylesheet" href="../styles/register.css">
    </head>
    <body>
        <h2 class="title">Dashboard</h2>

        <hr>

        <a href="../admin_pages.php?manage=users">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" style="width: 24px; margin-left:2vw;">
                <path fill-rule="evenodd" d="M7.793 2.232a.75.75 0 01-.025 1.06L3.622 7.25h10.003a5.375 5.375 0 010 10.75H10.75a.75.75 0 010-1.5h2.875a3.875 3.875 0 000-7.75H3.622l4.146 3.957a.75.75 0 01-1.036 1.085l-5.5-5.25a.75.75 0 010-1.085l5.5-5.25a.75.75 0 011.06.025z" clip-rule="evenodd" />
            </svg>
        </a>

        <section class="register-section">
            <div class="register-box">
                <h2>Edit User</h2>
                
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                        <label for="username">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" style="width: 32px; padding: 12px;">
                                <path d="M10 8a3 3 0 100-6 3 3 0 000 6zM3.465 14.493a1.23 1.23 0 00.41 1.412A9.957 9.957 0 0010 18c2.31 0 4.438-.784 6.131-2.1.43-.333.604-.903.408-1.41a7.002 7.002 0 00-13.074.003z" />
                            </svg>
                            <input type="text" name="username" placeholder="Username" value="<?php echo $resultUser['username']?>">
                        </label>
                        <br>
                        <label for="fname">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" style="width: 32px; padding: 12px;">
                                <path fill-rule="evenodd" d="M1 6a3 3 0 013-3h12a3 3 0 013 3v8a3 3 0 01-3 3H4a3 3 0 01-3-3V6zm4 1.5a2 2 0 114 0 2 2 0 01-4 0zm2 3a4 4 0 00-3.665 2.395.75.75 0 00.416 1A8.98 8.98 0 007 14.5a8.98 8.98 0 003.249-.604.75.75 0 00.416-1.001A4.001 4.001 0 007 10.5zm5-3.75a.75.75 0 01.75-.75h2.5a.75.75 0 010 1.5h-2.5a.75.75 0 01-.75-.75zm0 6.5a.75.75 0 01.75-.75h2.5a.75.75 0 010 1.5h-2.5a.75.75 0 01-.75-.75zm.75-4a.75.75 0 000 1.5h2.5a.75.75 0 000-1.5h-2.5z" clip-rule="evenodd" />
                            </svg>
                            <input type="text" name="fname" placeholder="Firstname" value="<?php echo $resultUser['firstname']?>">
                        </label>
                        <br>
                        <label for="lname">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" style="width: 32px; padding: 12px;">
                                <path fill-rule="evenodd" d="M1 6a3 3 0 013-3h12a3 3 0 013 3v8a3 3 0 01-3 3H4a3 3 0 01-3-3V6zm4 1.5a2 2 0 114 0 2 2 0 01-4 0zm2 3a4 4 0 00-3.665 2.395.75.75 0 00.416 1A8.98 8.98 0 007 14.5a8.98 8.98 0 003.249-.604.75.75 0 00.416-1.001A4.001 4.001 0 007 10.5zm5-3.75a.75.75 0 01.75-.75h2.5a.75.75 0 010 1.5h-2.5a.75.75 0 01-.75-.75zm0 6.5a.75.75 0 01.75-.75h2.5a.75.75 0 010 1.5h-2.5a.75.75 0 01-.75-.75zm.75-4a.75.75 0 000 1.5h2.5a.75.75 0 000-1.5h-2.5z" clip-rule="evenodd" />
                            </svg>
                            <input type="text" name="lname" placeholder="Lastname" value="<?php echo $resultUser['lastname']?>">
                        </label>
                        <br>
                        <label for="level">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width: 32px; padding: 12px;">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75" />
                            </svg>
                            <select name="level">
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                            </select>
                        </label>
                        <br>
                        <input type="hidden" name="userID" value="<?php echo $resultUser['id']?>">
                        <input type="submit" name="edit-submit" value="Submit">
                </form>
            </div>
        </section>
    </body>
</html>