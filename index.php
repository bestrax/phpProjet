<html>

<head>
    <title>Bread Express</title>
    <link rel="stylesheet" type="text/css" href="assets/css/master.css">
    <link rel="stylesheet" type="text/css" href="assets/css/order.css">
    <link rel="stylesheet" href="assets/lib/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=ABeeZee" rel="stylesheet">
</head>

<body>

    <nav id="navbar">

        <div class="row menu">
            <div class="logo">
                <a href="index.php"><img src="assets/img/logodemi.svg" /></a>
            </div>

            <div class="user">
                <div><a href="login.php" class="no-link"><i class="fa fa-user" aria-hidden="true"></i>Sign in</a></div>
                <div><a href="register.php" class="no-link"><i class="fa fa-edit" aria-hidden="true"></i>Register</a></div>
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

    <div class="button_where">
      <p>
            <span class="title1"> Where ? : </span>
            <select>
              <option value="Vieux Montreal">Vieux Montreal</option>
              <option value="Mont royal">Mont royal</option>
              <option value="Saint Laurent">Saint Laurent</option>
            </select>
        </p>

    </div>

    </div>

    <div id="container2">

    <div class="button_when">
        <p>
            <span class="title1"> Where ? : </span>
            <select>
                 <option value="9h">9h</option>
                 <option value="9h15">9h15</option>
                 <option value="9h30">9h30</option>
                 <option value="9h45">9h45</option>
            </select>
        </p>
    </div>

    </div>

    <div class="product">
    <a class="title">Croissant</a>
    <img src="croissant.jpg" alt="croissant" />
    <a class="description">Croissant saveur de France ...</a>
     <a class="prix">1€</a>


    <div class="add_sup">
        <div class="command">
            <a class="product_minus">-</a>
            <div class="product_number">1</div>
            <a class="product_plus">+</a>
        </div>

        <div >
            <a class="button">Add</a>
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