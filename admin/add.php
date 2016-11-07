<?php
session_start();

if(empty($_SESSION['user_id']))
    header('Location: login.php');

require_once '../assets/php/config/bdd.php';

$req = $bdd->prepare('SELECT `id` FROM `user` WHERE id = :id AND level >= 2');
$req->execute(array(':id' => $_SESSION['user_id']));

$validation = false;
$errorMsg = '';
$categories = [];

if($result = $req->fetch()) {

    if(!empty($_POST['name']) || !empty($_POST['category']) || !empty($_POST['price'])
            || !empty($_POST['description']) )
        $validation = true;

    if($validation && !empty($_POST['name']) && !empty($_POST['category']) && !empty($_POST['price'])
        && !empty($_POST['description']) ) {


        //Check if it's an image
        if (getimagesize($_FILES["image"]["tmp_name"]) !== false) {

            //Check the size if the image
            if ($_FILES["image"]["size"] > 500000)
                $errorMsg = 'Your image is too large !';
            else {

                // Check the extension of the image
                $extension = pathinfo($_FILES["image"]["name"])['extension'];
                if($extension != "jpg" && $extension != "png" && $extension != "jpeg")
                    $errorMsg = 'Sorry, only JPG, JPEG, PNG files are allowed !';
                else {

                    //Check if one image doesn't already exist with this extension
                    $path = 'assets/uploads/';
                    $name = '';
                    do {
                        $name = time().rand(0, 100).'.'.$extension;
                    } while (file_exists($path.$name));

                    //We try to move the image, if it doesn't work we show an error
                    if (move_uploaded_file($_FILES["image"]["tmp_name"], $path.$name)) {

                        $req = $bdd->prepare('INSERT INTO `product` (name, category_id, price, description, image) VALUES (:name, :category_id, :price, :description, :image)');
                        $req = $req->execute(array(':name' => $_POST['name'],
                            ':category_id' => $_POST['category'],
                            ':price' => $_POST['price'],
                            ':description' => $_POST['description'],
                            ':image' => $name));

                        if ($req) {
                            header('Location: index.php');
                            exit();
                        }
                        else
                            $errorMsg = 'An unknow error occured';

                    } else
                        $errorMsg = 'An unknow error occured while uploading the file';

                }

            }

        } else {
            $errorMsg = 'The file is not an image !';
        }


    }

    $req = $bdd->prepare('SELECT * FROM `category`');
    $req->execute();

    $categories = [];
    $categories = $req->fetchAll();


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

        <div class="head">
            New Product
        </div>

        <form method="post" action="add.php" enctype="multipart/form-data">

            <?php echo !empty($errorMsg)?'<p class="error-message">'.$errorMsg.'</p>':''; ?>

            <div class="form-control">
                <?php echo $validation && empty($_POST['name']) ?'<p class="missing-field">This field is compulsory</p>':''; ?>
                <label for="name">Name</label><span class="obligatoire">*</span>
                <input type="text" name="name" id="name" value="<?php echo !empty($_POST['name'])?$_POST['name']:'';?>"/>
            </div>

            <div class="form-control">
                <?php echo $validation && empty($_POST['category']) ?'<p class="missing-field">This field is compulsory</p>':''; ?>
                <label for="category">Category</label><span class="obligatoire">*</span>
                <select id="category" name="category">
                    <?php
                        foreach($categories as $category) {
                            ?>
                            <option value="<?php echo $category['id']; ?>" <?php echo !empty($_POST['category']) && $_POST['category'] == $category['id'] ? 'selected' : ''; ?> >
                                <?php echo $category['name']; ?>
                            </option>
                            <?php
                        }
                    ?>
                </select>
            </div>

            <div class="form-control">
                <?php echo $validation && empty($_POST['price']) ?'<p class="missing-field">This field is compulsory</p>':''; ?>
                <label for="price">Price</label><span class="obligatoire">*</span>
                <input type="number" name="price" id="price" value="<?php echo !empty($_POST['price'])?$_POST['price']:'';?>" />
            </div>

            <div class="form-control">
                <?php echo $validation && empty($_POST['description']) ?'<p class="missing-field">This field is compulsory</p>':''; ?>
                <label for="description">Description</label><span class="obligatoire">*</span>
                <textarea name="description" id="description"><?php echo !empty($_POST['description'])?$_POST['description']:'';?></textarea>
            </div>

            <div class="form-control">
                <label for="image">Image</label><span class="obligatoire">*</span>
                <input type="file" name="image" id="image" />
            </div>


            <div class="form-submit">
                <button type="submit" class="button btn-lg">Add <i class="fa fa-arrow-right"></i></button>
            </div>

        </form>

    </div>

</div>

<script src="../assets/js/admin.js"></script>

<?php
    include '../assets/php/partials/footer.php';
?>

