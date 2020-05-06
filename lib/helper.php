<?php
require_once('C:/xampp/htdocs/Laptopcu/db.php');
$pdo = new DB();
$pdo = $pdo->getPDO();
// $pdo = new PDO('mysql:host=localhost;dbname=shop_laptop', 'root', '');
$pdo->exec('set names utf8');
function generatePage($pdo, $tableName, $count)
{
    $row = $pdo->query('select count(*) as count from ' . $tableName);
    foreach ($row as $r) {
        $allRows = $r['count'];
    }
    $page = ceil($allRows / $count); //11/5 = 2.2 xấp xỉ 3 -> 2 trang
    for ($i = 0; $i < $page; $i++) {
        $pageCount = $i + 1;
        if (isset($_GET['page']) && $_GET['page'] == $pageCount) {
            echo '<a class="active" href="?page=' . $pageCount . '">' . $pageCount . '</a>';
        } else {
            echo '<a href="?page=' . $pageCount . '">' . $pageCount . '</a>';
        }
    }
}
