<?php
    
    $user_id = $_SESSION['user_id'];
    
    $conn = mysqli_connect("localhost","root","","hospital");
    
    
    $query = "UPDATE patients set image = '$image_path' WHERE user_id = '$user_id'";
    
    $result = mysqli_query($conn,$query);
    
    
    mysqli_free_result($result);
    
    mysqli_close($conn);
    
    