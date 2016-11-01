<html>

<head>
    <title>Bread Express</title>
    <link rel="stylesheet" type="text/css" href="assets/css/master.css">
    <link rel="stylesheet" type="text/css" href="assets/css/cart.css">
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
            <div class="step">Where and When ?</div>
            <div class="step">Selection</div>
            <div class="step active">Validation</div>
        </div>

    </div>

</nav>

<div id="container">

    <div id="cart">

        <div class="info">
            <i class="fa fa-info-circle type" aria-hidden="true"></i>
            <p>Your cart is ready to be validate. Please verify the items that are inside your cart, when you want to pick-up.
                When you're ready click on validate to be redirected to pay. </p>
        </div>

        <div class="previous">
            <a href="product.php" class="button btn-lg no-link"><i class="fa fa-arrow-left"></i> Go back</a>
        </div>

        <table class="summary">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Bread</td>
                    <td>
                        <i class="fa fa-minus" aria-hidden="true"></i>
                        <span class="quantity">4</span>
                        <i class="fa fa-plus" aria-hidden="true"></i>
                    </td>
                    <td>$2.40</td>
                    <td><i class="fa fa-times color-red" aria-hidden="true"></i></td>
                </tr>
                <tr>
                    <td>Croissant</td>
                    <td>
                        <i class="fa fa-minus" aria-hidden="true"></i>
                        <span class="quantity">4</span>
                        <i class="fa fa-plus" aria-hidden="true"></i>
                    </td>
                    <td>$0.60</td>
                    <td><i class="fa fa-times color-red" aria-hidden="true"></i></td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td></td>
                    <td></td>
                    <td>Total $3.00</td>
                    <td></td>
                </tr>
            </tfoot>
        </table>

        <div class="validate">
            <a type="submit" class="button btn-lg">Validate</a>
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