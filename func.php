<?php
function search($keyword)
{
    include('connect.php');
    $keyword = trim($keyword);
    $pro_kw = str_replace(' ', "%' or tieude like '%", $keyword);
    $query = "select * from baiviet p inner join tacgia a on a.ma_tgia=p.ma_tgia inner join theloai c on c.ma_tloai=p.ma_tloai where p.tieude like '%$pro_kw%'";

    $result = $conn->query($query) or die("Query failed: " . $conn->error);

    if ($result->num_rows > 0) {
        echo "<h3>Search result: $result->num_rows posts</h3>";
        while ($row = $result->fetch_assoc()) {
            echo <<<_RES
<pre>
    ID          $row[ma_bviet]
    Title       $row[tieude]
    Author      $row[ten_tgia]
    Created     $row[ngayviet]
    Song        $row[ten_bhat]
    Category    $row[ten_tloai]
    Summary     $row[tomtat]
</pre>
_RES;
        }
    } else {
        echo "Not found";
    }
}

function search_advance($keyword)
{
    include('connect.php');
    $keyword = trim($keyword);

    $pro_kw = "";
    $keys = explode('"', $keyword);
    if (count($keys) > 1) {
        for ($i = 0; $i < count($keys) - 1; $i++) {
            $key = trim($keys[$i]);
            if (!empty($key)) {
                if ($i == count($keys) - 2) {
                    if (empty(end($keys))) {
                        $pro_kw = $pro_kw . "$key";
                    } else {
                        $pro_kw = $pro_kw . "$key%' or tieude like '%" . trim(end($keys));
                    }
                } else {
                    $pro_kw = $pro_kw . "$key%' or tieude like '%";
                }
            }
        }
    } else {
        $pro_kw = $pro_kw = $pro_kw . "$keyword";
    }

    $pro_kw = str_replace('"', "", $pro_kw);
    $query = "select * from baiviet p inner join tacgia a on a.ma_tgia=p.ma_tgia inner join theloai c on c.ma_tloai=p.ma_tloai where p.tieude like '%$pro_kw%'";

    echo "$query";

    $result = $conn->query($query) or die("Query failed: " . $conn->error);

    if ($result->num_rows > 0) {
        echo "<h3>Search result: $result->num_rows posts</h3>";
        while ($row = $result->fetch_assoc()) {
            echo <<<_RES
<pre>
    ID          $row[ma_bviet]
    Title       $row[tieude]
    Author      $row[ten_tgia]
    Created     $row[ngayviet]
    Song        $row[ten_bhat]
    Category    $row[ten_tloai]
    Summary     $row[tomtat]
</pre>
_RES;
        }
    } else {
        echo "Not found";
    }
}

function baiviet_id()
{
    include('connect.php');
    $query = "select max(ma_bviet) + 1 as result from baiviet";
    return $conn->query($query)->fetch_assoc()['result'];
}
