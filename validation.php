<?php
require_once 'database.php';
class Validation
{
    # Properties to store input data and validation errors
    private $data;
    private $errors = [];

    # Constructor to initialize the object 
    public function __construct($data)
    {
        $this->data = $data;
    }

 
    # Method to clean input data
    private function clean($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    private function validateName()
    {
        $name = $this->clean($this->data['name']);
        if (empty($name)) {
            $this->addError('name', 'Name cannot be empty');
        } elseif (strlen($name) < 3) {
            $this->addError('name', 'Name must contain more than 3 characters');
        } elseif (strlen($name) > 20) {
            $this->addError('name', "Name cannot contain more than 20 characters");
        } elseif (!preg_match("/^[A-Za-z ]*$/", $name)) {
            $this->addError('name', "Only letters and white spaces  are allowed");
        }
    }

    private function validateEmail()
    {
        $email = $this->clean($this->data['email']);
        $this->userduplicateData();
        if (empty($email)) {
            $this->addError('email', 'Email is required.');
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->addError('email', 'Invalid email format.');
        }
    }

    private function validatePhone()
    {
        $phone = $this->clean($this->data['phone']);

        if (empty($phone)) {
            $this->addError('phone', "Phone number cannnot be empty");
        } elseif (!filter_var($phone, FILTER_VALIDATE_INT) || filter_var($phone, FILTER_VALIDATE_INT) == 0) {
            $this->addError('phone', "Phone number must be integer");
        } elseif (!preg_match("/^[0-9]{10}$/", $phone)) {
            $this->addError('phone', "Invalid phone number");
        }
    }


    private function validatePassword()
    {
        $password = $this->clean($this->data['password']);
        $this->userduplicateData();
        if (empty($password)) {
            $this->addError('password', "Password cannnot be empty");
        } elseif (!preg_match("/^[A-Za-z0-9@#]*$/", $password)) {
            $this->addError('password', "Password must contain letters, numbers and special characters('@','#')");
        } elseif (strlen($password) < 8 || strlen($password) > 15) {
            $this->addError('password', "Password length must be between 8 - 15");
        }
    }

    private function validateGender()
    {
        if (!isset($this->data['gender'])) {
            $this->addError('gender', "Please select a gender");
        }
    }

    private function validateAddress()
    {
        $address = $this->clean($this->data['address']);

        if (empty($address)) {
            $this->addError('address', "Address cannnot be empty");
        } elseif (strlen($address) < 10 || strlen($address) > 40) {
            $this->addError('address', "Address length must be between 10 - 40");
        }
    }


    private function  validateProfile()
    {
        if (!isset($_FILES['profile']['error']) || $_FILES['profile']['error'] == UPLOAD_ERR_NO_FILE) {
            $this->addError('profile', "Profile picture is required.");
        } else {
            $profile = $_FILES['profile'];
            $allowed_types = array("jpg", "jpeg", "png");
            $extension = strtolower(pathinfo($profile['name'], PATHINFO_EXTENSION));

            // if the uploaded file is an image
            if (!getimagesize($profile['tmp_name'])) {
                $this->addError('profile', "The uploaded file is not a valid image.");
            }

            // if the file extension is allowed
            elseif (!in_array($extension, $allowed_types)) {
                $this->addError('profile', "Only JPG, JPEG, PNG files are allowed.");
            }
        }

        // Return null if validation passes
        return null;
    }


    private function validate_login_Email()
    {
        $email = $this->clean($this->data['email']);
        if (empty($email)) {
            $this->addError('email', 'Email is required.');
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->addError('email', 'Invalid email format.');
        }
    }

    private function validate_login_Password()
    {
        $password = $this->clean($this->data['password']);
        if (empty($password)) {
            $this->addError('password', "Password cannnot be empty");
        } elseif (!preg_match("/^[A-Za-z0-9@#]*$/", $password)) {
            $this->addError('password', "Password must contain letters, numbers and special characters('@','#')");
        } elseif (strlen($password) < 8 || strlen($password) > 15) {
            $this->addError('password', "Password length must be between 8 - 15");
        }
    }

    public function validate_Login_Details()
    {
        $this->validate_login_Email();
        $this->validate_login_Password();
        return $this->errors;
    }

    
    public function validate_ForgotPassword_Details()
    {
        $this->validateName();
        $this->validate_login_Email();
        return $this->errors;
    }


    private function validate_book_title()
    {
        $title = $this->clean($this->data['title']);
        if (empty($title)) {
            $this->addError('title', 'Title cannot be empty');
        } elseif (strlen($title) < 3) {
            $this->addError('title', 'Title must contain more than 3 characters');
        } elseif (strlen($title) > 40) {
            $this->addError('title', "Title cannot contain more than 40 characters");
        } elseif (!preg_match("/^[A-Za-z-'(), ]*$/", $title)) {
            $this->addError('title', "Only letters, white spaces and ('-', ''', '(', ')', ',') are allowed");
        }
        $this->bookduplicateData();
    }

    private function validate_book_author()
    {
        $author = $this->clean($this->data['author']);
        if (empty($author)) {
            $this->addError('author', 'Author cannot be empty');
        } elseif (strlen($author) < 3) {
            $this->addError('author', 'Author must contain more than 3 characters');
        } elseif (strlen($author) > 40) {
            $this->addError('author', "Author cannot contain more than 40 characters");
        }
    }


    private function validate_book_category()
    {
        $category = $this->data['category'];

        if ($category === 'select') {
            $this->addError('category', 'Please select a valid category.');
        } elseif (empty($category)) {
            $this->addError('category', 'Category is required.');
        }
    }


    private function validate_book_description()
    {
        $description = $this->data['description'];
        if (empty($description)) {
            $this->addError('description', 'Description is required.');
        }
    }

    private function validate_book_quantity()
    {
        $quantity = $this->clean($this->data['quantity']);

        if (empty($quantity)) {
            $this->addError('quantity', "Quantity cannnot be empty");
        } elseif (!filter_var($quantity, FILTER_VALIDATE_INT) || filter_var($quantity, FILTER_VALIDATE_INT) == 0) {
            $this->addError('quantity', "Quantity must be integer");
        } elseif (!preg_match("/^[0-9]$/", $quantity)) {
            $this->addError('quantity', "Invalid quantity");
        }
    }

    private function validate_book_Price()
    {
        $price = $this->clean($this->data['price']);
    
        if (empty($price)) {
            $this->addError('price', "Rent amount cannot be empty");
        } elseif (!filter_var($price, FILTER_VALIDATE_FLOAT)) {
            $this->addError('price', "Rent amount must be a valid number");
        } elseif ($price <= 0) {
            $this->addError('price', "Rent amount must be greater than 0");
        }
    }
    
    
    private function validate_book_Fine()
    {
        $fine = $this->clean($this->data['fine']);
    
        if (empty($fine)) {
            $this->addError('fine', "Fine amount cannot be empty");
        } elseif (!filter_var($fine, FILTER_VALIDATE_INT)) {
            $this->addError('fine', "Fine amount must be a valid number");
        } elseif ($fine <= 0) {
            $this->addError('fine', "Fine amount must be greater than 0");
        }
    }

    private function validate_book_Status()
    {
        $status = $this->clean($this->data['status']);
    
        if (empty($status)) {
            $this->addError('status', "Book Status cannot be empty");
        } 
    }

    private function validate_book_Image()
    {
        if (!isset($_FILES['image']['error']) || $_FILES['image']['error'] == UPLOAD_ERR_NO_FILE) {
            $this->addError('image', "Book image is required.");
        } else {
            $image = $_FILES['image'];
            $allowed_types = array("jpg", "jpeg", "png");
            $extension = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));

           
            if (!getimagesize($image['tmp_name'])) {
                $this->addError('image', "The uploaded file is not a valid image.");
            }

           
            elseif (!in_array($extension, $allowed_types)) {
                $this->addError('image', "Only JPG, JPEG, PNG files are allowed.");
            }
        }

        //  null if validation passes
        return null;
    }

    private function validate_days()
    {
  
    $days = $this->clean($this->data['days']);
    if (empty( $days)) {
        $this->addError('days', "Days cannot be empty");
    }
    
    elseif(!is_numeric($days) || $days <= 0) {
        $this->addError('days', "Days must be numeric");
        
    } 
   }

    private function validate_card_Number()
    {
        $cardNumber = $this->clean($this->data['cardNumber']);
        if (empty($cardNumber)) {
            $this->addError('cardNumber', 'Card Number cannot be empty');
        }elseif (!filter_var($cardNumber, FILTER_VALIDATE_INT)) {
            $this->addError('cardNumber', "Card Number must be numeric");
        } 
        elseif (!preg_match("/^\d{16}$/", $cardNumber)) {
            $this->addError('cardNumber', 'Card Number must contain 16 digits');
        }
        
    }

    private function validate_cvv()
    {
        $cvv = $this->clean($this->data['cvv']);
        if (empty($cvv)) {
            $this->addError('cvv', 'CVV cannot be empty');
        } elseif ($cvv < 100 || $cvv > 999) {
            $this->addError('cvv', 'CVV must contain 3 digits');
        }
    }

    private function validate_expiry_date()
    {
        $expiryDate = ($this->data['expiryDate']);

    if (empty($expiryDate)) {
        $this->addError('expiryDate', 'Expiry date cannot be empty');
    } else {
        $currentDate = date('Y-m-d H:i:s');

        # Compare expiry date with the current date
        if ($expiryDate < $currentDate) {
            $this->addError('expiryDate', 'Invalid date Select a Valid Date');
        }
    
    } 
  }

   private function validate_rent_amount()
  {
    $amount = $this->clean($this->data['amount']);

    if (empty($amount)) {
        $this->addError('amount', "Amount cannnot be empty");
    } elseif (!filter_var($amount, FILTER_VALIDATE_FLOAT)) {
        $this->addError('amount', "Amount must be numeric");
    } elseif (!preg_match("/^[0-9]+(?:\.\d+)?$/", $amount)) {
        $this->addError('amount', "Invalid amount");
    }
    
  }

   public function validate_payment_details()
   {
    $this->validate_card_Number();
    $this->validateName();
    $this->validate_cvv();
    $this->validate_expiry_date();
    $this-> validate_rent_amount();
    return $this->errors;
   }

    public function validate_user_details()
    {
        $this->validateName();
        $this->validateEmail();
        $this->validatePhone();
        $this->validatePassword();
        $this->validateGender();
        $this->validateAddress();
        $this->validateProfile();
        $this->userduplicateData();


        return $this->errors;
    }


    
    #books validations
    public function validate_book_details()
    {
        $this->validate_book_title();
        $this->validate_book_author();
        $this->validate_book_category();
        $this->validate_book_description();
        $this->validate_book_quantity();
        $this->validate_book_Image();
        $this->validate_book_Price();
        $this->validate_book_Fine();
        $this->validate_book_Status();
        $this->bookduplicateData();

        return $this->errors;
    }

    public function validate_book_kept_days()
    {
        $this->validate_days();
        
        return $this->errors;
    }

    private function userduplicateData()
    {
        $useremail = $this->data['email'];
        $db = new Database();
        $redundent_email = $db->selectId("select email from users where email = '$useremail'");
        if ($redundent_email) {
            $this->addError('email', "This email has already taken");
        }
        $userpass = $this->data['password'];
        $redundent_pass = $db->selectId("select password from users where password = '$userpass'");
        if ($redundent_pass) {
            $this->addError('password', "This password has already taken");
        }

     
    }

    private function bookduplicateData()
    {

        $booktitle = $this->data['title'];
        $db = new Database();
        $redundent_title = $db->selectId("select title from books where title = '$booktitle'");
        if ($redundent_title) {
            $this->addError('title', "This title has already taken");
        }
        $category = $this->data['category'];
        $redundent_category = $db->selectId("select category from categories where category = '$category'");
        if ($redundent_category) {
            $this->addError('category', "This category has already taken");
        }

    }

    private function validateCode()
    {
        $code = $this->clean($this->data['verificationcode']);

        if (empty($code)) {
            $this->addError('code', "Verification Code cannnot be empty");
        } elseif (!filter_var($code, FILTER_VALIDATE_INT) || filter_var($code, FILTER_VALIDATE_INT) == 0) {
            $this->addError('code', "Verification Code must be integer");
        } elseif (!preg_match("/^[0-9]{6}$/", $code)) {
            $this->addError('code', "Invalid Verification Code");
        }
    }

    private function validate_reset_Password()
    {
        $password = $this->clean($this->data['password']);
        
        if (empty($password)) {
            $this->addError('password', "Password cannnot be empty");
        } elseif (!preg_match("/^[A-Za-z0-9@#]*$/", $password)) {
            $this->addError('password', "Password must contain letters, numbers and special characters('@','#')");
        } elseif (strlen($password) < 8 || strlen($password) > 15) {
            $this->addError('password', "Password length must be between 8 - 15");
        }
    }
    private function validate_confirm_Password()
    {
        $confirmpassword = $this->clean($this->data['confirmpassword']);
        $password = $this->clean($this->data['password']);
        if (empty($confirmpassword)) {
            $this->addError('confirmpassword', "Password cannnot be empty");
        } elseif (!preg_match("/^[A-Za-z0-9@#]*$/", $confirmpassword)) {
            $this->addError('confirmpassword', "Password must contain letters, numbers and special characters('@','#')");
        } elseif (strlen($confirmpassword) < 8 || strlen($confirmpassword) > 15) {
            $this->addError('confirmpassword', "Password length must be between 8 - 15");
        }elseif ($confirmpassword != $password) {
            $this->addError('confirmpassword', "Password not match with above password enter same password");
        }
    }
    public function validate_category_details()
    {

        $this->validate_book_category();
        //$this->duplicateData();

        return $this->errors;
    }

    public function validate_Verification_details(){
        $this->validate_login_Email();
        $this->validateCode();
        $this->validate_reset_Password();
        $this->validate_confirm_Password();
        return $this->errors;
    }

    # Method to add an error message to the errors array
    private function addError($key, $message)
    {
        $this->errors[$key] = $message;
    }
}
