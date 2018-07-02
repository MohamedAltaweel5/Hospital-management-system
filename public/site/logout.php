<?php
    session_start();
    
    if (!isset($_SESSION['username']))
    {
        header('location:../../index.php');
        die;
    }
    else
    {
        session_unset();
        session_destroy();
        
        header('location:../../index.php');
        die();
        
    }
    
    
    