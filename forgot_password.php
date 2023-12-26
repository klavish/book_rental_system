<?php 

require_once 'forgotpass_handler.php';
require_once 'validation.php';
if (isset($_POST['submit'])) {
    $validation = new Validation($_POST);
    $errors = $validation->validate_ForgotPassword_details();
    if (empty($errors)) {
        $resetpassword = new ForgotPassword();
        $errors = $resetpassword->resetPassword($_POST);
    }
}

?>
<?php require('views/partials/head.php') ?>

<body class="w-full h-full flex flex-col  justify-center items-center">
    <h1 class="font-semibold text-xl text-center">Forgot Password Form</h1>
    <form class="bg-slate-100 flex flex-col justify-center px-4 py-6 w-1/3  space-y-4" name="login"  method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="name" class="text-sm font-medium">Name<span class="text-red-600">*</span></label>
            <div>
                <input type="text" name="name" class="border rounded-md w-full px-4 py-2 text-sm" placeholder="Enter Name" value="<?php echo $_POST['name'] ?? ''; ?>">
                <span class="text-sm text-red-600"><?php echo $errors['name'] ?? ''; ?></span>
            </div>
        <label for="email" name="email" class="text-sm font-medium">Email <span class="text-red-600">*</span></label>
        <div>
            <input class="border rounded-md w-full px-4 py-2 text-sm" type="text" name="email" id="email" placeholder="Enter your email">
            <span class="text-sm text-red-600"><?php echo $errors['email'] ?? ''; ?></span>
        </div>
        
        <button type="submit" name="submit" value="submit" class="bg-blue-800 text-white w-full  px-4 py-2  rounded-md">Submit</button>
        
    </form>
    <?php require('views/partials/footer.php') ?>
