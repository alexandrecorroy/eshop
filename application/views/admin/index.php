<div id="breadcrumb">
    <a href="<?=site_url('admin')?>" title="Accueil Dashboard" class="tip-bottom"><i class="icon-home"></i> Dashboard</a>
    Bienvenue
</div>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <div class="alert alert-info">
                Bienvenue dans le <strong>Panel Admin</strong> !
                <a href="#" data-dismiss="alert" class="close">×</a>
            </div>
            <div class="widget-box">
                <div class="widget-title"><span class="icon"><i class="icon-signal"></i></span><h5>Statistiques du site</h5><div class="buttons" id="js-refresh"><a href="#" class="btn btn-mini"><i class="icon-refresh"></i> Mettre à jour les stats</a></div></div>
                <div class="widget-content">
                    <div class="row-fluid">
                        <div class="span12" id="js-refresh-data">
                            <ul class="site-stats">
                                <li><i class="fa fa-refresh"></i>
                                    <strong><?=$features->countUnvalidateOrders()?></strong> <small>Commandes à valider</small></li>
                                <li><i class="fa fa-truck"></i>
                                    <strong><?=$features->countUnsendOrders()?></strong> <small>Commandes à envoyer</small></li>
                                <li><i class="icon-user"></i> <strong><?=$features->countUsers()?></strong> <small>Utilisateurs</small></li>
                                <li><i class="icon-arrow-right"></i> <strong><?=$features->countUsersToday()?></strong> <small>Nouveaux utilisateurs (dernières 24h)</small></li>
                                <li><i class="icon-shopping-cart"></i> <strong><?=$features->countOrdersToday()?></strong> <small>Commandes sur les derniers 24h</small></li>
                                <li><i class="icon-tag"></i> <strong><?=$features->countOrders()?></strong> <small>Commandes au total</small></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row-fluid">
        <div class="span12">
            <?php if($productsStock!=null):?>
            <div class="widget-box">
                <div class="widget-title"><span class="icon"><i class="fa fa-exclamation-triangle"></i></span><h5>ATTENTION STOCKS FAIBLES</h5><span title="Total des produits avec un stock faible" class="label label-info tip-left"><?=$features->countProductsLowStock()?></span></div>
                <div class="widget-content nopadding">
                    <ul class="recent-posts">
                        <?php foreach($productsStock as $product): ?>
                            <li>
                                <div class="article-post">
                                    <p>
                                        <a href="<?=site_url('view/item/'.$product['id'])?>"><?=$product['name_product']?></a>
                                    </p>
                                    <h4 class="user-info"> Stock : <?=$product['stock']!=0 ? '<span class="text-warning">FAIBLE</span>' : '<span class="text-danger">NUL</span>'?> [<?=$product['stock']?>] </h4>
                                    <a class="btn btn-primary btn-mini" href="<?=site_url('admin/editProduct/'.$product['id'])?>" data-placement="right" title="Editer"><i class="icon-pencil"></i></a>
                                    <a class="btn btn-danger btn-mini" href="<?=site_url('admin/removeItem/'.$product['id'].'/true')?>" data-placement="left" title="Supprimer"><i class="icon-remove"></i></a>
                                </div>
                            </li>
                        <?php endforeach ?>
                    </ul>
                </div>
            </div>
            <?php endif ?>

            <div class="widget-box">
                <div class="widget-title"><span class="icon"><i class="icon-file"></i></span><h5>Derniers produits ajoutés</h5><span title="Total des produits" class="label label-info tip-left"><?=$features->countProducts()?></span></div>
                <div class="widget-content nopadding">
                    <ul class="recent-posts">
                        <?php foreach($products as $product): ?>
                        <li>
                            <div class="article-post">
                                <span class="user-info"> Ajouté le <?=$product['date_product']?> </span>
                                <p>
                                    <a href="<?=site_url('view/item/'.$product['id'])?>"><?=$product['name_product']?></a>
                                </p>
                                <a class="btn btn-primary btn-mini" href="<?=site_url('admin/editProduct/'.$product['id'])?>" data-placement="right" title="Editer"><i class="icon-pencil"></i></a>
                                <a class="btn btn-danger btn-mini" href="<?=site_url('admin/removeItem/'.$product['id'].'/true')?>" data-placement="left" title="Supprimer"><i class="icon-remove"></i></a>
                            </div>
                        </li>
                        <?php endforeach ?>
                    </ul>
                </div>
            </div>


            <div class="widget-box">
                <div class="widget-title"><span class="icon"><i class="icon-comment"></i></span><h5>Derniers commentaires</h5><span title="Total des commentaires" class="label label-info tip-left"><?=$features->countComments()?></span></div>
                <div class="widget-content nopadding">
                    <ul class="recent-comments">
                        <?php foreach($comments as $comment): ?>
                        <li>
                            <div class="comments">
                                <span class="user-info"> <?=$comment['login']?> le <?=$comment['date_comment']?> <?php
                                    for($i=0;$i<$comment['rating'];$i++)
                                    {
                                        echo '<i class="fa fa-star"></i>';
                                    }
                                    $diff = 5-$comment['rating'];
                                    if($diff!=0)
                                    {
                                        for($j=0;$j<$diff;$j++)
                                        {
                                            echo '<i class="fa fa-star-o"></i>';
                                        }
                                    }
                                    ?></span>
                                <p>
                                    <?=$comment['comment']?>
                                </p>
                                <?php if(!$comment['visibility']):?>
                                <a class="btn btn-success btn-mini" href="<?=site_url('admin/approveComment/'.$comment['id'])?>" data-placement="top" title="Approuver"><i class="icon-ok"></i></a>
                                <?php endif?>
                                <a class="btn btn-danger btn-mini" href="<?=site_url('admin/deleteComment/'.$comment['id'])?>" data-placement="top" title="Supprimer"><i class="icon-trash"></i></a>
                                <a class="btn btn-warning btn-mini" href="<?=site_url('view/item/'.$comment['id_product'])?>" data-placement="top" title="Voir le produit"><i class="fa fa-eye"></i></a>
                            </div>
                        </li>
                        <?php endforeach ?>
                        <li class="viewall">
                            <a title="Voir tous les commentaires" class="tip-top" href="<?=site_url('admin/comments')?>"> + Voir tout + </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
