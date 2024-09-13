<?php 
    include_once('./functions/db_config.php');
    $conn = new connection();

    $category = $conn -> query('SELECT * FROM categories');

    if (isset($_GET['category'])) { 
        $categorySearch = $_GET['category'];
        $booksResult = $conn -> query("SELECT * FROM books WHERE book_category = '$categorySearch'");
    ?>

    <section class="box-section">
        <div class="box-header">
            <h4 class="box-title">Manage Books <?php echo $categorySearch ?></h4>
        </div>

        <a href="./components/create_books.php?category=<?php echo $categorySearch ?>" class="create-users">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width: 20px; margin-right: 4px;">
                <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5m8.25 3v6.75m0 0l-3-3m3 3l3-3M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
            </svg>
            <span>Add Books</span>
        </a>
        
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Images</th>
                <th>Quantity</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>

            <?php
            foreach($booksResult as $result ) :
            ?>
            <tr>
                <td><?php echo $result['id'];?></td>
                <td><?php echo $result['book_name'];?></td>
                <td><?php echo $result['book_description'];?></td>
                <td><img src="./uploads/<?php echo $result['book_image'];?>"></td>
                <td><?php echo $result['book_quantity'];?></td>
                <td>
                    <a href="./components/edit_books.php?id=<?php echo $result['id'] ?>" style="background-color: rgb(197, 212, 255);">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" style="width: 24px; padding: 6px;">
                            <path d="M5.433 13.917l1.262-3.155A4 4 0 017.58 9.42l6.92-6.918a2.121 2.121 0 013 3l-6.92 6.918c-.383.383-.84.685-1.343.886l-3.154 1.262a.5.5 0 01-.65-.65z" />
                            <path d="M3.5 5.75c0-.69.56-1.25 1.25-1.25H10A.75.75 0 0010 3H4.75A2.75 2.75 0 002 5.75v9.5A2.75 2.75 0 004.75 18h9.5A2.75 2.75 0 0017 15.25V10a.75.75 0 00-1.5 0v5.25c0 .69-.56 1.25-1.25 1.25h-9.5c-.69 0-1.25-.56-1.25-1.25v-9.5z" />
                        </svg>
                    </a>
                </td>
                <td>
                    <a href="./functions/delete_books.php?id=<?php echo $result['id'] ?>&category=<?php echo $result['book_category'] ?>" style="background-color: rgb(255, 168, 168);">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" style="width: 24px; padding: 6px;">
                            <path fill-rule="evenodd" d="M8.75 1A2.75 2.75 0 006 3.75v.443c-.795.077-1.584.176-2.365.298a.75.75 0 10.23 1.482l.149-.022.841 10.518A2.75 2.75 0 007.596 19h4.807a2.75 2.75 0 002.742-2.53l.841-10.52.149.023a.75.75 0 00.23-1.482A41.03 41.03 0 0014 4.193V3.75A2.75 2.75 0 0011.25 1h-2.5zM10 4c.84 0 1.673.025 2.5.075V3.75c0-.69-.56-1.25-1.25-1.25h-2.5c-.69 0-1.25.56-1.25 1.25v.325C8.327 4.025 9.16 4 10 4zM8.58 7.72a.75.75 0 00-1.5.06l.3 7.5a.75.75 0 101.5-.06l-.3-7.5zm4.34.06a.75.75 0 10-1.5-.06l-.3 7.5a.75.75 0 101.5.06l.3-7.5z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </td>
            </tr>
            <?php
            endforeach;
            ?>
        </table>

    </section>

    <?php } else {?>

    <section class="box-section">
        <div class="box-header">
            <h4 class="box-title">Manage Books</h4>
        </div>

        <div class="category-box">
            <?php foreach ($category as $row) :?>
                <a class="category-items" href="./admin_pages.php?manage=books&category=<?php echo $row['category'] ?>">
                    <img src="./uploads/<?php echo $row['image']?>">

                    <div class="category-info">
                        <h4>Category : <?php echo $row['category']?></h4>
                        <p style="margin-top: -2vh;">Description : <?php echo $row['description']?></p>
                    </div>
                </a>
            <?php endforeach;?>
        </div>
    </section>

<?php } ?>