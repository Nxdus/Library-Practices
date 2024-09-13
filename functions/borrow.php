<?php
    include_once('db_config.php');
    $conn = new connection;

    if(isset($_GET['user_id']) && isset($_GET['book_id'])) {
        $bookID = $_GET['book_id'];
        $userID = $_GET['user_id'];

        $result = $conn->query("INSERT INTO transcriptions(accounts_id, books_id) VALUES('$userID','$bookID')");

        if ($result) {
            $bookQuery = $conn->query("SELECT book_quantity FROM books WHERE id = '$bookID'");
            $quantity = $conn->fetch($bookQuery);
            $quantityResult = $quantity['book_quantity'] - 1;

            $booksResult = $conn->query("UPDATE books SET book_quantity = $quantityResult WHERE id = '$bookID'");
            if ($booksResult) {
                header('location: ../user_pages.php');
            } else {
                echo "<script>alert('Something went wrong !')</script>";
            }
        } else {
            echo '<script>alert("Somthings went wrongs !")</script>';
            header('location: ../user_pages.php');
        }
    } else {
        header('location: ../user_pages.php');
    }
?>