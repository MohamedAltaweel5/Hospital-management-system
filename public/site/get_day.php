<?php
    
    $q = $_SESSION['day'];
    
    $con = mysqli_connect('localhost','root','','hospital');
    if (!$con)
    {
        die('Could not connect: ' . mysqli_error($con));
    }
    
    $sql = "SELECT doctor_id , doctor_name , specialty FROM doctors_days WHERE $q = 1 ;";
    $result = mysqli_query($con,$sql);
    
    print "<div class=" . '"' . "form-group" . '"' . ">";
    print "<div class=" . '"' . "col-lg-7" . '"' . ">";
    print "<label>";
    print "<select name=" . '"' . "select_doctor" . '"' . "required>";
    print "<option selected disabled hidden>::: Select Doctor :::</option>";
    
    while ($row = mysqli_fetch_array($result))
    {
        
        print "<option value=" . '"' . $row['doctor_id'] . '">' . "Dr." . $row['doctor_name'] . " - " . $row['specialty'] . "</option>";
        
    }
    
    print "</select>";
    print "</label>";
    print "</div>";
    print "</div>";
    
    mysqli_close($con);