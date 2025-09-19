<?php

class Model_images extends CI_Model
{

    public function isDefaultVignette($id_product)
    {
        $sql = "SELECT path
                FROM eshop_products_vignette
                WHERE id_product = ?";
        $query = $this->db->query($sql, array($id_product));

        $res = $query->row_array();

        if($res['path']!='assets/vignette/image.jpg')
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function addVignette($vignette, $id_product)
    {
        if($vignette['name']!='' && strstr($vignette['type'], 'image/'))
        {

            $file = explode('.', $vignette['name']);
            $path = 'assets/vignette/'.md5(uniqid()).'.'.$file[1];
            move_uploaded_file($vignette['tmp_name'], $path);

        }
        else
        {
            $path = 'assets/vignette/image.jpg';
        }

        $insert = "INSERT INTO eshop_products_vignette (id_product, path)
                       VALUE (?,?)";
        $data = array($id_product, $path);
        $this->db->query($insert, $data);

    }

    public function editVignette($vignette, $id_product)
    {
        if($vignette['name']!='' && strstr($vignette['type'], 'image/'))
        {

            $this->deleteVignettebyItem($id_product);

            $file = explode('.', $vignette['name']);
            $path = 'assets/vignette/'.md5(uniqid()).'.'.$file[1];
            move_uploaded_file($vignette['tmp_name'], $path);

            $insert = "INSERT INTO eshop_products_vignette (id_product, path)
                       VALUE (?,?)";
            $data = array($id_product, $path);
            $this->db->query($insert, $data);

        }


    }

    public function addImage($images, $id_product)
    {


        for($i=0; $i<count($images['name']); $i++)
        {
            if($images['name'][$i]!='' && strstr($images['type'][$i], 'image/'))
            {
                $file = explode('.', $images['name'][$i]);

                $path = 'assets/images/'.md5(uniqid()).'.'.$file[1];

                move_uploaded_file($images['tmp_name'][$i], $path);

                $insert = "INSERT INTO eshop_products_images (id_product, path)
                       VALUE (?,?)";
                $data = array($id_product, $path);
                $this->db->query($insert, $data);
            }
        }


    }

    public function showVignetteById($id_article)
    {
        $sql = "SELECT * FROM eshop_products_vignette WHERE id_product = ?";
        $query = $this->db->query($sql, array($id_article));

        $res = $query->row_array();

        return $res;
    }

    public function showImagesById($id_article)
    {
        $sql = "SELECT *
                FROM eshop_products_images
                WHERE id_product = ?";
        $query = $this->db->query($sql, array($id_article));

        $res = array();
        foreach($query->result_array() as $row)
        {
            $res[]=$row;
        }
        return $res;
    }

    public function showImageById($id)
    {
        $sql = "SELECT *
                FROM eshop_products_images
                WHERE id = ?";
        $query = $this->db->query($sql, array($id));

        $res = $query->row_array();

        return $res;
    }

    public function deleteVignettebyItem($id_article)
    {
        $vignette = $this->showVignetteById($id_article);

        if($this->isDefaultVignette($id_article))
        {
            unlink($vignette['path']);
        }

        $sql = "DELETE FROM eshop_products_vignette WHERE id_product = ?";

        $this->db->query($sql, array($id_article));

    }

    public function deleteImagesbyItem($id_article)
    {
        $images = $this->showImagesById($id_article);

        for($i=0; $i<count($images); $i++)
        {
            unlink($images[$i]['path']);
        }

        $sql = "DELETE FROM eshop_products_images WHERE id_product = ?";

        $this->db->query($sql, array($id_article));
    }

    public function deleteImage($id)
    {
        $image = $this->showImageById($id);

        unlink($image['path']);

        $sql = "DELETE FROM eshop_products_images WHERE id = ?";

        $this->db->query($sql, array($id));
    }

}