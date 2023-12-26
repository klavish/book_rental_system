
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
                    <th class="border">Rent Date</th>
                    <th class="border">Due Date</th>
                    <th class="border">Return Date</th>
                    <th class="border">Total Amount</th>
                   
                    
                    
                </tr>
            </thead>
            <tbody class="">
                <?php
                $db = new Database();
                $db->sql("select * from returnedbooks left join books on returnedbooks.bookId=books.bookId left join users on returnedbooks.userId = users.userId left join categories on returnedbooks.categoryId=categories.categoryId left join payment on returnedbooks.userId = payment.userId");
               
                while($rows =  $db->getResult()){
                 
                 ?>
                 <?php 
                 foreach($rows as $row):?>
                 <tr class="border text-center">
                    <td><img class="w-12 h-14 rounded-md" src="<?php echo '../uploads/'.$row['display_name']; ?>"/></td>
                    <td class="border"><?php echo $row['title'];?></td>
                    <td class="border"><?php echo $row['name'];?></td>
                    <td class="border"><?php echo $row['email'];?></td>
                    <td class="border"><?php echo $row['address'];?></td>
                    <td class="border"><?php echo $row['category'];?></td>
                    <td class="border"><?php echo $row['rentDate'];?></td>
                    <td class="border"><?php echo $row['dueDate'];?></td>
                    <td class="border"><?php echo $row['returnDate'];?></td>
                    <td class="border"><?php echo $row['amount'];?></td>
                   
                 </tr>
                 <?php   endforeach ?>
                 <?php }?> 
            </tbody>
        </table>
    </main>
