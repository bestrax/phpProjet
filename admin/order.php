<?php
session_start();

if(empty($_SESSION['user_id']))
    header('Location: login.php');

require_once '../assets/php/config/bdd.php';

$req = $bdd->prepare('SELECT `id` FROM `user` WHERE id = :id AND level >= 2');
$req->execute(array(':id' => $_SESSION['user_id']));

$orders = [];

if($result = $req->fetch()) {

    if(isset($_POST['delivered']) && !empty($_POST['id'])) {
        $req = $bdd->prepare('UPDATE `order` SET delivered=1 WHERE id=:id');
        $req->execute(array(':id' => htmlentities($_POST['id'])));
    }

    $req = $bdd->prepare('SELECT * FROM `order` ORDER BY delivered ASC');
    $req->execute();

    $orders = $req->fetchAll();

    foreach ($orders as $i => $order) {
        $req = $bdd->prepare('SELECT p.name name, l.quantity quantity, l.total total
                                  FROM order_line l 
                                  INNER JOIN product p 
                                  WHERE p.id = l.product_id
                                  AND l.order_id = :order_id');
        $req->execute(array(':order_id' => $order['id']));

        $orders[$i]['lines'] = $req->fetchAll();

        $req = $bdd->prepare('SELECT first_name, last_name FROM user WHERE id= :user_id');
        $req->execute(array(':user_id' => $order['user_id']));

        $orders[$i]['user'] = $req->fetch();
    }

}
else {
    header('Location: ../index.php');
}
?>

<?php
    include '../assets/php/partials/header.php';
    pageHeader('', ['admin', 'adminOrder'], 0);
?>

<div id="container">

    <div id="admin">

        <div class="admin-menu">
            <div>
                <a href="index.php" class="no-link">
                    <i class="fa fa-cog"></i> Categories/Products
                </a>
            </div>
            <div>
                <a href="order.php" class="no-link">
                    <i class="fa fa-coffee"></i> Orders
                </a>
            </div>
            <div>
                <a href="users.php" class="no-link">
                    <i class="fa fa-user"></i> Users
                </a>
            </div>
        </div>

        <table>

            <?php
            foreach ($orders as $order) {
                ?>
                <tr class="name-order <?php echo $order['delivered'] == 1 ? 'delivered' : ''; ?>">
                    <td>Command of <?php echo $order['date_order']; ?>  <?php echo $order['delivered'] == 1 ? '(delivered)' : '(waiting)'; ?> for <?php echo $order['date_delivered']; ?></td>
                    <td></td>
                    <td class="price">$<?php echo $order['total']; ?></td>
                </tr>
                <tr class="list-order <?php echo $order['delivered'] == 1 ? 'delivered' : ''; ?>">
                    <td><?php echo $order['user']['last_name'].' '.$order['user']['first_name']; ?></td>
                    <td></td>
                    <td></td>
                </tr>
                <?php

                foreach($order['lines'] as $line) {
                    ?>
                    <tr class="list-order <?php echo $order['delivered'] == 1 ? 'delivered' : ''; ?>">
                        <td><?php echo $line['name']; ?></td>
                        <td>Qte:<?php echo $line['quantity']; ?></td>
                        <td class="price">$<?php echo $line['total']; ?></td>
                    </tr>
                    <?php
                }

                if ($order['delivered'] == 0) {
                    ?>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>
                            <form action="order.php" method="post">
                                <input type="hidden" name="id" value="<?php echo $order['id']; ?>" />
                                <button type="submit" name="delivered" class="button">Delivered</button>
                            </form>
                        </td>
                    </tr>
                    <?php
                }

            }
            ?>

        </table>

    </div>

</div>

<script src="../assets/js/admin.js"></script>

<?php
include '../assets/php/partials/footer.php';
?>

