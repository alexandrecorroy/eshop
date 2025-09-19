<div class="span9">
    <ul class="breadcrumb">
        <li><a href="<?=base_url()?>">Accueil</a> <span class="divider">/</span></li>
        <li><a href="<?=site_url('user/panel/')?>">Mon compte</a> <span class="divider">/</span></li>
        <li class="active">Coordonnées postales</li>
    </ul>

    <div class="well">
        <?php if(!empty($details)):?>

        <?php
        if(array_key_exists('message', $_SESSION))
        {
            echo $_SESSION['message'];
            unset($_SESSION['message']);
        }
        ?>
        <form class="form-horizontal" method="post" action="<?= site_url('/user/editDetails')?>">
            <h4>Modifier votre addresse</h4>
            <div class="control-group">
                <label class="control-label" for="inputFname">Nom</label>
                <div class="controls">
                    <input type="text" id="inputFname" placeholder="Nom" name="nom" value="<?= $details['nom'] ?>">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputLname">Prénom</label>
                <div class="controls">
                    <input type="text" id="inputLname" placeholder="Prénom" name="prenom" value="<?= $details['prenom'] ?>"/>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="address">Addresse</label>
                <div class="controls">
                    <input type="text" id="address" placeholder="Adresse" name="adresse" value="<?= $details['adresse'] ?>"/>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="postcode">Code postal</label>
                <div class="controls">
                    <input type="number" id="postcode" placeholder="Code Postal" name="cp" value="<?= $details['code_postal'] ?>"/>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="city">Ville</label>
                <div class="controls">
                    <input type="text" id="city" placeholder="Ville" name="ville" value="<?= $details['ville'] ?>"/>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="phone">Téléphone</label>
                <div class="controls">
                    <input type="text" id="phone" placeholder="Téléphone" name="tel" value="<?= $details['telephone'] ?>"/>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="password">Mot de passe</label>
                <div class="controls">
                    <input type="password" id="password" placeholder="Votre mot de passe" name="password"/>
                </div>
            </div>

            <div class="control-group">
                <div class="controls">
                    <input class="btn btn-large btn-success" type="submit" value="Modifier" />
                </div>
            </div>
        </form>

        <?php else : ?>

            <?php if(array_key_exists('errorRegister', $_SESSION))
            {
                echo $_SESSION['errorRegister'];
                unset($_SESSION['errorRegister']);
            }
            ?>
            <form class="form-horizontal" method="post" action="<?= site_url('/user/addDetails/true')?>">
                <h4>Votre addresse</h4>
                <div class="control-group">
                    <label class="control-label" for="inputFname">Nom</label>
                    <div class="controls">
                        <input type="text" id="inputFname" placeholder="Nom" name="nom">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="inputLname">Prénom</label>
                    <div class="controls">
                        <input type="text" id="inputLname" placeholder="Prénom" name="prenom"/>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="address">Addresse</label>
                    <div class="controls">
                        <input type="text" id="address" placeholder="Adresse" name="adresse"/>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="postcode">Code postal</label>
                    <div class="controls">
                        <input type="text" id="postcode" placeholder="Code Postal" name="cp"/>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="city">Ville</label>
                    <div class="controls">
                        <input type="text" id="city" placeholder="Ville" name="ville"/>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="phone">Téléphone</label>
                    <div class="controls">
                        <input type="text" id="phone" placeholder="Téléphone" name="tel"/>
                    </div>
                </div>

                <div class="control-group">
                    <div class="controls">
                        <input class="btn btn-large btn-success" type="submit" value="Valider" />
                    </div>
                </div>
            </form>
        <?php endif ?>
    </div>

</div>