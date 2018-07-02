<?php
    
    $user_id = $_SESSION['user_id'];
    
    $image = NULL;
    
    
    $conn = mysqli_connect("localhost","root","","hospital");
    
    
    $query = "SELECT * FROM patients WHERE user_id = '$user_id' ";
    
    $result = mysqli_query($conn,$query);
    
    
    while ($row = mysqli_fetch_assoc($result))
    {
        
        $image = $row['image'];
    }
    
    
    
    
    mysqli_close($conn);
    
    
    