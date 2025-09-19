<div id="breadcrumb">
    <a href="<?=site_url('admin')?>" title="Accueil Dashboard" class="tip-bottom"><i class="icon-home"></i> Dashboard</a>
    Modifier un produit
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
                <div class="widget-title"><span class="icon"><i class="fa fa-plus"></i></span><h5>Modifier le produit Réf. <?=$id?></h5></div>
                <div class="widget-content">
                    <div class="row-fluid">
                        <div class="span12">

                            <form class="form-inline" method="post" enctype="multipart/form-data">

                                <input type="hidden" name="id_article" value="<?=$id?>">

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
                                                    echo "<option value='".$categorie['id']."' ";
                                                    echo $product['id_categorie']==$categorie['id'] ? 'selected' : '';
                                                    echo ">".$categorie['name_categorie']."</option>";
                                                }

                                            }

                                            ?>
                                        </select><br>
                                    </div>
                                </div><br>

                                <?php
                                $price = explode('.', $product['price']);
                                ?>

                                <div class="form-group">
                                    <label class="control-label" for="name_product">Nom</label>
                                    <div class="controls">
                                        <input class="form-control span12" name="name_product" id="name_product" type="text" placeholder="Nom" value="<?=$product['name_product']?>">
                                    </div>
                                </div><br>

                                <div class="form-group">
                                    <label class="control-label" for="vignette">Vignette (écrasera la précédente si renseignée)</label>
                                    <div class="controls">
                                        <input class="form-control span12" name="vignette" id="vignette" type="file">
                                    </div>
                                </div><br>
                                <div class="well">
                                <h5>Vignette actuelle :</h5>
                                <?php
                                echo "<img src='".base_url().$product['path']."' width='200px' height='auto'><br><br>";
                                ?>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="images">Vos images (ajoute aux précédentes)</label>
                                    <div class="controls">
                                        <input class="form-control span12" name="images[]" id="images" type="file" multiple>
                                    </div>
                                </div><br>
                                <div class="well images">
                                <h5>Images actuelles :</h5>
                                <?php
                                foreach ($images as $image)
                                {
                                    echo "<figure><img src='".base_url().$image['path']."' width='200px' height='auto'><br>";
                                    echo "<figcaption><a href='".site_url('admin/deleteOneImage/'.$image['id'].'/'.$id)."'>Supprimer cette image</a></figcaption></figure>";
                                }

                                ?>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="short_description">Résumé</label>
                                    <div class="controls">
                                        <textarea class="form-control span12" name="short_description" id="short_description"><?=$product['short_description']?></textarea>
                                    </div>
                                </div><br>

                                <div class="form-group">
                                    <label class="control-label" for="long_description">Détails</label>
                                    <div class="controls">
                                        <textarea class="form-control span12" rows="20" name="long_description" id="long_description"><?=htmlentities($product['long_description'])?></textarea>
                                    </div>
                                </div><br>

                                <div class="form-group">
                                    <label class="control-label" for="price">Prix</label>
                                    <div class="controls">
                                        <input class="form-control span3" type="number" name="price" id="price" value="<?=$price[0]?>"> <i class="fa fa-eur"></i> <input class="form-control span3" type="number" name="price_cents" maxlength="2" value="<?=$price[1]?>">
                                    </div>
                                </div><br>

                                <div class="form-group">
                                    <label class="control-label" for="stock">Stock</label>
                                    <div class="controls">
                                        <input class="form-control span3" type="number" name="stock" id="stock" value="<?=$product['stock']?>">
                                    </div>
                                </div><br>

                                <div class="control-group">
                                    <div class="controls">
                                        <input class="btn btn-large btn-success form-control" type="submit" value="Modifier" />
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