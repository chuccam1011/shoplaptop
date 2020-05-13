<?php
require_once('C:/xampp/htdocs/Laptopcu/db.php');
class Order extends DB
{
    const tableName = 'ordered';
    public function __construct()
    {
        parent::__construct();
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    function getListOrderByUser($user_id,$offset, $count)
    {
        $stm = $this->db->prepare("SELECT * FROM " . self::tableName . " WHERE user_id=:user_id ".' ORDER BY  id DESC'." LIMIT $offset,$count");
        $stm->execute(array(':user_id' => $user_id));
        return $stm->fetchAll();
    }
    function getOrder($offset, $count)
    { //in admin order
        $stm = $this->db->prepare('SELECT o.id,o.time,o.status,o.notes,u.username FROM ordered o INNER JOIN user u ON u.id = o.user_id
        ' . "ORDER BY  id DESC LIMIT $offset,$count");
        $stm->execute();
        return $stm->fetchAll();
    }
    function getOrderProducts($id) //get products of  order by user
    {
        $stm = $this->db->prepare("SELECT * FROM " . ' products_orders WHERE order_id=:id');
        $stm->execute(array(':id' => $id));
        return $stm->fetchAll();
    }
    function getProductListInOrder($id_order)
    {
        $stm = $this->db->prepare("SELECT p.name,p.price,p.id,po.quantity,p.quantity_product,p.selled FROM product p INNER JOIN products_orders po ON po.product_id=p.id INNER JOIN ordered o ON o.id=po.order_id " . " WHERE o.id=:id");
        $stm->execute(array(':id' => $id_order));
        return $stm->fetchAll();
    }
    function insert($payload, $cart)
    {
        try {
            $user_id = $payload['user_id'];
            $extra_address = '';
            $notes = $payload['shipping_notes'];

            //
            $stm = $this->db->prepare('INSERT INTO ' .
                self::tableName . '(user_id,status,notes,extra_address)
                 VALUES(:user_id, :status, :notes, :extra_address)');
            $stm->execute(array(
                'user_id' => $user_id,
                'status' => 0,
                'notes' => $notes,
                'extra_address' => $extra_address
            ));
            $db = new DB();
            $order_id = $db->getMax_id(self::tableName);
            // var_dump($cart);
            //insert ordered i to products_orders to save product
            foreach ($cart as $item) {

                $stm = $this->db->prepare('INSERT INTO ' .
                    'products_orders' . '(order_id,product_id,quantity)
                  VALUES(:order_id, :product_id, :quantity)');
                $stm->execute(array(
                    'order_id' => $order_id,
                    'product_id' => $item['id'],
                    'quantity' => $item['quantity']
                ));
            }
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }

        //tra ve so ban ghi
        return $stm->rowCount();
    }

    function delete($id) //for admin
    {
        $this->db->query("DELETE FROM " . self::tableName . " WHERE id = " . $id);
    }

    function update($id, $status, $listProducts_QuantityOrder, $check_status) //for admin update status
    {

        try {
            // update quantity_product

            if ($status == '2' && $check_status != 0) { //status = 2 la da nhan dc hang
                foreach ($listProducts_QuantityOrder as $product) {
                    $selled = $product['selled'] + $product['quantity'];
                    $quantity = $product['quantity_product'] - $product['quantity'];
                    $stm = $this->db->prepare('UPDATE  product' .
                        ' SET quantity_product=:quantity,selled=:selled WHERE id= :id');
                    $stm->execute(array( //product['quantity'] is the quantity of the order
                        ':quantity' => $quantity,
                        ':selled' => $selled,
                        ':id' => $product['id']
                    ));
                }
            }
            //udate the status
            $stm = $this->db->prepare('UPDATE  ' .
                self::tableName .
                ' SET status=:status WHERE id = :id');
            $stm->execute(array(
                ':status' => $status,
                ':id' => $id
            ));
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }

        return $stm->rowCount();
    }

    function updateUser($payload) //for user update
    {
        // $stm = $this->db->prepare('UPDATE ' . self::tableName . ' 
        //     SET address = :address, phone = :phone WHERE id = :id');
        //     $stm->execute(array(':address' => $address, ':phone' => $phone, ':id' => $id));
        try {
            $id = $payload['id'];
            // $username = $payload['username'];
            $address = $payload['address'];
            $phone = $payload['phone'];
            $city = $payload['city'];
            $full_name = $payload['full_name'];
            $dob = $payload['dob'];
            // $email = $payload['email'];
            $stm = $this->db->prepare('UPDATE  ' .
                self::tableName .
                ' SET address=:address,phone=:phone
                ,city=:city,full_name=:full_name,dob=:dob WHERE id = :id');
            $stm->execute(array(
                ':address' => $address,
                ':phone' => $phone,
                ':city' => $city,
                ':full_name' => $full_name,
                ':dob' => $dob,
                ':id' => $id
            ));
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }

        return $stm->rowCount();
    }

    function getOrderById($id)
    {
        $rows = $this->db->query("SELECT * FROM " . self::tableName . " WHERE id= $id");
        foreach ($rows as $r) {
            $row  = $r;
        }
        return $r;
    }
}
