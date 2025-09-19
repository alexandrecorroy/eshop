<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class admin extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        if(!array_key_exists('admin', $_SESSION))
        {
            redirect('/');
        }
    }

    public function index()
    {
        $this->load->model("Model_products", '', true);
        $this->load->model("Model_comments", '', true);
        $products = new Model_products();
        $comments = new Model_comments();
        $features = new Model_features();
        $this->load->adminTemplate('index', array('features'=>$features,'products'=>$products->showLastProducts(),'comments'=>$comments->showLastComments(),'productsStock'=>$products->showLowStockProducts()));
    }

    public function indexAjax()
    {
        $features = new Model_features();

        $stats = [
            'countUnvalidateOrders' => $features->countUnvalidateOrders(),
            'countUnsendOrders' => $features->countUnsendOrders(),
            'countUsers' => $features->countUsers(),
            'countUsersToday' => $features->countUsersToday(),
            'countOrdersToday' => $features->countOrdersToday(),
            'countOrders' => $features->countOrders()

            ];

        header("Content-Type: application/json");

        echo json_encode($stats);
    }

    public function manageCategories()
    {
        $features = new Model_features();
        $categories = new Model_categories();
        $cat = $categories->showAllCategories();


        $this->load->adminTemplate('category.php', array('categories'=>$cat,'features'=>$features));
    }

    public function addProduct()
    {
        $features = new Model_features();
        $categories = new Model_categories();
        $cat = $categories->showAllCategories();

        if(array_key_exists('name_product', $_POST) && array_key_exists('short_description', $_POST) && array_key_exists('long_description', $_POST) && array_key_exists('price', $_POST) && array_key_exists('price_cents', $_POST) && array_key_exists('stock', $_POST))
        {
            if($_POST['name_product']!='' && $_POST['short_description']!='' && $_POST['long_description']!='' && $_POST['price']!='' && $_POST['price_cents'] && $_POST['stock']!='' && is_numeric($_POST['id_categorie']))
            {

                $price = $_POST['price'].".".$_POST['price_cents'];

                $this->load->model("Model_products", '', true);
                $this->load->model("Model_images", '', true);
                $products = new Model_products();
                $images = new Model_images();

                $lastId = $products->addProduct($_POST['id_categorie'],$_POST['name_product'],$_POST['short_description'], $_POST['long_description'],$price,$_POST['stock']);

                $images->addVignette($_FILES['vignette'], $lastId);

                $images->addImage($_FILES['images'], $lastId);

                $_SESSION['message'] = '<div class="alert alert-info">
        Produit Ajouté.
        <a href="#" data-dismiss="alert" class="close">×</a>
    </div>';
            }
            else
            {
                $_SESSION['message'] = '<div class="alert alert-danger">
        Votre saisie est incorrect.
        <a href="#" data-dismiss="alert" class="close">×</a>
    </div>';
            }
        }
        $this->load->adminTemplate('add_product.php', array('categories'=>$cat, 'features'=>$features));
    }

    public function editProduct($id)
    {
        $features = new Model_features();
        $this->load->model("Model_categories", '', true);
        $categories = new Model_categories();
        $this->load->model("Model_products", '', true);
        $products = new Model_products();
        $this->load->model("Model_images", '', true);
        $images = new Model_images();

        $cat = $categories->showAllCategories();
        $product = $products->showOneProduct($id);
        $img = $images->showImagesById($id);

        if(array_key_exists('name_product', $_POST) && array_key_exists('short_description', $_POST) && array_key_exists('long_description', $_POST) && array_key_exists('price', $_POST) && array_key_exists('price_cents', $_POST) && array_key_exists('stock', $_POST) && array_key_exists('id_article', $_POST))
        {
            if($_POST['name_product']!='' && $_POST['short_description']!='' && $_POST['long_description']!='' && $_POST['price']!='' && $_POST['price_cents'] && $_POST['stock']!='' && is_numeric($_POST['id_categorie']) && is_numeric($_POST['id_article']))
            {

                $price = $_POST['price'].".".$_POST['price_cents'];

                $products->editProduct($_POST['id_article'], $_POST['id_categorie'],$_POST['name_product'],$_POST['short_description'], $_POST['long_description'],$price,$_POST['stock']);

                $images->editVignette($_FILES['vignette'], $id);

                $images->addImage($_FILES['images'], $id);

                $_SESSION['message'] = '<div class="alert alert-info">
        Produit Edité.
        <a href="#" data-dismiss="alert" class="close">×</a>
    </div>';

                redirect('/admin/editProduct/'.$id);
            }
            else
            {
                $_SESSION['message'] = '<div class="alert alert-danger">
        Saisie incorrect.
        <a href="#" data-dismiss="alert" class="close">×</a>
    </div>';
            }
        }
        $this->load->adminTemplate('edit_product.php', array('id'=>$id, 'categories'=>$cat, 'product'=>$product, 'images'=>$img, 'features'=>$features));

    }

    public function addCategory()
    {
        if(array_key_exists('new_cat', $_POST) && array_key_exists('id_parent', $_POST))
        {
            if((is_numeric($_POST['id_parent']) && $_POST['new_cat']!=''))
            {
                $this->load->model("Model_categories", '', true);
                $categories = new Model_categories();

                $categories->addCategory($_POST['id_parent'], $_POST['new_cat']);

                $_SESSION['message'] = '<div class="alert alert-info">
        Catégorie Ajoutée
        <a href="#" data-dismiss="alert" class="close">×</a>
    </div>';
                redirect('/admin/manageCategories');
            }
        }

        $_SESSION['message'] = '<div class="alert alert-danger">
        Catégorie non ajoutée !
        <a href="#" data-dismiss="alert" class="close">×</a>
    </div>';

        redirect('/admin/manageCategories');

    }

    public function removeCategory()
    {
        if(array_key_exists('id_parent', $_POST))
        {
            if(is_numeric($_POST['id_parent']) && $_POST['id_parent']>33)
            {
                $this->load->model("Model_categories", '', true);
                $categories = new Model_categories();

                $categories->removeCategory($_POST['id_parent']);

                $_SESSION['message'] = '<div class="alert alert-info">
        Catégorie supprimée !
        <a href="#" data-dismiss="alert" class="close">×</a>
    </div>';

                $items = $categories->getIdItems($_POST['id_parent']);

                foreach($items as $item)
                {
                    $this->removeItem($item['id'], 2);
                }

                redirect('/admin/manageCategories');
            }
        }

        $_SESSION['message'] = '<div class="alert alert-danger">
        Catégorie non supprimée !
        <a href="#" data-dismiss="alert" class="close">×</a>
    </div>';
        redirect('/admin/manageCategories');

    }

    public function removeItem($id, $bol = 0)
    {

        $this->load->model("Model_products", '', true);
        $this->load->model("Model_images", '', true);
        $this->load->model("Model_comments", '', true);
        $products = new Model_products();
        $images = new Model_images();
        $comments = new Model_comments();

        $products->deleteProduct($id);

        $images->deleteImagesbyItem($id);

        $images->deleteVignettebyItem($id);

        $comments->deleteCommentsByGameId($id);

        if($bol==2)
        {
            return true;
        }
        elseif($bol == 1)
        {
            redirect($_SERVER['HTTP_REFERER']);
        }
        else
        {
            redirect('/');
        }

    }

    public function deleteCommentFromItem($id_comment, $id_item)
    {
        $this->load->model("Model_comments", '', true);
        $comments = new Model_comments();

        $comments->deleteCommentById($id_comment);

        redirect('/view/item/'.$id_item);
    }

    public function comments()
    {
        $features = new Model_features();
        $this->load->model("Model_comments", '', true);
        $comments = new Model_comments();

        $this->load->adminTemplate('comments', array('comments'=>$comments,'features'=>$features));
    }

    public function deleteComment($id_comment)
    {
        $this->load->model("Model_comments", '', true);
        $comments = new Model_comments();

        $comments->deleteCommentById($id_comment);

        redirect($_SERVER['HTTP_REFERER']);
    }

    public function approveComment($id_comment)
    {
        $this->load->model("Model_comments", '', true);
        $comments = new Model_comments();

        $comments->acceptComment($id_comment);

        redirect($_SERVER['HTTP_REFERER']);
    }

    public function deleteOneImage($id, $id_product)
    {
        $this->load->model("Model_images", '', true);
        $images = new Model_images();

        $images->deleteImage($id);

        redirect('/admin/editProduct/'.$id_product);
    }

    public function validateOrders()
    {
        $features = new Model_features();
        $this->load->model("Model_orders", '', true);
        $orders = new Model_orders();

        $this->load->adminTemplate('validate_orders', array('orders'=>$orders->getUnvalidateOrders(), 'features'=>$features));
    }

    public function sendOrders()
    {
        $features = new Model_features();
        $this->load->model("Model_orders", '', true);
        $orders = new Model_orders();

        $res = $orders->getOrdersvalidated();


        $this->load->adminTemplate('send_orders', array('orders'=>$res, 'features'=>$features));
    }

    public function updateStatus($id)
    {
        $this->load->model("Model_orders", '', true);
        $orders = new Model_orders();

        $orders->updateStatusById($id);

        $_SESSION['message'] = '<div class="alert alert-info">
        Commande validée. Veuillez procéder à son envoi.
        <a href="#" data-dismiss="alert" class="close">×</a>
    </div>';


        /* MAIL */

        $this->load->model("Model_mails", '', true);
        $mail = new Model_mails();
        $this->load->model("Model_user", '', true);
        $user = new Model_user();

        $idUser = $user->getIdUserByIdOrder($id);
        $login  = $user->getLoginUserById($idUser);

        $sujet = "Commande N°$id en préparation !";
        $message = "<p>Bonjour $login,</p><p>Votre commande n°$id est en préparation, elle sera expédiée très bientôt.</p><p>Votre Boutique en ligne.</p>";
        $email = $user->getUserEmailById($idUser);

        $mail->send($sujet, $message, $email);

        /* END MAIL */

        redirect('/admin/validateOrders');

    }

    public function sendOrder($id)
    {
        $features = new Model_features();
        $this->load->model("Model_orders", '', true);
        $orders = new Model_orders();
        $this->load->model("Model_user", '', true);
        $this->load->model("Model_basket", '', true);
        $userAdresse = $orders->getOrderDetailsById($id);

        $products = $orders->getProductsOrdered($id);

        if($userAdresse['shipping_info']!='')
        {
            redirect('/');
        }

        $this->load->adminTemplate('send_one_order', array('id'=>$id,'products'=>$products,'userAdresse'=>$userAdresse, 'features'=>$features));
    }

    public function submitSendOrder()
    {
        $this->load->model("Model_orders", '', true);
        $orders = new Model_orders();

        $orders->updateShippingInfo($_POST['id'], $_POST['tracking']);

        /* MAIL */

        $this->load->model("Model_mails", '', true);
        $mail = new Model_mails();
        $this->load->model("Model_user", '', true);
        $user = new Model_user();

        $idUser = $user->getIdUserByIdOrder($_POST['id']);
        $login  = $user->getLoginUserById($idUser);

        $sujet = "Commande N°".$_POST['id']." envoyée !";
        $message = "<p>Bonjour $login,</p><p>Votre commande n°".$_POST['id']." est envoyé. Voici le lien de suivi <a href='".$_POST['tracking']."'>".$_POST['tracking']."</a></p><p>Votre Boutique en ligne.</p>";
        $email = $user->getUserEmailById($idUser);

        $mail->send($sujet, $message, $email);

        /* END MAIL */

        redirect('/admin/sendOrders');
    }

    public function cancel($id)
    {
        $this->load->model("Model_orders", '', true);
        $orders = new Model_orders();

        $orders->cancelOrder($id);

        /* MAIL */

        $this->load->model("Model_mails", '', true);
        $mail = new Model_mails();
        $this->load->model("Model_user", '', true);
        $user = new Model_user();

        $idUser = $user->getIdUserByIdOrder($id);
        $login  = $user->getLoginUserById($idUser);

        $sujet = "Commande N°$id annulée !";
        $message = "<p>Bonjour $login,</p><p>Votre commande n°$id a été annulée. Merci de prendre contact avec nous pour en connaitre la raison.</p><p>Votre Boutique en ligne.</p>";
        $email = $user->getUserEmailById($idUser);

        $mail->send($sujet, $message, $email);

        /* END MAIL */

        redirect('/admin/validateOrders');
    }

    public function searchOrder($id = 0)
    {
        if(array_key_exists('search_order', $_POST))
        {
            if(is_numeric($_POST['search_order']))
            {
                $id = $_POST['search_order'];
            }
        }

        $features = new Model_features();
        $this->load->model("Model_orders", '', true);
        $this->load->model("Model_user", '', true);
        $orders = new Model_orders();
        $users = new Model_user();

        $this->load->adminTemplate('search_order', array('id'=>$id,'features'=>$features, 'order'=>$orders->getOrderDetailsById($id),'orderDetails'=>$users->getUserOrderDetails($id)));
    }

    public function shipping()
    {
        $features = new Model_features();
        $this->load->model("Model_shipping", '', true);
        $shipping = new Model_shipping();
        $this->load->adminTemplate('shipping', array('features'=>$features,'shipping'=>$shipping));
    }

    public function coupon()
    {
        $features = new Model_features();
        $this->load->model("Model_coupon", '', true);
        $coupon = new Model_coupon();
        $getCoupons = $coupon->getAllCoupons();
        $this->load->adminTemplate('coupon', array('features'=>$features,'coupons'=>$getCoupons));
    }

    public function deleteCoupon($id)
    {
        $this->load->model("Model_coupon", '', true);
        $coupon = new Model_coupon();
        $coupon->deleteCoupon($id);
    }

    public function addCoupon()
    {
        if(array_key_exists('code', $_POST) && array_key_exists('reduc',$_POST))
        {
            $this->load->model("Model_coupon", '', true);
            $coupon = new Model_coupon();
            $coupon->createCoupon($_POST['code'], $_POST['reduc']);
        }
    }

    public function editShipping($id)
    {
        if(!is_numeric($id))
        {
            redirect('/admin/');
        }
        $features = new Model_features();
        $this->load->model("Model_shipping", '', true);
        $shipping = new Model_shipping();
        $this->load->adminTemplate('edit_shipping', array('id'=>$id,'features'=>$features,'shipping'=>$shipping));
    }

    public function updateShipping($id)
    {
        if(array_key_exists('name', $_POST) && array_key_exists('description',$_POST) && array_key_exists('price',$_POST) && array_key_exists('price_cent',$_POST) && array_key_exists('priority', $_POST))
        {
            $this->load->model("Model_shipping", '', true);
            $shipping = new Model_shipping();
            $shipping->updateShipping($id, $_POST['name'],$_POST['description'],$_POST['price'],$_POST['price_cent'],$_POST['priority']);
        }
    }

    public function addShipping()
    {
        if(array_key_exists('name', $_POST) && array_key_exists('description',$_POST) && array_key_exists('price',$_POST) && array_key_exists('price_cent',$_POST) && array_key_exists('priority', $_POST))
        {
            $this->load->model("Model_shipping", '', true);
            $shipping = new Model_shipping();
            $shipping->createShipping($_POST['name'],$_POST['description'],$_POST['price'],$_POST['price_cent'],$_POST['priority']);
        }
    }

    public function hideShipping()
    {
        $this->load->model("Model_shipping", '', true);
        $shipping = new Model_shipping();
        $shipping->hideShipping($_POST['id']);
    }

    public function showShipping()
    {
        $this->load->model("Model_shipping", '', true);
        $shipping = new Model_shipping();
        $shipping->activeShipping($_POST['id']);
    }

    public function users()
    {
        $features = new Model_features();
        $this->load->model("Model_user");
        $users = new Model_user();
        $this->load->adminTemplate('users', array('features'=>$features,'users'=>$users->getAllUsers()));
    }

    public function deleteUser($id)
    {
        $this->load->model("Model_user");
        $users = new Model_user();
        $users->deleteUserById($id);
    }

}