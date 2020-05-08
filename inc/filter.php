<?php
$product = new Product();
// make condition filter to in WHERE DB
$conditions = '';
if (isset($_POST['filter'])) {
    $filters = array();
    foreach ($_POST as $key => $value) {
        if ($value != '') {
            $filters[$key] = $value;
        }
    }
    //    var_dump($filters);
    $i = 0;
    foreach ($filters as $key => $value) {
        $i++;
        if ($i == count($filters)) {
            $condition = $key . ' LIKE ' . "'" . '%' . $value . '%' . "'";
        } else {
            $condition = $key . ' LIKE ' . "'" . '%' . $value . '%' . "'" . ' AND ';
        }
        $conditions = $conditions . $condition;
    }
}
?>
<div class="container">
    <form method="post">
        <table class="table table-striped table-inverse table-responsive">
            <thead class="thead-inverse">
                <tr>
                    <th>CPU</th>
                    <th>RAM</th>
                    <th>VGA</th>
                    <th>Ổ Cưng</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td scope="row"><select name="chip" id="">
                            <option value="">chon</option>
                            <option value="i3">Intel core I3</option>
                            <option value="i5">Intel core i5</option>
                            <option value="i7">Intel core i7</option>
                            <option value="i9">Intel core i9</option>
                        </select>
                    </td>
                    <td> <select name="ram" id="">
                            <option value="">chon</option>
                            <option value="4">4 GB</option>
                            <option value="8">8 GB</option>
                            <option value="12">12 GB</option>
                            <option value="16">16 GB</option>
                        </select>
                    </td>
                    <td> <select name="card" id="">
                            <option value="">chon</option>
                            <option value="1060">GTX 1060</option>
                            <option value="1070">GTX 1070</option>
                            <option value="1080">GTX 1080</option>
                        </select>
                    </td>
                    <td> <select name="drive" id="">
                            <option value="">chon</option>
                            <option value="ssd">SSD</option>
                            <option value="hdd">HDD</option>
                        </select>
                    </td>
                </tr>

            </tbody>
        </table>
        <button type="submit" value="" name="filter">Lọc</button>
        <hr>
    </form>
</div>