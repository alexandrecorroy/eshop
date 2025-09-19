<div id="breadcrumb">
    <a href="<?=site_url('admin')?>" title="Accueil Dashboard" class="tip-bottom"><i class="icon-home"></i> Dashboard</a>
    Envoyer les commandes
</div>
<?php if(array_key_exists('message', $_SESSION))
{
    echo $_SESSION['message'];
    unset($_SESSION['message']);
}
?>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <div class="widget-box">
                <div class="widget-title"><span class="icon"><i class="fa fa-shopping-cart"></i></span><h5>Commandes validées à envoyer</h5><span title="Total des commentaires en attente" class="label label-info tip-left"><?=$features->countUnsendOrders()?></span></div>
                <div class="widget-content nopadding">
                    <ul class="recent-comments">
                        <?php foreach($orders as $order): ?>
                            <li>
                                <div class="comments">
                                    <?php if($order['priority']): ?>
                                        <a class="btn btn-warning"><i class="fa fa-exclamation-triangle"></i> Prioritaire</a><br>
                                    <?php endif ?>
                                    <span class="user-info"> Commande N°<?=$order['id']?> le <?=$order['date_achat']?></span>
                                    <p>
                                        Cette commande contient <?=$order['nbre_article']?> article(s).
                                    </p>
                                    <a class="btn btn-success btn-mini" href="<?=site_url('/admin/sendOrder/'.$order['id'])?>" data-placement="top" title="Valider"><i class="fa fa-refresh"></i> Préparer la commande</a>
                                    <a class="btn btn-danger btn-mini" href="<?=site_url('/admin/cancel/'.$order['id'])?>" data-placement="top" title="Annuler"><i class="icon-trash"></i></a>
                                </div>
                            </li>
                        <?php endforeach ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
