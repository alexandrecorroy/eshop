<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {

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
    public function index()
    {
        $this->load->model("Model_products", '', true);
        $products = new Model_products();
        $categories = new Model_categories();
        $features = new Model_features();

        $this->load->template('index', array('products'=>$products->showProductsHome(), 'categories'=>$categories->showAllCategories(), 'features'=>$features));

    }
}

/* End of file index.php */
/* Location: ./application/controllers/index.php */