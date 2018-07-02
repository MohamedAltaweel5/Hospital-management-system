<?php
    
    session_start();
    
    if (!isset($_SESSION['success_msg']))
    {
        session_unset();
        session_destroy();
        
        header('location:../../index.php');
        die;
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="../images/favicon.png">
    <title> Success Page </title>

    <link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../css/style_success.css">

    <!--[if lt IE 9]>
    <script src="../bootstrap/js/html5shiv.min.js"></script>
    <script src="../bootstrap/js/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<div class="container">
    <div class="panel panel-success">
        <div class="panel-heading">
            <h3 class="panel-title">Success Panel</h3>
        </div>
        <div class="panel-body">
            
            <?php
                $success_msg = $_SESSION['success_msg'];
                print $success_msg . "<br>";
                
                
                
                
                if ($_SESSION['admin'] == TRUE)
                {
                    header("refresh:5;URL=../site/admin.php");
                    
                }
                else
                {
                    
                    header("refresh:5;URL=../site/home.php");
                }
            
            ?>
        </div>
    </div>

</div>

<script src="../bootstrap/js/jquery-3.2.0.min.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>
</body>
</html>