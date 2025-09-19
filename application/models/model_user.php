<?php

class Model_user extends CI_Model
{
    public function verifUser($login, $password)
    {
        $sql = "SELECT password FROM eshop_users WHERE login = ?";
        $query = $this->db->query($sql, array($login));
        $res = $query->row_array();

        if(password_verify($password, $res['password']))
        {
            return true;
        }
    }

    public function create($login, $email, $password, $ip)
    {
        $sql = "INSERT INTO eshop_users (login, email, password, ip_register)
                VALUES(?,?,?,?)";

        $data = array(htmlentities($login), htmlentities($email), $password, htmlentities($ip));

        $this->db->query($sql, $data);

        return $this->db->insert_id();
    }

    public function loginExists($login)
    {
        $sql = "SELECT login FROM eshop_users WHERE login = ?";
        $query = $this->db->query($sql, array($login));
        $res = $query->row_array();

        if($res!=null)
        {
            return true;
        }
    }

    public function emailExists($email)
    {
        $sql = "SELECT email FROM eshop_users WHERE email = ?";
        $query = $this->db->query($sql, array($email));
        $res = $query->row_array();

        if($res!=null)
        {
            return true;
        }
    }

    public function getIdUser($login)
    {
        $sql = "SELECT id FROM eshop_users WHERE login = ?";
        $query = $this->db->query($sql, array($login));
        $res = $query->row_array();

        return $res;
    }

    public function getUserStatut($id)
    {
        $sql = "SELECT status FROM eshop_users WHERE id = ?";
        $query = $this->db->query($sql, array($id));
        $res = $query->row_array();

        return $res;
    }

    public function getUserDetails($id)
    {
        $sql = "SELECT * FROM eshop_users_details WHERE id_user = ?";
        $query = $this->db->query($sql, array($id));
        $res = $query->row_array();

        return $res;
    }

    public function addUserDetails($id_user, $nom, $prenom, $adresse, $cp, $ville, $tel)
    {
        $sql = "INSERT INTO eshop_users_details (id_user, nom, prenom, adresse, code_postal, ville, telephone)
                VALUES(?,?,?,?,?,?,?)";

        $data = array($id_user, htmlentities($nom), htmlentities($prenom), htmlentities($adresse), htmlentities($cp), htmlentities($ville), htmlentities($tel));

        $this->db->query($sql, $data);
    }

    public function getUserOrders($id_user)
    {
        $sql = "SELECT o.id, o.date_achat, o.total_products_price, o.shipping_cost, o.status, o.shipping_info, s.name ship_name
                FROM eshop_orders o
                JOIN eshop_shipping s ON o.shipping_id = s.id
                WHERE o.id_client = ?
                ORDER BY o.date_achat DESC";
        $query = $this->db->query($sql, array($id_user));

        $res = array();
        foreach($query->result_array() as $row)
        {
            $res[]=$row;
        }
        return $res;
    }

    public function getUserOrderDetails($id_order)
    {
        $sql = "SELECT *
                FROM eshop_orders_details
                WHERE id_order = ?";
        $query = $this->db->query($sql, array($id_order));

        $res = array();
        foreach($query->result_array() as $row)
        {
            $res[]=$row;
        }
        return $res;
    }

    public function editUserDetails($id_user, $login, $nom, $prenom, $adresse, $cp, $ville, $tel, $password)
    {
        if($this->verifUser($login, $password))
        {
            if($nom!='' && $prenom!='' && $adresse!='' && is_numeric($cp) && $ville!='' && is_numeric($tel))
            {
                $insert = "UPDATE eshop_users_details
                   SET nom = ?, prenom = ?, adresse = ?, code_postal = ?, ville = ?, telephone = ?
                   WHERE id_user = ?";

                $data = array(htmlentities($nom), htmlentities($prenom), htmlentities($adresse), htmlentities($cp), htmlentities($ville), htmlentities($tel), htmlentities($id_user));

                $this->db->query($insert, $data);

                $_SESSION['message'] = 'Vos informations ont été mises à jour.';
            }
            else
            {
                $_SESSION['message'] = 'La saisie est incorrect. Vérifiez vos informations.';
            }

        }
        else
        {
            $_SESSION['message'] = 'Mot de passe incorrect.';
        }



    }

    public function getOrderAdress($id_order)
    {
        $sql = "SELECT nom, prenom, adresse, code_postal, ville, telephone, shipping_info FROM eshop_orders WHERE id = ?";
        $query = $this->db->query($sql, array($id_order));
        $res = $query->row_array();

        return $res;
    }

    public function getAllUsers()
    {
        $sql = "SELECT *
                FROM eshop_users
                WHERE status = 0 AND id!=2";
        $query = $this->db->query($sql);

        $res = array();
        foreach($query->result_array() as $row)
        {
            $res[]=$row;
        }
        return $res;
    }

    public function deleteUserById($id)
    {
        $sql = "DELETE FROM eshop_users
                WHERE id = ?";

        $data = array($id);

        $this->db->query($sql, $data);

        $sql = "DELETE FROM eshop_products_comments
                WHERE id_user = ?";

        $data = array($id);

        $this->db->query($sql, $data);

        $sql = "DELETE FROM eshop_users_details
                WHERE id_user = ?";

        $data = array($id);

        $this->db->query($sql, $data);

        $_SESSION['message'] = '<div class="alert alert-info">
        Utilisateur Supprimé !
        <a href="#" data-dismiss="alert" class="close">×</a>
    </div>';

        redirect('/admin/users');
    }

    public function getUserEmailById($id)
    {
        $sql = "SELECT email FROM eshop_users WHERE id = ?";
        $query = $this->db->query($sql, array($id));
        $res = $query->row_array();

        return $res['email'];
    }

    public function getIdUserByIdOrder($id)
    {
        $sql = "SELECT id_client FROM eshop_orders WHERE id = ?";
        $query = $this->db->query($sql, array($id));
        $res = $query->row_array();

        return $res['id_client'];
    }

    public function getLoginUserById($id)
    {
        $sql = "SELECT login FROM eshop_users WHERE id = ?";
        $query = $this->db->query($sql, array($id));
        $res = $query->row_array();

        return $res['login'];
    }


}
