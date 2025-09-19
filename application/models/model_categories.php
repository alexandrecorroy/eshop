<?php

class Model_categories extends CI_Model
{
    public function showAllCategories()
    {
        $sql = "SELECT *
                FROM eshop_categories
                ORDER BY `left` ASC";

        $query = $this->db->query($sql);

        $res = array();
        foreach($query->result_array() as $row)
        {
            $res[]=$row;
        }
        return $res;
    }

    private function updateKeysCatAdd($number)
    {
        $update1 = "UPDATE eshop_categories SET `left` = `left`+2 WHERE `left` >= ?";

        $this->db->query($update1, array($number));

        $update2 = "UPDATE eshop_categories SET `right` = `right`+2 WHERE `right` >= ?";

        $this->db->query($update2, array($number));
    }

    public function addCategory($id_parent, $name_new_cat)
    {
        $sql = "SELECT `left`, `right`
                FROM eshop_categories
                WHERE id = ?";

        $query = $this->db->query($sql, array($id_parent));

        $res = $query->row_array();

        $this->updateKeysCatAdd($res['right']);

        $insert = "INSERT INTO eshop_categories (`left`, `right`, name_categorie)
                VALUES(?,?,?)";

        $data = array($res['right'], $res['right']+1, htmlentities($name_new_cat));

        $this->db->query($insert, $data);

    }

    private function updateKeysCatRemove($left, $right)
    {
        $res = ($right-$left)+1;

        $update1 = "UPDATE eshop_categories
                    SET `left` = `left`-? WHERE `left` > ?";

        $this->db->query($update1, array($res, $left));

        $update2 = "UPDATE eshop_categories
                    SET `right` = `right`-? WHERE `right` > ?";

        $this->db->query($update2, array($res, $right));
    }

    public function removeCategory($id_parent)
    {
        $sql = "SELECT `left`, `right`
                FROM eshop_categories
                WHERE id = ?";

        $query = $this->db->query($sql, array($id_parent));

        $res = $query->row_array();

        $remove = "DELETE FROM eshop_categories WHERE `left` >= ? AND `right` <= ?";

        $data = array($res['left'], $res['right']);

        $this->db->query($remove, $data);

        $this->updateKeysCatRemove($res['left'], $res['right']);
    }

    public function getIdItems($id_category)
    {
        $sql = "SELECT id
                FROM eshop_products
                WHERE id_categorie = ?";

        $query = $this->db->query($sql, array($id_category));

        $res = array();
        foreach($query->result_array() as $row)
        {
            $res[]=$row;
        }
        return $res;
    }


}