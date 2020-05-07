<?php
include_once('./models/users.php') ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    $cate_ids = array(1);
    $conditions = '';
    for ($i = 0; $i < count($cate_ids); $i++) {

        $condition = ' cp.cate_id=' . "$cate_ids[$i] ";
        if ($i == count($cate_ids) - 1) {
        } else {
            $condition = $condition . ' AND ';
        }
        $conditions = $conditions . $condition;
    }
    echo $conditions;
    ?>
</body>

</html>