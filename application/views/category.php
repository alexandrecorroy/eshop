<div class="span9">
    <ul class="breadcrumb">
        <li><a href="<?=base_url()?>">Accueil</a> <span class="divider">/</span></li>
        <li class="active"><?=$features->getNameCategoryById($id)?></li>
    </ul>
    <h3><?=$features->getNameCategoryById($id)?> <small class="pull-right"><?=$features->countItemByCat($id)?> articles disponibles </small></h3>
    <hr class="soft"/>
    <form class="form-horizontal span8 alignR">
        <div class="control-group">


            <input type="hidden" id="js-page-number" value="<?php

            if(array_key_exists('page', $_GET))
            {
                echo $_GET['page'];
            }
            else
            {
                echo 0;
            }
            ?>">

            <input type="hidden" id="js-cat-number" value="<?=$id?>">

            <label class="control-label alignR">Trier par </label>
            <select id="js-sort">
                <option value="0" <?= $sort==0 ? 'selected' : '' ?>>Par nom A - Z</option>
                <option value="1" <?= $sort==1 ? 'selected' : '' ?>>Par nom Z - A</option>
                <option value="2" <?= $sort==2 ? 'selected' : '' ?>>Petits prix d'abord</option>
            </select>
        </div>
    </form>
    <br class="clr"/>
    <div class="tab-content">
        <hr class="soft"/>
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

                <?php

                $article = $features->countItemByCat($id);

                $nbrePagesPossibles = ceil($article/10);

                if(array_key_exists('page',$_GET))
                {
                    $page = $_GET['page'];
                    $previewPage = $page-1;
                    $nextPage = $page+1;
                }
                else
                {
                    $page = 1;
                    $previewPage = $page-1;
                    $nextPage = $page+1;
                }

                ?>
                <?php if($article>9): ?>
                <nav>
                    <ul class="pager">
                        <?php
                        if($previewPage<2)
                        {
                            echo '<li class="previous"><a href="'.base_url().'view/category/'.$id;
                            echo $sort!=0 ? '/'.$sort : '';
                            echo '"><span aria-hidden="true">&larr;</span> Page Précédente</a></li>';
                        }
                        else
                        {
                            echo '<li class="previous"><a href="?page='.$previewPage.'"><span aria-hidden="true">&larr;</span> Page Précédente</a></li>';
                        }

                        ?>

                        <?php
                        if($nbrePagesPossibles==1)
                        {
                            echo '<li class="next"><a href="'.base_url().'view/category/'.$id;
                            echo $sort!=0 ? '/'.$sort : '';
                            echo '">Page Suivante <span aria-hidden="true">&rarr;</span></a></li>';
                        }
                        elseif($page==$nbrePagesPossibles)
                        {
                            echo '<li class="next"><a href="?page='.$nbrePagesPossibles.'">Page Suivante <span aria-hidden="true">&rarr;</span></a></li>';
                        }
                        else
                        {
                            echo '<li class="next"><a href="?page='.$nextPage.'">Page Suivante <span aria-hidden="true">&rarr;</span></a></li>';
                        }

                        ?>
                    </ul>
                </nav>
                <?php endif ?>

            <?php else: ?>

                Pas encore de produits

            <?php endif ?>

        </div>

    </div>

</div>