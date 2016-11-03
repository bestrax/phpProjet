<?php

session_start();

$errorMsg = '';

if( !empty($_POST['first_name']) || !empty($_POST['last_name']) || !empty($_POST['mail'])
    || !empty($_POST['username']) || !empty($_POST['password']) || !empty($_POST['password-confirmation']))

    $validation = true;
else
    $validation = false;

if($validation && !empty($_POST['first_name']) && !empty($_POST['last_name']) && !empty($_POST['mail'])
    && !empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['password-confirmation'])) {

    if($_POST['password'] != $_POST['password-confirmation'])
        $errorMsg = 'Password doesn\'t match !';
    else if(strlen($_POST['password']) < 5)
        $errorMsg = 'Password need to be at least 5 characters';
    else {

        $regex = '/^(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){255,})(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){65,}@)(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22))(?:\.(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-[a-z0-9]+)*\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-[a-z0-9]+)*)|(?:\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\]))$/iD';

        if(!preg_match($regex, $_POST['mail']))
            $errorMsg = 'You need to enter a valid e-mail adress';
        else {
            require_once 'assets/php/bdd.php';

            $req = $bdd->prepare('SELECT COUNT(*) FROM `user` WHERE mail LIKE :mail OR username LIKE :username');

            $req->execute(array(':username' => $_POST['username'],
                ':mail' => $_POST['mail']));

            if($req->fetchColumn() != 0)
                $errorMsg = 'An user already exist with this e-mail adress or this username';
            else {
                $req = $bdd->prepare('INSERT INTO `user` (username, password, mail, first_name, last_name) VALUES (:username, :password, :mail, :first_name, :last_name)');

                $req = $req->execute(array(':username' => $_POST['username'],
                    ':password' => hash('sha256', $_POST['password']),
                    ':mail' => $_POST['mail'],
                    ':first_name' => $_POST['first_name'],
                    ':last_name' => $_POST['last_name']));

                if ($req) {

                    /**
                     * TODO : Faire envoie e-mail
                     */

                    $_SESSION['register_confirmation'] = true;
                    header('Location: register_confirmation.php');
                }
                else
                    $errorMsg = 'An unknow error occured';
            }
        }

    }

}

?>

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
            Registration
        </div>

        <div class="content">
            <form method="post" action="register.php">

                <?php echo !empty($errorMsg)?'<p class="error-message">'.$errorMsg.'</p>':''; ?>

                <div class="form-control">
                    <?php echo $validation && empty($_POST['last_name']) ?'<p class="missing-field">This field is compulsory</p>':''; ?>
                    <label for="last_name">Last name</label><span class="obligatoire">*</span>
                    <input type="text" name="last_name" id="last_name" value="<?php echo !empty($_POST['last_name'])?$_POST['last_name']:'';?>"/>
                </div>

                <div class="form-control">
                    <?php echo $validation && empty($_POST['first_name']) ?'<p class="missing-field">This field is compulsory</p>':''; ?>
                    <label for="first_name">First name</label><span class="obligatoire">*</span>
                    <input type="text" name="first_name" id="first_name" value="<?php echo !empty($_POST['first_name'])?$_POST['first_name']:'';?>"/>
                </div>

                <div class="form-control">
                    <?php echo $validation && empty($_POST['mail']) ?'<p class="missing-field">This field is compulsory</p>':''; ?>
                    <label for="mail">E-mail</label><span class="obligatoire">*</span>
                    <input type="email" name="mail" id="mail" value="<?php echo !empty($_POST['mail'])?$_POST['mail']:'';?>" />
                    <p class="mail-warning">The e-mail address will not be made public and will not be used only for the reception of a new password or for the reception of certain wished notifications.</p>
                </div>

                <div class="form-control">
                    <?php echo $validation && empty($_POST['username']) ?'<p class="missing-field">This field is compulsory</p>':''; ?>
                    <label for="username">User name</label><span class="obligatoire">*</span>
                    <input type="text" name="username" id="username" value="<?php echo !empty($_POST['username'])?$_POST['username']:'';?>"/>
                </div>

                <div class="form-control">
                    <?php echo $validation && empty($_POST['password']) ?'<p class="missing-field">This field is compulsory</p>':''; ?>
                    <label for="password">Password</label><span class="obligatoire">*</span>
                    <input type="password" name="password" id="password" />
                </div>

                 <div class="form-control">
                     <?php echo $validation && empty($_POST['password-confirmation']) ?'<p class="missing-field">This field is compulsory</p>':''; ?>
                    <label for="password-confirmation"> Retry Password</label><span class="obligatoire">*</span>
                    <input type="password" name="password-confirmation" id="password-confirmation" />
                </div>
                <div class="form-submit">
                    <button type="submit" class="button btn-lg">Register <i class="fa fa-arrow-right"></i></button>
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