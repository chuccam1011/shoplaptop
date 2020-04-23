<?php
require_once('./../db.php');
$db = new DB();
$stm = $db->getPDO()->prepare("SELECT id FROM detail WHERE product_id=7");
$stm->execute();
$iddetail = $stm->fetch();
$iddetail=$iddetail['id'];
echo $iddetail;
