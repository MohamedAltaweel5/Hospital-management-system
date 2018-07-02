<?php
    
    
    $user_email = $_SESSION['user_email'];
    
    $conn = mysqli_connect("localhost","root","","hospital");
    
    
    $query = "SELECT * FROM users WHERE email = '$user_email'";
    
    $result = mysqli_query($conn,$query);
    
    
    while ($row = mysqli_fetch_assoc($result))
    {
        
        $_SESSION['user_id'] = $row['id'];
    }
    
    $_SESSION['user_id'] = $row['id'];
    
    $user_id = $row['id'];
    