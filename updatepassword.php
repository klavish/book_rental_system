<?php
require_once 'database.php';
class UpdatePassword
{

    public function update_userPassword($data)
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $userEnteredCode = $_POST['verificationcode'];
            $userEmail = $_POST['email'];
            // Retrieve the stored verification code from db
            $query = new Database();
            $query->selectId("SELECT code FROM verification_codes where email='{$userEmail}'");
            $storedCode = $query->getResult();

            if ($userEnteredCode == $storedCode) {
                $newPassword = password_hash($_POST['password'], PASSWORD_DEFAULT); 
                $update_data = [
                    'password' => $newPassword
                ];
                $object = new Database();
                $object->update('users', $update_data, "email = '$userEmail'");

                // Delete the verification code from db
                $object->delete('verification_codes', "email = '$userEmail'");
                header('Location: user_login.php');
            }
        }
    }
}
