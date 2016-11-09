<?php
session_start();

if(empty($_SESSION['user_id']))
    header('Location: login.php');

require_once '../assets/php/config/bdd.php';

$req = $bdd->prepare('SELECT `id` FROM `user` WHERE id = :id AND level >= 2');
$req->execute(array(':id' => $_SESSION['user_id']));

$users = [];

if($result = $req->fetch()) {


    if(isset($_POST['user']) && !empty($_POST['id']) && !empty($_POST['level'])) {
        $req = $bdd->prepare('UPDATE user SET level=:level WHERE id=:id');
        $req->execute(array(':level' => $_POST['level'],
                            ':id' => $_POST['id']));
    }

    $req = $bdd->prepare('SELECT * FROM `user`');
    $req->execute();

    $users = $req->fetchAll();


}
else {
    header('Location: ../index.php');
}
?>

<?php
include '../assets/php/partials/header.php';
pageHeader('', ['admin'], 0);
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
            <thead>
            <tr>
                <th>Users</th>
                <th></th>
                <th></th>
            </tr>
            </thead>

            <tbody>

            <?php
            foreach($users as $user) {
                ?>
                <tr>
                    <td><?php echo $user['username']; ?></td>
                    <td><?php echo $user['level'] == 2 ? 'Admin' : 'User'; ?></td>
                    <td>
                            <form action="users.php" method="post">
                                <input type="hidden" name="id" value="<?php echo $user['id']; ?>" />
                                <input type="hidden" name="level" value="<?php echo $user['level'] == 2 ? '1' : '2'; ?>" />
                                <button type="submit" name="user" class="no-button">
                                    <i class="fa fa-<?php echo $user['level'] == 2 ? 'level-down' : 'level-up'; ?> color-red" aria-hidden="true"></i>
                                </button>
                            </form>
                    </td>
                </tr>
                <?php
            }
            ?>

            </tbody>

        </table>

    </div>

</div>

<script src="../assets/js/admin.js"></script>

<?php
include '../assets/php/partials/footer.php';
?>

