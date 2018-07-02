<?php
    
    session_start();
    
    
    
    
    // buttons
    
    if (isset($_POST['submit']) && $_POST['submit'] == "reserve_btn")
    {
        
        $_SESSION['reserve_btn'] = TRUE;
        header('location:../../public/site/home.php');
        
    }
    
    
    if (isset($_POST['submit']) && $_POST['submit'] == "reschedule_btn")
    {
        
        $_SESSION['reschedule_btn'] = TRUE;
    
        $_SESSION['show_doctors'] = FALSE;
        $_SESSION['reserve_btn'] = FALSE;
    
        header('location:../../public/site/home.php');
        
    }
    
    
    if (isset($_POST['submit']) && $_POST['submit'] == "reset_btn")
    {
        $_SESSION['show_doctors'] = FALSE;
        $_SESSION['r_show_doctors'] = FALSE;
    
        $_SESSION['reserve_btn'] = FALSE;
        $_SESSION['reschedule_btn'] = FALSE;
        
        header('location:../../public/site/home.php');
        
    }
    
    
    
    
    
    
    $reservation = NULL;
    
    
    
    
    // show doctors
    
    if (isset($_POST['submit']) && $_POST['submit'] == "show_doctors")
    {
        $reservation['day'] = $_SESSION['day'];
        
        
        $_SESSION['show_doctors'] = TRUE;
        $_SESSION['day'] = $_POST['select_day'];
        header('location:../../public/site/home.php');
        
    }
    
    
    //reserve appointment
    
    if (isset($_POST['submit']) && $_POST['submit'] == "reserve")
    {
        
        
        $conn = mysqli_connect("localhost","root","","hospital");
        $user_email = $_SESSION['user_email'];
        $query = "SELECT * FROM users WHERE email = $user_email";
        
        $result = mysqli_query($conn,$query);
        
        
        while ($row = mysqli_fetch_assoc($result))
        {
            
            $_SESSION['user_id'] = $row['id'];
        }
        
        $reservation['patient_id'] = $_SESSION['user_id'];
        
        
        $reservation['day'] = $_SESSION['day'];
        
        
        $reservation['doctor_id'] = $_POST['select_doctor'];
        
        include '../models/Reservation.php';
        
        $obj = new Reservation($reservation);
        
        if ($obj->get_appointment() != TRUE)
        {
            $_SESSION['success_msg'] = 'You have been reserve appointment successfully' /*. $user_email . $reservation['patient_id'] */ ;
            
            $_SESSION['show_doctors'] = FALSE;
            
            $_SESSION['reserve_btn'] = FALSE;
            $_SESSION['reschedule_btn'] = FALSE;
            
            header('location:../../public/site/success-page.php');
            
        }
        
        
        else
        {
            $_SESSION['admin'] = FALSE;
            
            $_SESSION['error_msg'] = 'Error : you already have a reserved appoinment' /*. $user_email . $reservation['patient_id'] */ ;
            $_SESSION['reserve_error'] = TRUE;
    
    
            $_SESSION['show_doctors'] = FALSE;
    
            $_SESSION['reserve_btn'] = FALSE;
            $_SESSION['reschedule_btn'] = FALSE;
            
            header('location:../../public/site/error-page.php');
        }
    }
    
    