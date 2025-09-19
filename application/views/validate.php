<div class="span9">
    <ul class="breadcrumb">
        <li><a href="<?=base_url()?>">Accueil</a> <span class="divider">/</span></li>
        <li><a href="<?=site_url('checkout/cart/')?>">Votre Panier</a> <span class="divider">/</span></li>
        <li class="active">Adresse de livraison</li>
    </ul>

<?php if(array_key_exists('login', $_SESSION) && array_key_exists('cart', $_SESSION)) : ?>

    <?php if(empty($userDetails)):?>

        <div class="well">
            <?php if(array_key_exists('errorRegister', $_SESSION))
            {
                echo $_SESSION['errorRegister'];
                unset($_SESSION['errorRegister']);
            }
            ?>
                <form class="form-horizontal" method="post" action="<?= site_url('/user/addDetails')?>">
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
            </div>

        <?php else:?>

        <hr class="soft"/>

        <h4>Votre adresse de livraison</h4>

            <p>	<?= $userDetails['nom'] ?> <?= $userDetails['prenom'] ?>
                <br/><br/>
                <?= $userDetails['adresse'] ?><br/>
                <?= $userDetails['code_postal'] ?> <?= $userDetails['ville'] ?><br>
                ﻿Tel  <?= $userDetails['telephone'] ?><br/>
            </p>

        <a class="btn" href="<?= site_url('/user/details')?>">Modifier</a><br><br><br>
        <a href="<?=site_url('checkout/cart/')?>" class="btn btn-large"><i class="icon-arrow-left"></i> Retour au panier</a><a class="btn btn-large pull-right" href="<?= site_url('/checkout/shipping')?>">Mode de livraison <i class="icon-arrow-right"></i></a>



    <?php endif ?>

<?php else:?>

    <table class="table table-bordered">
        <tr><th> J'ai déjà un compte  </th></tr>
        <tr>
            <td>
                <form class="form-horizontal" method="post" action="<?=site_url('/user/login')?>">
                    <div class="control-group">
                        <label class="control-label" for="inputUsername">Login</label>
                        <div class="controls">
                            <input type="text" id="inputUsername" placeholder="Login" name="login">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="inputPassword1">Mot de passe</label>
                        <div class="controls">
                            <input type="password" name="password" id="inputPassword1" placeholder="Mot de Passe">
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="controls">
                            <button type="submit" class="btn">Se Connecter</button> OU <a href="<?= site_url("/user/register")?>" class="btn">Créer un compte</a>
                        </div>
                    </div>
                </form>
            </td>
        </tr>
    </table>


<?php endif ?>

</div>