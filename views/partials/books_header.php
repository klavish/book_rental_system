<?php
session_start(); ?>
<header class="mb-20 container">
    <!-- Navigation Bar -->
    <nav class=" bg-[#2370f4] flex items-center dark:bg-indigo-800 fixed w-full top-0 left-0 z-20 xl:px-20 py-3">
        <ul class="flex  w-full  gap-6  items-center justify-evenly">
            <!-- logo -->
            <li>
                <a class="pt-4 cursor-pointer">
                    <img class="rounded-md w-24" src="https://cdn.pixabay.com/photo/2017/01/13/13/11/book-1977235_640.png" alt="books logo" title="Books">
                </a>
            </li>

            <!--anchors  -->
            <li class="flex gap-3">
                <a href="./home.php" class="hover:underline underline-offset-2  hover:text-blue-800  text-white" aria-label="user registration">Home</a>

                <a href="./bookreturn.php" class="hover:underline underline-offset-2 hover:text-blue-800 text-white" aria-label="user registration">ReturnBook</a>
            </li>

            <!-- search books by name -->
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <li class="w-96 sm:w-[100px] xl:w-[350px]  relative space-x-2 pt-5">
                <input class="mx-auto w-full rounded-lg p-1.5 px-3 text-base  dark:bg-gray-300 placeholder:text-gray-400 dark:placeholder:text-gray-700 " type="search" placeholder="Search For Books" autocomplete="off">
                <span>
                    <svg class="w-6 h-6 absolute top-9  right-3 -translate-y-1/2 text-[#2874f0] dark:text-indigo-800" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M18.319 14.4326C20.7628 11.2941 20.542 6.75347 17.6569 3.86829C14.5327 0.744098 9.46734 0.744098 6.34315 3.86829C3.21895 6.99249 3.21895 12.0578 6.34315 15.182C9.22833 18.0672 13.769 18.2879 16.9075 15.8442C16.921 15.8595 16.9351 15.8745 16.9497 15.8891L21.1924 20.1317C21.5829 20.5223 22.2161 20.5223 22.6066 20.1317C22.9971 19.7412 22.9971 19.1081 22.6066 18.7175L18.364 14.4749C18.3493 14.4603 18.3343 14.4462 18.319 14.4326ZM16.2426 5.28251C18.5858 7.62565 18.5858 11.4246 16.2426 13.7678C13.8995 16.1109 10.1005 16.1109 7.75736 13.7678C5.41421 11.4246 5.41421 7.62565 7.75736 5.28251C10.1005 2.93936 13.8995 2.93936 16.2426 5.28251Z" fill="currentColor"></path>
                    </svg>
                </span>
            </li></form>

            <!-- select books by category -->
            <li class="relative">
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <div class="grid grid-cols-2">
                        <select name="category" id="category" class="bg-gray-50 border border-gray-300  text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block  p-1 ">
                            <option value="all">All Categories</option>
                            <?php
                            $db = new Database();
                            $db->sql("select * from categories");
                            while ($rows =  $db->getResult()) {
                            ?>
                                <?php foreach ($rows as $row) : ?>
                                    <option value="<?php echo $row['category'] ?>"><?php echo $row['category'] ?></option>
                                <?php endforeach ?>

                            <?php } ?>

                        </select>
                        <button class="border rounded-md bg-blue-700 text-white text-sm p-1 w-16 h-10" name="submit" type="submit">Search</button>
                    </div>
                </form>
            </li>
            </li>
            <!-- cart -->
            <?php require('cart.php'); ?>

            <!-- User options -->
            <li>
                <?php require 'options.php'; ?>
            </li>
            <li class="flex gap-0 items-center pl-2">
                <a href="./user_registration.php" class="<?php echo !isset($_SESSION['loginUser']) ? "visible" : "hidden"; ?> hover:text-blue-800  px-4 py-2   text-white  text-sm " aria-label="user registration">Signup</a>
                <span class="<?php echo !isset($_SESSION['loginUser']) ? "visible" : "hidden"; ?> text-white">/</span>
                <a href="./user_login.php" class="<?php echo !isset($_SESSION['loginUser']) ? "visible" : "hidden"; ?> hover:text-blue-800  px-4 py-2  text-white  text-sm " aria-label="user registration">Signin</a>
                <a href="./user_logout.php" class="<?php echo isset($_SESSION['loginUser']) ? "visible" : "hidden"; ?> hover:text-blue-800  px-4 py-2  text-white  text-sm " aria-label="user registration">Signout</a>
            </li>
        </ul>
    </nav>
</header>