<?php
    session_start();
    include 'assets/php/partials/header.php';
    pageHeader('', ['profile'], 0);
?>

<div id="container">

    <div id="resume">

        <div class="title">Emilie Jolie</div>


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
        <div class="titre">Log out</div>

    </div>
   
</div>

<?php
    include 'assets/php/partials/footer.php';
?>

