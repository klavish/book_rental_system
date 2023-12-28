<?php
session_start();
if (!isset($_SESSION['loginUser'])) {
    header('location:user_login.php');
}
?>
<?php
require 'database.php';
require('views/partials/head.php') ?>
<?php require('views/partials/head.php') ?>

<body>
    <?php require('views/partials/books_header.php'); ?>
    <main>
        <table class="mx-auto w-full">
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

                $loginUserId = $_SESSION['loginUser'];
                $db = new Database();
                $db->sql("select * from rentedbooks where userId = '$loginUserId'");
                $bookData = $db->getResult();

                $db = new Database();
                $db->sql("select * from users left join image_file on users.userId = image_file.userId where Id = '$loginUserId'");

                while ($rows =  $db->getResult()) {

                ?>
                    <?php
                    foreach ($rows as $row) : ?>
                        <tr class="border text-center">
                            <td><img class="w-12 h-14 rounded-md" src="<?php echo $row['path']; ?>" /></td>
                            <td class="border"><?php echo $row['name']; ?></td>
                            <td class="border"><?php echo $row['email']; ?></td>
                            <td class="border"><?php echo $row['phone']; ?></td>
                            <td class="border"><?php echo $row['gender']; ?></td>
                            <td class="border"><?php echo $row['address']; ?></td>
                            <td class="flex gap-2 items-center justify-center">
                                <?php $loginId = isset($_SESSION['loginUser']) ? $_SESSION['loginUser'] : 's';

                                $dbId = isset($row['userId']) ? $row['userId'] : ''; ?>
                                <?php if ($loginId == $dbId) : ?>
                                    <a href="./update_user.php?userId=<?php echo $row['userId']; ?>"><svg class="w-6 h-6" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                            <path d="M402.6 83.2l90.2 90.2c3.8 3.8 3.8 10 0 13.8L274.4 405.6l-92.8 10.3c-12.4 1.4-22.9-9.1-21.5-21.5l10.3-92.8L388.8 83.2c3.8-3.8 10-3.8 13.8 0zm162-22.9l-48.8-48.8c-15.2-15.2-39.9-15.2-55.2 0l-35.4 35.4c-3.8 3.8-3.8 10 0 13.8l90.2 90.2c3.8 3.8 10 3.8 13.8 0l35.4-35.4c15.2-15.3 15.2-40 0-55.2zM384 346.2V448H64V128h229.8c3.2 0 6.2-1.3 8.5-3.5l40-40c7.6-7.6 2.2-20.5-8.5-20.5H48C21.5 64 0 85.5 0 112v352c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V306.2c0-10.7-12.9-16-20.5-8.5l-40 40c-2.2 2.3-3.5 5.3-3.5 8.5z">
                                            </path>
                                        </svg></a>

                                    <?php if (isset($bookData[0]['paymentStatus']) == 'Paid' || !isset($bookData[0]['userId'])):?>
                                    <a href="./delete_user.php?userId=<?php echo $row['userId']; ?>"><svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M0 0h24v24H0V0z" fill="none"></path>
                                            <path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zm2.46-7.12l1.41-1.41L12 12.59l2.12-2.12 1.41 1.41L13.41 14l2.12 2.12-1.41 1.41L12 15.41l-2.12 2.12-1.41-1.41L10.59 14l-2.13-2.12zM15.5 4l-1-1h-5l-1 1H5v2h14V4z"></path>
                                        </svg></a>
                                    <?php endif; ?>

                                <?php else : ?>
                                    <a href="unauthuser.php"><svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M4 8V6a6 6 0 1 1 12 0v2h1a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-8c0-1.1.9-2 2-2h1zm5 6.73V17h2v-2.27a2 2 0 1 0-2 0zM7 6v2h6V6a3 3 0 0 0-6 0z"></path>
                                        </svg></a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach ?>


                <?php } ?>
            </tbody>
        </table>
        <?php

        ?>
    </main>