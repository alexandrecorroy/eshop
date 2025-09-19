<div class="span9">
    <h4>Derniers produits ajoutés</h4>
        <?php if($products): ?>

        <ul class="thumbnails">

            <?php foreach($products as $product) :?>
                <li class="span3">
                    <div class="thumbnail">
                        <a  href="<?=site_url('view/item/'.$product['id_product'])?>"><img src="<?= base_url().$product['path']?>" alt="vignette <?=$product['name_product']?>"/></a>
                        <div class="caption">
                            <h5><?=$product['name_product']?></h5>
                            <h4 style="text-align:center"><a class="btn" href="<?=site_url('checkout/addCart/'.$product['id_product'])?>">Acheter <i class="icon-shopping-cart"></i></a> <a class="btn btn-primary" href="<?=site_url('view/item/'.$product['id_product'])?>"><?=$product['price']?>€</a></h4>
                        </div>
                    </div>
                </li>
            <?php endforeach ?>

        </ul>

        <?php else: ?>

            Pas encore de produits

        <?php endif ?>

</div>
