<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_coupon extends CI_Model
{
    public function getAllCoupons()
    {
        $sql = "SELECT *
                FROM eshop_coupons";

        $query = $this->db->query($sql);

        $res = array();
        foreach($query->result_array() as $row)
        {
            $res[]=$row;
        }
        return $res;
    }

    public function createCoupon($code, $reduc)
    {
        if($code=='' || !is_numeric($reduc))
        {
            $_SESSION['message'] = '<div class="alert alert-danger">
        Tous les champs ne sont pas remplis !
        <a href="#" data-dismiss="alert" class="close">×</a>
    </div>';
        }
        else
        {
            $sql = "INSERT INTO eshop_coupons (code, reduc_pourcentage)
                VALUES(?,?)";

            $data = array(htmlentities($code), htmlentities($reduc));

            $this->db->query($sql, $data);

            $_SESSION['message'] = '<div class="alert alert-info">
        Code de réduction ajouté !
        <a href="#" data-dismiss="alert" class="close">×</a>
    </div>';
        }
        redirect('/admin/coupon');
    }

    public function deleteCoupon($id)
    {
        $delete = "DELETE FROM eshop_coupons WHERE id = ?";

        $data = array($id);

        $this->db->query($delete, $data);

        $_SESSION['message'] = '<div class="alert alert-info">
        Code de réduction supprimé !
        <a href="#" data-dismiss="alert" class="close">×</a>
    </div>';

        redirect('/admin/coupon');
    }
}
