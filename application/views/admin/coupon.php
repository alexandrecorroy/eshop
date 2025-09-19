<div id="breadcrumb">
    <a href="<?=site_url('admin')?>" title="Accueil Dashboard" class="tip-bottom"><i class="icon-home"></i> Dashboard</a>
    Coupons de réduction
</div>
<div class="container-fluid">

    <?php
    if(array_key_exists('message', $_SESSION))
    {
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    }
    ?>
    <div class="row-fluid">

        <div class="span6">
            <div class="row-fluid">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Code</th>
                    <th>Réduction</th>
                    <th>Supprimer</th>
                </tr>
                </thead>

                <tbody>
                <?php foreach($coupons as $coupon): ?>
                    <tr>
                        <td><?=$coupon['id']?></td>
                        <td><?=$coupon['code']?></td>
                        <td><?=$coupon['reduc_pourcentage']?>%</td>
                        <td style="text-align: center"><a title="Supprimer" href="<?=site_url('admin/deleteCoupon/'.$coupon['id'])?>" class="btn btn-danger"><i class="fa fa-trash-o"></i></a></td>
                    </tr>
                <?php endforeach ?>
                </tbody>

            </table>
                </div>
        </div>
        <div class="span6">
            <div class="widget-box">
                <div class="widget-title"><span class="icon"><i class="fa fa-plus"></i></span><h5>Ajouter un code de réduction</h5></div>
                <div class="widget-content">
                    <div class="row-fluid">
                        <div class="span6">
                            <form class="form-inline" method="post" action="<?= site_url('/admin/addCoupon')?>">

                                <div class="form-group">
                                    <label class="control-label" for="code">Code</label>
                                    <div class="controls">
                                        <input class="form-control span12" name="code" id="code" type="text" placeholder="Code de réduction">
                                    </div>
                                </div><br>

                                <div class="form-group">
                                    <label class="control-label" for="reduc">Réduction</label>
                                    <div class="controls">
                                        <input class="form-control span4" name="reduc" id="reduc" type="number" placeholder="5">
                                        <span class="input-group-addon">%</span>
                                    </div>
                                </div><br>

                                <div class="control-group">
                                    <div class="controls">
                                        <input class="btn btn-small btn-success form-control span12" type="submit" value="Ajouter" />
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