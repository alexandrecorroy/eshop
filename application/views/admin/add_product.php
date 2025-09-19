<div id="breadcrumb">
    <a href="<?=site_url('admin')?>" title="Accueil Dashboard" class="tip-bottom"><i class="icon-home"></i> Dashboard</a>
    Ajouter un produit
</div>
<?php
if(array_key_exists('message', $_SESSION))
{
    echo $_SESSION['message'];
    unset($_SESSION['message']);
}
?>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <div class="widget-box">
                <div class="widget-title"><span class="icon"><i class="fa fa-plus"></i></span><h5>Ajouter un produit</h5></div>
                <div class="widget-content">
                    <div class="row-fluid">
                        <div class="span12">

                            <form class="form-inline" method="post" enctype="multipart/form-data">

                                <div class="form-group">
                                    <label class="control-label" for="categorie">Catégorie</label>
                                    <div class="controls">
                                        <select name="id_categorie" id="categorie" class="form-control span12">
                                            <?php
                                            $levels = 0;
                                            $topRight = 0;
                                            foreach($categories as $categorie)
                                            {
                                                $left = $categorie['left'];
                                                $right = $categorie['right'];

                                                if ($categorie['id']==1)
                                                {
                                                    continue;
                                                }
                                                if ($levels > 0 && $left>$topRight)
                                                {
                                                    echo '</optgroup>';
                                                    $levels--;
                                                }
                                                if ($left + 1 != $right)
                                                {
                                                    echo "<optgroup label='".$categorie['name_categorie']."'>";
                                                    $levels++;
                                                    $topRight=$right;
                                                }
                                                else
                                                {
                                                    echo "<option value='".$categorie['id']."'>".$categorie['name_categorie']."</option>";
                                                }

                                            }

                                            ?>
                                        </select><br>
                                    </div>
                                </div><br>

                                <div class="form-group">
                                    <label class="control-label" for="name_product">Nom</label>
                                    <div class="controls">
                                        <input class="form-control span12" name="name_product" id="name_product" type="text" placeholder="Nom">
                                    </div>
                                </div><br>

                                <div class="form-group">
                                    <label class="control-label" for="vignette">Vignette (Non Obligatoire)</label>
                                    <div class="controls">
                                        <input class="form-control span12" name="vignette" id="vignette" type="file">
                                    </div>
                                </div><br>

                                <div class="form-group">
                                    <label class="control-label" for="images">Vos images (Non Obligatoire)</label>
                                    <div class="controls">
                                        <input class="form-control span12" name="images[]" id="images" type="file" multiple>
                                    </div>
                                </div><br>

                                <div class="form-group">
                                    <label class="control-label" for="short_description">Résumé</label>
                                    <div class="controls">
                                        <textarea class="form-control span12" name="short_description" id="short_description"></textarea>
                                    </div>
                                </div><br>

                                <div class="form-group">
                                    <label class="control-label" for="long_description">Détails</label>
                                    <div class="controls">
                                        <textarea class="form-control span12" rows="20" name="long_description" id="long_description"></textarea>
                                    </div>
                                </div><br>

                                <div class="form-group">
                                    <label class="control-label" for="price">Prix</label>
                                    <div class="controls">
                                        <input class="form-control span3" type="number" name="price" id="price"> <i class="fa fa-eur"></i> <input class="form-control span3" type="number" name="price_cents" maxlength="2" value="00">
                                    </div>
                                </div><br>

                                <div class="form-group">
                                    <label class="control-label" for="stock">Stock</label>
                                    <div class="controls">
                                        <input class="form-control span3" type="number" name="stock" id="stock">
                                    </div>
                                </div><br>

                                <div class="control-group">
                                    <div class="controls">
                                        <input class="btn btn-large btn-success form-control" type="submit" value="Ajouter" />
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