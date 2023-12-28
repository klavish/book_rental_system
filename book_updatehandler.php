<?php
require_once 'validation.php';
require_once 'books_crud.php';


#getting bookId
if(isset($_GET['bookId'])){
    $bookid =  $_GET['bookId'];
    $object = new Database();
    $object->sql("select * from books left join categories on books.categoryId=categories.categoryId where bookId ='$bookid'");
    $res = $object->getResult();
    foreach($res as $row){
    }
 
 }
#handle update form
if (isset($_POST['update'])) {
    //echo "This is post bookId".$_POST[' bookId'];
    $validation = new Validation($_POST);
    $errors = $validation->validate_book_details();
    if (empty($errors)) {
        $book = new Books();
        $errors = $book->updateBook($_POST);
    }
}

?>