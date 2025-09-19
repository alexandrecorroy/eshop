<div id="breadcrumb">
    <a href="<?=site_url('admin')?>" title="Accueil Dashboard" class="tip-bottom"><i class="icon-home"></i> Dashboard</a>
    Modifier un mode de livraison
</div>
<div class="container-fluid">
    <?php
    if(array_key_exists('message', $_SESSION))
    {
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    }
    $shipInfo = $shipping->getShippingInfoById($id);
    $price = explode('.', $shipInfo['cost'])
    ?>
    <div class="row-fluid">


        <div class="span12">
            <div class="widget-box">
                <div class="widget-title"><span class="icon"><i class="fa fa-plus"></i></span><h5>Modifier le mode de livraison #<?=$id?></h5></div>
                <div class="widget-content">
                    <div class="row-fluid">
                        <div class="span12">
                            <form class="form-inline" method="post" action="<?= site_url('/admin/updateShipping/'.$id)?>">

                                <div class="form-group">
                                    <label class="control-label" for="name">Nom</label>
                                    <div class="controls">
                                        <input class="form-control span12" name="name" id="name" type="text" placeholder="Nom du mode de livraison" value="<?=$shipInfo['name']?>">
                                    </div>
                                </div><br>

                                <div class="form-group">
                                    <label class="control-label" for="description">Description</label>
                                    <div class="controls">
                                        <textarea class="form-control span12" rows="3" id="description" name="description" placeholder="Durée de livraison, avantages..."><?=$shipInfo['description']?></textarea>
                                    </div>
                                </div><br>

                                <div class="form-group">
                                    <label class="control-label" for="price">Tarif</label>
                                    <div class="controls">
                                        <input class="form-control span4" name="price" id="price" type="number" placeholder="5" value="<?=$price[0]?>"> <i class="fa fa-eur"></i> <input class="form-control span4" name="price_cent" type="number" placeholder="90" value="<?=$price[1]?>">
                                    </div>
                                </div><br>

                                <div class="form-group">
                                    <label class="control-label" for="select">Priorité</label>
                                    <div class="controls">
                                        <select name="priority" id="select" class="form-control span12">
                                            <option value="0" <?= $shipInfo['priority']==0 ? 'selected' : ''?>>Normale</option>
                                            <option value="1" <?= $shipInfo['priority']==1 ? 'selected' : ''?>>Haute</option>
                                        </select>
                                    </div>
                                </div><br>

                                <div class="control-group">
                                    <div class="controls">
                                        <input class="btn btn-small btn-success form-control span2" type="submit" value="Modifier" />
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>