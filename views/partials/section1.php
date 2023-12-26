<?php require_once 'database.php';?>
<section class="grid  grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-4 mb-4">
            <article class="flex gap-3 pl-3 border py-4 rounded-lg shadow-md">
                <div class="">
                    <svg class="w-12 h-12 bg-orange-200 p-3 rounded-full fill-orange-600 stroke-orange-600"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z">
                        </path>
                    </svg>
                </div>
                <div><?php $db = new Database();
                $db->selectId('select count(userId) from users');
                $totalUsers = $db->getResult(); ?>
                    <h2 class="font-medium text-base">Total Users</h2>
                    <span><?php echo $totalUsers; ?></span>
                </div>
            </article>

            <article class="flex gap-3 pl-3 border py-4 rounded-lg shadow-md">
                <div class="">
                    <svg class="w-12 h-12 bg-orange-200 p-3 rounded-full fill-orange-600 stroke-orange-600"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z">
                        </path>
                    </svg>
                </div>
                <div><?php $db = new Database();
                $db->selectId('select count(bookId) from books');
                $totalBooks = $db->getResult(); ?>
                    <h2 class="font-medium text-base">Total Books</h2>
                    <span><?php echo $totalBooks; ?></span>
                </div>
            </article>

            <article class="flex gap-3 pl-3 border py-4 rounded-lg shadow-md">
                <div class="">
                    <svg class="w-12 h-12 bg-orange-200 p-3 rounded-full fill-orange-600 stroke-orange-600"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z">
                        </path>
                    </svg>
                </div>
                <div><?php $db = new Database();
                $db->selectId('select count(categoryId) from categories');
                $totalCategories = $db->getResult(); ?>
                    <h2 class="font-medium text-base">Total Categories</h2>
                    <span><?php echo $totalCategories; ?></span>
                </div>
            </article>

            <article class="flex gap-3 pl-3 border py-4 rounded-lg shadow-md">
                <div class="">
                    <svg class="w-12 h-12 bg-orange-200 p-3 rounded-full fill-orange-600 stroke-orange-600"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z">
                        </path>
                    </svg>
                </div>
                <div><?php $db = new Database();
                $db->selectId('select count(rentId) from rentedbooks');
                $totalRentedbooks = $db->getResult(); ?>
                    <h2 class="font-medium text-base">Total RentedBooks</h2>
                    <span><?php echo $totalRentedbooks; ?></span>
                </div>
            </article>
        </section>