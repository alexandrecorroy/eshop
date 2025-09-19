<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Ecommerce</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/themes/smoothness/jquery-ui.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/jquery-ui.min.js"></script>
    <script>
        base_url = '<?php echo base_url(); ?>';
    </script>
    <script src="<?=site_url('/assets/js/script.js')?>"></script>
    <!-- Bootstrap style -->
    <link id="callCss" rel="stylesheet" href="<?=base_url()?>assets/businessltd/bootstrap.min.css" media="screen"/>
    <link href="<?=base_url()?>assets/css/base.css" rel="stylesheet" media="screen"/>
    <!-- Bootstrap style responsive -->
    <link href="<?=base_url()?>assets/css/bootstrap-responsive.min.css" rel="stylesheet"/>
    <link href="<?=base_url()?>assets/css/font-awesome.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
</head>
<body>
<?php
if(array_key_exists('error', $_SESSION))
{
    echo $_SESSION['error'];
    unset($_SESSION['error']);
}

?>
<div id="header">
    <div class="container">
        <div id="welcomeLine" class="row">
            <?php if(array_key_exists('login', $_SESSION)):?>
                <div class="span6">Bienvenue <strong><?=$_SESSION['login']?></strong> !</div>
            <?php else: ?>
                <div class="span6">Bienvenue ! <a href="<?= site_url("/user/register")?>">Pas encore de compte ?</a></div>
            <?php endif ?>

            <div id="topMenu" class="pull-right">
                <?php if(array_key_exists('login', $_SESSION)): ?>

                    <?php
                    if(array_key_exists('admin', $_SESSION))
                    {
                        echo '<a href="'.site_url('/admin/').'"><button class="btn btn-small btn-info"><i class="fa fa-lock"></i> ADMIN PANEL</button></a>';
                    }
                    else
                    {
                        echo '<a href="'.site_url('/user/panel').'"><button class="btn btn-small btn-info"><i class="fa fa-user"></i> Mon Compte</button></a>';
                    }
                    ?>

                    <a title="Se déconnecter" href="<?= site_url("/user/logout")?>"><button class="btn btn-small btn-danger"><i class="fa fa-power-off"></i></button></a>

                <?php else: ?>
                    <a href="#login" role="button" data-toggle="modal" style="padding-right:0"><span class="btn btn-small btn-success">Login</span></a>
                    <div id="login" class="modal hide fade in" tabindex="-1" role="dialog" aria-labelledby="login" aria-hidden="false" >
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h3>Connectez-vous !</h3>
                        </div>
                        <div class="modal-body">
                            <form class="form-horizontal loginFrm" action="<?= site_url("/user/login")?>" method="post">
                                <div class="control-group">
                                    <input type="text" id="inputEmail" placeholder="Login" name="login">
                                </div>
                                <div class="control-group">
                                    <input type="password" id="inputPassword" placeholder="Password" name="password">
                                </div>
                                <div class="control-group">
                                    <a href="<?= site_url("/user/register")?>">Créer un compte gratuitement !</a>
                                </div>
                                <div class="control-group">
                                    <button type="submit" class="btn btn-success">Se connecter</button>
                                </div>
                            </form>

                        </div>
                    </div>

                <?php endif ?>
            </div>
        </div>
        <!-- Navbar ================================================== -->
        <div id="logoArea" class="navbar">
            <div class="navbar-inner">
                <a class="brand" href="<?=base_url()?>"><img src="<?=base_url()?>assets/images/logo.png" alt="Bootsshop"/></a>
                <form class="form-inline navbar-search pull-right" id="searchForm" method="post" action="<?=site_url('/view/search')?>" >
                    <input id="search" name="search" class="srchTxt" type="text" />
                    <button type="submit" id="submitButton" class="btn btn-primary">Aller</button>
                </form>

            </div>
        </div>
    </div>
</div>
<!-- Header End====================================================================== -->
<div id="mainBody">
    <div class="container">
        <div class="row">
            <!-- Sidebar ================================================== -->
            <div id="sidebar" class="span3">
                <?php if(!array_key_exists('admin', $_SESSION)):?>
                    <?php
                    if(array_key_exists('cart', $_SESSION))
                    {
                        $article = count($_SESSION['cart']);

                        if($article<2)
                        {
                            $article = count($_SESSION['cart']).' article';
                        }
                        else
                        {
                            $article = count($_SESSION['cart']).' articles';
                        }
                    }
                    else
                    {
                        $article = '0 article';
                    }
                    ?>
                <div class="well well-small"><a id="myCart" href="<?=site_url('/checkout/cart')?>"><img src="<?=base_url()?>assets/images/ico-cart.png" alt="cart">Panier (<?=$article?>)</a></div>
                <?php endif ?>
                <ul id="sideMenu" class="nav nav-tabs nav-stacked">
                    <?php
                    $levels = 0;
                    $topRight = 0;
                    foreach($categories as $key=>$categorie)
                    {
                        $left = $categorie['left'];
                        $right = $categorie['right'];

                        if ($categorie['id']==1)
                        {
                            continue;
                        }
                        if ($levels > 0 && $left>$topRight)
                        {
                            echo "</ul>";
                            $levels--;
                        }
                        if ($left + 1 != $right)
                        {
                            echo "<li class='subMenu";
                            echo $key==1 ? ' open' : '';
                            echo "'><a class='cursor'>".$categorie['name_categorie']."</a>";
                            echo $key!=1 ? '<ul style="display:none">' : '<ul>';
                            $levels++;
                            $topRight=$right;
                        }
                        else
                        {
                            echo "<li><a href='".site_url('view/category/'.$categorie['id'])."'><i class='icon-chevron-right'></i>".$categorie['name_categorie']." (".$features->countItemByCat($categorie['id']).")</a></li>";
                        }

                    }
                    if($levels)
                    {
                        echo "</ul></li>";
                    }


                    ?>
                </ul>
            </div>