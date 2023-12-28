<?php 
require_once 'validation.php';
require_once 'updatepassword.php';
require_once 'database.php';
if (isset($_POST['reset'])) {
    $validation = new Validation($_POST);
    $errors = $validation->validate_Verification_details();
    if (empty($errors)) {  
        $updatepassword = new UpdatePassword();
        $errors = $updatepassword-> update_userPassword($_POST);
    }

}
   

?>
<?php require('views/partials/head.php'); ?>

<body class="w-full h-full flex flex-col  justify-center items-center">
    <h1 class="font-semibold text-xl text-center">Reset Password Form</h1>
    <form class="bg-slate-100 flex flex-col justify-center px-4 py-6 w-1/3  space-y-4" name="login"  method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="email" name="email" class="text-sm font-medium">Email <span class="text-red-600">*</span></label>
        <div>
            <input class="border rounded-md w-full px-4 py-2 text-sm" type="text" name="email" id="email" placeholder="Enter your email" value="<?php echo $_POST['email']?? ''; ?>">
            <span class="text-sm text-red-600"><?php echo $errors['email'] ?? ''; ?></span>
        </div>
    <label for="verificationcode" class="text-sm font-medium">Verification Code<span class="text-red-600">*</span></label>
            <div>
                <input type="password" name="verificationcode" class="border rounded-md w-full px-4 py-2 text-sm" placeholder="Enter Verification Code" value="<?php echo $_POST['verificationcode'] ?? ''; ?>">
                <span class="text-sm text-red-600"><?php echo $errors['verificationcode'] ?? ''; ?></span>
            </div>
        <label for="password" class="text-sm font-medium">New Password <span class="text-red-600">*</span></label>
        <div>
            <input class="border rounded-md w-full px-4 py-2 text-sm" type="password" name="password" id="password" placeholder="Enter Password" value="<?php echo $_POST['password']?? ''; ?>">
            <span class="text-sm text-red-600"><?php echo $errors['password'] ?? ''; ?></span>
        </div>
        <label for="confirmpassword" class="text-sm font-medium">Confirm Password <span class="text-red-600">*</span></label>
        <div>
            <input class="border rounded-md w-full px-4 py-2 text-sm" type="password" name="confirmpassword" id="confirmpassword" placeholder="Confirm Password" value="<?php echo $_POST['confirmpassword']?? ''; ?>">
            <span class="text-sm text-red-600"><?php echo $errors['confirmpassword'] ?? ''; ?></span>
        </div>
        
        
        <button type="submit" name="reset" value="reset" class="bg-blue-800 text-white w-full  px-4 py-2  rounded-md">Submit</button>
        
    </form>
</body>
</html>