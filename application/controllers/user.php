<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends MY_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function login()
    {
        if(array_key_exists('login', $_SESSION))
        {
            redirect('/');
        }

        if(array_key_exists('login', $_POST) && array_key_exists('password', $_POST))
        {
            $this->load->model("Model_user", '', true);
            $verifUser = $this->Model_user->verifUser($_POST['login'], $_POST['password']);
            if($verifUser)
            {
                $idUser = $this->Model_user->getIdUser($_POST['login']);
                $admin = $this->Model_user->getUserStatut($idUser['id']);
                if($admin['status']==1)
                {
                    $_SESSION['admin'] = 1;
                }
                $_SESSION['id'] = $idUser['id'];
                $_SESSION['login']=$_POST['login'];
                redirect($_SERVER["HTTP_REFERER"]);


            }
            else
            {

                $_SESSION['error']='<div class="alert alert-block alert-error fade in">
		<button type="button" class="close" data-dismiss="alert">×</button>
		<strong>Les informations rentrées sont erronées.</strong></div>';
                redirect($_SERVER["HTTP_REFERER"]);
            }
        }

    }

    public function logout()
    {
        session_destroy();
        redirect('/');
    }

    public function register()
    {
        $features = new Model_features();
        $categories = new Model_categories();
        if(array_key_exists('login', $_SESSION))
        {
            redirect('/');
        }

        $this->load->template('register', array('categories'=>$categories->showAllCategories(), 'features'=>$features));
    }

    public function create_user()
    {

        if(array_key_exists('login', $_POST) && array_key_exists('email', $_POST) && array_key_exists('password', $_POST) && array_key_exists('ip', $_POST))
        {

            if(!empty($_POST['login']) && !empty($_POST['password']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) && !empty($_POST['ip']))
            {
                $this->load->model("Model_user", '', true);
                $createUser = new Model_user();

                if($createUser->emailExists($_POST['email']))
                {
                    $_SESSION['errorRegister'] = '<div class="alert alert-block alert-error fade in"><button type="button" class="close" data-dismiss="alert">×</button>Cette adresse mail existe déjà.</div>';
                    redirect('user/register');
                    exit;
                }
                if($createUser->loginExists($_POST['login']))
                {
                    $_SESSION['errorRegister'] = '<div class="alert alert-block alert-error fade in"><button type="button" class="close" data-dismiss="alert">×</button>Le login existe déjà.</div>';
                    redirect('user/register');
                    exit;
                }
                $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

                $lastId = $createUser->create($_POST['login'], $_POST['email'], $password, $_POST['ip']);

                $_SESSION['id'] = $lastId;
                $_SESSION['login'] = $_POST['login'];

                /* MAIL */

                $sujet = "Bienvenue ".$_POST['login'];
                $message = "<p>Bonjour ".$_POST['login'].",</p><br><p>Merci pour votre inscription sur notre boutique en ligne. Vous pouvez dès maintenant effectuer des achats.</p><p>Rappel des informations fournies : <br><br>Login : ".$_POST['login']."<br>Mot de passe : ".$_POST['password']."</p><p>Votre Boutique en ligne.</p>";
                $email = $_POST['email'];

                $this->load->model("Model_mails", '', true);
                $mail = new Model_mails();

                $mail->send($sujet, $message, $email);

                /* END MAIL */

                redirect('/');
            }
            else
            {
                $_SESSION['errorRegister'] = '<div class="alert alert-block alert-error fade in"><button type="button" class="close" data-dismiss="alert">×</button>Les champs sont mals renseignés.</div>';
                redirect('user/register');
            }

        }

    }

    public function addDetails($true)
    {

        if(array_key_exists('nom', $_POST) && array_key_exists('prenom', $_POST) && array_key_exists('adresse', $_POST) && array_key_exists('cp', $_POST) && array_key_exists('ville', $_POST) && array_key_exists('tel', $_POST))
        {
            if($_POST['nom']!='' && $_POST['prenom']!='' && $_POST['adresse']!='' && is_numeric($_POST['cp']) && $_POST['ville']!='' && is_numeric($_POST['tel']))
            {
                $this->load->model("Model_user", '', true);
                $users = new Model_user();

                $users->addUserDetails($_SESSION['id'], $_POST['nom'],$_POST['prenom'],$_POST['adresse'],$_POST['cp'],$_POST['ville'],$_POST['tel']);

            }
            else
            {
                $_SESSION['errorRegister'] = '<div class="alert alert-block alert-error fade in"><button type="button" class="close" data-dismiss="alert">×</button>Les champs sont mals renseignés.</div>';
            }
            if($true)
            {
                redirect('/user/panel');
            }
            else
            {
                redirect($_SERVER['HTTP_REFERER']);
            }

        }

    }

    public function panel()
    {
        $features = new Model_features();
        $categories = new Model_categories();
        if(!array_key_exists('login', $_SESSION))
        {
            redirect('/');
        }
        $this->load->template('user_panel',array('categories'=>$categories->showAllCategories(), 'features'=>$features));
    }

    public function details()
    {
        $features = new Model_features();
        $categories = new Model_categories();
        if(!array_key_exists('login', $_SESSION))
        {
            redirect('/');
        }
        $this->load->model("Model_user", '', true);
        $users = new Model_user();

        $details = $users->getUserDetails($_SESSION['id']);

        $this->load->template('user_details', array('details'=>$details,'categories'=>$categories->showAllCategories(), 'features'=>$features));
    }

    public function orders()
    {
        $features = new Model_features();
        $categories = new Model_categories();
        if(!array_key_exists('login', $_SESSION))
        {
            redirect('/');
        }
        $this->load->model("Model_user", '', true);
        $users = new Model_user();
        $orders = $users->getUserOrders($_SESSION['id']);

        $this->load->template('user_orders', array('orders'=>$orders,'categories'=>$categories->showAllCategories(), 'features'=>$features));
    }

    public function ordersDetails($id)
    {
        $this->load->model("Model_user", '', true);
        $users = new Model_user();

        $orders = $users->getUserOrderDetails($id);
        $adress = $users->getOrderAdress($id);

        $chaine = [
                'items' => $orders,
                'adress'=>$adress
        ];

        header("Content-Type: application/json");
        echo json_encode($chaine);
    }

    public function editDetails()
    {
        if(!array_key_exists('login', $_SESSION))
        {
            redirect('/');
        }
        $this->load->model("Model_user", '', true);
        $users = new Model_user();

        $users->editUserDetails($_SESSION['id'],$_SESSION['login'], $_POST['nom'], $_POST['prenom'], $_POST['adresse'], $_POST['cp'], $_POST['ville'], $_POST['tel'], $_POST['password']);

        redirect('/user/details');
    }

}

/* End of file index.php */
/* Location: ./application/controllers/index.php */