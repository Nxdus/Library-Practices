<?php
    session_start();

    if (!isset($_SESSION["userID"])) {
        header("Location: ./");
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>User Page</title>

        <link rel="stylesheet" href="./styles/users_pages.css">
    </head>
    <body>
        <section class="nav-section">
            <div class="nav-box">
                <h2 class="title">Library</h2>

                <div class="nav-menu">
                    <a href="user_info.php">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" style="width: 32px; padding: 12px;">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-5.5-2.5a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0zM10 12a5.99 5.99 0 00-4.793 2.39A6.483 6.483 0 0010 16.5a6.483 6.483 0 004.793-2.11A5.99 5.99 0 0010 12z" clip-rule="evenodd" />
                        </svg>
                    </a>

                    <a href="./functions/logout.php">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" style="width: 32px; padding: 12px;">
                            <path fill-rule="evenodd" d="M3 4.25A2.25 2.25 0 015.25 2h5.5A2.25 2.25 0 0113 4.25v2a.75.75 0 01-1.5 0v-2a.75.75 0 00-.75-.75h-5.5a.75.75 0 00-.75.75v11.5c0 .414.336.75.75.75h5.5a.75.75 0 00.75-.75v-2a.75.75 0 011.5 0v2A2.25 2.25 0 0110.75 18h-5.5A2.25 2.25 0 013 15.75V4.25z" clip-rule="evenodd" />
                            <path fill-rule="evenodd" d="M19 10a.75.75 0 00-.75-.75H8.704l1.048-.943a.75.75 0 10-1.004-1.114l-2.5 2.25a.75.75 0 000 1.114l2.5 2.25a.75.75 0 101.004-1.114l-1.048-.943h9.546A.75.75 0 0019 10z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>
            </div>
        </section>

        <section class="user-section">
            <?php 
                include_once('./functions/db_config.php');
                $conn = new connection;

                $category = $conn->query('SELECT * FROM categories');
            ?>

            <section class="sidebar-section">
                <h4 class="sidebar-title">User Menu</h4>

                <div class="sidebar-menu">
                    <a href="user_pages.php">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width: 32px; padding: 12px;">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>

                        <span>Main</span>
                    </a>
                </div>

                <div class="sidebar-menu">
                    <a href="user_pages.php?menu=transcriptions">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width: 32px; padding: 12px;">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>

                        <span>Transcriptions</span>
                    </a>
                </div>

                <h4 class="sidebar-title">Categories</h4>

                <div class="sidebar-menu">
                    <?php foreach($category as $row) : ?>
                    <a href="user_pages.php?category=<?php echo $row['category']?>">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width: 32px; padding: 12px;">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                        </svg>


                        <span><?php echo $row['category']?></span>
                    </a>
                    <?php endforeach; ?>
                </div>
            </section>
            
            <?php 
                if(isset($_GET['category'])) { 
                $categoryResult = $_GET['category'];
                $books = $conn->query(
                    "SELECT * FROM books WHERE book_category = '$categoryResult' and book_quantity > 0");
            ?>
                <section class="box-section">
                    <div class="box-header">
                        <h4 class="box-title"><?php echo $categoryResult ?></h4>
                    </div>

                    <div class="box-items">
                        <?php foreach($books as $book) : ?>
                        <div class="item">
                            <img src="uploads/<?php echo $book['book_image']?>" alt="">
                            <div class="item-info">
                                <span>หนังสือ | <?php echo $book['book_name']?></span>
                                <span>รายละเอียด | <br> <?php echo $book['book_description']?></span>
                                <span>เหลืออยู่จำนวน | <?php echo $book['book_quantity']?> เล่ม</span>
                                <button><a href="./functions/borrow.php?user_id=<?php echo $_SESSION["userID"] ?>&book_id=<?php echo $book['id'] ?>">Borrow</a></button>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </section>
            <?php } else { ?>
                <?php if (isset($_GET['menu'])) { ?>
                    <section class="box-section">
                        <div class="box-header">
                            <h4 class="box-title">Yours Transcriptions</h4>
                        </div>

                        <div class="box-items">
                            <?php 
                                $userID = $_SESSION['userID'];  
                                $transcription = $conn->query("SELECT * FROM transcriptions WHERE accounts_id = '$userID'");

                                foreach ($transcription as $result) :
                                    $Books_ID = $result['books_id'];
                                    $BooksResult = $conn->query("SELECT * FROM books WHERE id = '$Books_ID'");

                                    foreach ($BooksResult as $row) : ?>

                                    <div class="item">
                                        <img src="uploads/<?php echo $row['book_image']?>" alt="">
                                        <div class="item-info">
                                            <span>หนังสือ | <?php echo $row['book_name']?></span>
                                            <span>รายละเอียด | <br> <?php echo $row['book_description']?></span>
                                            <span>หมวดหมู่ | <?php echo $row['book_category']?></span>
                                            <button><a href="./functions/giveback.php?transcription_id=<?php echo $result["transcriptions_id"] ?>&book_id=<?php echo $row['id'] ?>">Give It Back</a></button>
                                        </div>
                                    </div>

                                    <?php endforeach;  

                                endforeach; ?>
                        </div>

                    </section>
                <?php } else { ?>
                    <section class="box-section">
                        <div class="box-header">
                            <h4 class="box-title">Welcome To Library !</h4>
                        </div>
                    </section>
                <?php }?>
            <?php } ?>
        </section>
    </body>
</html>