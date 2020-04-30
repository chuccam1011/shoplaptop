<?php
require_once('C:/xampp/htdocs/Laptopcu/db.php');
require_once('imodel.php');
class Users extends DB implements IModel
{
    const tableName = 'user';
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

    function insert($payload)
    {
        try {

            $username = $payload['username'];
            $address = $payload['address'];
            $phone = $payload['phone'];
            $city = $payload['city'];
            $password = $payload['password'];
            $passwordR = $payload['passwordR'];
            $full_name = $payload['full_name'];
            $dob = $payload['dob'];
            $email = $payload['email'];
            if ($password = $passwordR) {
                $check = self::checkUser_Enail($username, $email);
                if ($check == 'OK') {
                    $stm = $this->db->prepare('INSERT INTO ' .
                        self::tableName . '(username,address,phone,password,email,city,full_name,dob)
                               VALUES(:username,:address,:phone,:password,:email,:city,:full_name,:dob)');
                    $stm->execute(array(
                        ':username' => $username,
                        ':address' => $address,
                        ':phone' => $phone,
                        ':email' => $email,
                        ':password' => md5($password),
                        ':city' => $city,
                        ':full_name' => $full_name,
                        ':dob' => $dob
                    ));
                } else return $check;
            } else return 'Hai mật khảu không khớp';
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }

        //tra ve so ban ghi
        return $stm->rowCount();
    }
    function checkUser_Enail($username, $email)
    {
        $stm = $this->db->prepare("SELECT * FROM " . self::tableName . " WHERE username=:username");
        $stm->setFetchMode(PDO::FETCH_ASSOC);
        $stm->execute(array(":username" => $username));
        $check = $stm->fetch();
        if (!empty($check)) {
            return 'Tên đăng nhập đã tồn tại';
        }
        $stm = $this->db->prepare("SELECT * FROM " . self::tableName . " WHERE email=:email");
        $stm->setFetchMode(PDO::FETCH_ASSOC);
        $stm->execute(array(':email' => $email));
        $check = $stm->fetch();
        if (!empty($check)) {
            return 'Email đã tồn tại';
        }
        return 'OK';
    }
    function checkLogin($payload)
    {
        $username = $payload['username'];
        $password = $payload['password'];
        $stm =  $this->db->prepare('SELECT * FROM ' . self::tableName . " WHERE username = :username AND password = :password  LIMIT 1");
        $stm->setFetchMode(PDO::FETCH_ASSOC);
        $stm->execute(array(':username' => $username, ':password' =>  md5($password)));
        return  $stm->fetch();
    }
    function delete($id)
    {
        $this->db->query("DELETE FROM " . self::tableName . " WHERE id = " . $id);
    }

    function update($payload)
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
    public function login($payload)
    {
    }
    public function register($payload)
    {
        # code...
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
