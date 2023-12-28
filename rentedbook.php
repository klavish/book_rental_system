<?php
session_start();
include_once 'database.php';

class RentedBook
{
    /**
     * Add rented book information to the database.
     *
     * @param array $data - Data contains information of rented book.
     */
    public function addrentedbook($data)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Get the current date and time for rentDate
            $rentDate = date('Y-m-d H:i:s');
            // Get the user ID from the session
            $userId = $_SESSION['loginUser']['userId'];
            // Get book information from the form
            $bookId = $_POST['bookId'];
            $days = $_POST['days'];
            // Calculate due date based on rentDate and number of days
            $dueDate = date('Y-m-d H:i:s', strtotime("+$days days"));

     
            $insert_data = [
                'userId' => $userId,
                'bookId' => $bookId,
                'categoryId' => $_POST['categoryId'],
                'days' => $_POST['days'],
                'price' => $_POST['price'],
                'fine' => $_POST['fine'],
                'rentDate' => $rentDate,
                'dueDate' => $dueDate,
                'paymentStatus' => 'Unpaid'
            ];

            // Insert rented book record into the database
            $recordInserted = new Database();
            $recordInserted->insert('rentedbooks', $insert_data);

            if ($recordInserted) {
                // Update book quantity in the books table
                $recordupdate = new Database();
                $recordupdate->selectId("select quantity from books  where bookId = '$bookId'");
                $quantity = $recordupdate->getResult();
                $qty = array('quantity' => $quantity - 1);
                $recordupdate->update('books', $qty, "bookId = '$bookId'");
                // Clear user's stored book information from the session
                unset($_SESSION['loginUser']['book']);
                // Redirect to the home page
                header("location:home.php");
            }
        }
    }

    /**
     * Process the return of a book and make a payment.
     *
     * @param array $data - Data containing information about the returned book and payment.
     */
    public function return_bookandmake_Payment($data)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Get the current date and time for the transaction
            $transactionDate = date('Y-m-d H:i:s');
            // Get user ID from the session
            $userId = $_SESSION['loginUser'];
            // Get book information from the form
            $bookId = $_POST['bookId'];

            // Prepare data for payment insertion
            $payment_data = [
                'userId' => $userId,
                'bookId' => $bookId,
                'cardNumber' => $_POST['cardNumber'],
                'name' => $_POST['name'],
                'amount' => $_POST['amount'],
                'transactionDate' => $transactionDate,
                'status' => 'Success'
            ];

            // Insert payment record into the database
            $recordInsert = new Database();
            $recordInsert->insert('payment',  $payment_data);

            // Get the return date
            $returnDate = date('Y-m-d H:i:s');

            // Prepare data for returned book insertion
            $returnedbook_data = [
                'userId' => $userId,
                'bookId' => $_POST['bookId'],
                'categoryId' => $_POST['categoryId'],
                'rentDate' => $_POST['rentDate'],
                'dueDate' => $_POST['dueDate'],
                'returnDate' => $returnDate,
                'status' => 'paid',
            ];

            if ($recordInsert) {
                // Insert returned book record into the database
                $recordInsert->insert('returnedbooks',  $returnedbook_data);

                // Update book quantity in the books table
                $recordInsert = new Database();
                $recordInsert->selectId("select quantity from books  where bookId = '$bookId'");
                $quantity = $recordInsert->getResult();
                $qty = array('quantity' => $quantity + 1);
                $recordInsert->update('books', $qty, "bookId = '$bookId'");
                // Redirect to the home page
                header("location:home.php");
            }
        }
    }
}
?>
