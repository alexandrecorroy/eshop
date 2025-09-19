<?php

class Model_features extends CI_Model
{
    public function countItemByCat($id_cat)
    {
        $sql = "SELECT COUNT(id) number_items
                FROM eshop_products
                WHERE id_categorie = ? AND stock > 0";
        $query = $this->db->query($sql, array($id_cat));

        $res = $query->row_array();

        return $res['number_items'];
    }

    public function countUnvalidateComments()
    {
        $sql = "SELECT COUNT(id) number_comments FROM eshop_products_comments WHERE visibility = 0";

        $query = $this->db->query($sql);

        $res = $query->row_array();

        return $res['number_comments'];
    }

    public function countValidateComments()
    {
        $sql = "SELECT COUNT(id) number_comments FROM eshop_products_comments WHERE visibility = 1";

        $query = $this->db->query($sql);

        $res = $query->row_array();

        return $res['number_comments'];
    }

    public function avgRating($id_article)
    {
        $sql = "SELECT AVG(rating) avg_rating FROM eshop_products_comments WHERE visibility = 1 AND id_product = ?";

        $query = $this->db->query($sql, array($id_article));

        $res = $query->row_array();

        return $res['avg_rating'];
    }

    public function countUnvalidateOrders()
    {
        $sql = "SELECT COUNT(id) number_orders FROM eshop_orders WHERE status = 0";

        $query = $this->db->query($sql);

        $res = $query->row_array();

        return $res['number_orders'];
    }

    public function countUnsendOrders()
    {
        $sql = "SELECT COUNT(id) number_orders FROM eshop_orders WHERE status = 1";

        $query = $this->db->query($sql);

        $res = $query->row_array();

        return $res['number_orders'];
    }

    public function getNameCategoryById($id)
    {
        $sql = "SELECT name_categorie FROM eshop_categories WHERE id = ?";

        $query = $this->db->query($sql, array($id));

        $res = $query->row_array();

        return $res['name_categorie'];
    }

    public function getCouponReduction($coupon)
    {
        $sql = "SELECT reduc_pourcentage, code FROM eshop_coupons WHERE code = ?";

        $query = $this->db->query($sql, array($coupon));

        $res = $query->row_array();

        if($res!=null)
        {
            return $res;
        }
    }

    public function countUsers()
    {
        $sql = "SELECT COUNT(id) utilisateur FROM eshop_users WHERE status = 0";

        $query = $this->db->query($sql);

        $res = $query->row_array();

        return $res['utilisateur'];
    }

    public function countUsersToday()
    {
        $sql = "SELECT COUNT(id) utilisateur FROM eshop_users WHERE date_register > DATE_SUB(NOW(),INTERVAL 24 HOUR)";

        $query = $this->db->query($sql);

        $res = $query->row_array();

        return $res['utilisateur'];
    }

    public function countOrders()
    {
        $sql = "SELECT COUNT(id) orders FROM eshop_orders";

        $query = $this->db->query($sql);

        $res = $query->row_array();

        return $res['orders'];
    }

    public function countOrdersToday()
    {
        $sql = "SELECT COUNT(id) orders FROM eshop_orders WHERE date_achat > DATE_SUB(NOW(),INTERVAL 24 HOUR)";

        $query = $this->db->query($sql);

        $res = $query->row_array();

        return $res['orders'];
    }

    public function countProducts()
    {
        $sql = "SELECT COUNT(id) products FROM eshop_products";

        $query = $this->db->query($sql);

        $res = $query->row_array();

        return $res['products'];
    }

    public function countProductsLowStock()
    {
        $sql = "SELECT COUNT(id) products FROM eshop_products WHERE stock < 50";

        $query = $this->db->query($sql);

        $res = $query->row_array();

        return $res['products'];
    }

    public function countComments()
    {
        $sql = "SELECT COUNT(id) comments FROM eshop_products_comments";

        $query = $this->db->query($sql);

        $res = $query->row_array();

        return $res['comments'];
    }

}