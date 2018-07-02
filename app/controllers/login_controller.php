<?php
    session_start();
    
    if (isset($_POST['submit']) && $_POST['submit'] == "login")
    {
        $login_data['email'] = $_POST['email'];
        $login_data['password'] = $_POST['password'];
        
        try
        {
            include '../models/Login.php';
            $login = new Login($login_data);
            
            if ($login && $login_data['email'] != 'admin@hospital.com')
            {
                $_SESSION['admin'] = FALSE;
                $_SESSION['username'] = $login->get_username();
                $_SESSION['user_email'] = $login->get_email();
                $_SESSION['user_id'] = $login->get_user_id();
                
                header('location:../../public/site/home.php');
                
            }
            else
            {
                $_SESSION['admin'] = TRUE;
                $_SESSION['username'] = $login->get_username();
                $_SESSION['user_email']  = $login->get_email();
                $_SESSION['user_id'] = $login->get_user_id();
    
                header('location:../../public/site/admin.php');
            }
        }
        
        catch (Exception $exception)
        {
            $_SESSION['admin'] = FALSE;
            
            $_SESSION['error_msg'] = 'Please try again , Email or Password is invalid';
            
            header('location:../../public/site/error-page.php');
            
            //header('location:../../public/site/error-page.php?error_msg=' . urlencode('username or password is invalid , please try again'));
            
        }
        
    }
    
    
