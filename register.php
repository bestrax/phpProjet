<html>

<head>
    <title>Bread Express</title>
     <link rel="stylesheet" type="text/css" href="assets/css/register.css">
    <link rel="stylesheet" type="text/css" href="assets/css/master.css">
    <link rel="stylesheet" type="text/css" href="assets/css/login.css">
    <link rel="stylesheet" href="assets/lib/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=ABeeZee" rel="stylesheet">
</head>

<body>

<nav id="navbar">

    <div class="row menu">
        <div class="logo">
            <a href="index.php"><img src="assets/img/logodemi.jpg" /></a>
        </div>

        <div class="user">
            <div><a href="login.php" class="no-link"><i class="fa fa-user" aria-hidden="true"></i>Sign in</a></div>
            <div><a href="register.php" class="no-link"><i class="fa fa-edit" aria-hidden="true"></i>Register</a></div>
        </div>

        <div class="cart"><a href="cart.php" class="no-link"><i class="fa fa-shopping-cart" aria-hidden="true"></i>Cart</a></div>
    </div>

    <div class="row" id="order-process">

        <div class="process">
            <div class="step active">Where and When ?</div>
            <div class="step">Selection</div>
            <div class="step">Validation</div>
        </div>

    </div>

</nav>

<div id="container">

    <div id="login">

        <div class="head">
            INSCRIPTION 
        </div>

        <div class="content">
            <form>

                <div class="form-control">
                    <label for="lname">Last name</label><span class="obligatoire">*</span>
                     <input type="text" name="lname" id="lname"/>
                </div>

                <div class="form-control">
                    <label for="fname">First name</label><span class="obligatoire">*</span>
                    <input type="text" name="fname" id="fname" />
                </div>

                <div class="form-control">
                    <label for="email">E-mail</label><span class="obligatoire">*</span>
                    <input type="text" name="email" id="email" />
                    <p>The e-mail address will not be made public and will not be used only for the reception of a new password or for the reception of certain wished notifications.P</p>
            
                </div>

                <div class="form-control">
                    <label for="id">User name</label><span class="obligatoire">*</span>
                    <input type="text" name="id" id="id" />
                </div>

                <div class="form-control">
                    <label for="password">Password</label><span class="obligatoire">*</span>
                    <input type="text" name="password" id="password" />
                </div>

                 <div class="form-control">
                    <label for="password"> Retry Password</label><span class="obligatoire">*</span>
                    <input type="text" name="password" id="password" />
                </div>
                <div class="form-submit">
                    <a type="submit" class="button btn-lg">Register <i class="fa fa-arrow-right"></i></a>
                </div>

            </form>
        </div>

    </div>

   
</div>

<footer id="footer">
    <div class="row">
        <p>Bread express is a trademak brand. We want to make your life easier tasty too !</p>
    </div>
</footer>

</body>

</html>