<html>

<head>
    <title>Bread Express</title>
    <link rel="stylesheet" type="text/css" href="assets/css/master.css">
    <link rel="stylesheet" type="text/css" href="assets/css/order.css">
    <link rel="stylesheet" href="assets/lib/css/font-awesome.min.css">
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

    <div class="button_where">
      <p>
      <p1> Where ? : </p1>
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
      <p2> When ? : </p1>
       <select>
             <option value="9h">9h</option>
             <option value="9h15">9h15</option>
             <option value="9h30">9h30</option>
             <option value="9h45">9h45</option>
        </select>
     </p2>

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