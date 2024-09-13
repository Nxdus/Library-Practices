<?php

    include_once("./db_config.php");
    $conn = new connection();

    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $result = $conn->query("DELETE FROM categories WHERE id = '$id'");

        if ($result) {
            echo "<script>alert('Delete '$id' Successfully');</script>";
            echo "<script>window.location.href = '../admin_pages.php?manage=categories'</script>";
        } else {
            echo "<script>alert('Some thing went wrong !');</script>";
            echo "<script>window.location.href = '../admin_pages.php?manage=categories'</script>";
        }
    } else {
        echo "<script>window.location.href = '../admin_pages.php?manage=categories'</script>";
    }

?>