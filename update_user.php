<?php require 'user_updatehandler.php';?>
<?php require('views/partials/head.php'); ?>
<body class="w-full h-full flex flex-col  justify-center items-center">
    <h1 class="font-semibold text-xl text-center">Update Form</h1>
        <form class="bg-slate-100 flex flex-col justify-center px-4 py-6 w-1/2  space-y-3"  name="update" enctype = "multipart/form-data" method="post"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="grid grid-cols-2 gap-4">
        <input type="hidden" name="Id" value="<?php  echo $row['userId'];?>">
        <label for="name" class="text-sm font-medium">Name<span class="text-red-600">*</span></label>
        <div>
            <input type="text" name="name" class="border rounded-md w-full px-4 py-2 text-sm" placeholder="Enter Name" value="<?php echo $row['name'];?>">
            <span class="text-sm text-red-600"><?php echo $errors['name'] ?? '';?></span>
        </div>
        <label for="email" class="text-sm font-medium">E-mail <span class="text-red-600">*</span> </label>
        <div>
            <input type="text" name="email" class="border rounded-md w-full px-4 py-2 text-sm" placeholder="Enter Email" value="<?php echo $row['email'];?>">
            <span class="text-sm text-red-600"><?php echo $errors['email'] ?? ''; ?></span>
        </div>

        <label for="phone" class="text-sm font-medium">Phone <span class="text-red-600">*</span> </label>
        <div>
            <input type="tel" name="phone" class="border rounded-md w-full px-4 py-2 text-sm" placeholder="Enter Phone Number" value="<?php echo $row['phone'];?>">
            <span class="text-sm text-red-600"><?php echo $errors['phone'] ?? ''; ?></span>
        </div>

        <label for="password" class="text-sm font-medium">Password <span class="text-red-600">*</span> </label>
        <div>
            <input type="password" name="password" class="border rounded-md w-full px-4 py-2 text-sm mb-2" placeholder="Enter Password" value="<?php echo $row['gender'];?>">
            <span class="text-sm text-red-600"><?php echo $errors['password'] ?? ''; ?></span>
        </div>

        <label for="gender" class="text-sm font-medium">Gender<span class="text-red-600">*</span></label>
        <div class="flex flex-row gap-2 items-center">
            <input type="radio" name="gender" value="Male" <?php if($row['gender'] == 'Male'){echo 'checked';}?>>Male
            <input type="radio" name="gender" value="Female" <?php if($row['gender'] == 'Female'){echo 'checked';}?>>Female
            <input type="radio" name="gender" value="other" <?php if($row['gender'] == 'Other'){echo 'checked';}?>>Other
            <span class="text-sm text-red-600"><?php echo $errors['gender'] ?? '';; ?></span>
        </div>
      
        <label for="address" class="text-sm font-medium">Address <span class="text-red-600">*</span> </label>
        <div>
            <textarea name="address" id="address" class="border rounded-md w-full px-4 py-2 text-sm mb-2" placeholder="Enter Address" rows="3" cols="15"><?php echo $row['address']?></textarea>
            <span class="text-sm text-red-600"><?php echo $errors['address'] ?? ''; ?></span>
        
        </div>


        <label for="profile" class="text-sm font-medium">Profile <span class="text-red-600">*</span> </label>
        <img class="w-12 h-14 rounded-md" src="<?php  echo '../uploads/'.$row['unique_name']; ?>"/>Uploaded Image
        <div>
        <input type="file" name="profile" id="profile">
        <span class="text-sm text-red-600"><?php echo $errors['profile'] ?? ''; ?></span>
        </div>
    </div>
        <button type="submit" name="update"  class="bg-blue-800 text-white w-full  px-4 py-2  rounded-md">Update</button>
     
       
    </form>

</body>
</html>