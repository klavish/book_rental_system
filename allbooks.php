
    <?php 
    require 'database.php';
    require('views/partials/head.php'); ?>
    <?php require('views/partials/header.php'); ?>
    <?php require('views/partials/aside.php'); ?>
    <main class="sm:overflow-auto pl:0 md:pl-[16rem]">
    <header><?php require('views/partials/addbooksbtn.php');?></header>
    <?php require('views/partials/section1.php'); 
          ?>
        <table class="overflow-x-auto">
            <thead class="border">
                <tr class="border">
                    <th class="border">Image</th>
                    <th class="border">Title</th>
                    <th class="border">Author</th>
                    <th class="border">Category</th>
                    <th class="border">Description</th>
                    <th class="border">Quantity</th>
                    <th class="border">Rent</th>
                    <th class="border">Fine</th>
                    <th class="border">Book Status</th>
                    <th class="border">Created</th>
                    <th class="border">Modified</th>
                    <th class="border">Action</th>
                </tr>
            </thead>
            <tbody class="">
                <?php
                $db = new Database();
                $db->sql("select * from books left join categories on books.categoryId=categories.categoryId");
               
               while($rows =  $db->getResult()){
                 
                 ?>
                 <?php 
                 foreach($rows as $row):?>
                 <tr class="border">
                    <td><img class="w-12 h-14 rounded-md" src="<?php echo $row['image_path']; ?>"/></td>
                    <td class="border"><?php echo $row['title'];?></td>
                    <td class="border"><?php echo $row['author'];?></td>
                    <td class="border"><?php echo $row['category'];?></td>
                    <td class="border"><?php echo $row['description'];?></td>
                    <td class="border"><?php echo $row['quantity'];?></td>
                    <td class="border"><?php echo $row['price'];?></td>
                    <td class="border"><?php echo $row['fine'];?></td>
                    <td class="border"><?php echo $row['status'];?></td>
                    <td class="border"><?php echo $row['created'];?></td>
                    <td class="border"><?php echo $row['modified'];?></td>
                    <td class="flex items-center justify-center pt-6 gap2">
                        <a class="border bg-blue-800 text-white text-sm  px-4 py-2 rounded-md" href="./update_book.php?bookId=<?php echo $row['bookId'];?>">edit</a>
                        <a class="border bg-blue-800 text-white text-sm  px-4 py-2 rounded-md" href="./delete_book.php?bookId=<?php echo $row['bookId'];?>">delete</a>
                    </td>
                 </tr>
                 <?php   endforeach ?>
                 <?php }?> 
            </tbody>
        </table>
    </main>
