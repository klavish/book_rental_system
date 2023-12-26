<?php
session_start();
require_once 'database.php';
if(!isset($_SESSION['loginUser'])){
header('location:user_login.php');
} 
?>
<?php
$userId = $_SESSION['loginUser']['userId'];
$getStatus = new Database();
$getStatus->selectId("select paymentStatus from rentedbooks  where userId = '$userId'");
$status = $getStatus->getResult();
?> 
<?php
require_once 'rentcalculation.php';
require_once 'rentedbook.php';
require_once 'validation.php';


if (isset($_POST['payment'])) {
    $validation = new Validation($_POST);
    $errors = $validation->validate_payment_details();
 
    if (empty($errors)) {
        $payment = new RentedBook();
        $errors = $payment->return_bookandmake_Payment($_POST);
    }
}
?>

<?php if ($status == 'Paid'){

    header('location:home.php');
}?>
    
<?php require('views/partials/head.php') ?>
<body>
    <?php require('views/partials/books_header.php') ?>
    <main class="flex items-center justify-center  space-x-8 container p-6 mx-auto">
        <div class="flex flex-col flex-1  items-start">
            <?php $userid = $_SESSION['loginUser']['userId'];
            $db = new Database();
            $db->sql("select * from rentedbooks left join books on books.bookId=rentedbooks.bookId where userId = '$userid'");
            while ($rows =  $db->getResult()) { ?>
                <?php foreach ($rows as $row) : ?>
                    <div class="w-full h-full ">
                        <img class="w-56 h-56  object-fill rounded-sm" src="<?php echo '../uploads/' . $row['display_name']; ?>" >
                    </div>
                    <cite class="line-clamp-2 text-base font-medium"> <?php echo "Title :" . $row['title']; ?></cite>
                    <em class="text-sm font-medium "><?php echo "Author :" . " " . $row['author']; ?></em>
        </div>
        <?php 
        # find rent amount using calculateRentAndFine that will return $total rent amount
        $rentDate = strtotime($row['rentDate']);
        $current =  strtotime(date('Y-m-d H:i:s'));
        $daysDiff = abs($rentDate - $current);
        $daysKept = floor($daysDiff / (60 * 60 * 24));
        $rentPerDay = $row['price'];
        $finePerDay = $row['fine'];
        $rentCalculate = new RentCalculation();
        $dueDate = $row['dueDate'];
        $returnDate = date('Y-m-d H:i:s');
        $rentAmount = $rentCalculate->calculateRentAndFine($rentPerDay, $finePerDay, $daysKept, $dueDate, $returnDate);
        
        ?> 
        <?php endforeach ?>
        <?php } ?>

        <div class="flex flex-1 m-auto w-full">
            <form class="bg-slate-100 flex flex-col justify-center space-y-2 px-4 py-6 h-full" name="payment"  method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <h1 class="font-semibold text-lg text-center">Book Return </h1>
                <div class="grid grid-cols-2 gap-4">
                        
                        <input type="hidden" name="bookId" class="border rounded-md w-full px-4 py-2 text-sm" value="<?php  echo $row['bookId']; ?>">
                        <input type="hidden" name="quantity" class="border rounded-md w-full px-4 py-2 text-sm"  value="<?php  echo $row['dueDate']; ?>">   
                        <input type="hidden" name="categoryId" class="border rounded-md w-full px-4 py-2 text-sm" value="<?php echo  $row['categoryId']; ?>">
                        <input type="hidden" name="rentDate" class="border rounded-md w-full px-4 py-2 text-sm"  value="<?php echo $row['rentDate']; ?>">
                        <input type="hidden" name="dueDate" class="border rounded-md w-full px-4 py-2 text-sm"  value="<?php  echo $row['dueDate']; ?>">   
                    
                    <label for="cardNumber" class="text-sm font-medium">Card Number<span class="text-red-600">*</span></label>
                    <div>
                        <input type="text" name="cardNumber" class="border rounded-md w-full px-4 py-2 text-sm" placeholder="Enter Card Number">
                        <span class="text-sm text-red-600"><?php echo $errors['cardNumber'] ?? ''; ?></span>                 
                    </div>

                    <label for="name" class="text-sm font-medium">Name on Card<span class="text-red-600">*</span></label>
                    <div>
                        <input type="text" name="name" class="border rounded-md w-full px-4 py-2 text-sm" placeholder="Enter Name on Card" >
                        <span class="text-sm text-red-600"><?php echo $errors['name'] ?? ''; ?></span>
                    </div>
                    <label for="expiryDate"  class="text-sm font-medium">Expiry Date<span class="text-red-600">*</span></label>
                    <div>
                        <input type="month"  name="expiryDate" class="border rounded-md w-full px-4 py-2 text-sm" placeholder="Select Expiry date">
                        <span class="text-sm text-red-600"><?php echo $errors['expiryDate'] ?? ''; ?></span>
                    </div>

                    <label for="cvv"  class="text-sm font-medium">CVV<span class="text-red-600">*</span></label>
                    <div>
                        <input type="password"  name="cvv" class="border rounded-md w-full px-4 py-2 text-sm" placeholder="Enter CVV">
                        <span class="text-sm text-red-600"><?php echo $errors['cvv'] ?? ''; ?></span>                
                    </div>

                    <label for="amount" class="text-sm font-medium">Amount<span class="text-red-600">*</span></label>
                    <div>
                        <input type="number" name="amount" class="border rounded-md w-full px-4 py-2 text-sm" value="<?php  echo $rentAmount; ?>">
                        <span class="text-sm text-red-600"><?php echo $errors['amount'] ?? ''; ?></span>
                    </div>

                </div>
                <button type="submit" name="payment" id="payment"  class=" text-white rounded-md bg-blue-700 w-full px-28 py-2 text-center">Pay</button>
            </form>

            </div>


    </main>

    <?php require('views/partials/footer.php') ?>
