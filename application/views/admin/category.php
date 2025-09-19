<div id="breadcrumb">
    <a href="<?=site_url('admin')?>" title="Accueil Dashboard" class="tip-bottom"><i class="icon-home"></i> Dashboard</a>
    Catégories
</div>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <div class="widget-box">
                <div class="widget-title"><span class="icon"><i class="fa fa-eye"></i></span><h5>Visualisation</h5></div>
                <div class="widget-content">
                    <div class="row-fluid">
                        <div class="span12">
                            <ul id="sideMenu" class="nav nav-tabs nav-stacked">
                                <?php
                                $levels = 0;
                                $topRight = 0;
                                foreach($categories as $key=>$categorie)
                                {

                                    $left = $categorie['left'];
                                    $right = $categorie['right'];

                                    if ($categorie['id']==1)
                                    {
                                        continue;
                                    }
                                    if ($levels > 0 && $left>$topRight)
                                    {
                                        echo "</ul>";
                                        $levels--;
                                    }
                                    if ($left + 1 != $right)
                                    {
                                        echo "<li><i class='fa fa-chevron-right'></i> ".$categorie['name_categorie'];
                                        echo "<ul>";
                                        $levels++;
                                        $topRight=$right;
                                    }
                                    else
                                    {
                                        echo "<li><i class='fa fa-caret-right'></i> ".$categorie['name_categorie']."</li>";
                                    }

                                }
                                if($levels)
                                {
                                    echo "</ul></li>";
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
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
                <div class="widget-title"><span class="icon"><i class="fa fa-plus"></i></span><h5>Ajouter une catégorie</h5></div>
                <div class="widget-content">
                    <div class="row-fluid">
                        <div class="span12">
                            <form class="form-inline" method="post" action="<?= site_url('/admin/addCategory')?>">

                                <div class="form-group">
                                    <label class="control-label" for="select">Catégorie mère</label>
                                    <div class="controls">
                                <select name="id_parent" id="select" class="form-control span12">
                                    <?php
                                    $levels = 0;
                                    $topRight = 0;
                                    foreach($categories as $key=>$categorie)
                                    {
                                        $left = $categorie['left'];
                                        $right = $categorie['right'];

                                        if ($categorie['id']==1)
                                        {
                                            continue;
                                        }
                                        if ($levels > 0 && $left>$topRight)
                                        {
                                            $levels--;
                                        }
                                        if ($left + 1 != $right)
                                        {
                                            echo "<option value='".$categorie['id']."'>".$sep.$categorie['name_categorie']."</option>";
                                            $levels++;
                                            $topRight=$right;
                                        }
                                        else
                                        {
                                            continue;
                                        }

                                    }
                                    ?>
                                </select>
                        </div>
                    </div><br>
                    <div class="form-group">
                        <label class="control-label" for="new_cat">Nouvelle Catégorie</label>
                        <div class="controls">
                                <input class="form-control span12" name="new_cat" id="new_cat" type="text" placeholder="Nom">
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
                <div class="widget-title"><span class="icon"><i class="fa fa-trash-o"></i></span><h5>Supprimer une catégorie</h5></div>
                <div class="widget-content">
                    <div class="row-fluid">
                        <div class="span12">
                            <form class="form-inline" method="post" action="<?= site_url('/admin/removeCategory')?>">

                                <div class="form-group">
                                    <label class="control-label" for="select">Sélectionner la catégorie à supprimer</label>
                                    <div class="controls">
                                        <select class="form-control span12" name="id_parent" id="select">
                                            <?php
                                            $levels = 0;
                                            $topRight = 0;
                                            foreach($categories as $key=>$categorie)
                                            {
                                                $left = $categorie['left'];
                                                $right = $categorie['right'];

                                                if ($categorie['id']==1)
                                                {
                                                    continue;
                                                }
                                                if ($levels > 0 && $left>$topRight)
                                                {
                                                    echo "</optgroup>";
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
                                                    echo "<option value='".$categorie['id']."'>".$sep.$categorie['name_categorie']."</option>";
                                                }

                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div><br>

                                <div class="control-group">
                                    <div class="controls">
                                        <input class="btn btn-small btn-danger form-control span12" type="submit" value="Supprimer" />
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