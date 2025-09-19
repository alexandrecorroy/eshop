<div id="breadcrumb">
    <a href="<?=site_url('admin')?>" title="Accueil Dashboard" class="tip-bottom"><i class="icon-home"></i> Dashboard</a>
    Modes de livraison
</div>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Tarif</th>
                    <th>Priorité</th>
                    <th>Etat</th>
                    <th>Modifier</th>
                </tr>
                </thead>

                <tbody>
                <?php
                    $priority = ['Normal','Haute'];
                    $active = ['Désactivé','Activé']
                ?>
                <?php foreach($shipping->getAllShipping() as $row): ?>
                    <tr>
                        <td><?=$row['name']?></td>
                        <td><?=$row['description']?></td>
                        <td><?=$row['cost']?>€</td>
                        <td><?=$priority[$row['priority']]?></td>
                        <td><?=$active[$row['active']]?></td>
                        <td style="text-align: center"><a title="Modifier" href="<?=site_url('admin/editShipping/'.$row['id'])?>" class="btn btn-success"><i class="fa fa-pencil"></i></a></td>
                    </tr>
                <?php endforeach ?>
                </tbody>

            </table>
        </div>
    </div>
    <?php
    if(array_key_exists('message', $_SESSION))
    {
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    }
    ?>
    <div class="row-fluid">


        <div class="span6">
            <div class="widget-box">
                <div class="widget-title"><span class="icon"><i class="fa fa-plus"></i></span><h5>Ajouter un mode de livraison</h5></div>
                <div class="widget-content">
                    <div class="row-fluid">
                        <div class="span12">
                            <form class="form-inline" method="post" action="<?= site_url('/admin/addShipping')?>">

                                <div class="form-group">
                                    <label class="control-label" for="name">Nom</label>
                                    <div class="controls">
                                        <input class="form-control span12" name="name" id="name" type="text" placeholder="Nom du mode de livraison">
                                    </div>
                                </div><br>

                                <div class="form-group">
                                    <label class="control-label" for="description">Description</label>
                                    <div class="controls">
                                        <textarea class="form-control span12" rows="3" id="description" name="description" placeholder="Durée de livraison, avantages..."></textarea>
                                    </div>
                                </div><br>

                                <div class="form-group">
                                    <label class="control-label" for="price">Tarif</label>
                                    <div class="controls">
                                        <input class="form-control span4" name="price" id="price" type="number" placeholder="5"> <i class="fa fa-eur"></i> <input class="form-control span4" name="price_cent" type="number" placeholder="90">
                                    </div>
                                </div><br>

                                <div class="form-group">
                                    <label class="control-label" for="select">Priorité</label>
                                    <div class="controls">
                                        <select name="priority" id="select" class="form-control span12">
                                            <option value="0">Normale</option>
                                            <option value="1">Haute</option>
                                        </select>
                                    </div>
                                </div><br>

                                <div class="control-group">
                                    <div class="controls">
                                        <input class="btn btn-small btn-success form-control span12" type="submit" value="Créer" />
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="span6">
            <div class="widget-box">
                <div class="widget-title"><span class="icon"><i class="fa fa-trash-o"></i></span><h5>Retirer un mode de livraison</h5></div>
                <div class="widget-content">
                    <div class="row-fluid">
                        <div class="span12">
                            <form class="form-inline" method="post" action="<?= site_url('/admin/hideShipping')?>">

                                <div class="form-group">
                                    <label class="control-label" for="select">Sélectionner la livraison à retirer</label>
                                    <div class="controls">
                                        <select class="form-control span12" name="id" id="select">
                                            <?php foreach($shipping->getAllShipping() as $key=>$row): ?>
                                                <?php if($row['active']==1):?>
                                                    <option value="<?=$row['id']?>"><?=$row['name']?></option>
                                                <?php endif ?>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div><br>

                                <div class="control-group">
                                    <div class="controls">
                                        <input class="btn btn-small btn-danger form-control span12" type="submit" value="Retirer" />
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="span6">
            <div class="widget-box">
                <div class="widget-title"><span class="icon"><i class="fa fa-trash-o"></i></span><h5>Réactiver un mode de livraison</h5></div>
                <div class="widget-content">
                    <div class="row-fluid">
                        <div class="span12">
                            <form class="form-inline" method="post" action="<?= site_url('/admin/showShipping')?>">

                                <div class="form-group">
                                    <label class="control-label" for="select">Sélectionner la livraison à réactiver</label>
                                    <div class="controls">
                                        <select class="form-control span12" name="id" id="select">
                                            <?php foreach($shipping->getAllShipping() as $key=>$row): ?>
                                                <?php if($row['active']==0):?>
                                                    <option value="<?=$row['id']?>"><?=$row['name']?></option>
                                                <?php endif ?>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div><br>

                                <div class="control-group">
                                    <div class="controls">
                                        <input class="btn btn-small btn-primary form-control span12" type="submit" value="Réactiver" />
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