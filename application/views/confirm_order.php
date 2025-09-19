<div class="span9">
    <ul class="breadcrumb">
        <li><a href="<?=base_url()?>">Accueil</a> <span class="divider">/</span></li>
        <li><a href="<?=site_url('checkout/cart/')?>">Votre Panier</a> <span class="divider">/</span></li>
        <li class="active">Récapitulatif de commande</li>
    </ul>

    <hr class="soft"/>

    <h4>Récapitulatif de commande</h4>

    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Produit</th>
            <th>Description</th>
            <th>Quantité</th>
            <th>Total</th>
        </tr>
        </thead>
        <tbody>
        <?php

        if(array_key_exists('coupon', $_SESSION))
        {
            $coupon = $_SESSION['coupon'];
        }
        else
        {
            $coupon = '';
        }

        $globalPrice = 0;
        $totalPrice = 0;
        $globalPriceNoReduc = 0;

        ?>

        <?php foreach ($items as $key=>$item):?>

            <?php
            $quantity = $_SESSION['cart'][$key]['quantity'];
            $totalPrice = $quantity*$item['price'];



            $globalPriceNoReduc += $totalPrice;

            $globalPrice += $totalPrice;

            ?>

            <tr>
                <td> <img width="60" src="<?=base_url()?><?=$item['path']?>" alt=""/></td>
                <td><?=$item['name_product']?><br/><?=$item['name_categorie']?></td>
                <td><?=$_SESSION['cart'][$key]['quantity']?></td>
                <td><?=$totalPrice?>€</td>
            </tr>

        <?php endforeach ?>

        <?php
        $globalPrice = round($globalPrice, 2);
        $globalPriceNoReduc = round($globalPriceNoReduc, 2);

        if($coupon!='')
        {

            $globalPrice = round($globalPrice-(($globalPriceNoReduc/100)*$coupon),2);
        }

        $totalTaxes = round(((($globalPrice)/100)*20), 2);
        ?>

        <tr>
            <td colspan="3" style="text-align:right">Coupon réduction :	</td>
            <td> <?php if($coupon!='')
                {
                    echo round((($globalPriceNoReduc/100)*$coupon),2).'€';
                } ?></td>
        </tr>
        <tr>
            <td colspan="3" style="text-align:right">Prix Total :	</td>
            <td> <?=$globalPrice?></td>
        </tr>
        <tr>
            <td colspan="3" style="text-align:right">Livraison :	</td>
            <td> <?=$shipping['cost']?>€</td>
        </tr>
        <tr>
            <td colspan="3" style="text-align:right"><strong>TOTAL A PAYER =</strong></td>
            <td class="label label-important" style="display:block"> <strong> <?= $globalPrice+$shipping['cost'] ?>€</strong></td>
        </tr>
        </tbody>
    </table>

    <a href="<?=site_url('/checkout/shipping')?>" class="btn btn-large"><i class="icon-arrow-left"></i> Choix mode de livraison </a>
    <a href="<?=site_url('/checkout/addOrder')?>" class="btn btn-large pull-right">Je procède au paiement <i class="icon-arrow-right"></i></a>


</div>