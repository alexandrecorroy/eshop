<div class="span9">
    <ul class="breadcrumb">
        <li><a href="<?=base_url()?>">Accueil</a> <span class="divider">/</span></li>
        <li><a href="<?=site_url('/view/category/'.$game['id_categorie'])?>"><?=$game['name_categorie']?></a> <span class="divider">/</span></li>
        <li class="active"><?=$game['name_product']?></li>
    </ul>
    <div class="row">
        <div id="gallery" class="span3">
            <a href="<?=base_url()?>/<?=$game['path']?>" title="<?=$game['name_product']?>">
                <img src="<?=base_url()?><?=$game['path']?>" style="width:100%" alt="<?=$game['name_product']?>"/>
            </a>
            <div id="differentview" class="moreOptopm carousel slide">
                <div class="carousel-inner">

                    <div class="item active">
                        <?php foreach($images as $key=>$image): ?>
                            <?php
                            if($key==3)
                            {
                                echo "</div>";
                                echo '<div class="item">';
                            }
                            ?>
                            <a href="<?=base_url()?><?=$image['path']?>"> <img style="width:29%" src="<?=base_url()?><?=$image['path']?>" alt=""/></a>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="span6">
            <?php
            if(array_key_exists('admin', $_SESSION))
            {
                echo '<a href="'.site_url('/admin/removeItem/'.$id).'"><button class="btn btn-sm btn-danger pull-right"><i class="fa fa-trash-o"></i> Supprimer ce produit</button></a>';
                echo '<a href="'.site_url('/admin/editProduct/'.$id).'"><button class="btn btn-sm btn-warning pull-left"><i class="fa fa-pencil"></i> Editer ce produit</button></a>';
                echo '<span class="clearfix"></span>';
            }
            ?>
            <h3><?=$game['name_product']?></h3>

                <h4 class="pull-left"><?=$game['stock']?> articles en stock</h4><h4 class="pull-right"><?php
                $avgRating = round($avgRating);
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
                ?> (<?= (count($comments))==1 ? '1 Avis' : count($comments).' Avis' ?>)</h4>
            <span class="clearfix"></span>
            <hr class="soft"/>
            <small><?=$game['short_description']?></small>
            <hr class="soft"/>
            <p class="lead pull-left">Seulement <?=$game['price']?> euros</p>

            <a href="<?=site_url('/checkout/addCart/'.$id)?>"><button class="btn btn-sm btn-primary pull-right"> Ajouter au panier <i class=" icon-shopping-cart"></i></button></a>


        </div>

        <div class="span9">
            <ul id="productDetail" class="nav nav-tabs">
                <li class="active"><a href="#reviews" data-toggle="tab">Commentaires</a></li>
                <li><a href="#description" data-toggle="tab">Détails du produit</a></li>
                <li><a href="#profile" data-toggle="tab">Produits similaires</a></li>
            </ul>
            <div id="myTabContent" class="tab-content">
                <div class="tab-pane fade active in" id="reviews">
                    <?php if($comments!=null): ?>

                        <?php foreach ($comments as $comment):?>
                            <div class="alert alert-success">
                                <?php
                                if(array_key_exists('admin', $_SESSION))
                                {
                                    echo '<a title="Supprimer ce commentaire" href="'.site_url('/admin/deleteCommentFromItem/'.$comment['id'].'/'.$id).'"><button type="button" class="close" data-dismiss="alert">×</button></a>';
                                }

                                ?>

                            <i class="fa fa-user"></i> <?= $comment['login'] ?> (<?= $comment['date_comment'] ?>) <?php
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
                                ?><br>
                            <i class="fa fa-quote-left"></i> <?= $comment['comment'] ?> <i class="fa fa-quote-right"></i>

                            </div>

                        <?php endforeach ?>


                    <?php endif ?>
                    <h4>Ajouter un commentaire</h4>
                    <?php if(array_key_exists('id', $_SESSION)): ?>
                    <div class="well">

                        <?php
                        if(array_key_exists('comment', $_SESSION))
                        {
                            echo $_SESSION['comment'];
                            unset($_SESSION['comment']);
                        }

                        ?>

                        <form class="form-horizontal" method="post" action="<?= site_url('view/add_comment') ?>">

                            <input type="hidden" name="id_game" value="<?=$id?>">

                        <div class="control-group">
                            <label class="control-label" for="rating">Note :</label>
                            <div class="controls">
                            <select class="span1" name="rating" id="rating">
                                <option value="">-</option>
                                <option value="5">5</option>
                                <option value="4">4</option>
                                <option value="3">3</option>
                                <option value="2">2</option>
                                <option value="1">1</option>
                            </select>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="aditionalInfo">Commentaire :</label>
                            <div class="controls">
                            <textarea name="comment" id="aditionalInfo" rows="5"></textarea>
                            </div>
                        </div>
                            <div class="control-group">
                                <div class="controls">
                                    <input class="btn btn-md btn-success" type="submit" value="Envoyer" />
                                </div>
                            </div>


                        </form>
                    </div>
                    <?php else: ?>

                        Vous devez être connecté pour laisser un commentaire.

                    <?php endif ?>
                </div>
                <div class="tab-pane fade" id="description">
                    <h4>Information du produit</h4>
                    <?=$game['long_description']?>
                </div>
                <div class="tab-pane fade" id="profile">
                    <div class="tab-content">
                        <div class="tab-pane active">
                            <ul class="thumbnails">
                                <?php foreach($randomProducts as $product) :?>
                                    <?php if($product['id_product']!=$id): ?>
                                    <li class="span3">
                                        <div class="thumbnail">
                                            <a  href="<?=site_url('view/item/'.$product['id_product'])?>"><img src="<?= base_url().$product['path']?>" alt="vignette <?=$product['name_product']?>"/></a>
                                            <div class="caption">
                                                <h5><?=$product['name_product']?></h5>
                                                <h4 style="text-align:center"><a class="btn" href="<?=site_url('checkout/addCart/'.$product['id_product'])?>">Acheter <i class="icon-shopping-cart"></i></a> <a class="btn btn-primary" href="<?=site_url('view/item/'.$product['id_product'])?>"><?=$product['price']?>€</a></h4>
                                            </div>
                                        </div>
                                    </li>
                                    <?php endif ?>
                                <?php endforeach ?>
                            </ul>
                            <hr class="soft"/>
                        </div>
                    </div>
                    <br class="clr">
                </div>
            </div>
        </div>

    </div>
</div>