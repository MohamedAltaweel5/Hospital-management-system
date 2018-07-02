<?php
    
    session_start();
    
    if (!isset($_SESSION['error_msg']))
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
    <title> Error Page </title>

    <link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../css/style_error.css">

    <!--[if lt IE 9]>
    <script src="../bootstrap/js/html5shiv.min.js"></script>
    <script src="../bootstrap/js/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<div class="container">
    <div class="panel panel-danger">
        <div class="panel-heading">
            <h3 class="panel-title">Error Panel</h3>
        </div>
        <div class="panel-body">
            
            <?php
                $error_msg = $_SESSION['error_msg'];
                print $error_msg;
                
                
                if ($_SESSION['admin'])
                {
                    header("refresh:5;URL=admin.php");
                    
                    die();
                }
                else if (@$_SESSION['error_upload'] || @$_SESSION['reserve_error'] )
                {
                    header("refresh:5;URL=../site/home.php");
                }
                
                else
                {
                    session_unset();
                    session_destroy();
                    
                    header("refresh:5;URL=../../index.php");
                    die();
                }
            ?>
        </div>
    </div>

</div>

<script src="../bootstrap/js/jquery-3.2.0.min.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>
</body>
</html>