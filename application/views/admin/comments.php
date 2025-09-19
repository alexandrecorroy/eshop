<div id="breadcrumb">
    <a href="<?=site_url('admin')?>" title="Accueil Dashboard" class="tip-bottom"><i class="icon-home"></i> Dashboard</a>
    Commentaires
</div>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <?php if($comments->showCommentsUnvalidate()!=null): ?>
            <div class="widget-box">
                <div class="widget-title"><span class="icon"><i class="icon-comment"></i></span><h5>Commentaires en attente</h5><span title="Total des commentaires en attente" class="label label-info tip-left"><?=$features->countUnvalidateComments()?></span></div>
                <div class="widget-content nopadding">
                    <ul class="recent-comments">
                        <?php foreach($comments->showCommentsUnvalidate() as $comment): ?>
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
                                        <a class="btn btn-success btn-mini" href="<?=site_url('admin/approveComment/'.$comment['id'])?>" data-placement="top" title="Approuver"><i class="icon-ok"></i></a>
                                    <a class="btn btn-danger btn-mini" href="<?=site_url('admin/deleteComment/'.$comment['id'])?>" data-placement="top" title="Supprimer"><i class="icon-trash"></i></a>
                                    <a class="btn btn-warning btn-mini" href="<?=site_url('view/item/'.$comment['id_product'])?>" data-placement="top" title="Voir le produit"><i class="fa fa-eye"></i></a>
                                </div>
                            </li>
                        <?php endforeach ?>
                    </ul>
                </div>
            </div>
            <?php endif ?>

            <div class="widget-box">
                <div class="widget-title"><span class="icon"><i class="fa fa-comments"></i></span><h5>Derniers commentaires validés</h5><span title="Total des commentaires validés" class="label label-info tip-left"><?=$features->countValidateComments()?></span></div>
                <div class="widget-content nopadding">
                    <ul class="recent-comments">
                        <?php foreach($comments->showCommentsValidate() as $comment): ?>
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
                                    <a class="btn btn-danger btn-mini" href="<?=site_url('admin/deleteComment/'.$comment['id'])?>" data-placement="top" title="Supprimer"><i class="icon-trash"></i></a>
                                    <a class="btn btn-warning btn-mini" href="<?=site_url('view/item/'.$comment['id_product'])?>" data-placement="top" title="Voir le produit"><i class="fa fa-eye"></i></a>
                                </div>
                            </li>
                        <?php endforeach ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>