<?php
    
    session_start();
    
    
    //add new user
    
    if (isset($_POST['submit']) && $_POST['submit'] == "add_new_user")
    {
        $register_data['username'] = $_POST['username'];
        $register_data['email'] = $_POST['email'];
        $register_data['password'] = $_POST['password'];
        $register_data['user_type'] = $_POST['user_type'];
        
        try
        {
            include '../models/Register.php';
            $register = new Register($register_data);
            
            if ($register)
            {
                $_SESSION['success_msg'] = 'You have been added a new registered user successfully';
                $_SESSION['username'] = $register_data['username'];
                
                $_SESSION['admin'] = TRUE;
                
                header('location:../../public/site/success-page.php');
            }
        }
        
        catch (Exception $exception)
        {
            $_SESSION['error_msg'] = 'Please try to register with other Email';
            $_SESSION['admin'] = TRUE;
            
            header('location:../../public/site/error-page.php');
            
            //header('location:../../public/site/error-page.php?error_msg=' . urlencode('username or password is invalid , please try again'));
            
        }
    }
    
    
    
    // edit user
    
    if (isset($_POST['submit']) && $_POST['submit'] == "edit_user")
    {
        $data['email'] = $_POST['email'];
        
        $data['username'] = '';
        $data['password'] = '';
        
        $new_user_data['new_username'] = $_POST['new_username'];
        $new_user_data['new_email'] = $_POST['new_email'];
        $new_user_data['new_password'] = $_POST['new_password'];
        $new_user_data['new_user_type'] = $_POST['new_user_type'];
        
        try
        {
            include '../models/Admin.php';
            $admin_obj = new Admin($data);
            
            $edit = $admin_obj->edit_user($new_user_data);
            
            if ($edit)
            {
                $_SESSION['success_msg'] = 'You have been edit this user successfully';
                $_SESSION['username'] = $new_user_data['new_username'];
                
                $_SESSION['admin'] = TRUE;
                
                header('location:../../public/site/success-page.php');
            }
        }
        
        catch (Exception $exception)
        {
            $_SESSION['error_msg'] = 'Please try to enter a registered Email';
            $_SESSION['admin'] = TRUE;
            
            header('location:../../public/site/error-page.php');
            
            // header('location:../../public/site/error-page.php?error_msg=' . urlencode('username or password is invalid , please try again'));
        }
        
    }
    
    
    
    // delete user
    
    if (isset($_POST['submit']) && $_POST['submit'] == "delete")
    {
        $data['email'] = $_POST['email'];
        
        $data['username'] = '';
        $data['password'] = '';
        
        
        try
        {
            include '../models/Admin.php';
            $admin_obj = new Admin($data);
            
            $delete = $admin_obj->delete_user();
            
            if ($delete)
            {
                $_SESSION['success_msg'] = 'User Deleted Successfully';
                $_SESSION['admin'] = TRUE;
                header('location:../../public/site/success-page.php');
                
            }
        }
        
        catch (Exception $exception)
        {
            $_SESSION['error_msg'] = 'Please try to enter a registered Email';
            $_SESSION['admin'] = TRUE;
            
            header('location:../../public/site/error-page.php');
            
            //header('location:../../public/site/error-page.php?error_msg=' . urlencode('username or password is invalid , please try again'));
            
        }
        
    }
    
    
    if (is_file('../../public/site/get_email.php'))
    {
        include '../../app/models/Admin.php';
        $admin_obj = new Admin();
        
        $GLOBALS = $admin_obj->search_user();
        
    }
    
    
    
    
    

    
    
    