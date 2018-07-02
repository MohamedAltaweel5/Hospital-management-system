<?php
    
    // AJAX in admin search by email
    
    $data[] = 'admin@hospital.com';;
    
    $conn = mysqli_connect("localhost","root","","hospital");
    
    
    $query = "SELECT * FROM users ";
    
    $result = mysqli_query($conn,$query);
    
    $row = mysqli_fetch_assoc($result);
    
    while ($row = mysqli_fetch_assoc($result))
    {
        
        $data[] = $row['email'];
    }
    
    
    mysqli_free_result($result);
    
    mysqli_close($conn);
    
    
    
    
    // get the q parameter from URL
    $q = $_REQUEST["q"];
    
    $hint = "";
    
    // lookup all hints from array if $q is different from ""
    if ($q !== "")
    {
        $q = strtolower($q);
        $len = strlen($q);
        foreach ($data as $email)
        {
            if (stristr($q,substr($email,0,$len)))
            {
                if ($hint === "")
                {
                    $hint = $email;
                }
                else
                {
                    $hint .= "<br> $email";
                }
            }
        }
    }
    
    // Output "no suggestion" if no hint was found or output correct values
    echo $hint === "" ? "No Users" : $hint;

