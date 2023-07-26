<?php 
    function validate_Email($email)
    {
        $valid_email = $email;
        if (!filter_var($valid_email, FILTER_VALIDATE_EMAIL)) {
            echo "<script>alert('Enter Valid Email please');</script>";
           
        } else {
            return true;
        }
    }
    function validate_Phone($Phone)
    {
        $valid_Phone = $Phone;
        if (!preg_match("/^\d{10}$/", $valid_Phone)) {
            echo "<script>alert('phone number must contain only 10 numeric values');</script>";
            // return false;
        } else 
        {
            
                return true;
            
        }
    }

?>