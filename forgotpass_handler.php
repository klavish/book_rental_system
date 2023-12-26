<?php
session_start();
require_once 'validation.php';
require_once 'database.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
//Load Composer's autoloader
require 'vendor/autoload.php';

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
                    'userId'=>$val['userId'],
                    'email' => $userEmail,
                    'code' => $verificationCode,
                    'created' => date('Y-m-d H:i:s'),
                    'deleted' => date('Y-m-d H:i:s'),

                ];
                $query->insert('verification_codes', $code);

                //Create an instance; passing `true` enables exceptions
                $mail = new PHPMailer(true);
                try {
                    $mail->isSMTP(); // Set mailer to use SMTP
                    $mail->CharSet = "utf-8"; // set charset to utf8
                    $mail->SMTPAuth = true; // Enable SMTP authentication
                    $mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted

                    $mail->Host = 'smtp.gmail.com'; // Specify main and backup SMTP servers
                    $mail->Port = 587; // TCP port to connect to
                    $mail->SMTPOptions = array(
                        'ssl' => array(
                            'verify_peer' => false,
                            'verify_peer_name' => false,
                            'allow_self_signed' => true
                        )
                    );
                    $mail->isHTML(true); // Set email format to HTML

                    $mail->Username = 'lavishkr96@gmail.com'; // SMTP username
                    $mail->Password = 'ioyn eoze acix awyd'; // SMTP password

                    $mail->setFrom('lavishkr96@gmail.com', 'John'); //Your application NAME and EMAIL
                    $mail->Subject = 'Reset password '; //Message subject
                    $mail->MsgHTML("href='http://localhost/book_rental/verify_details.php',$verificationCode"); // Message body
                    $mail->addAddress("$userEmail", "$userName"); // Target email

                    $mail->send();
                    echo 'Message has been sent';
                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
                
            }else{
                echo "Invalid User";
            }


        }
    }
}
