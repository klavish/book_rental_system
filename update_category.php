<?php  
require_once 'admin_loginhandler.php';
if(!isset($_SESSION['admin_Login'])){
    header('location:admin_login.php');
}

?>
<?php  require 'category_updatehandler.php';?>
<?php require('views/partials/head.php'); ?>
<body class="w-full h-full flex flex-col  justify-center items-center">
    <h1 class="font-semibold text-xl text-center">Category Update Form</h1>
        <form class="bg-slate-100 flex flex-col justify-center px-4 py-6 w-1/3   space-y-4"  name="updatecategory" enctype = "multipart/form-data" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="hidden" name="categoryId" value="<?php  echo $row['categoryId'];?>">
        <label for="category" class="text-sm font-medium">Category Name<span class="text-red-600">*</span></label>
        <div>
            <input type="text" name="category" class="border rounded-md w-full px-4 py-2 text-sm" placeholder="Enter Category" value="<?php echo $row['category']; ?>">
            <span class="text-sm text-red-600"><?php echo $errors['category'] ?? ''; ?></span>
        </div>
        
        <button type="submit" name="update" id="update" class="bg-blue-800 text-white w-full  px-4 py-2  rounded-md">Update</button>
        </form>
       
</form>

</body>
</html>