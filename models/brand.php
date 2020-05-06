<?php

require_once('C:/xampp/htdocs/Laptopcu/db.php');
require_once('ibrand.php');
class Brand extends DB implements Ibrand
{
    const tableName = 'brand';
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
            $brandName = $payload['brandName'];
            $file = $payload['file']; //logo
            $stm = $this->db->prepare('INSERT INTO ' .
                self::tableName . '(name,img)
             VALUES(:brandName,:file)');
            $stm->execute(array(
                ':brandName' => $brandName,
                ':file' => $file

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
    function getProduct($id)
    {
        $stm = $this->db->prepare("SELECT * FROM product WHERE brand_id= $id");
        $stm->execute();
        return $stm->fetchAll();
    }
    function update($payload)
    {
        try {
            $brandName = $payload['name'];
            $brandLogo = $payload['file'];
            $id = $payload['id'];
            $stm = $this->db->prepare('UPDATE ' . self::tableName . ' 
            SET    name = :brandName, img = :brandlogo WHERE id = :id');
            $stm->execute(array(':brandName' => $brandName, ':brandlogo' => $brandLogo, ':id' => $id));
            //tra ve so ban ghi
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }

        return $stm->rowCount();
    }

    function getBrandById($id)
    {
        $rows = $this->db->query("SELECT * FROM " . self::tableName . " WHERE id= $id");
        foreach ($rows as $r) {
            $row  = $r;
        }
        return $r;
    }
}
