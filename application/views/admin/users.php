<div id="breadcrumb">
    <a href="<?=site_url('admin')?>" title="Accueil Dashboard" class="tip-bottom"><i class="icon-home"></i> Dashboard</a>
    Gestion des utilisateurs
</div>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <?php
            if(array_key_exists('message', $_SESSION))
            {
                echo $_SESSION['message'];
                unset($_SESSION['message']);
            }
            ?>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Login</th>
                    <th>Mail</th>
                    <th>Adresse IP</th>
                    <th>Date d'enregistrement</th>
                    <th>Supprimer</th>
                </tr>
                </thead>

                <tbody>
                <?php foreach($users as $user): ?>
                    <tr>
                        <td><?=$user['login']?></td>
                        <td><?=$user['email']?></td>
                        <td><?=$user['ip_register']?></td>
                        <td><?=$user['date_register']?></td>
                        <td style="text-align: center"><a href="<?=site_url('admin/deleteUser/'.$user['id'])?>" class="btn btn-danger"><i class="fa fa-trash-o"></i></a></td>
                    </tr>
                <?php endforeach ?>
                </tbody>

            </table>
        </div>
    </div>
</div>