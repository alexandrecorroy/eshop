<?php

class Model_products extends CI_Model
{
    public function showProductsHome()
    {
        $sql = "SELECT p.id id_product, name_product, price, c.name_categorie, c.id id_categorie, img.path
                FROM eshop_products p
                JOIN eshop_products_vignette img ON p.id = img.id_product
                JOIN eshop_categories c ON c.id = p.id_categorie
                WHERE p.stock > 0
                ORDER BY p.date_product DESC
                LIMIT 9";
        $query = $this->db->query($sql);

        $res = array();
        foreach($query->result_array() as $row)
        {
            $res[]=$row;
        }
        return $res;

    }

    public function showOneProduct($id)
    {
        $sql = "SELECT p.id id_product, name_product, p.short_description, p.long_description, price, c.name_categorie, c.id id_categorie, img.path, p.stock
                FROM eshop_products p
                JOIN eshop_products_vignette img ON p.id = img.id_product
                JOIN eshop_categories c ON c.id = p.id_categorie
                WHERE p.id = ?";
        $query = $this->db->query($sql, array($id));

        $res = $query->row_array();

        return $res;
    }

    public function showProductsByCat($id, $sort, $page)
    {
    //        0 = alpha A-Z
    //        1 = alpha Z-A
    //        2 = prix - > +

        if($sort==1)
        {
            $sortby = 'name_product DESC';
        }
        elseif ($sort==2)
        {
            $sortby = 'price ASC';
        }
        else
        {
            $sortby = 'name_product ASC';
        }

        $page = intval($page);

        if($page==1 || $page<1 || !is_numeric($page))
        {
            $limit = 'LIMIT 10';
        }
        else
        {
            $number = (($page-1)*10);
            $limit = 'LIMIT '.$number.', 10';
        }

        $sql = "SELECT p.id id_product, name_product, short_description, price, c.name_categorie, c.id id_categorie, img.path
                FROM eshop_products p
                JOIN eshop_products_vignette img ON p.id = img.id_product
                JOIN eshop_categories c ON c.id = p.id_categorie
                WHERE p.id_categorie = ? AND p.stock > 0
                ORDER BY ".$sortby."
                ".$limit;
        $query = $this->db->query($sql, array($id));

        $res = array();
        foreach($query->result_array() as $row)
        {
            $res[]=$row;
        }
        return $res;
    }

    public function addProduct($id, $name, $short, $long, $price, $stock)
    {
        $insert = "INSERT INTO eshop_products (id_categorie, name_product, short_description, long_description, price, stock)
                VALUES(?,?,?,?,?,?)";

        $data = array(htmlentities($id), htmlentities($name), htmlentities($short), $long, htmlentities($price), htmlentities($stock));

        $this->db->query($insert, $data);

        return $this->db->insert_id();

    }

    public function editProduct($id, $id_categorie, $name, $short, $long, $price, $stock)
    {
        $insert = "UPDATE eshop_products
                   SET id_categorie = ?, name_product = ?, short_description = ?, long_description = ?, price = ?, stock = ?
                   WHERE id = ?";

        $data = array(htmlentities($id_categorie), htmlentities($name), htmlentities($short), $long, htmlentities($price), htmlentities($stock), htmlentities($id));

        $this->db->query($insert, $data);

    }

    public function deleteProduct($id)
    {
        $delete = "DELETE FROM eshop_products WHERE id = ?";

        $data = array($id);

        $this->db->query($delete, $data);
    }

    public function showProductsBySearch($mot)
    {
        $mot = '%'.htmlentities($mot).'%';

        $sql = "SELECT p.id as id_product, name_product as label, name_product, price, c.name_categorie, p.short_description, c.id id_categorie, img.path
                FROM eshop_products p
                JOIN eshop_products_vignette img ON p.id = img.id_product
                JOIN eshop_categories c ON c.id = p.id_categorie
                WHERE name_product LIKE '".$mot."' AND p.stock > 0
                LIMIT 10";
        $query = $this->db->query($sql);

        $res = array();
        foreach($query->result_array() as $row)
        {
            $res[]=$row;
        }
        return $res;
    }

    public function randomProductsByCat($id)
    {
        $sql = "SELECT p.id id_product, name_product, price, c.name_categorie, c.id id_categorie, img.path
                FROM eshop_products p
                JOIN eshop_products_vignette img ON p.id = img.id_product
                JOIN eshop_categories c ON c.id = p.id_categorie
                WHERE c.id = ? AND p.stock > 0
                ORDER BY RAND()
                LIMIT 6";
        $query = $this->db->query($sql, array($id));

        $res = array();
        foreach($query->result_array() as $row)
        {
            $res[]=$row;
        }
        return $res;
    }

    public function showLastProducts()
    {
        $sql = "SELECT id, name_product, date_product
                FROM eshop_products
                ORDER BY date_product DESC
                LIMIT 5";
        $query = $this->db->query($sql);

        $res = array();
        foreach($query->result_array() as $row)
        {
            $res[]=$row;
        }
        return $res;

    }

    public function showLowStockProducts()
    {
        $sql = "SELECT id, name_product, date_product, stock
                FROM eshop_products
                WHERE stock < 50
                ORDER BY stock ASC
                LIMIT 5";
        $query = $this->db->query($sql);

        $res = array();
        foreach($query->result_array() as $row)
        {
            $res[]=$row;
        }
        return $res;
    }

}