<?php

session_start();

$errorMsg = '';

if(!empty($_SESSION['user_id']))
    header('Location: index.php');

if(!empty($_POST['username']) && !empty($_POST['password'])) {

    require_once 'assets/php/config/bdd.php';

    $req = $bdd->prepare('SELECT `id`, `password` FROM `user` WHERE username LIKE :username');

    $req->execute(array(':username' => htmlentities($_POST['username'])));

    $result = $req->fetch();

    if(!empty($result['password']) && hash_equals($result['password'], crypt($_POST['password'], $result['password']))) {
        $_SESSION['user_id'] = $result['id'];

        //If the user was confirming its order
        if(isset($_GET['cart']))
            header('Location: cart.php');
        else
            header('Location: index.php');
    }
    else
        $errorMsg = 'User or Passowrd is incorrect !';

}

?>


<?php
    include 'assets/php/partials/header.php';
    pageHeader('', ['login'], 1);
?>


<div id="container">

    <div id="login">

        <div class="head">
            Already have an account ?
        </div>

        <div class="content">
            <form method="post" action="login.php<?php echo isset($_GET['cart']) ? '?cart=true' : ''; ?>">

                <?php echo !empty($errorMsg)?'<p class="error-message">'.$errorMsg.'</p>':''; ?>

                <div class="form-control">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username"/>
                </div>

                <div class="form-control">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" />
                </div>

                <div class="form-submit">
                    <button type="submit" class="button btn-lg">Sign in <i class="fa fa-arrow-right"></i></button>
                </div>

            </form>
        </div>

    </div>

    <div id="register">

        <div class="head">
            Don't have an account ?
        </div>

        <div class="content">
            <form method="post" action="register.php">

                <div class="form-control">
                    <label for="email">e-mail</label>
                    <input type="hidden" name="from_login" value="1" />
                    <input type="text" name="mail" id="mail" title="mail" />
                </div>

                <div class="form-submit">
                    <button type="submit" class="button btn-lg">Register <i class="fa fa-arrow-right"></i></button>
                </div>

            </form>
        </div>

    </div>

</div>

<?php
    include 'assets/php/partials/footer.php';
?>