<div class="span9">
    <ul class="breadcrumb">
        <li><a href="<?=base_url()?>">Accueil</a> <span class="divider">/</span></li>
        <li><a href="<?=site_url('user/panel/')?>">Mon compte</a> <span class="divider">/</span></li>
        <li class="active">Listing des commandes</li>
    </ul>

    <?php if(!empty($orders)): ?>

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Numéro de commande</th>
                <th>Date d'achat</th>
                <th>Montant réglé</th>
                <th>Mode de livraison</th>
                <th>Status</th>
                <th>Détail</th>
            </tr>
            </thead>
            <tbody>
            <?php

            $status = [];

            $status = ['Payée', 'En Préparation', 'Envoyée', 'Annulée'];

            foreach($orders as $order)
            {
                echo "<tr>";
                echo "<td>".$order['id']."</td>";
                echo "<td>".$order['date_achat']."</td>";
                echo "<td>".($order['total_products_price']+$order['shipping_cost'])." €</td>";
                echo "<td>".$order['ship_name']."</td>";
                echo "<td>".$status[$order['status']]."</td>";
                echo "<td style='text-align:center;font-size:1.3rem;'><a class='js-link' href='".site_url('/user/ordersDetails/'.$order['id'])."'><i class='fa fa-eye'></i></a></td>";
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>

<div id="js-order-detail">

</div>
    <?php else :?>

        <p>Aucune commande enregistrée.</p>

    <?php endif ?>

</div>