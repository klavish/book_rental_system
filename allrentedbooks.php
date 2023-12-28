
    <?php 

    require 'database.php';
    require('views/partials/head.php') ?>
    <?php require('views/partials/header.php') ?>
    <?php require('views/partials/aside.php') ?>
    <main class="sm:overflow-auto pl:0 md:pl-[16rem]">
    <header><?php require('views/partials/addbooksbtn.php');?></header>
    <?php require('views/partials/section1.php'); 
          ?>
        <table class="overflow-x-auto">
            <thead class="border">
                <tr class="border">
                    <th class="border">Image</th>
                    <th class="border">Title</th>
                    <th class="border">UserName</th>
                    <th class="border">Email</th>
                    <th class="border">Address</th>
                    <th class="border">Category</th>
                    <th class="border">Days</th>
                    <th class="border">Price</th>
                    <th class="border">Fine</th>
                    <th class="border">Rent Date</th>
                    <th class="border">Due Date</th>
                    <th class="border">Payment Status</th>
                    
                    
                </tr>
            </thead>
            <tbody class="">
                <?php
                $db = new Database();
                $db->sql("select * from rentedbooks left join books on rentedbooks.bookId=books.bookId left join users on rentedbooks.userId = users.userId left join categories on rentedbooks.categoryId=categories.categoryId");
               
               while($rows =  $db->getResult()){
                 
                 ?>
                 <?php 
                 foreach($rows as $row):?>
                 <tr class="border">
                    <td><img class="w-12 h-14 rounded-md" src="<?php echo $row['image_path']; ?>"/></td>
                    <td class="border"><?php echo $row['title'];?></td>
                    <td class="border"><?php echo $row['name'];?></td>
                    <td class="border"><?php echo $row['email'];?></td>
                    <td class="border"><?php echo $row['address'];?></td>
                    <td class="border"><?php echo $row['category'];?></td>
                    <td class="border"><?php echo $row['days'];?></td>
                    <td class="border"><?php echo $row['price'];?></td>
                    <td class="border"><?php echo $row['fine'];?></td>
                    <td class="border"><?php echo $row['rentDate'];?></td>
                    <td class="border"><?php echo $row['dueDate'];?></td>
                    <td class="border"><?php echo $row['paymentStatus'];?></td>
                 </tr>
                 <?php   endforeach ?>
                 <?php }?> 
            </tbody>
        </table>
    </main>
