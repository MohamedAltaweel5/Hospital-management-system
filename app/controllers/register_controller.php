<?php
    
    session_start();
    
    if (isset($_POST['submit']) && $_POST['submit'] == "register")
    {
        $register_data['username'] = $_POST['username'];
        $register_data['email'] = $_POST['email'];
        $register_data['password'] = $_POST['password'];
        $register_data['user_type'] = 'patient';
        
        try
        {
            include '../models/Register.php';
            $register = new Register($register_data);
            
            
            if ($register)
            {
                $_SESSION['success_msg'] = 'You have registered successfully';
                $_SESSION['username'] = $register_data['username'];
                $_SESSION['admin'] = FALSE;
                
                
                $_SESSION['user_email'] = $register_data['email'];
                
                
                include "get_user_id.php";
                
                header('location:../../public/site/success-page.php');
                
            }
        }
        
        catch (Exception $exception)
        {
            $_SESSION['admin'] = FALSE;
            $_SESSION['error_msg'] = 'Please try to register with other Email';
            
            header('location:../../public/site/error-page.php');
            
            //header('location:../../public/site/error-page.php?error_msg=' . urlencode('username or password is invalid , please try again'));
            
        }
        
    }
    
    
