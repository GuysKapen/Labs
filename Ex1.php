<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        td:nth-child(2) {
            padding-left: 1rem;
        }

        td {
            vertical-align: bottom;
            text-align: right;
        }

        textarea {
            width: 100%;
        }

        .error {
            color: red;
            margin-left: 0.5rem;
        }
    </style>
</head>

<body>
    <h3>Add post</h3>
    <?php
    include_once 'func.php';
    include_once('connect.php');
    ?>
    <hr>
    <form id="form" action="" method="POST">
        <table>
            <tr>
                <td>Ma bai viet</td>
                <td><input type="text" name="ma_bviet" value="<?php echo baiviet_id(); ?>"><span id="ma-bviet-error" class="error"></span></td>
            </tr>
            <tr>
                <td>Tieu de</td>
                <td><input type="text" name="tieude"><span id="tieude-error" class="error"></span></td>
            </tr>
            <tr>
                <td>Ma tac gia</td>
                <td><input type="text" name="ma_tgia"><span id="ma-tgia-error" class="error"></span></td>
            </tr>
            <tr>
                <td>Ngay viet</td>
                <td><input type="text" name="ngayviet" value="<?php echo date('Y/m/d'); ?>"><span id="ngayviet-error" class="error"></span></td>
            </tr>
            <tr>
                <td>Bai hat</td>
                <td><input type="text" name="ten_bhat"><span id="ten-bhat-error" class="error"></span></td>
            </tr>
            <tr>
                <td>Ma the loai</td>
                <td><input type="text" name="ma_tloai"><span id="ma-tloai-error" class="error"></span></td>
            </tr>
            <tr>
                <td>Tom tat</td>
                <td><textarea type="text" name="tomtat" rows="5"><span id="tomtat-error" class="error"></span></textarea></td>
            </tr>
            <tr>
                <td></td>
                <td><button type="submit" name="add">Them bai viet</button></td>
            </tr>
        </table>
    </form>

    <?php
    if (isset($_POST['add'])) {
        $ma_bviet = $_POST['ma_bviet'];
        $tieude = $_POST['tieude'];
        $ma_tgia = $_POST['ma_tgia'];
        $ngay_viet = $_POST['ngayviet'];
        $ten_bhat = $_POST['ten_bhat'];
        $ma_tloai = $_POST['ma_tloai'];
        $tomtat = $_POST['tomtat'];
        $query = "INSERT INTO baiviet(ma_bviet, tieude, ten_bhat, ma_tloai, tomtat, ma_tgia, ngayviet) values ('$ma_bviet', '$tieude', '$ten_bhat', '$ma_tloai', '$tomtat', '$ma_tgia', '$ngay_viet')";

        if ($conn->query($query)) {
            echo "Title '$tieude' has been added";
        } else {
            echo "Insert failed: " . $conn->error;
        }
    }
    ?>

    <hr>

    <?php
    $query = "select * from baiviet p inner join tacgia a on a.ma_tgia=p.ma_tgia inner join theloai c on c.ma_tloai=p.ma_tloai";

    $result = $conn->query($query) or die("Query failed: " . $conn->error);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo <<<_RES
    <p>$row[ma_bviet]. <b>$row[tieude] ($row[ten_tloai]).</b> $row[ten_tgia]. $row[ngayviet]</p>
    _RES;
        }
    } else {
        echo "Not found";
    }
    ?>


<script>
        const form = document.getElementById("form");
        form.addEventListener('submit', (e) => {
            e.preventDefault();

            const MaError = document.getElementById("ma-bviet-error");
            const tieuDeError = document.getElementById("tieude-error");
            const tGiaError = document.getElementById("ma-tgia-error");
            const ngayVietError = document.getElementById("ngayviet-error");
            const tenBHatError = document.getElementById("ten-bhat-error");
            const tLoaiError = document.getElementById("ma-tloai-error");
            const tomtatError = document.getElementById("tomtat-error");


            if (!form.elements["ma_bviet"].value) {
                nameError.textContent = "Ma bai viet is required";
            }

            
            if (!form.elements["tieude"].value) {
                tieuDe.textContent = "Tieu de is required";
            }

            
            if (!form.elements["ma_tgia"].value) {
                tGiaError.textContent = "Ma tac gia is required";
            }

            
            if (!form.elements["ngayviet"].value) {
                ngayVietError.textContent = "Ngay viet is required";
            }

            
            if (!form.elements["ten_bhat"].value) {
                tenBHatError.textContent = "Ten bai hat is required";
            }

            
            if (!form.elements["ma_tloai"].value) {
                tLoaiError.textContent = "Ma the loai is required";
            }

            
            if (!form.elements["tomtat"].value) {
                tomtatError.textContent = "Tomtat is required";
            }

        })

    </script>

</body>

</html>