<?php
require_once 'admin_loginhandler.php';
if(!isset($_SESSION['admin_Login'])){
    header('location:admin_login.php');
}

?>
<?php require_once 'book_updatehandler.php'; ?>
<?php require('views/partials/head.php'); ?>

<body class="w-full h-full flex flex-col  justify-center items-center">
    <h1 class="font-semibold text-xl text-center">Book Update Form</h1>
    <form class="bg-slate-100 flex flex-col justify-center px-4 py-6 w-1/2   space-y-4" name="addbook" enctype="multipart/form-data" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="grid grid-cols-2 gap-4">
            <input type="hidden" name="bookId" value="<?php  $row['bookId']; ?>">
            <label for="title" class="text-sm font-medium">Title<span class="text-red-600">*</span></label>
            <div>
                <input type="text" name="title" class="border rounded-md w-full px-4 py-2 text-sm" placeholder="Enter Title" value="<?php echo $row['title']; ?>">
                <span class="text-sm text-red-600"><?php echo $errors['title'] ?? ''; ?></span>
            </div>
            <label for="author" class="text-sm font-medium">Author <span class="text-red-600">*</span> </label>
            <div>
                <input type="text" name="author" class="border rounded-md w-full px-4 py-2 text-sm" placeholder="Enter Author" value="<?php echo $row['author']; ?>">
                <span class="text-sm text-red-600"><?php echo $errors['author'] ?? ''; ?></span>
            </div>

            <label for="category" class="text-sm font-medium">Category<span class="text-red-600">*</span> </label>
            <div>
                <select class="flex flex-row gap-2 border rounded-md w-full px-4 py-2 text-sm" name="category" id="category">
                    <option value="select">select</option>
                    <?php
                    $db = new Database();
                    $db->sql("select * from categories");
                    $categories = $db->getResult();

                    foreach ($categories as $category) :
                        $opt_category = $category['category'];
                    ?>
                        <option value="<?php echo  $opt_category ; ?>" <?php echo ($row['category'] ==  $opt_category) ? 'selected' : ''; ?>><?php echo  $opt_category; ?></option>
                    <?php endforeach; ?>
                </select>
                <span class="text-sm text-red-600"><?php echo $errors['category'] ?? ''; ?></span>

            </div>

            <label for="description" class="text-sm font-medium">Description<span class="text-red-600">*</span> </label>
            <div>
                <textarea name="description" id="description" class="border rounded-md w-full px-4 py-2 text-sm mb-2" rows="3" cols="40" placeholder="Enter Description"><?php echo $row['description']; ?></textarea>
                <span class="text-sm text-red-600"><?php echo $errors['description'] ?? ''; ?></span>
            </div>

            <label for="quantity" class="text-sm font-medium">Quantity <span class="text-red-600">*</span> </label>
            <div>
                <input type="text" name="quantity" class="border rounded-md w-full px-4 py-2 text-sm" placeholder="Enter Quantity" value="<?php echo $row['quantity']; ?>">
                <span class="text-sm text-red-600"><?php echo $errors['quantity'] ?? ''; ?></span>
            </div>

            <label for="price" class="text-sm font-medium">Price <span class="text-red-600">*</span> </label>
            <div>
                <input type="text" name="price" class="border rounded-md w-full px-4 py-2 text-sm" placeholder="Enter Price" value="<?php echo $row['price']; ?>">
                <span class="text-sm text-red-600"><?php echo $errors['price'] ?? ''; ?></span>
            </div>

            <label for="fine" class="text-sm font-medium">Fine<span class="text-red-600">*</span> </label>
            <div>
                <input type="text" name="fine" class="border rounded-md w-full px-4 py-2 text-sm" placeholder="Enter Fine" value="<?php echo $row['fine']; ?>">
                <span class="text-sm text-red-600"><?php echo $errors['fine'] ?? ''; ?></span>
            </div>
            <label for="status" class="text-sm font-medium">Available Status<span class="text-red-600">*</span> </label>
            <div>
                <input type="text" name="status" class="border rounded-md w-full px-4 py-2 text-sm" placeholder="Enter Book Status" value="<?php echo $row['status']; ?>">
                <span class="text-sm text-red-600"><?php echo $errors['status'] ?? ''; ?></span>
            </div>
            <label for="image">Image<span class="text-red-600">*</span></label>
            
            <div>
            <img class="w-12 h-14 rounded-md" src="<?php  echo '../uploads/'.$row['display_name']; ?>"/>Uploaded Image
                <input type="file" name="image" id="image">
                <span class="text-sm text-red-600"><?php echo $errors['image'] ?? ''; ?></span>
            </div>
        </div>
        <button type="submit" name="update" id="update" class="bg-blue-800 text-white w-full  px-4 py-2  rounded-md">Update</button>
    </form>

    </form>

</body>

</html>