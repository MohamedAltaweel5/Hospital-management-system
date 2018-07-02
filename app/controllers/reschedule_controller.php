<?php
    
    
    
    
    
    
    
    $reschedule = NULL;
    
    
    // reschedule show doctors
    
    if (isset($_POST['submit']) && $_POST['submit'] == "r_show_doctors")
    {
        $reschedule['r_day'] = $_SESSION['r_day'];
        
        
        $_SESSION['r_show_doctors'] = TRUE;
        $_SESSION['r_day'] = $_POST['r_select_day'];
        
        header('location:../../public/site/home.php');
        
    }
    
    
    
    //reschedule appointment
    
    if (isset($_POST['submit']) && $_POST['submit'] == "reschedule")
    {
        
        
        $conn = mysqli_connect("localhost","root","","hospital");
        $user_email = $_SESSION['user_email'];
        $query = "SELECT * FROM users WHERE email = $user_email";
        
        $result = mysqli_query($conn,$query);
        
        
        while ($row = mysqli_fetch_assoc($result))
        {
            
            $_SESSION['user_id'] = $row['id'];
        }
        
        $reschedule['patient_id'] = $_SESSION['user_id'];
        
        
        $reschedule['r_day'] = $_SESSION['r_day'];
        
        
        $reschedule['doctor_id'] = $_POST['r_select_doctor'];
        
        include '../models/Reschedule.php';
        
        $obj = new Reschedule($reschedule);
        
        if ($obj->get_appointment() == TRUE)
        {
            $_SESSION['success_msg'] = 'You have been reschedule appointment successfully' . $user_email . $reservation['patient_id'];
            
            $_SESSION['show_doctors'] = FALSE;
            $_SESSION['r_show_doctors'] = FALSE;
            
            $_SESSION['reserve_btn'] = FALSE;
            $_SESSION['reschedule_btn'] = FALSE;
            
            header('location:../../public/site/success-page.php');
            
        }
        
        
        else
        {
            $_SESSION['admin'] = FALSE;
            
            $_SESSION['error_msg'] = 'Error : please first reserve an appoinment';
            $_SESSION['reserve_error'] = TRUE;
            
            
            $_SESSION['show_doctors'] = FALSE;
            $_SESSION['r_show_doctors'] = FALSE;
            
            $_SESSION['reserve_btn'] = FALSE;
            $_SESSION['reschedule_btn'] = FALSE;
            
            header('location:../../public/site/error-page.php');
        }
    }

