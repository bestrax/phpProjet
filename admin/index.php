<?php
    session_start();

    if(empty($_SESSION['user_id']))
        header('Location: login.php');

    require_once '../assets/php/config/bdd.php';

    $req = $bdd->prepare('SELECT `id` FROM `user` WHERE id = :id AND level >= 2');
    $req->execute(array(':id' => $_SESSION['user_id']));

    $categories = [];

    if($result = $req->fetch()) {

        //--------- CATEGORIES ------------------

        if(!empty($_POST['category'])) {
            $req = $bdd->prepare('INSERT INTO `category` (name) VALUES (:name)');
            $req->execute(array(':name' => $_POST['category']));
        }

        if(!empty($_GET['category']) && isset($_GET['delete'])) {

            $req = $bdd->prepare('DELETE FROM `product` WHERE category_id=:id');
            $req->execute(array(':id' => $_GET['category']));

            $req = $bdd->prepare('DELETE FROM `category` WHERE id=:id');
            $req->execute(array(':id' => $_GET['category']));
        }

        $req = $bdd->prepare('SELECT * FROM `category`');
        $req->execute();

        $categories = [];
        $categories = $req->fetchAll();


        //--------- PRODUCTS ------------------

        if(!empty($_GET['product']) && isset($_GET['delete'])) {

            $req = $bdd->prepare('SELECT `image` FROM `product` WHERE id=:id');
            $req->execute(array(':id' => $_GET['product']));

            $image = $req->fetchColumn();
            if(!empty($image) && file_exists('assets/uploads/'.$image))
                unlink('assets/uploads/'.$image);

            $req = $bdd->prepare('DELETE FROM `product` WHERE id=:id');
            $req->execute(array(':id' => $_GET['product']));
        }

        $req = $bdd->prepare('  SELECT p.id id, p.name name, c.name category
                                FROM product p
                                INNER JOIN category c
                                WHERE c.id = p.category_id ');
        $req->execute();

        $products = [];
        $products = $req->fetchAll();

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
                    <th>Categories</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>

            <?php
                foreach($categories as $category) {
                    ?>
                    <tr>
                        <td><?php echo $category['name']; ?></td>
                        <td>
                            <span onClick="confirmDeleteCategory(<?php echo $category['id'];?>)">
                                <i class="fa fa-times color-red" aria-hidden="true"></i>
                            </span>
                        </td>
                    </tr>
                    <?php
                }
            ?>

            </tbody>

            <tfoot>
                <tr>
                    <form method="post" action="index.php">
                        <td> <input type="text" name="category" placeholder="Category name" /> </td>
                        <td> <button type="submit" class="button">ADD</button> </td>
                    </form>
                </tr>
            </tfoot>

        </table>


        <table>
            <thead>
            <tr>
                <th>Product</th>
                <th>Category</th>
                <th></th>
            </tr>
            </thead>

            <tbody>

            <?php
            foreach($products as $product) {
                ?>
                <tr>
                    <td><?php echo $product['name']; ?></td>
                    <td><?php echo $product['category']; ?></td>
                    <td>
                            <a href="add.php?id=<?php echo $product['id']; ?>" class="no-link">
                                <i class="fa fa-pencil color-blue margin-pencil" aria-hidden="true"></i>
                            </a>
                            <span onClick="confirmDeleteProduct(<?php echo $product['id'];?>)">
                                <i class="fa fa-times color-red" aria-hidden="true"></i>
                            </span>
                    </td>
                </tr>
                <?php
            }
            ?>

            </tbody>

            <tfoot>
                <tr>
                    <td></td>
                    <td></td>
                    <td><a href="add.php" class="button no-link">New</a></td>
                </tr>
            </tfoot>

        </table>

    </div>

</div>

<script src="../assets/js/admin.js"></script>

<?php
    include '../assets/php/partials/footer.php';
?>

