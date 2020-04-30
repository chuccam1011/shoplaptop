<?php
require_once('./../db.php');
require_once('iadmin.php');
class Admin extends DB implements Iadmin
{
    const tableName = 'admin';
    public function __construct()
    {
        parent::__construct();
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    function insert($payload) ///register
    {
        try {
            $alert = '';
            $username = $payload['username'];
            $phone = $payload['phone'];
            $password = $payload['password'];
            $email = $payload['email'];
            $passwordR = $payload['passwordR'];
            if ($password == $passwordR) {
                $stm = $this->db->prepare('INSERT INTO ' .
                    self::tableName . '(username,phone,password,email)
                 VALUES(:username,:phone,:password,:email)');
                $stm->execute(array(
                    ':username' => $username,
                    ':phone' => $phone,
                    ':password' => md5($password),
                    ':email' => $email

                ));
            } else {
                $alert = 'Mat khau k khop';
                return $alert;
            }
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
        //tra ve so ban ghi
        return $stm->rowCount();
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

    function update($payload)//chua su dung toi
    {
        try {
            $username = $payload['username'];
            $phone = $payload['phone'];
            $password = $payload['password'];
            $email = $payload['email'];
            $id = $payload['id'];
            $stm = $this->db->prepare('UPDATE ' . self::tableName . ' 
            SET    username=:username,=:phone,password=:password,email=:email WHERE id = :id');
            $stm->execute(array(
                ':username' => $username,
                ':phone' => $phone,
                ':password' => $password,
                ':email' => $email,
                ':id' => $id
            ));
            //tra ve so ban ghi
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }

        return $stm->rowCount();
    }

    function getAdminById($id)//chua su dung toi
    {
        $rows = $this->db->query("SELECT * FROM " . self::tableName . " WHERE id= $id");
        foreach ($rows as $r) {
            $row  = $r;
        }
        return $r;
    }
}
