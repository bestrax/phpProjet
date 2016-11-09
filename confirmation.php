<?php
    session_start();

    require_once 'assets/php/config/bdd.php';

    $cart = array();
    $cartInfo = array('pickup' => 0, 'total' => 0);

    //If user is not connected
    if (!isset($_SESSION['user_id'])) {
        header('Location: login.php?cart=true');
        exit();
    }

    //To manage the pickup
    if (empty($_SESSION['cartPickup'])) {
        header('Location: index.php');
        exit();
    }

    //In the case the cart is empty
    if (!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0) {
        header('Location: product.php');
        exit();
    }


    $cartInfo['pickup'] = $_SESSION['cartPickup'];


    //To register the car

    $req = $bdd->prepare('INSERT INTO `order` (user_id, date_delivered) VALUES (:user_id, :date_delivered)');
    $req->execute(array(':user_id' => $_SESSION['user_id'],
                        ':date_delivered' => $cartInfo['pickup']));
    $order = $bdd->lastInsertId();

    $content = "Hello,\n\n Your order number $order which will be ready to be pick-up at $cartInfo[pickup]. You ordered the following items :\n\n";

    foreach ($_SESSION['cart'] as $item) {
        $req = $bdd->prepare('SELECT id, name, price FROM product WHERE id=:id');
        $req->execute(array(':id' => $item['id']));
        $value = $req->fetch();

        $req = $bdd->prepare('INSERT INTO `order_line` (order_id, product_id, price, quantity, total) VALUES (:order_id, :product_id, :price, :quantity, :total)');
        $req->execute(array(':order_id' => $order,
                            ':product_id' => $value['id'],
                            ':price' => $value['price'],
                            ':quantity' => $item['quantity'],
                            ':total' => $item['quantity'] * $value['price']));

        $content .= "- $item[quantity] x $value[name] (\$$value[price]) = ".($item['quantity'] * $value['price'])."\n";

        $cart[] = array('item' => $value, 'quantity' => $item['quantity']);
        $cartInfo['total'] += $item['quantity'] * $value['price'];
    }

    $content .= "\nTotal : \$$cartInfo[total]\n\nThank's for your order.\n\nBest Regards,\n\nBreadExpress";

    $req = $bdd->prepare('SELECT mail from user WHERE id=:id');
    $req->execute(array(':id' => $_SESSION['user_id']));
    $mail = $req->fetch();

    mail($mail['mail'], "BreadExpress - Order number $order", $content);

    $req = $bdd->prepare('UPDATE `order` set total=:total WHERE id=:id');
    $req->execute(array(':id' => $order,
        ':total' => $cartInfo['total']));

    $_SESSION['cart'] = array();
    $_SESSION['cartPickup'] = '';



?>

<?php
include 'assets/php/partials/header.php';
pageHeader('', ['cart'], 3);
?>

    <div id="container">

        <div id="cart">

            <div class="info">
                <i class="fa fa-info-circle type" aria-hidden="true"></i>
                <p>Thank's you for your order, you're order will be ready for your pick-up time. This is a summary of your order. <br/><br/>
                    Pick-up time : <?php echo $cartInfo['pickup']; ?></p>
            </div>


            <table class="summary">
                <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                </tr>
                </thead>
                <tbody>

                <?php
                foreach ($cart as $item) {
                    ?>
                    <tr>

                            <td><?php echo $item['item']['name']; ?></td>
                            <td>
                                <span class="quantity"><?php echo $item['quantity']; ?></span>
                            </td>
                            <td>$<?php echo $item['item']['price']*$item['quantity']; ?></td>
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
                </tr>
                </tfoot>
            </table>

            <div class="validate">
                <a href="profile.php" class="button btn-lg no-link">Go to your profile</a>
            </div>

        </div>

    </div>

<?php
include 'assets/php/partials/footer.php';
?>