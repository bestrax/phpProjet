<?php
    session_start();


$errorMsg = '';

if(empty($_SESSION['user_id']))
    header('Location: login.php');

if(!empty($_POST['first_name']) || !empty($_POST['last_name']) || !empty($_POST['mail'])
        || !empty($_POST['username']) || !empty($_POST['password']))

    $validation = true;
else
    $validation = false;

if($validation && !empty($_POST['first_name']) && !empty($_POST['last_name']) && !empty($_POST['mail'])
    && !empty($_POST['username']) && !empty($_POST['password'])) {


    $regex = '/^(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){255,})(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){65,}@)(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22))(?:\.(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-[a-z0-9]+)*\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-[a-z0-9]+)*)|(?:\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\]))$/iD';

    if(!preg_match($regex, $_POST['mail']))
        $errorMsg = 'You need to enter a valid e-mail adress';
    else {
        require_once 'assets/php/config/bdd.php';

        $req = $bdd->prepare('SELECT `password` FROM `user` WHERE id=:id');

        $req->execute(array(':id' => $_SESSION['user_id']));

        $result = $req->fetch();

        if(empty($result['password']) || !hash_equals($result['password'], crypt($_POST['password'], $result['password'])))
            $errorMsg = 'Incorrect password !';
        else {

            $req = $bdd->prepare('SELECT COUNT(*) FROM `user` WHERE (mail LIKE :mail OR username LIKE :username) AND id != :id');

            $req->execute(array(':username' => $_POST['username'],
                ':mail' => $_POST['mail'],
                ':id' => $_SESSION['user_id']));

            if ($req->fetchColumn() != 0)
                $errorMsg = 'An user already exist with this e-mail adress or this username';
            else {
                $req = $bdd->prepare('UPDATE `user` SET `username` = :username , `first_name` = :first_name , `last_name` = :last_name ,  `mail` = :mail WHERE `id` = :id');

                $req = $req->execute(array(':username' => $_POST['username'],
                    ':mail' => htmlentities($_POST['mail']),
                    ':first_name' => htmlentities($_POST['first_name']),
                    ':last_name' => htmlentities($_POST['last_name']),
                    ':id' => $_SESSION['user_id']));

                if ($req) {
                    header('Location: profile.php');
                } else
                    $errorMsg = 'An unknow error occured';
            }
        }
    }

}

else if(!$validation) {
    require_once 'assets/php/config/bdd.php';

    $req = $bdd->prepare('SELECT `username`, `mail`, `first_name`, `last_name` FROM `user` WHERE id = :id');

    $req->execute(array(':id' => $_SESSION['user_id']));

    if($result = $req->fetch()) {
        $_POST['last_name'] = $result['last_name'];
        $_POST['first_name'] = $result['first_name'];
        $_POST['mail'] = $result['mail'];
        $_POST['username'] = $result['username'];
    }
    else {
        session_destroy();
        header('Location: login.php');
    }
}

?>

<?php
    include 'assets/php/partials/header.php';
    pageHeader('', ['register', 'login'], 0);
?>

<div id="container">

    <div id="login">

        <div class="head">
            EDIT PROFILE
        </div>

        <div class="content">
            <form method="post" action="modify_profile.php">

                <?php echo !empty($errorMsg)?'<p class="error-message">'.$errorMsg.'</p>':''; ?>

                <div class="form-control">
                    <?php echo $validation && empty($_POST['last_name']) ?'<p class="missing-field">This field is compulsory</p>':''; ?>
                    <label for="last_name">Last name</label><span class="obligatoire">*</span>
                    <input type="text" name="last_name" id="last_name" value="<?php echo !empty($_POST['last_name'])?$_POST['last_name']:'';?>" oninput="validateString(this)"/>
                </div>

                <div class="form-control">
                    <?php echo $validation && empty($_POST['first_name']) ?'<p class="missing-field">This field is compulsory</p>':''; ?>
                    <label for="first_name">First name</label><span class="obligatoire">*</span>
                    <input type="text" name="first_name" id="first_name" value="<?php echo !empty($_POST['first_name'])?$_POST['first_name']:'';?>" oninput="validateString(this)"/>
                </div>

                <div class="form-control">
                    <?php echo $validation && empty($_POST['mail']) ?'<p class="missing-field">This field is compulsory</p>':''; ?>
                    <label for="mail">E-mail</label><span class="obligatoire">*</span>
                    <input type="email" name="mail" id="mail" value="<?php echo !empty($_POST['mail'])?$_POST['mail']:'';?>" oninput="validateEmail(this)"/>
                    <p class="mail-warning">The e-mail address will not be made public and will not be used only for the reception of a new password or for the reception of certain wished notifications.</p>
                </div>

                <div class="form-control">
                    <?php echo $validation && empty($_POST['username']) ?'<p class="missing-field">This field is compulsory</p>':''; ?>
                    <label for="username">User name</label><span class="obligatoire">*</span>
                    <input type="text" name="username" id="username" value="<?php echo !empty($_POST['username'])?$_POST['username']:'';?>" oninput="validateString(this)"/>
                </div>

                <div class="form-control">
                    <?php echo $validation && empty($_POST['password']) ?'<p class="missing-field">This field is compulsory</p>':''; ?>
                    <label for="password">Password</label><span class="obligatoire">*</span>
                    <input type="password" name="password" id="password" />
                </div>

                <div class="form-submit">
                    <button type="submit" class="button btn-lg">Edit <i class="fa fa-arrow-right"></i></button>
                </div>

            </form>
        </div>

    </div>


</div>

<script src="assets/js/validate.js"></script>

<?php
    include 'assets/php/partials/footer.php';
?>