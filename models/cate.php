<?php
//require_once('./../../db.php');
require_once('C:/xampp/htdocs/Laptopcu/db.php');
require_once('icate.php');
class Cate extends DB implements Icate
{
    const tableName = 'category';
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
    function getAllnoLimit()
    {
        $stm = $this->db->prepare("SELECT * FROM " . self::tableName);
        $stm->execute();
        return $stm->fetchAll();
    }
    function getCateIndex() //get  all cate  with  level = 0
    {
        $stm = $this->db->prepare("SELECT * FROM " . self::tableName . ' WHERE level =0');
        $stm->execute();
        return $stm->fetchAll();
    }
    function getCatesByProductId($product_id)
    {
        $stm = $this->db->prepare("SELECT c.id,c.name FROM category c INNER JOIN cate_product cp ON cp.cate_id= c.id INNER JOIN product p ON cp.product_id= p.id WHERE cp.product_id=$product_id ");
        $stm->execute();
        return $stm->fetchAll();
    }

    function insert($payload)
    {
        try {
            $cateName = $payload['name'];
            $cateLevel = $payload['level'];

            $stm = $this->db->prepare('INSERT INTO ' .
                self::tableName . '(name,level)
             VALUES(:cateName,:level)');
            $stm->execute(array(
                ':cateName' => $cateName,
                ':level' => $cateLevel
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
            $cateName = $payload['name'];
            $cateLevel = $payload['level'];
            $id = $payload['id'];
            $stm = $this->db->prepare('UPDATE ' . self::tableName . ' 
            SET    name = :cateName, level = :cateLevel WHERE id = :id');
            $stm->execute(array(':cateName' => $cateName, ':cateLevel' => $cateLevel, ':id' => $id));
            //tra ve so ban ghi
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }

        return $stm->rowCount();
    }
    function getCatesByProducts($product_id)
    {
        $stm = $this->db->prepare("SELECT cate_id,name FROM cate_product WHERE product_id=$product_id ");
        $stm->execute();
        return $stm->fetchAll();
    }
    function getCateById($id)
    {
        $rows = $this->db->query("SELECT * FROM " . self::tableName . " WHERE id= $id");
        foreach ($rows as $r) {
            $row  = $r;
        }
        return $r;
    }
}
