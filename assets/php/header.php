<?php
    function pageHeader($name, $css, $active)
    {
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
                    <a href="index.php"><img src="assets/img/logodemi.jpg"/></a>
                </div>

                <div class="user">

                    <?php if(!isset($_SESSION['user_id'])) {
                        ?>

                        <div>
                            <a href="login.php" class="no-link"><i class="fa fa-user" aria-hidden="true"></i>Sign in</a>
                        </div>
                        <div>
                            <a href="register.php" class="no-link"><i class="fa fa-edit" aria-hidden="true"></i>Register</a>
                        </div>

                        <?php
                    } else {
                        ?>

                        <div>
                            <a href="resume.php" class="no-link"><i class="fa fa-user" aria-hidden="true"></i>Account</a>
                        </div>
                        <div>
                            <a href="logout.php" class="no-link"><i class="fa fa-sign-out" aria-hidden="true"></i>Log out</a>
                        </div>

                        <?php
                    } ?>

                </div>

                <div class="cart"><a href="cart.php" class="no-link"><i class="fa fa-shopping-cart"
                                                                        aria-hidden="true"></i>Cart</a></div>
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

