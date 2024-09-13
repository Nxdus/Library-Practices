<?php

    include_once("./db_config.php");
    $conn = new connection();

    if (isset($_GET['id']) && isset($_GET['category'])) {
        $id = $_GET['id'];
        $category = $_GET['category'];

        $result = $conn->query("DELETE FROM books WHERE id = '$id'");

        if ($result) {
            echo "<script>alert('Delete '$id' Successfully');</script>";
            echo "<script>window.location.href = '../admin_pages.php?manage=books&category=$category'</script>";
        } else {
            echo "<script>alert('Some thing went wrong !');</script>";
            echo "<script>window.location.href = '../admin_pages.php?manage=books&category=$category'</script>";
        }
    } else {
        echo "<script>window.location.href = '../admin_pages.php?manage=books&category=$category'</script>";
    }

?>