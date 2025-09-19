<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_shipping extends CI_Model
{
    public function getAllShipping()
    {
        $sql = "SELECT *
                FROM eshop_shipping";

        $query = $this->db->query($sql);

        $res = array();
        foreach($query->result_array() as $row)
        {
            $res[]=$row;
        }
        return $res;
    }

    public function createShipping($name, $description, $price, $cents, $priority)
    {
        if($name=='' || $description=='' || $price=='' || $priority=='')
        {
            $_SESSION['message'] = '<div class="alert alert-danger">
        Tous les champs ne sont pas remplis !
        <a href="#" data-dismiss="alert" class="close">×</a>
    </div>';
        }
        else
        {
            if($cents=='')
            {
                $cents = '00';
            }

            $cost = $price.'.'.$cents;

            $sql = "INSERT INTO eshop_shipping (`name`, description, cost, priority)
                VALUES(?,?,?,?)";

            $data = array(htmlentities($name), htmlentities($description), htmlentities($cost), htmlentities($priority));

            $this->db->query($sql, $data);

            $_SESSION['message'] = '<div class="alert alert-info">
        Mode de livraison ajouté !
        <a href="#" data-dismiss="alert" class="close">×</a>
    </div>';
        }
        redirect('/admin/shipping');
    }

    public function activeShipping($id)
    {
        $sql = "UPDATE eshop_shipping
                SET active = 1
                WHERE id = ?";

        $data = array($id);

        $this->db->query($sql, $data);

        $_SESSION['message'] = '<div class="alert alert-info">
        Mode de livraison réactivé !
        <a href="#" data-dismiss="alert" class="close">×</a>
    </div>';

        redirect('/admin/shipping');
    }

    public function hideShipping($id)
    {
        $sql = "UPDATE eshop_shipping
                SET active = 0
                WHERE id = ?";

        $data = array($id);

        $this->db->query($sql, $data);

        $_SESSION['message'] = '<div class="alert alert-info">
        Mode de livraison désactivé !
        <a href="#" data-dismiss="alert" class="close">×</a>
    </div>';

        redirect('/admin/shipping');
    }

    public function getShippingInfoById($id)
    {
        $sql = "SELECT *
                FROM eshop_shipping
                WHERE id = ?";

        $query = $this->db->query($sql, array($id));

        $res = $query->row_array();

        return $res;
    }

    public function updateShipping($id, $name, $description, $price, $cents, $priority)
    {
        if($name=='' || $description=='' || $price=='' || $priority=='')
        {
            $_SESSION['message'] = '<div class="alert alert-danger">
        Tous les champs ne sont pas remplis !
        <a href="#" data-dismiss="alert" class="close">×</a>
    </div>';
        }
        else
        {
            if($cents=='')
            {
                $cents = '00';
            }

            $cost = $price.'.'.$cents;

            $sql = "UPDATE eshop_shipping
                    SET name = ?, description = ?, cost = ?, priority = ?
                    WHERE id = ?";

            $data = array(htmlentities($name), htmlentities($description), htmlentities($cost), htmlentities($priority), htmlentities($id));

            $this->db->query($sql, $data);

            $_SESSION['message'] = '<div class="alert alert-info">
        Mode de livraison modifié !
        <a href="#" data-dismiss="alert" class="close">×</a>
    </div>';
        }
        redirect('/admin/shipping');
    }
}
