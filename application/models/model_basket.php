<?php

class Model_basket extends CI_Model
{

    public function getShippingInfo()
    {
        $sql = "SELECT *
                FROM eshop_shipping
                WHERE active = 1
                ORDER BY cost ASC";

        $query = $this->db->query($sql);

        $res = array();
        foreach($query->result_array() as $row)
        {
            $res[]=$row;
        }
        return $res;
    }

    public function getShippingInfoSelected($id)
    {
        $sql = "SELECT *
                FROM eshop_shipping
                WHERE id = ?";

        $query = $this->db->query($sql, array($id));

        $res = $query->row_array();

        return $res;
    }

    public function addOrder($id, $price, $shipId, $shipCost, $userDetails)
    {

        $sql = "INSERT INTO eshop_orders (id_client, total_products_price, shipping_id, shipping_cost, nom, prenom, adresse, code_postal, ville, telephone)
                VALUES(?,?,?,?,?,?,?,?,?,?)";

        $data = array(htmlentities($id), htmlentities($price), htmlentities($shipId), htmlentities($shipCost), $userDetails['nom'], $userDetails['prenom'], $userDetails['adresse'], $userDetails['code_postal'], $userDetails['ville'], $userDetails['telephone']);

        $this->db->query($sql, $data);

        return $this->db->insert_id();
    }

    public function addOrderDetails($id, $id_product, $name_product, $price_product, $quantity)
    {
        $sql = "INSERT INTO eshop_orders_details (id_order, id_product, name_product, price_product, quantity)
                VALUES(?,?,?,?,?)";

        $data = array(htmlentities($id), htmlentities($id_product), htmlentities($name_product), htmlentities($price_product), htmlentities($quantity));

        $this->db->query($sql, $data);
    }

    public function updateStock($id, $quantity)
    {
        $insert = "UPDATE eshop_products
                   SET stock = stock-?
                   WHERE id = ?";

        $data = array($quantity, $id);

        $this->db->query($insert, $data);
    }

}