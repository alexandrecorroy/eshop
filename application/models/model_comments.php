<?php

class Model_comments extends CI_Model
{
    public function addComment($id_user, $id_product, $comment, $rating)
    {
        $sql = "INSERT INTO eshop_products_comments (id_user, id_product, comment, rating)
                VALUES(?,?,?,?)";

        $data = array(htmlentities($id_user), htmlentities($id_product), htmlentities($comment), htmlentities($rating));

        $this->db->query($sql, $data);

        return $this->db->insert_id();
    }

    public function showCommentsByGameId($id)
    {
        $sql = "SELECT pc.id, u.login, pc.comment, pc.date_comment, pc.rating
                FROM eshop_products_comments pc
                JOIN eshop_users u ON pc.id_user = u.id
                WHERE id_product = ? AND visibility = 1
                ORDER BY pc.date_comment DESC";
        $query = $this->db->query($sql, array($id));

        $res = array();
        foreach($query->result_array() as $row)
        {
            $res[]=$row;
        }
        return $res;
    }

    public function showCommentsUnvalidate()
    {
        $sql = "SELECT pc.id, pc.id_product, u.login, pc.comment, pc.date_comment, pc.rating
                FROM eshop_products_comments pc
                JOIN eshop_users u ON pc.id_user = u.id
                WHERE visibility = 0
                ORDER BY pc.date_comment ASC";
        $query = $this->db->query($sql);

        $res = array();
        foreach($query->result_array() as $row)
        {
            $res[]=$row;
        }
        return $res;
    }

    public function deleteCommentsByGameId($id)
    {
        $sql = "DELETE FROM eshop_products_comments WHERE id_product = ?";

        $this->db->query($sql, array($id));
    }

    public function deleteCommentById($id)
    {
        $sql = "DELETE FROM eshop_products_comments WHERE id = ?";

        $this->db->query($sql, array($id));
    }

    public function acceptComment($id)
    {
        $sql = "UPDATE eshop_products_comments
                SET visibility = 1
                WHERE id = ?";

        $this->db->query($sql, array($id));
    }

    public function countCommentsById($id)
    {
        $sql = "SELECT COUNT(id) as comments
                FROM eshop_products_comments
                WHERE id_product = ? AND visibility = 1";
        $query = $this->db->query($sql, array($id));

        $res = $query->row_array();

        return $res['comments'];

    }

    public function showLastComments()
    {
        $sql = "SELECT pc.id, pc.id_product, u.login, pc.comment, pc.date_comment, pc.rating, pc.visibility
                FROM eshop_products_comments pc
                JOIN eshop_users u ON pc.id_user = u.id
                ORDER BY pc.date_comment DESC
                LIMIT 5";
        $query = $this->db->query($sql);

        $res = array();
        foreach($query->result_array() as $row)
        {
            $res[]=$row;
        }
        return $res;
    }

    public function showCommentsValidate()
    {
        $sql = "SELECT pc.id, pc.id_product, u.login, pc.comment, pc.date_comment, pc.rating, pc.visibility
                FROM eshop_products_comments pc
                JOIN eshop_users u ON pc.id_user = u.id
                WHERE visibility = 1
                ORDER BY pc.date_comment DESC
                LIMIT 20";
        $query = $this->db->query($sql);

        $res = array();
        foreach($query->result_array() as $row)
        {
            $res[]=$row;
        }
        return $res;
    }

    public function verifyUserAlreadyComment($id_user, $id_item)
    {
        $sql = "SELECT COUNT(id) as number_elem
                FROM eshop_products_comments
                WHERE id_user = ? AND id_product = ?";
        $query = $this->db->query($sql, array($id_user, $id_item));

        $res = $query->row_array();

        return $res['number_elem']==0 ? true : false;
    }

}