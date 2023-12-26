<?php
require_once 'database.php';
require_once 'category.php';

require_once 'admin_loginhandler.php';
if(!isset($_SESSION['admin_Login'])){
    header('location:admin_login.php');
}


#handle delete
if (isset($_POST['delete'])) {
    $category=new Category();
    $category->deleteCategory();
}

?>
<?php require('views/partials/head.php') ?>
<body class="w-full h-full flex flex-col  justify-center items-center">
    <h1 class="font-semibold text-xl text-center">Delete Form</h1>
        <form class="bg-slate-100 flex flex-col justify-center px-4 py-6 w-1/3  space-y-3"  name="delete"  method="post"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div>
        <input type="hidden" name="categoryId" class="border rounded-md w-full px-4 py-2 text-sm" value="<?php  echo $_GET['categoryId'];?>">
        <p class="text-base font-medium text-red-600 text-center">Are you sure want to delete this category?</p>   
        </div>
        <button type="submit" name="delete" class="bg-blue-800 text-white w-full  px-4 py-2  rounded-md">Delete</button>
     
       
    </form>

<?php require('views/partials/footer.php') ?> 
