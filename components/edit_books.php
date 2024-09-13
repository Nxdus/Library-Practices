<?php

    session_start();

    include_once("../functions/db_config.php");
    $conn = new connection;

    $ID = '';

    if (isset($_GET["id"])) {
        $ID = $_GET["id"];

        $data = $conn->query("SELECT * FROM books WHERE id = '$ID' LIMIT 1");
        $booksResult =  $conn->fetch($data);
    }

    if (isset($_POST['edit-submit'])) {
        if (!empty($_FILES['image']['name'])) {
            $filename = basename($_FILES['image']['name']);
            $targetFilePath = $targetDir .'/'. $filename;
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
            $allowTypes = array('jpg', 'png');
    
            $book_name = $_POST['book_name'];
            $book_description = $_POST['book_description'];
            $book_quantity = $_POST['book_quantity'];
            $book_category = $_POST['book_category'];
            $ID = $_POST['id'];
    
            if (in_array($fileType, $allowTypes)) {
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
                    $result = $conn->query("
                    UPDATE books 
                    SET book_name = '$book_name', book_description = '$book_description', 
                    book_quantity = '$book_quantity', book_category = '$book_category', book_image = '$filename' WHERE id = '$ID'
                    ");
                }
            }
    
            if ($result) {
                $_SESSION['success'] = "insert category successfully";
                header("location: ../admin_pages.php?manage=books&category=$book_category");
            } else {
                $_SESSION["error"] = "Something went wrong !";
                header("location: ../admin_pages.php?manage=books&category=$book_category");
            }
        } else {
            $book_name = $_POST['book_name'];
            $book_description = $_POST['book_description'];
            $book_quantity = $_POST['book_quantity'];
            $book_category = $_POST['book_category'];
            $ID = $_POST['id'];
    
            $result = $conn->query("
            UPDATE books 
            SET book_name = '$book_name', book_description = '$book_description', 
            book_quantity = '$book_quantity', book_category = '$book_category' WHERE id = '$ID'
            ");
        
    
            if ($result) {
                $_SESSION['success'] = "insert category successfully";
                header("location: ../admin_pages.php?manage=books&category=$book_category");
            } else {
                $_SESSION["error"] = "Something went wrong !";
                header("location: ../admin_pages.php?manage=books&category=$book_category");
            }
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

        <a href="../admin_pages.php?manage=books&category=<?php echo $booksResult['book_category']?>">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" style="width: 24px; margin-left:2vw;">
                <path fill-rule="evenodd" d="M7.793 2.232a.75.75 0 01-.025 1.06L3.622 7.25h10.003a5.375 5.375 0 010 10.75H10.75a.75.75 0 010-1.5h2.875a3.875 3.875 0 000-7.75H3.622l4.146 3.957a.75.75 0 01-1.036 1.085l-5.5-5.25a.75.75 0 010-1.085l5.5-5.25a.75.75 0 011.06.025z" clip-rule="evenodd" />
            </svg>
        </a>

        <section class="register-section">
            <div class="register-box">
                <h2>Edit Category</h2>
                
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                        <label for="book_name">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width: 32px; padding: 12px;">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                            </svg>
                            <input id="book_name" type="text" name="book_name" placeholder="Book Name" value="<?php echo $booksResult['book_name']?>">
                        </label>
                        <br>
                        <label for="book_description">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width: 32px; padding: 12px;">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                            </svg>
                            <textarea id="book_description" type="text" name="book_description" placeholder="Description"><?php echo $booksResult['book_description']?></textarea>
                        </label>
                        <br>
                        <label for="book_image">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width: 32px; padding: 12px;">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 10.5v6m3-3H9m4.06-7.19l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z" />
                            </svg>
                            <input id="book_image" type="file" name="book_image" accept="image/jpeg, image/png">
                        </label>
                        <br>
                        <label for="book_quantity">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width: 32px; padding: 12px;">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75" />
                            </svg>
                            <select name="book_category">
                                <?php 
                                    $bookCategory = $conn->query("SELECT * FROM categories");

                                    foreach ($bookCategory as $row) :
                                ?>
                                    <option value="<?php echo $row['category'] ?>"><?php echo $row['category'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </label>
                        <br>
                        <label for="book_quantity">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width: 32px; padding: 12px;">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 10.5v6m3-3H9m4.06-7.19l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z" />
                            </svg>
                            <input id="book_quantity" type="number" name="book_quantity" value="<?php echo $booksResult['book_quantity']?>">
                        </label>
                        <br>
                        <input type="hidden" name="id" value="<?php echo $booksResult['id']?>">
                        <input type="submit" name="edit-submit" value="Edit">
                </form>
            </div>
        </section>
    </body>
</html>