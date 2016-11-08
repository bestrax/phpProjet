<?php
    session_start();

    require_once 'assets/php/config/bdd.php';

    $cart = array();
    $cartInfo = array('pickup' => 0, 'total' => 0);


    //To manage the pickup

    if (empty($_SESSION['cartPickup']))
        header('Location: index.php');

    $cartInfo['pickup'] = $_SESSION['cartPickup'];


    // To modify item in the cart
    if (!empty($_POST['modify'])) {

        foreach ($_SESSION['cart'] as $i => $item) {
            if ($item['id'] == $_POST['modify']) {
                if (isset($_POST['plus']))
                    $_SESSION['cart'][$i]['quantity']++;
                else if (isset($_POST['minus']))
                    $_SESSION['cart'][$i]['quantity']--;

                if (isset($_POST['remove']) || $_SESSION['cart'][$i]['quantity'] <= 0)
                    array_splice($_SESSION['cart'], $i, 1);
                break;
            }
        }

    }

    //To show the cart

    if (isset($_SESSION['cart'])) {

        foreach ($_SESSION['cart'] as $item) {
            $req = $bdd->prepare('SELECT id, name, price FROM product WHERE id=:id');
            $req->execute(array(':id' => $item['id']));
            $value = $req->fetch();
            $cart[] = array('item' => $value, 'quantity' => $item['quantity']);
            $cartInfo['total'] += $item['quantity'] * $value['price'];
        }

    }

    //In the case the cart is empty
    if (!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0)
        header('Location: product.php');

?>

<?php
    include 'assets/php/partials/header.php';
    pageHeader('', ['cart'], 3);
?>

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

                <?php
                    foreach ($cart as $item) {
                        ?>
                        <tr>
                            <form action="cart.php" method="post">
                                <input type="hidden" name="modify" value="<?php echo $item['item']['id']; ?>"/>

                                <td><?php echo $item['item']['name']; ?></td>
                                <td>
                                    <button type="submit" name="minus"><i class="fa fa-minus" aria-hidden="true"></i></button>
                                    <span class="quantity"><?php echo $item['quantity']; ?></span>
                                    <button type="submit" name="plus"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                </td>
                                <td>$<?php echo $item['item']['price']*$item['quantity']; ?></td>
                                <td> <button type="submit" name="remove"><i class="fa fa-times color-red" aria-hidden="true"></i></button></td>
                            </form>
                        </tr>
                        <?php
                    }
                ?>

            </tbody>
            <tfoot>
                <tr>
                    <td></td>
                    <td></td>
                    <td>Total $<?php echo $cartInfo['total']; ?></td>
                    <td></td>
                </tr>
            </tfoot>
        </table>

        <div class="validate">
            <a type="submit" class="button btn-lg">Validate</a>
        </div>

    </div>

</div>

<?php
    include 'assets/php/partials/footer.php';
?>