<html>

<head>
    <title>Bread Express</title>
    <link rel="stylesheet" type="text/css" href="assets/css/master.css">
    <link rel="stylesheet" type="text/css" href="assets/css/login.css">
    <link rel="stylesheet" href="assets/lib/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=ABeeZee" rel="stylesheet">
</head>

<body>

<nav id="navbar">

    <div class="row menu">
        <div class="logo">
            <img src="assets/img/logodemi.svg" />
        </div>

        <div class="user">
            <div><i class="fa fa-user" aria-hidden="true"></i>Sign in</div>
            <div><i class="fa fa-edit" aria-hidden="true"></i>Register</div>
        </div>

        <div class="cart"><i class="fa fa-shopping-cart" aria-hidden="true"></i>Cart</div>
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
            Already have an account ?
        </div>

        <div class="content">
            <form>

                <div class="form-control">
                    <label for="username">Username</label>
                    <input type="text" name="username" />
                </div>

                <div class="form-control">
                    <label for="password">Password</label>
                    <input type="text" name="password" />
                </div>

                <div class="form-submit">
                    <a type="submit" class="button btn-lg">Sign in</a>
                </div>

            </form>
        </div>

    </div>

    <div id="register">

        <div class="head">
            Don't have an account ?
        </div>

        <div class="content">
            <form>

                <div class="form-control">
                    <label for="username">e-mail</label>
                    <input type="text" name="email" />
                </div>

                <div class="form-submit">
                    <a type="submit" class="button btn-lg">Register</a>
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