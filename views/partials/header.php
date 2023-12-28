<?php
require_once 'admin_loginhandler.php';
require_once 'database.php';
//require_once 'user_record.php';
if(!isset($_SESSION['admin_Login'])){
    header('location:admin_login.php');
}

?>

<header class="p-0 md:pl-[16rem] text-purple-800 pt-2">
<h2 class="text-lg font-medium text-black">Welcome , Admin</h2>
        <nav class="flex py-2 gap-1 ">

            <svg class="w-8 h-8 md:hidden" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M6 8h12M6 12h12M6 16h12"></path>
            </svg>


            <div class="w-full flex justify-between pr-8">
                <form name="searchform" method="post" class="w-2/3 pl-4" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                     <div class="relative w-full flex">
                        <input type="text" name="email" 
                            class="w-full border h-8 shadow py-4 pl-8 rounded-xl bg-slate-100 focus:outline-indigo-200"
                            placeholder="search" autocomplete="off">
                        <button type="submit" name="search">
                        <svg class="w-5 h-5 absolute top-2.5 left-1" xmlns="http://www.w3.org/2000/svg" role="img"
                            viewBox="0 0 24 24" aria-labelledby="searchIconTitle" fill="none" stroke="currentColor">
                            <title id="searchIconTitle">Search</title>
                            <path d="M14.4121122,14.4121122 L20,20"></path>
                            <circle cx="10" cy="10" r="6"></circle>
                        </svg>
                        </button>
                        <?php
                        if(isset($_POST['search'])) {
                        // Redirect to another page
                        header('location:searchuser.php');
                        // Ensure that no further code is executed after the header is sent
                        }
                    ?>
                    </div>
                    
                </form>
            </div>
            <div class="flex gap-2 pt-2 items-center">
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    viewBox="0 0 16 16">
                    <path
                        d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z">
                    </path>
                </svg>



                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    viewBox="0 0 16 16">
                    <path
                        d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zm.995-14.901a1 1 0 1 0-1.99 0A5.002 5.002 0 0 0 3 6c0 1.098-.5 6-2 7h14c-1.5-1-2-5.902-2-7 0-2.42-1.72-4.44-4.005-4.901z">
                    </path>
                </svg>
                
               
                <button type="submit" value="submit">
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"  width="16" height="16" fill="currentColor">
                    <path d="M10 20a10 10 0 1 1 0-20 10 10 0 0 1 0 20zM7 6v2a3 3 0 1 0 6 0V6a3 3 0 1 0-6 0zm-3.65 8.44a8 8 0 0 0 13.3 0 15.94 15.94 0 0 0-13.3 0z">

                    </path>
                </svg>
                
                </button>

                
            </div>

        </nav>
    </header>