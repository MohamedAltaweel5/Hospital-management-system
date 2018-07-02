<?php
    
    session_start();
    
    // edit user
    
    if (isset($_POST['submit']) && $_POST['submit'] == "edit_user")
    {
        $data['email'] = $_SESSION['user_email'];
        
        $data['user_id'] = $_SESSION['user_id'];
        $data['username'] = '';
        $data['password'] = '';
        
        $new_user_data['new_username'] = $_POST['new_username'];
        $new_user_data['new_email'] = $_POST['new_email'];
        $new_user_data['new_password'] = $_POST['new_password'];
        $new_user_data['new_age'] = $_POST['new_age'];
        $new_user_data['new_gender'] = $_POST['new_gender'];
        
        $new_user_data['new_user_type'] = 'patient';
        
        try
        {
            include '../models/Patient.php';
            $obj = new Patient($data);
            
            $edit = $obj->edit_user($new_user_data);
            
            if ($edit)
            {
                
                $_SESSION['admin'] = FALSE;
                
                $_SESSION['success_msg'] = 'You have been edit your profile successfully';
                $_SESSION['username'] = $new_user_data['new_username'];
                
                
                header('location:../../public/site/success-page.php');
            }
        }
        
        catch (Exception $exception)
        {
            $_SESSION['admin'] = FALSE;
            
            $_SESSION['error_msg'] = 'Please try to enter a registered Email';
            
            
            header('location:../../public/site/error-page.php');
            
            // header('location:../../public/site/error-page.php?error_msg=' . urlencode('username or password is invalid , please try again'));
        }
        
    }
    
    
    