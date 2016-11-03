<?php
    session_start();

    if(empty($_SESSION['user_id']))
        header('Location: login.php');

    require_once 'assets/php/config/bdd.php';

    $req = $bdd->prepare('SELECT `username`, `mail`, `first_name`, `last_name` FROM `user` WHERE id = :id');

    $req->execute(array(':id' => $_SESSION['user_id']));
    $data = [];

    if($result = $req->fetch()) {
        $data = $result;
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
            <tr class="name-order">
                <td>Command of 17/09 at 16pm :</td>
                <td></td>
                <td class="price">$4</td>
            </tr>

            <tr class="list-order">
                <td>Croissant</td>
                <td>Qte:3</td>
                <td class="price">$3</td>
            </tr>
            <tr class="list-order">
                <td>Bread </td>
                <td>Qte:1</td>
                <td class="price">$1</td>
            </tr>

        </table>

        <div class="titre"><a href="modify_profile.php" class="no-link">Modify Profil</a></div>
        <div class="titre"><a href="logout.php" class="no-link">Log out</a></div>

    </div>
   
</div>

<?php
    include 'assets/php/partials/footer.php';
?>

