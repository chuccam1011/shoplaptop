<?php
class upload
{
    public $realPath;
    public function upload()
    {
        if (isset($_FILES['file'])) {
            $size = $_FILES['file']['size'];
            $error = [];
            //nếu mà kích cỡ file mà lớn hơn 1 mb
            if ($size > 1 * 1024 * 1024) {
                $error[] = 'Kích thuớc file phải nhỏ hơn 1mb';
            }

            $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
            if ($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg') {
            } else   $error[] = 'File phải có định dạng png,jpg,jpeg';

            if (count($error) == 0) {
                // $dir = date('m', time()) . '_' . date('yy', time()) . '/'; // 3_2020 định dạng;
                // $dir = 'uploads/' . $dir; // uploads/3_2020;
                // tạo thư mục mới nếu chưa tồn tại (tạo thư mục theo tháng và năm)
                // if (!file_exists($dir) && !is_dir($dir)) {
                //     mkdir($dir, 0777); //make directory
                // }
                $tmpFile = $_FILES['file']['tmp_name'];
                global $realPath;
                $realPath =  time() . str_replace(' ', '_', $_FILES['file']['name']);
                //di chuyển file từ thư mục tạm sang thư mục thật
                $real =  'uploads/' . $realPath;
                move_uploaded_file($tmpFile, $real);
                return 1;
            }
            if (isset($error) && count($error) != 0) {
                foreach ($error as $r) {
                    echo '<p>' . $r . '</p>';
                }
            }
        }
    }
    public function getRealpath()
    { // lay ten anh dc luu trong uploads
        global $realPath;
        return $realPath;
    }

    public function uploadImgOfContent($n) //n la so anh cam upload
    {
        $src = array();
        for ($i = 1; $i <= $n; $i++) {
            if (isset($_FILES['file' . $i]) && $_FILES['file' . $i]['name'] != null) {
                $size = $_FILES['file' . $i]['size'];
                $error = [];
                if ($size > 1 * 1024 * 1024) {
                    $error[] = 'Kích thuớc file phải nhỏ hơn 1mb';
                }
                $ext = pathinfo($_FILES['file' . $i]['name'], PATHINFO_EXTENSION);
                if ($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg') {
                } else   $error[] = 'File phải có định dạng png,jpg,jpeg';

                if (count($error) == 0) {
                    move_uploaded_file($_FILES['file' . $i]['tmp_name'], 'uploads/' . time() . $_FILES['file' . $i]['name']);
                    $src[] = time() . $_FILES['file' . $i]['name'];
                }
                if (isset($error) && count($error) != 0) {
                    foreach ($error as $r) {
                        echo '<p>' . $r . '</p>';
                    }
                    return 0;
                }
            }
        }
        return $src;
    }
    public  function multiupload()
    {
        $src = array();
        if (isset($_FILES["files"]["tmp_name"])) {
            extract($_POST);
            $error = array();
            $extension = array("jpeg", "jpg", "png", "gif");
            foreach ($_FILES["files"]["tmp_name"] as $key => $tmp_name) {
                $file_name = $_FILES["files"]["name"][$key];
                $file_tmp = $_FILES["files"]["tmp_name"][$key];
                $ext = pathinfo($file_name, PATHINFO_EXTENSION);

                if (in_array($ext, $extension)) {
                    if (!file_exists("uploads/"  . $file_name)) {
                        move_uploaded_file($file_tmp, "uploads/" . $file_name);
                        $src[] = $file_name;
                    } else {
                        $filename = basename($file_name, $ext);
                        $newFileName = $filename . time() . "." . $ext;
                        move_uploaded_file($file_tmp, "uploads/" . $newFileName);
                        $src[] = $file_name;
                    }
                } else {
                    array_push($error, "$file_name, ");
                }
            }
        }
        return $src;
    }
}
