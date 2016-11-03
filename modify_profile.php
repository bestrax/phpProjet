<?php
    session_start();
    include 'assets/php/partials/header.php';
    pageHeader('', ['register', 'login'], 0);
?>

<div id="container">

    <div id="login">

        <div class="head">
            Modify your profile
        </div>

        <div class="content">
            <form>

                <div class="form-control">
                    <label for="lname">Last name</label><span class="obligatoire">*</span>
                     <input type="text" name="lname" id="lname"/>
                </div>

                <div class="form-control">
                    <label for="fname">First name</label><span class="obligatoire">*</span>
                    <input type="text" name="fname" id="fname" />
                </div>

                <div class="form-control">
                    <label for="email">E-mail</label><span class="obligatoire">*</span>
                    <input type="text" name="email" id="email" />
                    <p>The e-mail address will not be made public and will not be used only for the reception of a new password or for the reception of certain wished notifications.P</p>
            
                </div>

                <div class="form-control">
                    <label for="id">User name</label><span class="obligatoire">*</span>
                    <input type="text" name="id" id="id" />
                </div>

                <div class="form-control">
                    <label for="password">Password</label><span class="obligatoire">*</span>
                    <input type="text" name="password" id="password" />
                </div>

                 <div class="form-control">
                    <label for="password"> Retry Password</label><span class="obligatoire">*</span>
                    <input type="text" name="password" id="password" />
                </div>
                <div class="form-submit">
                    <a type="submit" class="button btn-lg">Save Changes <i class="fa fa-arrow-right"></i></a>
                </div>

            </form>
        </div>

    </div>

   
</div>

<?php
    include 'assets/php/partials/footer.php';
?>