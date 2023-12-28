<?php
# Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $selectedCategory = $_POST['category'];
    $db = new Database();
    $db->sql("SELECT * FROM books left join categories on books.categoryId = categories.categoryId where category= '$selectedCategory'");
    $selectedBooks = $db->getResult();
}
?>
<?php if (!empty($selectedBooks)) : ?>

    <?php foreach ($selectedBooks as $row) : ?>
        <li class="w-80 hover:shadow-md hover:shadow-gray-400 rounded-lg  flex justify-center items-center text-start flex-col cursor-pointer pt-4 h-[400px]">
            <!-- image -->
            <div class=" w-56 h-56">
                <img class="w-full h-full object-fill rounded-sm" src="<?php echo $row['image_path']; ?>" alt="book Image">
            </div>

            <!-- title -->
            <div class="p-4 space-y-1">
                <cite class="line-clamp-2"><?php echo $row['title']; ?></cite>
                <!-- author -->
                <span class="text-sm font-medium "><?php echo "By" . " " . $row['author']; ?></span>
                <!-- rent -->
                <div class="flex space-x-2 items-center pb-2"><span class="font-medium">&#8377;<?php echo $row['price']; ?> per day</span>
                </div>
                <a href="./userbookhandler.php?bookId=<?php echo $row['bookId']; ?>" name="getbook" class="text-white bg-blue-600 w-full px-16 py-1.5 border rounded-md font-medium text-sm">Get 
                         
                </a>
            </div>
        </li>
    <?php endforeach; ?>

  <?php endif; ?>
</li>