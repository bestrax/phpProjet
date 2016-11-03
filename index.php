<html>

<head>
    <title>Bread Express</title>
    <link rel="stylesheet" type="text/css" href="assets/css/master.css">
    <link rel="stylesheet" type="text/css" href="assets/css/index.css">
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
                <div class="step ">Selection</div>
                <div class="step">Validation</div>
            </div>

        </div>

    </nav>

    <div id="container">

        <div class="info">
            <i class="fa fa-clock-o type" aria-hidden="true"></i>
            <div>
                <label for="hour"> When do you want to pick-up ? : </label>
                <select name="hour" id="hour-selector" title="hour">
                    <option value="9h">9PM</option>
                    <option value="9h15">10PM</option>
                    <option value="9h30">11PM</option>
                    <option value="9h45">12PM</option>
                    <option value="9h">1AM</option>
                    <option value="9h15">2AM</option>
                    <option value="9h30">3AM</option>
                    <option value="9h45">4AM</option>
                    <option value="9h15">5AM</option>
                    <option value="9h30">6AM</option>
                    <option value="9h45">7AM</option>
                </select>
                <span class="fa fa-chevron-down select-down" aria-hidden="true"></span>

                <a href="product.php" class="button btn-lg no-link select-product">Select product <i class="fa fa-arrow-right"></i></a>
            </div>
        </div>

        <div class="content">
            <p>On Bake Express you can order and pay online for the products you want. Then you just need to come to our office to pick-up your order.<br/>
            You no more less time in waiting for a product that is not available !</p>
            <div id="map"></div>
        </div>

    </div>


    <footer id="footer">
        <div class="row">
            <p>Bread express is a trademak brand. We want to make your life easier tasty too !</p>
        </div>
    </footer>

    <script src="assets/js/master.js"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBnJ23ZmykJ3XTHmXqQWYiRuKqhV0LyBDI&callback=initMap"></script>

</body>

</html>