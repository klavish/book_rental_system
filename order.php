<?php

require 'database.php';
require_once 'rentedbook.php';
require_once 'validation.php';


if (isset($_POST['order'])) {
    $validation = new Validation($_POST);
    $errors = $validation->validate_book_kept_days();
    if (empty($errors)) {
        $rentedBook = new RentedBook();
        $errors = $rentedBook->addrentedbook($_POST);
    }
}

?>
<?php require('views/partials/head.php') ?>

<body>
    <?php require('views/partials/books_header.php'); ?>
    <h2 class="text-2xl font-medium text-center">Order Summary</h2>
    <main class="flex items-center justify-center  space-x-8 container p-6">

        <div class="flex items-center justify-center">
            <div class="flex flex-col flex-1  items-start">

                <?php $val = $_SESSION['loginUser']['book'];
                $db = new Database();
                $db->sql("select * from books left join categories on books.categoryId=categories.categoryId where bookId = '$val'");
                while ($rows =  $db->getResult()) { ?>
                    <?php foreach ($rows as $row) : ?>
                        <div class="w-full h-full ">
                            <img class="w-56 h-56  object-fill rounded-sm" src="<?php echo '../uploads/' . $row['display_name']; ?>" alt="Product Image">
                        </div>
                        <cite class="line-clamp-2 text-base font-medium"> <?php echo "Title :" . $row['title']; ?></cite>
                        <em class="text-sm font-medium "><?php echo "Author :" . " " . $row['author']; ?></em>
                        <span class="text-sm font-medium"><?php echo "Category :" . $row['category']; ?></span>
                        <span class="text-sm font-medium"><?php echo "Description :" ?></span>
                        <p class="max-w-sm text-sm font-normal"><?php echo $row['description']; ?></p>

            </div>

            <div class="flex flex-1 w-full  p-4  space-y-5">

                <div>
                    <div class="grid grid-cols-2 gap-2">
                        <span class="text-base font-medium">Book Status :</span>
                        <span class="font-normal"><?php echo $row['status']; ?></span>
                    </div>
                    <div class="grid grid-cols-2 gap-2">
                        <span class="text-base font-medium">Rent :</span>
                        <span class="font-normal"><?php echo $row['price'] . " " . "per/day"; ?></span>
                    </div>
                    <div class="grid grid-cols-2 gap-2">
                        <span class="text-base font-medium">Fine :</span>
                        <span class="font-normal"><?php echo $row['fine'] . " " . "per/day"; ?></span>
                    </div>
                <?php endforeach ?>
            <?php } ?>
            <?php $val = $_SESSION['loginUser']['book'];

            $db = new Database();
            $db->sql("select * from books where bookId = '$val'");
            while ($values =  $db->getResult()) { ?>
                <?php foreach ($values as $value) : ?>
                    <form class="bg-slate-100 flex flex-col justify-center px-4 py-6 " name="order" enctype="multipart/form-data" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <div class="grid grid-cols-2 gap-4">
                        <?php endforeach ?>
                    <?php } ?>

                    <input type="hidden" name="bookId" class="border rounded-md w-full px-4 py-2 text-sm" value="<?php echo $val; ?>">
                    <input type="hidden" name="categoryId" class="border rounded-md w-full px-4 py-2 text-sm" value="<?php echo $value['categoryId']; ?>">
                    <input type="hidden" name="price" class="border rounded-md w-full px-4 py-2 text-sm" value="<?php echo $value['price']; ?>">
                    <input type="hidden" name="fine" class="border rounded-md w-full px-4 py-2 text-sm" value="<?php echo $value['fine']; ?>">
                    <label for="days" class="text-sm font-medium">Days <span class="text-red-600">*</span> </label>
                    <div>
                        <input type="text" name="days" class="border rounded-md w-full px-4 py-2 text-sm pb-2" placeholder="Enter Number of Days" value="<?php echo $_POST['days'] ?? ''; ?>">
                        <span class="text-sm text-red-600"><?php echo $errors['days'] ?? ''; ?></span>
                    </div>

                        </div>
                        <button type="submit" name="order" id="order" class="bg-blue-800 text-white w-full  px-4 py-2 pt-1 rounded-md">Confirm Order</button>
                    </form>
                </div>
            </div>
        </div>

    </main>

    <?php require('views/partials/footer.php') ?>