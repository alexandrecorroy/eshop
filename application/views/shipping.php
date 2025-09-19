<div class="span9">
    <ul class="breadcrumb">
        <li><a href="<?=base_url()?>">Accueil</a> <span class="divider">/</span></li>
        <li><a href="<?=site_url('checkout/cart/')?>">Votre Panier</a> <span class="divider">/</span></li>
        <li class="active">Mode de livraison</li>
    </ul>

    <hr class="soft"/>

<h4>Choisir son mode de livraison</h4>

<form method="post" action="<?= site_url('/checkout/confirmShipping')?>">


    <?php for($i=0; $i<count($shipping); $i++): ?>

        <div class="radio">
            <label for="<?=$shipping[$i]['name']?>">
                <input type="radio" name="ship" id="<?=$shipping[$i]['name']?>" value="<?=$shipping[$i]['id']?>" <?=$i==0 ? 'checked' : ''?>>
                <?=$shipping[$i]['name']?>
                <p><?=$shipping[$i]['description']?></p>
                <strong>Tarif : <?=$shipping[$i]['cost']?>€</strong>
            </label>
        </div>

    <?php endfor ?>
    <br>
     <a href="<?=site_url('checkout/validate/')?>" class="btn btn-large"><i class="icon-arrow-left"></i> Adresse de livraison</a><button class="btn btn-large pull-right">Récapitulatif de commande <i class="icon-arrow-right"></i></button>


</form>

</div>