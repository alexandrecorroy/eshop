<div class="span9">
    <ul class="breadcrumb">
        <li><a href="<?=base_url()?>">Accueil</a> <span class="divider">/</span></li>
        <li class="active">Recherche sur le site</li>
    </ul>
    <h3>Résultat de votre recherche <i class="fa fa-angle-double-left"></i> <?=$word?> <i class="fa fa-angle-double-right"></i></h3>
    <hr class="soft"/>
    <br class="clr"/>
    <div class="tab-content">
        <div class="tab-pane active" id="listView">
            <?php if($products): ?>

                <?php foreach($products as $product) :?>

                    <?php $countComments = $comments->countCommentsById($product['id_product']) ?>

                    <div class="row">
                        <div class="span2">
                            <img src="<?=base_url()?><?=$product['path']?>" alt=""/>
                        </div>
                        <div class="span4">
                            <h5><?=$product['name_product']?></h5>
                            <p>
                                <?=$product['short_description']?>
                            </p>
                            <?php if($countComments!=0):?>
                                <h4><?php
                                    $avgRating = round($features->avgRating($product['id_product']));
                                    for($i=0;$i<$avgRating;$i++)
                                    {
                                        echo '<i class="fa fa-star"></i>';
                                    }
                                    $diff = 5-$avgRating;
                                    if($diff!=0)
                                    {
                                        for($j=0;$j<$diff;$j++)
                                        {
                                            echo '<i class="fa fa-star-o"></i>';
                                        }
                                    }
                                    ?> (<a href="<?=site_url('view/item/'.$product['id_product'].'#reviews')?>"><?= $countComments==1 ? '1 Avis' : $countComments.' Avis' ?></a>)</h4>
                            <?php endif ?>
                            <br class="clr"/>
                        </div>
                        <div class="span3 alignR">
                            <h3><?=$product['price']?> €</h3><br>

                            <a href="<?=site_url('checkout/addCart/'.$product['id_product'])?>" class="btn btn-large btn-primary"> Ajouter au <i class=" icon-shopping-cart"></i></a>
                            <a href="<?=site_url('view/item/'.$product['id_product'])?>" class="btn btn-large"><i class="icon-zoom-in"></i></a>
                        </div>
                    </div>
                    <hr class="soft"/>

                <?php endforeach ?>

            <?php else: ?>

                Aucun résultat trouvé pour votre recherche.

            <?php endif ?>

        </div>

    </div>

</div>