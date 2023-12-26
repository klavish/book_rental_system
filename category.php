<?php

include_once 'database.php';

class Category
{

    public function addCategory()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $$created = date('Y-m-d H:i:s');
            $modified = date('Y-m-d H:i:s');
            $insert_data = [
                'category' => $_POST['category'],
                'created' => $created,
                'modified' => $modified
            ];

            $obj1 = new Database();
            $obj1->insert('categories', $insert_data);
            header('Location:dashboard.php');
        }
    }


    public function updateCategory()
    {
        if (isset($_POST['update'])) {
            $categoryid = $_POST['categoryId'];
            $modified = date('Y-m-d H:i:s');
            $update_data = [
                'category' => $_POST['category'],
                'modified' => $modified
            ];
            $object = new Database();
            $object->selectId("select categoryId from books where Id = '$categoryid'");
            $resultingId = $object->getResult();
            if (!$resultingId) {
                $object->update('categories', $update_data, "categoryId = '$categoryid'");
                header('Location:dashboard.php');
            }
        }   echo "Did not get Id";

    }


    public function deleteCategory()
    {
        if (isset($_GET['categoryId'])) {
            $cid = $_GET['categoryId'];
            $dbobj = new Database();
            $dbobj->selectId("select categoryId from categories where categoryId='$cid'");
        }

        if (isset($_POST['categoryId'])) {
            $categoryid = $_POST['categoryId'];
            $dbobject = new Database();
            $dbobject->selectId("select categoryId from books where categoryId='$categoryid'");
            $categoryId = $dbobject->getResult();
            if (!$categoryId) {
            $dbobject->delete('categories', "categoryId = '$categoryid'");
            header('Location:dashboard.php');
            }
        }  echo "You cannot delete this category";
        
    }
}
