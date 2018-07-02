<?php
    session_start();
    if (!isset($_SESSION['username']))
    {
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
    <title> Home Page </title>

    <link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../css/style_home.css">

    <!--[if lt IE 9]>
    <script src="../bootstrap/js/html5shiv.min.js"></script>
        <script src="../bootstrap/js/respond.min.js"></script>
    <![endif]-->


</head>
<body background="../../public/images/hospital4.jpg">
<div class="container">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Home Panel</h3>
        </div>
        <div class="panel-body">

            <div class="container">

                <div class=" row ">
                    <div class="col-lg-5 userwelcome">
                        <?php
                            $user = $_SESSION['username'];
                            
                            print "<h3>Welcome $user <a href='logout.php' > Logout </a></h3>";
                            
                        ?>
                    </div>
                    <div class="col-lg-7 userwelcome">
                        <?php
                            $image = " ";
                            
                            include "../../app/controllers/get_user_image.php";
                            
                            function check($image)
                            {
                                if ($image == NULL or $image == "" or $image == " ")
                                {
                                    $image = "../images/pp/pp.png";
                                    print $image;
                                }
                                elseif (!is_file($image))
                                {
                                    $image = "../images/pp/pp.png";
                                    print $image;
                                }
                                else
                                {
                                    print $image;
                                }
                            }
                        
                        ?>
                        <img src="<?php check($image); ?>" class="img-rounded" alt="user image">

                    </div>
                </div>

            </div>



            <!--Edit User Data -->
            <div class="row col-lg-offset-1 col-lg-5">

                <form action="../../app/controllers/patient_controller.php" method="post"
                      class="form-horizontal ">
                    <h2>Edit Your Data</h2>

                    <div class="form-group">
                        <div class="col-lg-7">
                            <input type="text" name="new_username" class="form-control"
                                   placeholder="New Username"
                                   minlength="4" maxlength="16" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-7">
                            <input type="number" name="new_age" class="form-control"
                                   placeholder="New Age"
                                   min="1" max="99  " required>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-7">
                            <label>
                                <select name="new_gender" required>
                                    <option selected disabled hidden>----- Select Gender -----</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-7">
                            <input type="email" name="new_email" class="form-control"
                                   placeholder="New Email"
                                   required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-7">
                            <input type="password" name="new_password" class="form-control"
                                   placeholder="New Password" minlength="4" maxlength="16"
                                   required>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-0 col-sm-12">
                            <button type="submit" name="submit" value="edit_user"
                                    class="btn btn-primary">
                                Edit User
                            </button>
                        </div>
                    </div>
                </form>
            </div>



            <!-- upload profile picture -->
            <div class="row col-lg-offset-1 col-lg-5 file-pp">

                <form action="../../app/controllers/upload.php" method="post"
                      enctype="multipart/form-data">

                    <div class="form-group">
                        <label>Change Profile Picture</label>
                        <input type="file" name="fileToUpload" id="fileToUpload" required>
                    </div>

                    <button type="submit" name="pp" value="upload" class="btn btn-primary">Submit</button>
                </form>

            </div>

            <div class="row col-lg-offset-1">

            </div>

            
            <!-- buttons -->
                                        
            <br>
            <div class="row col-lg-offset-4 col-lg-6">
                <form class="reserve" action="../../app/controllers/reservation_controller.php"
                      method="post">

                    <button name="submit" value="reserve_btn" class="btn btn-success">
                        <b>Resserve Appointment<b>
                    </button>
                </form>

                <!-- <form class="reschdule" action="../../app/controllers/reservation_controller.php"
                      method="post">
                    <button name="submit" value="reschedule_btn" class="btn btn-warning">
                        <b>Reschedule Appointment</b>

                    </button>
                </form> -->

                <br><br>
                <form class="row col-lg-offset-3 col-lg-6 reset"
                      action="../../app/controllers/reservation_controller.php" method="post">
                    <button name="submit" value="reset_btn" class="btn  btn-danger">
                        <b>Reset</b>

                    </button>
                </form>

            </div>




            <!-- reserve appointment -->
            
            <?php
                
                if (@$_SESSION['reserve_btn'] == TRUE)
                {
                    
                    if (@$_SESSION['show_doctors'] == TRUE)
                    {
                        
                        
                        print "   <div class=\"row col-lg-offset-1 col-lg-11\">
                <form action=\"../../app/controllers/reservation_controller.php\" method=\"post\" class=\"form-horizontal \">";
                        
                        include "get_day.php";
                        
                        
                        print "<div class=\"form-group\">
                       <div class=\"col-sm-offset-0 col-sm-12\">
                            <button type=\"submit\" name=\"submit\" value=\"reserve\"
                                    class=\"btn btn-primary\">
                                Reserve
                            </button>
                        </div>
                    </div>";
                    
                    }
                    
                    
                    //else load show doctors
                    
                    else
                    {
                        print "
                        <div class=\"row col-lg-offset-1 col-lg-11\">
                <form action=\"../../app/controllers/reservation_controller.php\" method=\"post\" class=\"form-horizontal \">
                    <h2>Reserve Appointment</h2>
                    <div class=\"form-group\">
                        <div class=\"col-lg-7\">
                            <label>
                                <select name=\"select_day\" required>
                                    <option selected disabled hidden>::: Select Day :::</option>
                                    <option value=\"saturday\">Saturday</option>
                                    <option value=\"sunday\">Sunday</option>
                                    <option value=\"monday\">Monday</option>
                                    <option value=\"tuesday\">Tuesday</option>
                                    <option value=\"wednesday\">Wednesday</option>
                                    <option value=\"thursday\">Thursday</option>
                                    <option value=\"friday\">Friday</option>
                                </select>
                            </label>
                        </div>
                    </div>
                    <div class=\"form-group\">
                        <div class=\"col-sm-offset-0 col-sm-12\">
                            <button type=\"submit\" name=\"submit\" value=\"show_doctors\"
                                    class=\"btn btn-primary\">
                                Show Doctors
                            </button>
                        </div>
                    </div>
                    
                   
                </form>
            </div>
";
                        @$_SESSION['day'] = $_POST['select_day'];
                        
                    }
                }
                
                // reschedule

                elseif (@$_SESSION['reschedule_btn'] == TRUE)
                {
                    
                    
                    if (@$_SESSION['r_show_doctors'] == TRUE)
                    {
                        
                        
                        print "   <div class=\"row col-lg-offset-1 col-lg-11\">
                <form action=\"../../app/controllers/reschedule_controller.php\" method=\"post\" class=\"form-horizontal \">";
                        
                        include "get_r_day.php";
                        
                        
                        print "<div class=\"form-group\">
                       <div class=\"col-sm-offset-0 col-sm-12\">
                            <button type=\"submit\" name=\"submit\" value=\"reschedule\"
                                    class=\"btn btn-primary\">
                                Reschedule
                            </button>
                        </div>
                    </div>";
                    
                    }
                    
                    else
                    {
                        print "
                        <div class=\"row col-lg-offset-1 col-lg-11\">
                <form action=\"../../app/controllers/reschedule_controller.php\" method=\"post\" class=\"form-horizontal \">
                    <h2>Reschedule Appointment</h2>
                    <div class=\"form-group\">
                        <div class=\"col-lg-7\">
                            <label>
                                <select name=\"r_select_day\" required>
                                    <option selected disabled hidden>::: Select Day :::</option>
                                    <option value=\"saturday\">Saturday</option>
                                    <option value=\"sunday\">Sunday</option>
                                    <option value=\"monday\">Monday</option>
                                    <option value=\"tuesday\">Tuesday</option>
                                    <option value=\"wednesday\">Wednesday</option>
                                    <option value=\"thursday\">Thursday</option>
                                    <option value=\"friday\">Friday</option>
                                </select>
                            </label>
                        </div>
                    </div>
                    <div class=\"form-group\">
                        <div class=\"col-sm-offset-0 col-sm-12\">
                            <button type=\"submit\" name=\"submit\" value=\"r_show_doctors\"
                                    class=\"btn btn-primary\">
                                Show Doctors
                            </button>
                        </div>
                    </div>
                    
                   
                </form>
            </div>
";
                            @$_SESSION['r_day'] = $_POST['r_select_day'];
                            @$_SESSION['r_show_doctors'] = TRUE;
                        
                        
                    }
                }
            
            ?>


            <div class="row col - lg - offset - 1 col - lg - 5">

            </div>

            <br><br><br><br>
            <div class="row col-lg-offset-5 col-lg-5">
                <form class="reschdule" action="../PDF/print_invoive.php"
                      method="post">
                    <button name="submit" value="reschedule_btn" formtarget="_blank" class="btn btn-info">
                        <b> Print Invoice <b>

                    </button>
                </form>

            </div>

        </div>
    </div>
</div>
<script src=" ../js/script.js"></script>
<script src=" ../bootstrap/js/jquery-3.2.0.min.js"></script>
<script src=" ../bootstrap/js/bootstrap.min.js"></script>
</body>
</html>