<?php 
    require 'database.php';
    require('views/partials/head.php') ?>
    <?php require('views/partials/header.php') ?>
    <?php require('views/partials/aside.php') ?>
    <main class="sm:overflow-auto pl:0 md:pl-[16rem]">
    <?php require('views/partials/banner.php') ?>
    <?php require('views/partials/section1.php') ?>
        <table>
            <thead class="border">
                <tr class="border">
                    <th class="border">Profile</th>
                    <th class="border">Name</th>
                    <th class="border">Email</th>
                    <th class="border">Phone</th>
                    <th class="border">Gender</th>
                    <th class="border">Address</th>
                    <th class="border">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if(isset($_POST['search'])) {
                    $email = $_POST['email'];
                } 
               
                $db = new Database();
                $db->sql("select * from users left join image_file on users.userId = image_file.userId where email = '$email'");
                while($rows =  $db->getResult()){ 
                ?>
                <?php foreach($rows as $row):?>
                 <tr class="border">
                    <td><img class="w-12 h-14 rounded-md" src="<?php echo $row['path']; ?>"/></td>
                    <td class="border"><?php echo $row['name'];?></td>
                    <td class="border"><?php echo $row['email'];?></td>
                    <td class="border"><?php echo $row['phone'];?></td>
                    <td class="border"><?php echo $row['gender'];?></td>
                    <td class="border"><?php echo $row['address'];?></td>
                    <td class="border">
                        <a class="border bg-blue-800 text-white text-sm  px-4 py-2 rounded-md" href="deleteuser.php?userId=<?php echo $row['userId'];?>">delete</a>
                    </td>
                 </tr>
                 <?php   endforeach ?> 
                 <?php } ?>
            </tbody>
        </table>
    </main>
