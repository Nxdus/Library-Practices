<?php
    if (isset($_GET['transcription_id']) && isset($_GET['book_id'])) {

        include_once('db_config.php');
        $conn = new connection;

        $transcriptionID = $_GET['transcription_id'];
        $bookID = $_GET['book_id'];

        $bookQuery = $conn->query("SELECT book_quantity FROM books WHERE id = '$bookID'");
        $quantity = $conn->fetch($bookQuery);
        $quantityResult = $quantity['book_quantity'] + 1;

        $gaveBook = $conn -> query("UPDATE books SET book_quantity = $quantityResult WHERE id = $bookID");

        if ($gaveBook) {
            $deleteTrans = $conn -> query("DELETE FROM transcriptions WHERE transcriptions_id = '$transcriptionID'");
            if ($deleteTrans) {
                header('Location: ../user_pages.php?menu=transcriptions');
            }
        } else {
            header('Location: ../user_pages.php?menu=transcriptions');
        }

    } else {
        header('Location: ../user_pages.php?menu=transcriptions');
    }
?>