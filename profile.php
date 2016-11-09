<?php
    session_start();

    if(empty($_SESSION['user_id']))
        header('Location: login.php');

    require_once 'assets/php/config/bdd.php';

    $req = $bdd->prepare('SELECT `username`, `mail`, `first_name`, `last_name` FROM `user` WHERE id = :id');

    $req->execute(array(':id' => $_SESSION['user_id']));
    $data = [];
    $orders = [];

    if($result = $req->fetch()) {
        $data = $result;

        $req = $bdd->prepare('SELECT * FROM `order` WHERE user_id=:user_id');
        $req->execute(array(':user_id' => $_SESSION['user_id']));

        $orders = $req->fetchAll();

        foreach ($orders as $i => $order) {
            $req = $bdd->prepare('SELECT p.name name, l.quantity quantity, l.total total
                                  FROM order_line l 
                                  INNER JOIN product p 
                                  WHERE p.id = l.product_id
                                  AND l.order_id = :order_id');
            $req->execute(array(':order_id' => $order['id']));

            $orders[$i]['lines'] = $req->fetchAll();
        }

    }
    else {
        session_destroy();
        header('Location: login.php');
    }
?>

<?php
    include 'assets/php/partials/header.php';
    pageHeader('', ['profile'], 0);
?>

<div id="container">

    <div id="resume">

        <div class="title"><p><?php echo $data['last_name'].' '.$data['first_name']; ?></p></div>


        <div class="name">Order History :</div><br/>
        <table>

            <?php
                foreach ($orders as $order) {
                    ?>
                    <tr class="name-order">
                        <td>Command of <?php echo $order['date_order']; ?>  for <?php echo $order['date_delivered']; ?> :</td>
                        <td></td>
                        <td class="price">$<?php echo $order['total']; ?></td>
                    </tr>
                    <?php

                    foreach($order['lines'] as $line) {
                        ?>
                        <tr class="list-order">
                            <td><?php echo $line['name']; ?></td>
                            <td>Qte:<?php echo $line['quantity']; ?></td>
                            <td class="price">$<?php echo $line['total']; ?></td>
                        </tr>
                        <?php
                    }

                }
            ?>

        </table>

        <div class="titre"><a href="modify_profile.php" class="no-link">Modify Profil</a></div>
        <div class="titre"><a href="logout.php" class="no-link">Log out</a></div>

    </div>
   
</div>

<?php
    include 'assets/php/partials/footer.php';
?>

