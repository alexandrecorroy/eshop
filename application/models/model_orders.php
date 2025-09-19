<?php

class Model_orders extends CI_Model
{
    public function updateStatusById($id)
    {
        $sql = "UPDATE eshop_orders
                SET status = status+1
                WHERE id = ?";

        $this->db->query($sql, array($id));
    }

    public function updateShippingInfo($id, $link)
    {
        if(is_numeric($id) && $link!='')
        {
            $sql = "UPDATE eshop_orders
                  SET shipping_info = ?
                  WHERE id = ?";

            $this->db->query($sql, array($link, $id));
            $this->updateStatusById($id);
        }

    }

    public function getOrdersvalidated()
    {
        $sql = "SELECT o.id, id_client, date_achat, priority, status, SUM(quantity) nbre_article
                FROM eshop_orders o
                JOIN eshop_shipping s ON o.shipping_id = s.id
                JOIN eshop_orders_details od ON od.id_order = o.id
                WHERE status = 1
                GROUP BY o.id
                ORDER BY date_achat AND s.priority DESC
                LIMIT 5";

        $query = $this->db->query($sql);

        $res = array();
        foreach($query->result_array() as $row)
        {
            $res[]=$row;
        }
        return $res;
    }

    public function getIdClient($id_order)
    {
        $sql = "SELECT id_client
                FROM eshop_orders
                WHERE id = ?";

        $query = $this->db->query($sql, array($id_order));

        $res = $query->row_array();

        return $res['id_client'];
    }

    public function getIdShipping($id_order)
    {
        $sql = "SELECT shipping_id
                FROM eshop_orders
                WHERE id = ?";

        $query = $this->db->query($sql, array($id_order));

        $res = $query->row_array();

        return $res['shipping_id'];
    }

    public function getProductsOrdered($id_order)
    {
        $sql = "SELECT id_product, name_product, quantity
                FROM eshop_orders_details
                WHERE id_order = ?
                ";

        $query = $this->db->query($sql, array($id_order));

        $res = array();
        foreach($query->result_array() as $row)
        {
            $res[]=$row;
        }
        return $res;
    }

    public function getUnvalidateOrders()
    {
        $sql = "SELECT o.id, id_client, date_achat, priority, status, SUM(quantity) nbre_article
                FROM eshop_orders o
                JOIN eshop_shipping s ON o.shipping_id = s.id
                JOIN eshop_orders_details od ON od.id_order = o.id
                WHERE status = 0
                GROUP BY o.id
                ORDER BY date_achat AND s.priority DESC
                LIMIT 5";

        $query = $this->db->query($sql);

        $res = array();
        foreach($query->result_array() as $row)
        {
            $res[]=$row;
        }
        return $res;
    }

    public function cancelOrder($id)
    {
        $sql = "SELECT id_product, quantity
                FROM eshop_orders_details
                WHERE id_order = ?";

        $query = $this->db->query($sql, array($id));

        $res = array();
        foreach($query->result_array() as $row)
        {
            $res[]=$row;
        }

        foreach($res as $product)
        {
            $sql = "UPDATE eshop_products
                    SET stock = stock + ?
                WHERE id = ?";

            $this->db->query($sql, array($product['quantity'], $product['id_product']));
        }

        $sql = "UPDATE eshop_orders
                SET status = 3
                WHERE id = ?";

        $this->db->query($sql, array($id));
    }

    public function getOrderDetailsById($id)
    {
        $sql = "SELECT o.id, o.date_achat, o.total_products_price, o.shipping_cost, o.status, o.shipping_info, s.name ship_name, nom, prenom, adresse, code_postal, ville, telephone
                FROM eshop_orders o
                JOIN eshop_shipping s ON o.shipping_id = s.id
                WHERE o.id = ?
                ORDER BY o.date_achat DESC";
        $query = $this->db->query($sql, array($id));

        $res = $query->row_array();

        return $res;
    }

}