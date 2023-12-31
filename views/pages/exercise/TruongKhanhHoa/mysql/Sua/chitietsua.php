<?php $this->layout('layout_exercise') ?>
<?php $this->section('content'); ?>

<style>
    .container {
        display: block;
        max-width: 1200px;
        margin: 0 auto;
        border: 1px solid #000;
    }

    .item {
        display: flex;
        font-size: 20px;
    }

    .item>div {
        border-left: 1px solid #000;
        padding-left: 10px;
    }

    p {
        margin: 5px 0;
    }

    h4 {
        margin-bottom: 0;
    }

    img {
        width: 300px;
        padding: 10px;
    }
</style>
</head>
<?php
$conn = mysqli_connect('localhost', 'root', '', 'qlbansua')
    or die('Could not connect to MySQL: ' . mysqli_connect_error());
$sql = "
select Ten_sua,TP_Dinh_Duong,Loi_ich,Don_gia,Trong_luong,Hinh 
from sua where Ma_sua = '{$_GET['masua']}'";
$result = mysqli_query($conn, $sql);
$ds_sua = [];
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    $ds_sua[] = array(
        'Ten_sua' => $row['Ten_sua'],
        'Trong_luong' => $row['Trong_luong'],
        'Don_gia' => $row['Don_gia'],
        'TP_Dinh_Duong' => $row['TP_Dinh_Duong'],
        'Loi_ich' => $row['Loi_ich'],
        'Hinh' => $row['Hinh'],
    );
}
?>
<h1 align="center" style="background-color: blueviolet;"><?= $ds_sua[0]['Ten_sua'] ?></h1>
<div class="container">
    <div class="item" align="left">
        <img src="http://localhost/QuanLyTienLuong_PHP/views/pages/exercise/TruongKhanhHoa/Hinh_sua/<?= $ds_sua[0]['Hinh'] ?>" alt="">
        <div>
            <p>
            <h4>Thành phần dinh dưỡng</h4> <br>
            <?= $ds_sua[0]['TP_Dinh_Duong'] ?>
            </p>
            <p>
            <h4>Lợi ích</h4> <br>
            <?= $ds_sua[0]['Loi_ich'] ?>
            </p>
        </div>
    </div>
    <!-- <p align="right">Trọng lượng: <?= $ds_sua[0]['Trong_luong'] . " - Đơn giá: " . $ds_sua[0]['Don_gia'] ?></p> -->
</div>
<?php $this->end(); ?>