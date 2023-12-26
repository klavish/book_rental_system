<?php 
  
    require 'database.php';
    require('views/partials/head.php'); ?>
    <?php require('views/partials/header.php'); ?>
    <?php require('views/partials/aside.php'); ?>
    <main class="sm:overflow-auto pl:0 md:pl-[16rem]">
    <header><?php require('views/partials/addcategorybtn.php')?></header>
    <?php require('views/partials/section1.php'); ?>
        <table class="w-full text-center">
            <thead class=" border">
                <tr class="border">
                    <th class="border">Category Id</th>
                    <th class="border">Category Name</th>
                    <th class="border">Created</th>
                    <th class="border">Modified</th>
                    <th class="border">Status</th>
                    <th class="border">Action</th>
                </tr>
            </thead>
            <tbody class=" border">
                <?php
                $db = new Database();
                $db->sql("select * from categories");
               
               while($rows =  $db->getResult()){
                 
                 ?>
                 <?php 
                 foreach($rows as $row):?>
                 <tr class="border">
                    <td class="border"><?php echo $row['categoryId'];?></td>
                    <td class="border"><?php echo $row['category'];?></td> 
                    <td class="border"><?php echo $row['created'];?></td> 
                    <td class="border"><?php echo $row['modified'];?></td> 
                    <td class="border"><?php echo $row['status'];?></td> 
                    <td class="flex items-center justify-center pt-6 gap-2">
                        <a class="border bg-blue-800 text-white text-sm  px-4 py-2 rounded-md" href="update_category.php?categoryId=<?php echo $row['categoryId'];?>">edit</a>
                        <a class="border bg-blue-800 text-white text-sm  px-4 py-2 rounded-md" href="delete_category.php?categoryId=<?php echo $row['categoryId'];?>">delete</a>
                    </td>
                   
                 </tr>
                 <?php   endforeach ?>
                 <?php }?>

            </tbody>
        </table>
    </main>
