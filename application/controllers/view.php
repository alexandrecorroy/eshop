<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class View extends MY_Controller {

    public function item($id)
    {
        if(is_numeric($id) && $id!='')
        {
            $this->load->model("Model_products", '', true);
            $this->load->model("Model_images", '', true);
            $images = new Model_images();
            $products = new Model_products();
            $this->load->model("Model_comments", '', true);
            $comments = new Model_comments();
            $game = $products->showOneProduct($id);
            $validComments = $comments->showCommentsByGameId($id);
            $features = new Model_features();
            $avgRating = $features->avgRating($id);
            $categories = new Model_categories();

            $randomProducts = $products->randomProductsByCat($game['id_categorie']);

            if($game!=null && $game['stock']!=0)
            {
                $this->load->template('item', array('game'=>$game, 'comments'=>$validComments,'categories'=>$categories->showAllCategories(),'features'=>$features,'id'=>$id, 'avgRating'=>$avgRating, 'images'=>$images->showImagesById($id),'randomProducts'=>$randomProducts));
            }
            else
            {
                redirect('/');
            }
        }
        else
        {
            redirect('/');
        }
    }

    public function add_comment()
    {
        if(array_key_exists('rating', $_POST) && array_key_exists('comment', $_POST) && array_key_exists('id_game', $_POST))
        {
            if($_POST['comment']!=null && is_numeric($_POST['id_game']) && is_numeric($_POST['rating']))
            {
                $this->load->model("Model_comments", '', true);
                $comments = new Model_comments();
                $userNotAlreadyComment = $comments->verifyUserAlreadyComment($_SESSION['id'], $_POST['id_game']);
                if($userNotAlreadyComment)
                {
                    $this->load->model("Model_comments", '', true);
                    $products = new Model_comments();
                    $products->addComment($_SESSION['id'], $_POST['id_game'], $_POST['comment'], $_POST['rating']);
                    $_SESSION['comment'] = '<div class="alert alert-info fade in"><button type="button" class="close" data-dismiss="alert">×</button>Votre commentaire a bien été ajouté. Il est en attente de modération</div>';

                }
                else
                {
                    $_SESSION['comment'] = '<div class="alert alert-block alert-error fade in"><button type="button" class="close" data-dismiss="alert">×</button>Vous avez déjà commenté ce produit.</div>';

                }
            }
            else
            {
                $_SESSION['comment'] = '<div class="alert alert-block alert-error fade in"><button type="button" class="close" data-dismiss="alert">×</button>Votre commentaire n\'est pas valide.</div>';
            }
        }

        redirect('/view/item/'.$_POST['id_game'].'/#reviews');
    }

    public function category($id, $sort = 0)
    {
        if(array_key_exists('page', $_GET))
        {
            $page = $_GET['page'];
        }
        else
        {
            $page = 1;
        }
        if(is_numeric($id) && $id!='')
        {
            $categories = new Model_categories();
            $features = new Model_features();
            $this->load->model("Model_products", '', true);
            $products = new Model_products();
            $this->load->model("Model_comments", '', true);
            $comments = new Model_comments();

            $game = $products->showProductsByCat(htmlentities($id), htmlentities($sort), htmlentities($page));

            $this->load->template('category', array('id'=>$id,'products'=>$game,'categories'=>$categories->showAllCategories(),'features'=>$features, 'sort'=>$sort,'comments'=>$comments));


        }
        else
        {
            redirect('/');
        }

    }

    public function search()
    {
        if(array_key_exists('search', $_POST))
        {
            $this->load->model("Model_comments", '', true);
            $comments = new Model_comments();
            $features = new Model_features();
            $categories = new Model_categories();
            $this->load->model("Model_products", '', true);
            $products = new Model_products();
            $search = $products->showProductsBySearch(htmlentities($_POST['search']));

            $this->load->template('search', array('products'=>$search,'categories'=>$categories->showAllCategories(),'features'=>$features,'comments'=>$comments, 'word'=>$_POST['search']));
        }
        else
        {
            redirect('/');
        }


    }

    public function ajax_search()
    {
        $mot = $_GET['term'];
        if($mot!='')
        {
            $this->load->model("Model_products", '', true);
            $products = new Model_products();
            $search = $products->showProductsBySearch(htmlentities($mot));

            header("Content-Type: application/json");

            echo json_encode($search);
        }
    }

}