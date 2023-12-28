<?php require_once 'database.php';?>
<?php require('views/partials/head.php') ?>

<body class="bg-slate-100">
    <?php require('views/partials/books_header.php') ?>

    <main>
        <?php
         !isset($_POST['submit']);
         ?>
        <!-- This  shows books  -->
        <ul class="p-6 flex flex-wrap gap-8  justify-center items-center">
            <?php
            $db = new Database();
            $db->sql("select * from books");
            while ($rows =  $db->getResult()) {
            ?>
                <?php
                foreach ($rows as $row) : ?>

                    <!-- Books Listing -->
                    <li class="<?php echo !isset($_POST['submit']) ? "visible" : "hidden"; ?> w-80 hover:shadow-md hover:shadow-gray-400 rounded-lg  flex justify-center items-center text-start flex-col cursor-pointer pt-4 h-[400px]">
                        <!-- image -->
                        <div class=" w-56 h-56">
                            <img class="<?php echo !isset($_POST['submit']) ? "visible" : "hidden"; ?> w-full h-full object-fill rounded-sm" src="<?php echo $row['image_path']; ?>" alt="book Image">
                        </div>

                        <!-- title -->
                        <div class="<?php echo !isset($_POST['submit']) ? "visible" : "hidden"; ?> p-4 space-y-1">
                            <cite class="line-clamp-2"><?php echo $row['title']; ?></cite>
                            <!-- author -->
                            <span class="text-sm font-medium "><?php echo "By" . " " . $row['author']; ?></span>
                            <!-- price -->
                            <div class="flex space-x-2 items-center pb-2"><span class="font-medium">&#8377;<?php echo $row['price']; ?> per day</span>
                            </div>
                            
                            <a href="./userbookhandler.php?bookId=<?php echo $row['bookId']; ?>" name="getbook" class="text-white bg-blue-600 w-full px-16 py-1.5 border rounded-md font-medium text-sm">Get

                            </a>

                        </div>
                    </li>
                <?php endforeach ?>
            <?php } ?>
            <li>
                <?php require 'selected_category_book.php'; ?>
            </li>
        </ul>
    </main>
    <?php require('views/partials/footer.php'); ?>