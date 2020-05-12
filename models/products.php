<?php
//require_once('./../../db.php');

require_once('C:/xampp/htdocs/Laptopcu/db.php');
require_once('iproduct.php');
class Product extends DB implements Iproduct
{
    const tableName = 'product';
    public function __construct()
    {
        parent::__construct();
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    function countNumImgOfProduct($id)
    {
        $sql = "SELECT COUNT(id) FROM `img` WHERE product_id=$id";
        $result = $this->db->prepare($sql);
        $result->execute();
        $max = $result->fetchColumn();
        echo $max;
    }
    //SELECT p.id, p.name,p.price,p.discount FROM product p INNER JOIN cate_product cp ON cp.product_id= p.id INNER JOIN category c ON c.id= cp.cate_id WHERE cp.cate_id=3 ORDER BY p.id DESC
    function getListProductByCategory($cate_id)
    {
        $stm = $this->db->prepare("SELECT p.id, p.name,p.price,p.discount FROM product p INNER JOIN cate_product cp ON cp.product_id= p.id INNER JOIN category c ON c.id= cp.cate_id WHERE cp.cate_id=$cate_id ORDER BY p.id DESC");
        $stm->execute();
        return $stm->fetchAll();
    }
    function getListProductByCategorys($cate_ids, $conditionsFilter)
    {
        $conditions = '';
        for ($i = 0; $i < count($cate_ids); $i++) {

            $condition = ' cp.cate_id=' . "$cate_ids[$i] ";
            if ($i == count($cate_ids) - 1) {
            } else {
                $condition = $condition . ' OR ';
            }
            $conditions = $conditions . $condition;
        }

        $stm = $this->db->prepare("SELECT p.id, p.name,p.price,p.discount FROM product p INNER JOIN cate_product cp ON cp.product_id= p.id INNER JOIN category c ON c.id= cp.cate_id WHERE 
        " . $conditions . " ORDER BY p.id DESC");
        $stm->execute();
        return $stm->fetchAll();
    }
    function getAll($offset, $count)
    {
        $stm = $this->db->prepare("SELECT * FROM " . self::tableName . " LIMIT $offset,$count");
        $stm->execute();
        return $stm->fetchAll();
    }
    function getProductByFilter($conditions, $sort)
    {
        $sortsql = '';
        if ($conditions == '') $conditions = 1;
        switch ($sort) {
            case 'new':
                $sortsql = 'time_add DESC';
                break;
            case 'giam':
                $sortsql = 'price ASC';
                break;
            case 'tang':
                $sortsql = 'price DESC';
                break;
            case 'dis_max':
                $sortsql = 'discount DESC';
                break;
            case 'topsell':
                $sortsql = 'selled  DESC';
                break;

            default:
                $sortsql = 'id desc';
                break;
        }

        $stm = $this->db->prepare("SELECT * FROM " . self::tableName . ' WHERE ' . $conditions . " ORDER BY " . $sortsql);
        $stm->execute();
        return $stm->fetchAll();
    }
    function getImg($id)
    {
        try {
            $stm = $this->db->prepare("SELECT img FROM " . 'img WHERE product_id=' . "$id");
            $stm->execute();
            return $stm->fetchAll();
        } catch (\Throwable $e) {
            echo $e;
        }
    }
    function getTopSell()
    {
        try {
            $stm = $this->db->prepare("SELECT * FROM " .  self::tableName . ' WHERE 1 ORDER BY selled DESC LIMIT 5');
            $stm->execute();
            return $stm->fetchAll();
        } catch (\Throwable $e) {
            echo $e;
        }
    }
    function getTopNew()
    {
        try {
            $stm = $this->db->prepare("SELECT * FROM " .  self::tableName . ' WHERE 1 ORDER BY time_add DESC LIMIT 5');
            $stm->execute();
            return $stm->fetchAll();
        } catch (\Throwable $e) {
            echo $e;
        }
    }
    function getopDiscont()
    {
        try {
            $stm = $this->db->prepare("SELECT * FROM " .  self::tableName . ' WHERE 1 ORDER BY time_add DESC LIMIT 5');
            $stm->execute();
            return $stm->fetchAll();
        } catch (\Throwable $e) {
            echo $e;
        }
    }
    function getListBySearch($keyword)
    {
        try {

            $stm = $this->db->prepare("SELECT * FROM " . self::tableName . ' WHERE name LIKE :keyword ' . ' ORDER BY name');
            $stm->setFetchMode(PDO::FETCH_ASSOC);
            $stm->execute(array(":keyword" => '%' . $keyword . '%'));
            return $stm->fetchAll();
        } catch (\Throwable $e) {
            echo $e;
        }
    }
    function insert($payload, $srcs, $srcOfContent)
    {
        try {
            $productName = $payload['productName'];
            $price = $payload['price'];
            $brand_id = $payload['brand_id'];
            $cate_ids = $payload['cate_id'];
            $keyword = $payload['keyword'];
            $short_desc = $payload['short_desc'];
            $status = $payload['status'];
            $model = $payload['model'];
            $chip = $payload['chip'];
            $ram = $payload['ram'];
            $card = $payload['card'];
            $drive = $payload['drive'];
            $card = $payload['card'];
            $display = $payload['display'];
            $connect = $payload['connect'];
            $vantay = $payload['vantay'];
            $operation = $payload['operation'];
            $pin = $payload['pin'];
            $weight = $payload['weight'];
            $size = $payload['size'];
            $discount = $payload['discount'];

            $stm = $this->db->prepare('INSERT INTO ' .
                self::tableName . '(name,price,brand_id,keyword,short_desc,status,model,chip,ram,card,drive,display,connect,vantay,operation,pin,weight,size,discount)
                            VALUES(:productName,:price,:brand_id,:keyword,:short_desc,:status,:model,:chip,:ram,:card,:drive,:display,:connect,:vantay,:operation,:pin,:weight,:size,:discount)');
            $stm->execute(array(
                ':productName' => $productName,
                ':price' => $price,
                ':brand_id' => $brand_id,
                ':keyword' => $keyword,
                ':short_desc' => $short_desc,
                ':status' => $status,
                ':model' => $model,
                ':chip' => $chip,
                ':ram' => $ram,
                ':card' => $card,
                ':drive' => $drive,
                ':display' => $display,
                ':connect' => $connect,
                ':vantay' => $vantay,
                ':operation' => $operation,
                ':pin' => $pin,
                ':weight' => $weight,
                ':size' => $size,
                ':discount' => $discount
            ));
            $dbtmp = new DB();
            $max =  $dbtmp->getMax_id(self::tableName);
            //chen img_src va product id vao bang img
            foreach ($srcs as $src) {
                $stm2 = $this->db->prepare('INSERT INTO  img (img,product_id) VALUES (:img,:product_id)');
                $stm2->execute(array(
                    ':img' => $src,
                    ':product_id' => $max
                ));
            }
            //insert img src vao detail table
            for ($i = 0; $i < count($srcOfContent); $i++) {
                $title = $payload['title' . ($i + 1)];
                echo $title;
                $content = $payload['content' . ($i + 1)];
                $stm2 = $this->db->prepare('INSERT INTO  detail (product_id,img,content,title) VALUES (:product_id,:img,:content,:title)');
                $stm2->execute(array(
                    ':img' => $srcOfContent[$i],
                    ':product_id' => $max,
                    ':content'  => $content,
                    ':title'  => $title
                ));
            }
            //insert category

            foreach ($cate_ids as $cate_id) {
                $stm2 = $this->db->prepare('INSERT INTO  cate_product (product_id,cate_id) VALUES (:product_id,:cate_id)');
                $stm2->execute(array(
                    ':product_id' => $max,
                    ':cate_id' => $cate_id
                ));
            }
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }

        //tra ve so ban ghi
        return $stm->rowCount();
    }

    public function getContentProduct($id)
    {
        $stm = $this->db->prepare("SELECT * FROM detail WHERE product_id=$id");
        $stm->execute();
        return $stm->fetchAll();
    }
    function delete($id)
    {
        $this->db->query("DELETE FROM " . self::tableName . " WHERE id = " . $id);
    }

    function update($payload)
    {
        try {
            $productName = $payload['productName'];
            $price = $payload['price'];
            $brand_id = $payload['brand_id'];
            $cate_ids = $payload['cate_id'];
            $keyword = $payload['keyword'];
            $short_desc = $payload['short_desc'];
            $status = $payload['status'];
            $model = $payload['model'];
            $chip = $payload['chip'];
            $ram = $payload['ram'];
            $card = $payload['card'];
            $drive = $payload['drive'];
            $card = $payload['card'];
            $display = $payload['display'];
            $connect = $payload['connect'];
            $vantay = $payload['vantay'];
            $operation = $payload['operation'];
            $pin = $payload['pin'];
            $weight = $payload['weight'];
            $size = $payload['size'];
            $discount = $payload['discount'];
            $id = $payload['id'];
            $stm = $this->db->prepare('UPDATE ' . self::tableName . ' 
             SET  name=:productName,price=:price,brand_id=:brand_id,keyword=:keyword
            ,short_desc=:short_desc,status=:status,model=:model,chip=:chip,ram=:ram,card=:card,drive=:drive
            ,display=:display,connect=:connect,vantay=:vantay,operation=:operation,pin=:pin,weight=:weight,
            size=:size,discount=:discount WHERE id = :id');
            $stm->execute(array(
                ':productName' => $productName,
                ':price' => $price,
                ':brand_id' => $brand_id,
                ':keyword' => $keyword,
                ':short_desc' => $short_desc,
                ':status' => $status,
                ':model' => $model,
                ':chip' => $chip,
                ':ram' => $ram,
                ':card' => $card,
                ':drive' => $drive,
                ':card' => $card,
                ':display' => $display,
                ':connect' => $connect,
                ':vantay' => $vantay,
                ':operation' => $operation,
                ':pin' => $pin,
                ':weight' => $weight,
                ':size' => $size,
                ':discount' => $discount,
                ':id' => $id
            ));

            //update  content of products
            // lay id cua bang detail dua vao  product id
            $stm = $this->db->prepare("SELECT id FROM detail WHERE product_id=$id");
            $stm->execute();
            $iddetail = $stm->fetch();
            $iddetail = $iddetail['id'];
            for ($i = 1; $i <= 3; $i++) {
                $content = $payload['content' . $i];
                $title = $payload['title' . $i];
                $stmcontent = $this->db->prepare('UPDATE detail
                SET  content=:content, title=:title
                 WHERE id = :id');
                $stmcontent->execute(array(
                    ':content' => $content,
                    ':title' => $title,
                    ':id' => ($iddetail + ($i - 1))
                ));
            }
            //update category of product
            $stm = $this->db->prepare("SELECT id FROM cate_product WHERE product_id=$id");
            $stm->execute();
            $idCate_product = $stm->fetch();
            $idCate_product = $idCate_product['id'];
            for ($i = 0; $i <= 3; $i++) {
                $cate_id = $cate_ids[$i];
                $stmcontent = $this->db->prepare('UPDATE cate_product
                SET  cate_id=:cate_id
                 WHERE id = :id');
                $stmcontent->execute(array(
                    ':cate_id' => $cate_id,
                    ':id' => ($idCate_product + $i)
                ));
            }
        } catch (\Throwable $th) {
            echo $th->getMessage();
        } //tra ve so ban ghi
        return $stm->rowCount();
    }
    function getListByListID($id)
    {
        $stm = $this->db->prepare("SELECT * FROM " . self::tableName . " WHERE id= $id");
        $stm->execute();
        return $stm->fetchAll();
    }
    function getProductById($id)
    {
        $rows = $this->db->query("SELECT * FROM " . self::tableName . " WHERE id= $id");
        foreach ($rows as $r) {
            $row  = $r;
        }
        return $r;
    }
}
