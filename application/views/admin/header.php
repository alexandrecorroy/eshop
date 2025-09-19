<!DOCTYPE html>
<html lang="en">
<head>
    <title>Dashboard Admin</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet/less" type="text/css" href="<?=base_url()?>assets/admin/less/bootstrap.less">
    <script src="<?=base_url()?>assets/admin/js/less/less.js" type="text/javascript"></script>
    <link rel="stylesheet" href="<?=base_url()?>assets/admin/style/fullcalendar.css" />
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/admin/style/delta.main.css" />
    <link rel="stylesheet" href="<?=base_url()?>assets/admin/style/delta.grey.css"/>
    <script src="//tinymce.cachefly.net/4.1/tinymce.min.js"></script>
    <script>
        base_url = '<?php echo base_url(); ?>';
        tinymce.init({
            selector:'#long_description',
            language_url : base_url+'assets/admin/langs/fr_FR.js',
            entity_encoding : "raw"
        });

    </script>
</head>
<body>
<br>
<div id="sidebar">
    <a href="#" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a>
    <ul>
        <li <?=$this->uri->ruri_string()=='/admin/index' ? 'class="active"' : ''?>><a href="<?=site_url('admin')?>"><i class="icon icon-home"></i> <span>Dashboard</span></a></li>

        <li <?=$this->uri->ruri_string()=='/admin/addProduct' ? 'class="active"' : ''?>><a href="<?= site_url('/admin/addProduct')?>"><i class="fa fa-plus"></i> <span>Ajouter un produit</span></a></li>

        <li <?=$this->uri->ruri_string()=='/admin/manageCategories' ? 'class="active"' : ''?>><a href="<?= site_url('/admin/manageCategories')?>"><i class="fa fa-cog"></i> <span>Catégories</span></a></li>

        <li class="submenu <?=$this->uri->ruri_string()=='/admin/searchOrder' ? 'active' : ''?><?=$this->uri->ruri_string()=='/admin/sendOrders' ? 'active' : ''?><?=$this->uri->ruri_string()=='/admin/validateOrders' ? 'active' : ''?>">
            <a class="cursor"><i class="fa fa-shopping-cart"></i> <span>Commandes</span> <span class="label">3</span></a>
            <ul>
                <li><a href="<?= site_url('admin/searchOrder')?>">Rechercher une commande</a></li>
                <li><a href="<?=site_url('admin/validateOrders')?>">Commandes à valider</a></li>
                <li><a href="<?= site_url('admin/sendOrders')?>">Commandes à envoyer</a></li>
            </ul>
        </li>

        <li <?=$this->uri->ruri_string()=='/admin/users' ? 'class="active"' : ''?>><a href="<?= site_url('/admin/users')?>"><i class="fa fa-users"></i> <span>Utilisateurs</span></a></li>

        <li <?=$this->uri->ruri_string()=='/admin/comments' ? 'class="active"' : ''?>><a href="<?= site_url('/admin/comments')?>"><i class="fa fa-comments"></i> <span>Commentaires</span></a></li>
        <li <?=$this->uri->ruri_string()=='/admin/shipping' ? 'class="active"' : ''?>><a href="<?= site_url('/admin/shipping')?>"><i class="fa fa-paper-plane"></i> <span>Modes de livraison</span></a></li>
        <li <?=$this->uri->ruri_string()=='/admin/coupon' ? 'class="active"' : ''?>><a href="<?= site_url('/admin/coupon')?>"><i class="fa fa-eur"></i> <span>Coupons de réduction</span></a></li>
    </ul>
</div>
<div id="mainBody">
    <h1>Dashboard
        <div class="pull-right">
            <a href="<?= site_url('/admin/addProduct')?>" class="btn btn-large tip-bottom" title="Ajouter un produit"><i class="fa fa-plus"></i></a>
            <a href="<?= site_url('/admin/manageCategories')?>" class="btn btn-large tip-bottom" title="Manage Catégories"><i class="fa fa-cogs"></i></a>
            <a class="btn btn-large tip-bottom" href="<?= site_url('/admin/users')?>" title="Manage Utilisateurs"><i class="icon-user"></i></a>
            <a class="btn btn-large tip-bottom" href="<?= site_url('/admin/comments')?>" title="Manage Commentaires" style="position:relative"><i class="icon-comment"></i>
            <span style="position:absolute; border-radius:12px; top:-23%; height:16px; width:16px" class="label label-important"><?=$features->countUnvalidateComments()?></span></a>
            <a class="btn btn-large tip-bottom" href="<?= site_url('/admin/searchOrder')?>" title="Rechercher une commande"><i class="fa fa-search"></i></a>
            <a class="btn btn-large btn-info" title="Accueil Boutique" href="<?= base_url()?>"><i class="fa fa-home"></i></a>
            <a class="btn btn-large btn-danger" title="Se Déconnecter" href="<?= site_url("/user/logout")?>"><i class="icon-off"></i></a>
        </div>
    </h1>