<div id="breadcrumb">
    <a href="<?=site_url('admin')?>" title="Accueil Dashboard" class="tip-bottom"><i class="icon-home"></i> Dashboard</a>
    Rechercher une commande
</div>

<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">

            <form method="post" class="form-inline">
                <div class="form-group">
                    <div class="controls">
                        <input class="form-control" type="number" name="search_order" placeholder="Numéro de commande">
                    </div>
                </div><br>

                <div class="form-group">
                    <div class="controls">
                        <input class="btn btn-small btn-primary form-control" type="submit" value="Rechercher" />
                    </div>
                </div>
            </form><br><br>

            <?php if(!empty($order)): ?>

                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Numéro de commande</th>
                        <th>Date d'achat</th>
                        <th>Montant réglé</th>
                        <th>Mode de livraison</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php

                    $status = ['Payée', 'En Préparation', 'Envoyée', 'Annulée'];

                    echo "<tr>";
                    echo "<td>".$order['id']."</td>";
                    echo "<td>".$order['date_achat']."</td>";
                    echo "<td>".($order['total_products_price']+$order['shipping_cost'])." €</td>";
                    echo "<td>".$order['ship_name']."</td>";
                    echo "<td>".$status[$order['status']]."</td>";
                    echo "</tr>";
                    ?>
                    </tbody>
                </table>

            <h4>Détail de votre commande #<?=$order['id']?></h4>

                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Désignation</th>
                        <th>Prix Unitaire TTC</th>
                        <th>Quantité</th>
                        <th>Prix Total</th>
                    </tr>
                    </thead>

                    <tbody>

                <?php foreach($orderDetails as $item): ?>
                <?php
                    $price = 0;

                    $price = $item['quantity']*$item['price_product'];
                ?>

                <tr><td><?=$item['name_product']?></td><td><?=$item['price_product']?>€</td><td><?=$item['quantity']?></td><td><?=$price?>€</td></tr>

                <?php endforeach ?>

                </tbody>
                </table>
                <h5>Adresse de livraison :</h5>
                <p>
                    <?=$order['nom']?> <?=$order['prenom']?><br/><br/>
                    <?=$order['adresse']?><br/>
                    <?=$order['code_postal']?> <?=$order['ville']?><br>
                    Téléphone :  <?=$order['telephone']?><br/>
                </p>
                <?php if($order['shipping_info']):?>
                    <p>
                        Lien de suivi : <a href="<?=$order['shipping_info']?>"><?=$order['shipping_info']?></a>
                    </p>
                <?php endif ?>

            <?php else :?>

                <?php if($id!=0): ?>
                <p>Aucune commande correspondante.</p>
                <?php endif ?>

            <?php endif ?>
        </div>
    </div>