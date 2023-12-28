<?php
session_start();
require_once 'validation.php';
require_once 'database.php';


class ForgotPassword
{
    public function resetPassword($data)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $name = $_POST['name'];
            $email = $_POST['email'];
            $ob = new Database();
            $ob->sql("select * from users where email='{$email}'");
            $res = $ob->getResult();
            foreach ($res as $key => $val) {
                $val['name'];
                $val['email'];
            }

            if ($_POST['name'] == $val['name'] && ($_POST['email'] == $val['email'])) {

                // Function to generate a random 6-digit number
                function generateRandomNumber()
                {
                    return mt_rand(100000, 999999);
                }

                // Generate a random verification code
                $verificationCode = generateRandomNumber();

                // Store the verification code in the database 
                $userEmail = $_POST['email'];
                $userName = $_POST['name'];
                $query = new Database();
                $code = [
                    'userId' => $val['userId'],
                    'email' => $userEmail,
                    'code' => $verificationCode,
                    'created' => date('Y-m-d H:i:s'),
                    'deleted' => date('Y-m-d H:i:s'),

                ];
                $query->insert('verification_codes', $code);

                $to_email = "$userEmail";
                $subject = "Reset password";
                $body = "href=http://localhost/book_rental/verifydetails.php ,Verification code $verificationCode";
                $headers = "From:lavishkr96@gmail.com";

                if (mail($to_email, $subject, $body, $headers)) {
                    echo "Email sent sucessfully";
                } else {
                    echo "Email not send";
                }
            }
        }
    }
}
