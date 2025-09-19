<div class="span9">
    <ul class="breadcrumb">
        <li><a href="<?=base_url()?>">Accueil</a> <span class="divider">/</span></li>
        <li class="active">Créer un compte client</li>
    </ul>
    <h3> S'enregistrer sur le site</h3>
    <div class="well">

        <?php
        if(array_key_exists('errorRegister', $_SESSION))
        {
            echo $_SESSION['errorRegister'];
            unset($_SESSION['errorRegister']);
        }

        ?>
        <form class="form-horizontal" method="post" action="<?= site_url("/user/create_user")?>">
            <h4>Vos informations personnelles</h4>

            <div class="control-group">
                <label class="control-label" for="inputLnam">Login</label>
                <div class="controls">
                    <input type="text" id="inputLnam" placeholder="Login" name="login">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="input_email">Email</label>
                <div class="controls">
                    <input type="email" id="input_email" placeholder="Email" name="email">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputPassword1">Mot de passe</label>
                <div class="controls">
                    <input type="password" id="inputPassword1" placeholder="Mot de passe" name="password">
                </div>
            </div>

            <div class="control-group">
                <div class="controls">
                    <input type="hidden" value="<?=$_SERVER["REMOTE_ADDR"];?>" name="ip">
                    <input class="btn btn-large btn-success" type="submit" value="S'enregistrer" />
                </div>
            </div>
        </form>
    </div>

</div>