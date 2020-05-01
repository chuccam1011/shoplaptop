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

    function getAll($offset, $count)
    {
        $stm = $this->db->prepare("SELECT * FROM " . self::tableName . " LIMIT $offset,$count");
        $stm->execute();
        return $stm->fetchAll();
    }
    function getOrderProducts($id)
    {

        $stm = $this->db->prepare("SELECT * FROM " . ' products_orders WHERE order_id=:id');
        $stm->execute(array(':id' => $id));
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

    function update($payload) //for admin update status
    {
        // $stm = $this->db->prepare('UPDATE ' . self::tableName . ' 
        //     SET address = :address, phone = :phone WHERE id = :id');
        //     $stm->execute(array(':address' => $address, ':phone' => $phone, ':id' => $id));
        try {
            $id = $payload['id'];
            $username = $payload['username'];
            $address = $payload['address'];
            $phone = $payload['phone'];
            $city = $payload['city'];
            $password = $payload['password'];
            $full_name = $payload['full_name'];
            $dob = $payload['dob'];
            $email = $payload['email'];
            $stm = $this->db->prepare('UPDATE  ' .
                self::tableName .
                ' SET username=:username,address=:address,phone=:phone
                ,password=:password,email=:email,city=:city,full_name=:full_name,dob=:dob WHERE id = :id');
            $stm->execute(array(
                ':username' => $username,
                ':address' => $address,
                ':phone' => $phone,
                ':email' => $email,
                ':password' => md5($password),
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

    function getById($id)
    {
        $rows = $this->db->query("SELECT * FROM " . self::tableName . " WHERE id= $id");
        foreach ($rows as $r) {
            $row  = $r;
        }
        return $r;
    }
    function getByUsername($username)
    {
        $stm =  $this->db->prepare('SELECT * FROM ' . self::tableName . " WHERE username = :username ");
        $stm->setFetchMode(PDO::FETCH_ASSOC);
        $stm->execute(array(':username' => $username));
        return  $stm->fetch();
    }
}
