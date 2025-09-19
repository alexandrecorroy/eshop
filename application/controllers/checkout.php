<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Checkout extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        if(array_key_exists('admin', $_SESSION))
        {
            redirect('/');
        }
    }

    public function addCart($id)
    {
        $id = intval($id);

        $add = true;

        $array = [
            'id'=>$id,
            'quantity'=>1
        ];

        if(!array_key_exists('cart', $_SESSION))
        {
            $_SESSION['cart'] = array();
        }

        if($_SESSION['cart']!=null)
        {
            for($i=0; $i<count($_SESSION['cart']); $i++)
            {
                if($id==$_SESSION['cart'][$i]['id'])
                {
                    if($_SESSION['cart'][$i]['quantity']>3)
                    {
                        $_SESSION['cart'][$i]['quantity']=4;
                    }
                    else
                    {
                        $_SESSION['cart'][$i]['quantity']++;
                    }
                    $add = false;
                }
            }
        }

        if($add==true OR $_SESSION['cart']==null)
        {
            array_push($_SESSION['cart'], $array);
        }


        redirect('/checkout/cart');
    }

    public function cart()
    {
        $features = new Model_features();
        $categories = new Model_categories();
        if(array_key_exists('coupon', $_POST))
        {
            $res = $features->getCouponReduction($_POST['coupon']);
            $_SESSION['coupon_code'] = $res['code'];
            $_SESSION['coupon'] = $res['reduc_pourcentage'];
        }

        $this->load->model("Model_products", '', true);
        $products = new Model_products();


        if(array_key_exists('cart', $_SESSION))
        {
            $items = array();

            for($i=0; $i<count($_SESSION['cart']); $i++)
            {
                $product = $products->showOneProduct($_SESSION['cart'][$i]['id']);
                array_push($items, $product);
            }

            $this->load->template('cart', array('items'=>$items, 'categories'=>$categories->showAllCategories(), 'features'=>$features));

        }
        else
        {

            $this->load->template('cart', array('categories'=>$categories->showAllCategories(), 'features'=>$features));

        }

    }

    public function delete()
    {
        unset($_SESSION['cart']);

        redirect('/checkout/cart');
    }

    public function deleteItem($id)
    {

        array_splice($_SESSION['cart'], $id, 1);

        redirect('/checkout/cart');
    }

    public function validate()
    {

        $features = new Model_features();
        $categories = new Model_categories();
        $this->load->model("Model_user", '', true);
        $users = new Model_user();

        if(array_key_exists('id', $_SESSION))
        {
            $userDetails = $users->getUserDetails($_SESSION['id']);
            $this->load->template('validate', array('userDetails'=>$userDetails,'categories'=>$categories->showAllCategories(), 'features'=>$features));

        }
        else
        {
            $this->load->template('validate', array('categories'=>$categories->showAllCategories(), 'features'=>$features));
        }


    }

    public function shipping()
    {
        $features = new Model_features();
        $categories = new Model_categories();
        $this->load->model("Model_basket", '', true);
        $basket = new Model_basket();

        $this->load->template('shipping', array('shipping'=>$basket->getShippingInfo(), 'categories'=>$categories->showAllCategories(), 'features'=>$features));
    }

    public function confirmShipping()
    {
        if(array_key_exists('ship', $_POST))
        {
            if(is_numeric($_POST['ship']))
            {
                $_SESSION['shipping'] = intval($_POST['ship']);
                redirect('/checkout/confirm/');
            }
        }
    }

    public function confirm()
    {
        $features = new Model_features();
        $categories = new Model_categories();
        $this->load->model("Model_basket", '', true);
        $basket = new Model_basket();

        $items = array();

        $this->load->model("Model_products", '', true);
        $products = new Model_products();

        for($i=0; $i<count($_SESSION['cart']); $i++)
        {
            $product = $products->showOneProduct($_SESSION['cart'][$i]['id']);
            array_push($items, $product);
        }

        $shipInfo = $basket->getShippingInfoSelected($_SESSION['shipping']);

        $this->load->template('confirm_order', array('shipping'=>$shipInfo, 'items'=>$items, 'categories'=>$categories->showAllCategories(), 'features'=>$features));
    }

    public function updateCart()
    {
        if(array_key_exists('quantity', $_POST) && array_key_exists('field', $_POST))
        {
            if(is_numeric($_POST['field']) && is_numeric($_POST['quantity']))
            {
                $_SESSION['cart'][$_POST['field']]['quantity'] = intval($_POST['quantity']);
                redirect('/checkout/cart/');
            }
        }
    }

    public function addOrder()
    {
        $totalPrice = 0;

        $this->load->model("Model_basket", '', true);
        $this->load->model("Model_products", '', true);
        $this->load->model("Model_user", '', true);
        $basket = new Model_basket();
        $products = new Model_products();
        $user = new Model_user();

        $items = array();

        for($i=0; $i<count($_SESSION['cart']); $i++)
        {
            $product = $products->showOneProduct($_SESSION['cart'][$i]['id']);
            array_push($items, $product);
        }

        $shipping = $basket->getShippingInfoSelected($_SESSION['shipping']);

        foreach($items as $key=>$item)
        {
            $price = $_SESSION['cart'][$key]['quantity']*$item['price'];
            $totalPrice += $price;
        }

        if(array_key_exists('coupon', $_SESSION))
        {
            if($_SESSION['coupon']!='')
            {
                $totalPrice = round($totalPrice-(($totalPrice/100)*$_SESSION['coupon']),2);
            }
        }

        $userDetails = $user->getUserDetails($_SESSION['id']);

        $lastId = $basket->addOrder($_SESSION['id'], $totalPrice, $shipping['id'], $shipping['cost'],$userDetails);

        foreach($items as $key=>$item)
        {
            $id_product = $item['id_product'];
            $price_product = $item['price'];
            $name_product = $item['name_product'];
            $quantity = $_SESSION['cart'][$key]['quantity'];
            $basket->addOrderDetails($lastId, $id_product, $name_product, $price_product, $quantity);
            $basket->updateStock($id_product, $quantity);
        }

        redirect('/checkout/endOrder/'.$lastId);

    }

    public function endOrder($id)
    {
        /* MAIL */

        $this->load->model("Model_mails", '', true);
        $mail = new Model_mails();
        $this->load->model("Model_user", '', true);
        $user = new Model_user();

        $sujet = "Votre commande #$id";
        $message = "<p>Bonjour ".$_SESSION['login'].",</p><p>Merci pour votre commande n°$id, vous pouvez désormais suivre son évolution dans votre compte en ligne, rubrique 'Vos commandes'.</p><p>Votre Boutique en ligne.</p>";
        $email = $user->getUserEmailById($_SESSION['id']);

        $mail->send($sujet, $message, $email);

        /* END MAIL */

        $features = new Model_features();
        $categories = new Model_categories();
        unset($_SESSION['cart']);
        unset($_SESSION['shipping']);
        unset($_SESSION['coupon']);
        $this->load->template('finish', array('idOrder'=>$id, 'categories'=>$categories->showAllCategories(), 'features'=>$features));
    }

}