<?php session_start();
if (!isset($_SESSION['loginUser'])) {
    header('location:user_login.php');
}  
?>
<?php require_once 'database.php';?>
<?php require('views/partials/head.php') ?>

<body class="bg-slate-100">
    <?php require('views/partials/books_header.php') ?>

    <main class="flex items-center justify-center  space-x-8 container p-6">

<div class="flex  items-center justify-center">
    <div class="flex flex-col flex-1  items-start">

        <?php $userId = $_SESSION['loginUser']['userId'];
        $db = new Database();
        $db->sql("select * from rentedbooks left join categories on rentedbooks.categoryId=categories.categoryId left join books on rentedbooks.bookId = books.bookId where userId = '$userId'");
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
                <span class="text-base font-medium">Rent :</span>
                <span class="font-normal"><?php echo $row['price'] . " " . "per/day"; ?></span>
            </div>
            <div class="grid grid-cols-2 gap-2">
                <span class="text-base font-medium">Fine :</span>
                <span class="font-normal"><?php echo $row['fine'] . " " . "per/day"; ?></span>
            </div>

            <div class="grid grid-cols-2 gap-2">
                <span class="text-base font-medium">Order Date:</span>
                <span class="font-normal"><?php echo $row['rentDate']; ?></span>
            </div>

            <div class="grid grid-cols-2 gap-2">
                <span class="text-base font-medium">Due Date:</span>
                <span class="font-normal"><?php echo $row['dueDate']; ?></span>
            </div>

            <div class="grid grid-cols-2 gap-2">
                <span class="text-base font-medium">Payment Status:</span>
                <span class="font-normal"><?php echo $row['paymentStatus']; ?></span>
            </div>
        </div>
        </div>    
        <?php endforeach ?>
    <?php } ?>

   
</div>

</main>
    <?php require('views/partials/footer.php') ?>