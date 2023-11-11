<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Thông tin khách hàng</title>
    <style>
        tr:nth-child(even) {
            background-color: #dddddd;
        }
        th {
            color: blueviolet;
        }
        img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
        }
    </style>
</head>


<body>
    <?php
    // Ket noi CSDL
    //require("connect.php");
    $conn = mysqli_connect('localhost', 'root', '', 'qlbansua')
        or die('Could not connect to MySQL: ' . mysqli_connect_error());
    $sql = 'select Ma_khach_hang,Ten_khach_hang,Phai,Dia_chi,Dien_thoai,Email from Khach_hang';
    $result = mysqli_query($conn, $sql);
    echo "<p align='center'><font size='5' color='blue'> THÔNG TIN KHÁCH HÀNG</font></P>";
    echo "<table align='center' width='1500' border='1' cellpadding='2' cellspacing='2' style='border-collapse:collapse'>";
    echo '<tr>
    <th width="50">STT</th>
    <th width="100">Mã khách hàng</th>
    <th width="800">Tên khách hàng</th>
    <th width="200">Phái</th>
    <th width="1000">Địa chỉ</th>
    <th width="200">Điện thoại</th>
    <th width="200">Email</th>
</tr>';

    if (mysqli_num_rows($result) <> 0) {
        $stt = 1;
        while ($rows = mysqli_fetch_row($result)) {
            echo "<tr>";
            echo "<td>$stt</td>";
            echo "<td>$rows[0]</td>";
            echo "<td>$rows[1]</td>";
            echo $rows[2] == 1 ? 
            "<td align='center'><img src='./avatar/Avt-đôi-Anime-nu.jpg'></td>" : 
            "<td align='center'><img src='./avatar/Avt-đôi-Anime-nam.jpg'></td>";
            echo "<td>$rows[3]</td>";
            echo "<td>$rows[4]</td>";
            echo "<td>$rows[5]</td>";
            echo "</tr>";
            $stt += 1;
        }
    }
    echo "</table>";
    ?>
</body>
</html>