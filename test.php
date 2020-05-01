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
    $users = new Users();
    $arr=array(

        'username'=>'chuc',
        'password'=>'1'
    );
    var_dump($users->checkLogin($arr));

    ?>
</body>

</html>