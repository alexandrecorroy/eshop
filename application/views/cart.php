<div class="span9">
    <ul class="breadcrumb">
        <li><a href="<?=base_url()?>">Accueil</a> <span class="divider">/</span></li>
        <li class="active"> Panier</li>
    </ul>
    <h3>  Votre Panier<?php if(array_key_exists('cart', $_SESSION)):?><?php if($_SESSION['cart']!=null):?> [ <small><?=count($_SESSION['cart'])?> article(s) </small>]<a href="<?=site_url('/checkout/delete')?>" class="btn btn-large pull-right"><i class="fa fa-trash-o"></i> Vider son panier</a><?php endif?><?php endif?></h3>
    <hr class="soft"/>

    <?php if(array_key_exists('cart', $_SESSION)):?>

        <?php if($_SESSION['cart']!=null):?>


            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Produit</th>
                    <th>Description</th>
                    <th>Quantité/Suppression</th>
                    <th>Prix Unitaire</th>
                    <th>TVA Unitaire</th>
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
                        <td>
                            <div class="input-append">
                                <form method='post' class='quantityForm' action='<?=site_url('/checkout/updateCart')?>'>
                                    <input type='hidden' name='field' value='<?=$key?>'>
                                    <select name='quantity'>

                                        <?php
                                        for($i=1;$i<5;$i++)
                                        {
                                            echo "<option value='$i' ";
                                            echo $i==$quantity ? 'selected' : '';
                                            echo ">$i</option>";
                                        }
                                        ?>
                                    </select><a href="<?=site_url('/checkout/deleteItem/'.$key)?>"><button class="btn btn-danger" type="button"><i class="icon-remove icon-white"></i></button></a></form>				</div>
                        </td>
                        <td><?=$item['price']?>€</td>
                        <td><?=round(((($item['price'])/100)*20), 2)?>€</td>
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
                    <td colspan="5" style="text-align:right">Prix Total :	</td>
                    <td> <?=$globalPriceNoReduc?>€</td>
                </tr>
                <tr>
                    <td colspan="5" style="text-align:right">Coupon réduction :	</td>
                    <td> <?php if($coupon!='')
                        {
                            echo round((($globalPriceNoReduc/100)*$coupon),2).'€';
                        } ?></td>
                </tr>
                <tr>
                    <td colspan="5" style="text-align:right">Taxes (20%) :	</td>
                    <td> <?=$totalTaxes?>€</td>
                </tr>
                <tr>
                    <td colspan="5" style="text-align:right"><strong>TOTAL (Hors Livraison) =</strong></td>
                    <td class="label label-important" style="display:block"> <strong> <?=$globalPrice?>€</strong></td>
                </tr>
                </tbody>
            </table>


            <table class="table table-bordered">
                <tbody>
                <tr>
                    <td>
                        <?php if(array_key_exists('coupon', $_SESSION)):?>

                            <?php if($coupon!=''):?>

                            <div class="alert">
                                Le code de réduction <?=$_SESSION['coupon_code']?> vous donne droit à <strong><?=$coupon?>%</strong> sur votre panier.
                            </div>
                            <?php endif ?>
                        <?php endif ?>
                        <form class="form-horizontal" method="post" action="">
                            <div class="control-group">
                                <label class="control-label"><strong> Coupon de réduction : </strong> </label>
                                <div class="controls">
                                    <input type="text" class="input-medium" placeholder="CODE" name="coupon">
                                    <button class="btn"> AJOUTER </button>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="controls">
                                    <small>Exemple : 5POURCENT</small>
                                </div>
                            </div>
                        </form>
                    </td>
                </tr>

                </tbody>
            </table>

            <a href="<?=base_url()?>" class="btn btn-large"><i class="icon-arrow-left"></i> Continuer le Shopping </a>
            <a href="<?=site_url('/checkout/validate')?>" class="btn btn-large pull-right">Valider <i class="icon-arrow-right"></i></a>

        <?php else:?>

            Votre panier est vide.
            <?php if(array_key_exists('coupon',$_SESSION))
            {
                unset($_SESSION['coupon']);
            }
            ?>
        <?php endif ?>

    <?php else:?>

        Votre panier est vide.
        <?php if(array_key_exists('coupon',$_SESSION))
        {
            unset($_SESSION['coupon']);
        }
        ?>
    <?php endif ?>


</div>