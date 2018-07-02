<?php
    session_start();
    if (!isset($_SESSION['username']) && $_SESSION['username'] != 'admin')
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
    <title> Admin Page </title>

    <link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../css/style_admin.css">

    <!--[if lt IE 9]>
    <script src="../bootstrap/js/html5shiv.min.js"></script>
    <script src="../bootstrap/js/respond.min.js"></script>
    <![endif]-->
</head>
<body background="../../public/images/hospital4.jpg">

<div class="container">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Admin Panel</h3>
        </div>
        <div class="panel-body">

            <div class="container">

                <div class=" row ">
                    <div class="col-lg-5 userwelcome">
                        <?php
                            $user = 'Admin';
                            print "<h3>Welcome $user <a href='logout.php' > Logout </a></h3>";
                        ?>
                    </div>

                </div>


                <!--Add New User -->
                <div class="row col-lg-offset-1 col-lg-5">

                    <form action="../../app/controllers/admin_controller.php" method="post"
                          class="form-horizontal ">
                        <h2>Add New User</h2>

                        <div class="form-group">
                            <div class="col-lg-7">
                                <input type="text" name="username" class="form-control"
                                       placeholder="Username"
                                       minlength="4" maxlength="16" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-7">
                                <input type="email" name="email" class="form-control"
                                       placeholder="Email"
                                       required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-7">
                                <input type="password" name="password" class="form-control"
                                       placeholder="Password" minlength="4" maxlength="16" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-7">
                                <label>
                                    <select name="user_type" required>
                                        <option selected disabled hidden>::: User Role :::</option>
                                        <option value="employee">Employee</option>
                                        <option value="nurse">Nurse</option>
                                        <option value="patient">Patient</option>
                                    </select>
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-0 col-sm-12">
                                <button type="submit" name="submit" value="add_new_user"
                                        class="btn btn-primary">
                                    Add User
                                </button>
                            </div>
                        </div>
                    </form>
                </div>


                <!--Edit User Data -->
                <div class="row col-lg-offset-1 col-lg-5">

                    <form action="../../app/controllers/admin_controller.php" method="post"
                          class="form-horizontal ">
                        <h2>Edit User Data</h2>
                        <div class="form-group">
                            <div class="col-lg-7">
                                <input type="email" name="email" class="form-control"
                                       placeholder="User Email"
                                       required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-7">
                                <input type="text" name="new_username" class="form-control"
                                       placeholder="New Username"
                                       minlength="4" maxlength="16" required>
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
                            <div class="col-lg-7">
                                <label>
                                    <select name="new_user_type" required>
                                        <option selected disabled hidden>::: User Role :::</option>
                                        <option value="employee">Employee</option>
                                        <option value="nurse">Nurse</option>
                                        <option value="patient">Patient</option>
                                    </select>
                                </label>
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



                <!--Search for username using AJAX -->
                <div class="row col-lg-12 text-center">

                    <br><br><br>

                    <h2 class="ajax-search">search for user</h2>
                    <form>
                        <h4>:: please enter user Name ::</h4>
                        <input type="text" onkeyup="show_email(this.value)">
                    </form>
                    <br>
                    <p><span id="txtHint"></span></p>

                    <br>
                </div>



                <!-- Delete -->
                <div class="row  col-lg-12">
                    <form action="../../app/controllers/admin_controller.php" method="post"
                          class="form-horizontal ">

                        <div class="form-group">
                            <div class="col-lg-offset-3 col-lg-6">
                                <h2 class="delete">Delete User</h2>
                                <h4 class="delete">:: please enter user email ::</h4>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-offset-5 col-lg-6">
                                <button type="submit" name="submit" value="delete"
                                        class="btn btn-danger delete-btn">
                                    Delete
                                </button>
                            </div>
                            <br><br>
                        </div>
                    </form>
                </div>



            </div>
        </div>
    </div>
</div>
<script src="../js/script.js"></script>
<script src="../bootstrap/js/jquery-3.2.0.min.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>
</body>
</html>