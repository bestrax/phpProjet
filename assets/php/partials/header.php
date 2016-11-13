<?php

    function pageHeader($name, $css, $active)
    {

        $admin = false;

        if(isset($_SESSION['user_id'])) {

            require dirname(dirname(__FILE__)).'/config/bdd.php';

            $req = $bdd->prepare('SELECT `id` FROM `user` WHERE id = :id AND level >= 2');

            $req->execute(array(':id' => $_SESSION['user_id']));

            if($result = $req->fetch()) {
                $admin = true;
            }
        }

        $path = '';

        if(preg_match('/.*admin.*/iD', $_SERVER['REQUEST_URI']))
            $path = '../';

        ?>
        <html>

        <head>
            <title>Bread Express <?php echo !empty($name)?' - '.$name:''; ?></title>
            <link rel="stylesheet" type="text/css" href="assets/css/master.css">

            <?php
                foreach($css as $c)
                    echo '<link rel="stylesheet" type="text/css" href="assets/css/'.$c.'.css">';
            ?>

            <link rel="stylesheet" href="assets/lib/css/font-awesome.min.css">
            <link href="https://fonts.googleapis.com/css?family=ABeeZee" rel="stylesheet">
        </head>

        <body>

        <nav id="navbar">

            <div class="row menu">
                <div class="logo">
                    <a href="<?php echo $path; ?>index.php"><img src="assets/img/logodemi.jpg"/></a>
                </div>

                <div class="user">

                    <div class="hidden-sm">
                        <a href="<?php echo $path; ?>index.php" class="no-link"><i class="fa fa-home" aria-hidden="true"></i>Home</a>
                    </div>

                    <?php if(!isset($_SESSION['user_id'])) {
                        ?>

                        <div>
                            <a href="<?php echo $path; ?>login.php" class="no-link"><i class="fa fa-user" aria-hidden="true"></i>Sign in</a>
                        </div>
                        <div>
                            <a href="<?php echo $path; ?>register.php" class="no-link"><i class="fa fa-edit" aria-hidden="true"></i>Register</a>
                        </div>

                        <?php
                    } else {
                        ?>

                        <div>
                            <a href="<?php echo $path; ?>profile.php" class="no-link"><i class="fa fa-user" aria-hidden="true"></i>Account</a>
                        </div>

                        <?php echo $admin?'<div><a href="'.$path.'admin/" class="no-link"><i class="fa fa-lock" aria-hidden="true"></i>Admin</a></div>':'' ?>

                        <div>
                            <a href="<?php echo $path; ?>logout.php" class="no-link"><i class="fa fa-sign-out" aria-hidden="true"></i>Log out</a>
                        </div>

                        <?php
                    } ?>

                </div>
            </div>

            <div class="row" id="order-process">

                <div class="process">
                    <div class="step <?php echo $active == 1?'active':''; ?>">Where and When ?</div>
                    <div class="step <?php echo $active == 2?'active':''; ?>">Selection</div>
                    <div class="step <?php echo $active == 3?'active':''; ?>">Validation</div>
                </div>

            </div>

        </nav>

        <?php
    }
?>

