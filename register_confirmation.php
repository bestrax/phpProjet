<?php
    session_start();

    if(!isset($_SESSION['register_confirmation']) || $_SESSION['register_confirmation'] != true)
        header('Location: login.php');

    $_SESSION['register_confirmation'] = false;

?>

<?php
    include 'assets/php/partials/header.php';
    pageHeader('', ['register', 'login'], 0);
?>

<div id="container">

    <div id="login">

        <div class="head">
            Registration
        </div>

        <div class="content">
            <p>Your registration is done, we sent you an e-mail.</p>
        </div>

    </div>


</div>

<?php
    include 'assets/php/partials/footer.php';
?>