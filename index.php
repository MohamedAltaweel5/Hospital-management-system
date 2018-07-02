<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="public/images/favicon.png">
    <title> Hospital </title>

    <link rel="stylesheet" href="public/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="public/css/style_index.css">

    <!--[if lt IE 9]>
    <script src="public/bootstrap/js/html5shiv.min.js"></script>
    <script src="public/bootstrap/js/respond.min.js"></script>
    <![endif]-->
</head>
<body background="public/images/hospital3.jpg">


<nav class="navbar navbar-default">
    <div class="container">
        <div class="row">
            <ul class="nav navbar-nav col-sm-12">
                <li class=" col-sm-4"><a href="">Hospital</a></li>
                <!-- <li class=" col-sm-2"><a href="">About</a></li>
                <li class=" col-sm-2"><a href="">Contact Us</a></li>
                <li class=" col-sm-2"><a href="">Feedback</a></li> -->
            </ul>
        </div>
    </div>
</nav>


<div class="container">
    <div class="row col-sm-offset-1 col-sm-5">

        <form action="app/controllers/login_controller.php" method="post"
              class="form-horizontal login">
            <h2>Login</h2>
            <div class="form-group ">
                <div class="col-sm-7">
                    <input type="email" name="email" class="form-control"
                           placeholder="Email">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-7">
                    <input type="password" name="password" class="form-control"
                           placeholder="Password" required>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-0 col-sm-12">
                    <button type="submit" name="submit" value="login" class="btn btn-success">
                        Login
                    </button>
                </div>
            </div>
        </form>

    </div>

    <div class="row col-lg-offset-1 col-lg-5">

        <form action="app/controllers/register_controller.php" method="post"
              class="form-horizontal register">
            <h2>Register</h2>

            <div class="form-group">
                <div class="col-lg-7">
                    <input type="text" name="username" class="form-control" placeholder="Username"
                           minlength="4" maxlength="16" required>
                </div>
            </div>

            <div class="form-group">
                <div class="col-lg-7">
                    <input type="email" name="email" class="form-control" placeholder="Email"
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
                <div class="col-sm-offset-0 col-sm-12">
                    <button type="submit" name="submit" value="register" class="btn btn-primary">
                        Register
                    </button>
                </div>
            </div>
        </form>
    </div>

</div>


<script src="public/bootstrap/js/jquery-3.2.0.min.js"></script>
<script src="public/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>