<?php

require_once('C:/xampp/htdocs/Laptopcu/db.php');
//equire_once('./../../db.php');
require_once('islider.php');
class Slider extends DB implements Islider
{
    const tableName = 'slide';
    public function __construct()
    {
        parent::__construct();
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    function getAll($offset, $count)
    {
        $stm = $this->db->prepare("SELECT * FROM " . self::tableName . " LIMIT $offset,$count");
        $stm->execute();
        return $stm->fetchAll();
    }
    function getAllNoLimit()
    {
        $stm = $this->db->prepare("SELECT * FROM " . self::tableName);
        $stm->execute();
        return $stm->fetchAll();
    }

    function insert($payload)
    {
        try {
            $tittle = $payload['tittle'];
            $file = $payload['file']; //img slider
            $product_id = $payload['product_id'];
            $stm = $this->db->prepare('INSERT INTO ' .
                self::tableName . '(tittle,img,product_id)
             VALUES(:tittle,:file,:product_id)');
            $stm->execute(array(
                ':tittle' => $tittle,
                ':file' => $file,
                ':product_id' => $product_id

            ));
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
        //tra ve so ban ghi
        return $stm->rowCount();
    }

    function delete($id)
    {
        $this->db->query("DELETE FROM " . self::tableName . " WHERE id = " . $id);
    }

    function update($payload)
    {
        try {
            $tittle = $payload['tittle'];
            $file = $payload['file']; //img slider
            $product_id = $payload['product_id'];
            $id = $payload['id'];
            $stm = $this->db->prepare('UPDATE ' . self::tableName . ' 
            SET    tittle = :tittle, img = :file, product_id = :product_id WHERE id = :id');
            $stm->execute(array(
                ':tittle' => $tittle, ':file' => $file,':product_id' => $product_id ,  ':id' => $id
            ));
            //tra ve so ban ghi
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }

        return $stm->rowCount();
    }

    function getSliderById($id)
    {
        $rows = $this->db->query("SELECT * FROM " . self::tableName . " WHERE id= $id");
        foreach ($rows as $r) {
            $row  = $r;
        }
        return $r;
    }
}
