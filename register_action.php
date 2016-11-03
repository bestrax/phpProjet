<?php

    if( empty($_POST['fname']) || empty($_POST['lname']) || empty($_POST['email'])
        || empty($_POST['username']) || empty($_POST['password']) || empty($_POST['password-confirmation']))

        return header('Location: register.php?error=true');

    require_once 'assets/php/bdd.php';

    $req = $bdd->prepare('INSERT INTO `user` (username, password, mail, first_name, last_name) VALUES (:username, :password, :mail, :first_name, :last_name)');

    $req->execute(array(':username' => $_POST['username'],
        ':password' => $_POST['password'],
        ':mail' => $_POST['mail'],
        ':first_name' => $_POST['first_name'],
        ':last_name' => $_POST['last_name']));



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
            <p>Your registration is done, please verify your e-mail adress in order to validate your account.</p>
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