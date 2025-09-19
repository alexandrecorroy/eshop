<div id="breadcrumb">
    <a href="<?=site_url('admin')?>" title="Accueil Dashboard" class="tip-bottom"><i class="icon-home"></i> Dashboard</a>
    Préparation de la commande N°<?=$id?>
</div>

<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <h4>Bon de commande N°<?=$id?></h4>

                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Référence</th>
                        <th>Intitulé de l'article</th>
                        <th>Quantité</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php

                    foreach($products as $product)
                    {
                        echo '<tr>';
                        echo '<td>'.$product['id_product'].'</td>';
                        echo '<td>'.$product['name_product'].'</td>';
                        echo '<td>'.$product['quantity'].'</td>';
                        echo '<tr>';
                    }

                    ?>
                    </tbody>
                </table>

                <h5>Adresse de livraison :</h5>
                <p>
                    <?=$userAdresse['nom']?> <?=$userAdresse['prenom']?><br/><br/>
                    <?=$userAdresse['adresse']?><br/>
                    <?=$userAdresse['code_postal']?> <?=$userAdresse['ville']?><br>
                    Téléphone :  <?=$userAdresse['telephone']?><br/>
                </p>

                <div class="widget-box">
                    <div class="widget-title"><span class="icon"><i class="fa fa-truck"></i></span><h5>Mode de livraison : <?=$userAdresse['ship_name']?></h5></div>
                    <div class="widget-content">
                        <div class="row-fluid">
                            <div class="span12">
                                <form class="form-inline" action="<?=site_url('/admin/submitSendOrder')?>" method="post">

                                    <div class="form-group">
                                        <label class="control-label" for="tracking">Lien de suivi <?=$userAdresse['ship_name']?></label>
                                        <div class="controls">
                                            <input class="form-control span12" name="tracking" id="tracking" placeholder="http://...">
                                        </div>
                                    </div><br>

                                    <div class="control-group">
                                        <div class="controls">
                                            <input type="hidden" name="id" value="<?=$id?>">
                                            <button style="margin-left: 0" class="btn btn-primary form-control span3" type="submit"><i class="fa fa-paper-plane"></i> Expédier la commande</button>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <p><a href="<?=site_url('/admin/cancel/'.$id)?>" style="margin-left: 0" class="btn btn-danger form-control span2" type="submit">Annuler la commande</a></p>

        </div>
    </div>
</div>