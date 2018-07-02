<?php
    session_start();
    
    $target_dir = "../../public/images/pp/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    
    // Check if image file is a actual image or fake image
    
    if (isset($_POST["submit"]) && $_POST['submit'] == 'upload')
    {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if ($check !== FALSE)
        {
            $uploadOk = 1;
        }
        else
        {
            $uploadOk = 0;
            
            $_SESSION['admin'] = FALSE;
            
            $_SESSION['error_msg'] = 'File is not an image.';
            $_SESSION['error_upload'] = TRUE;
            
            header('location:../../public/site/error-page.php');
        }
    }
// Check if file already exists
    if (file_exists($target_file))
    {
        
        $uploadOk = 0;
        
        $_SESSION['admin'] = FALSE;
        
        $_SESSION['error_msg'] = "Sorry, file already exists.";
        $_SESSION['error_upload'] = TRUE;
        
        header('location:../../public/site/error-page.php');
    }

// Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000)
    {
        
        $uploadOk = 0;
        
        
        $_SESSION['admin'] = FALSE;
        
        $_SESSION['error_msg'] = "Sorry, your file is too large.";
        $_SESSION['error_upload'] = TRUE;
        
        header('location:../../public/site/error-page.php');
    }


// Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" && $imageFileType != "JPG" && $imageFileType != "PNG"
        && $imageFileType != "JPEG" && $imageFileType != "GIF"
    )
    {
        
        $uploadOk = 0;
        
        $_SESSION['admin'] = FALSE;
        
        $_SESSION['error_msg'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $_SESSION['error_upload'] = TRUE;
        
        header('location:../../public/site/error-page.php');
        
    }
// Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0)
    {
        
        $_SESSION['admin'] = FALSE;
        
        $_SESSION['error_msg'] = "Sorry, your file was not uploaded.";
        $_SESSION['error_upload'] = TRUE;
        
        header('location:../../public/site/error-page.php');
        
    }
    
    // if everything is ok, try to upload file
    else
    {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],$target_file))
        {
            $_SESSION['admin'] = FALSE;
            
            $_SESSION['success_msg'] = "Profile Picture have been changed ";
            $_SESSION['success_upload'] = TRUE;
            
            
            $image_path = "../images/pp/" . basename($_FILES["fileToUpload"]["name"]);
            
            
            include "upload_to_db.php";
            
            
            
            header('location:../../public/site/success-page.php');
            
            
        }
        else
        {
            
            $_SESSION['admin'] = FALSE;
            
            $_SESSION['error_msg'] = "Sorry, there was an error uploading your file.";
            
            header('location:../../public/site/error-page.php');
            
        }
    }
