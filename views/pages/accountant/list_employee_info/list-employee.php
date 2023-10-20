<?php $this->layout('layout_accountant') ?>
<?php $this->section('content'); ?>

<style>
    table img {
        width: 50px;
        height: 50px;
        border-radius: 5px;
        border: 1.5px solid black;
    }

    table {
        border-collapse: collapse;
        width: 100%;
    }

    td {
        padding: 10px;
        font-size: 20px;
    }

    p {
        font-size: 16px;
        font-weight: bold;
    }
    label{
        margin-right: 5px;
    }

    input[type="radio"] {
        transform: scale(1.6);
        margin-right: 5px;
        margin-left: 5px;
    }

    .larger-text {
        font-size: 20px;
        /* Điều chỉnh kích thước chữ theo nhu cầu */
        margin-right: 20px;
        /* Điều chỉnh khoảng cách giữa nút radio và văn bản */
    }

    .form-control {
        height: 30px;
    }

    a {
        text-decoration: none;
        color: blue;
        font-size: 16px;
    }

    .search-btn {
        width: 100%;

    }

    .search-btn span {
        margin-right: 5px;
    }

    .pagination-link {
        display: inline-block;
        padding: 5px 8px;
        margin: 0 3px;
        border: 1px solid #ccc;
        text-decoration: none;
        color: #333;
        font-size: 14px;

    }

    .pagination-link.active {
        background-color: #333;
        color: #fff;
    }

    .pagination-link:not(.active) {
        font-weight: 400;
        font-size: 14px;
        color: #666;
    }
</style>
<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/' . explode('/', $_SERVER['PHP_SELF'])[1] . "/connect.php");

$sqlChucVu = 'select MaChucVu, TenChucVu from chuc_vu';

$resultChucVu = mysqli_query($conn, $sqlChucVu);

$sqlPhong = 'select MaPhong, TenPhong from phong_ban';

$resultPhong = mysqli_query($conn, $sqlPhong);

if (isset($_GET['maNV']))
    $maNV = trim($_GET['maNV']);
else $maNV = "";

if (isset($_GET['hoTen']))
    $hoTen = trim($_GET['hoTen']);
else $hoTen = "";

if (isset($_GET['phong']))
    $maPhong = $_GET['phong'];
else $maPhong = "";

if (isset($_GET['chucVu']))
    $maChucVu = $_GET['chucVu'];
else $maChucVu = "";

if (isset($_GET['radGT']))
    $gioiTinh = $_GET['radGT'];
else $gioiTinh = "";

$rowsPerPage = 4; //số mẩu tin trên mỗi trang, giả sử là 10
if (!isset($_GET['p'])) {
    $_GET['p'] = 1;
}
//vị trí của mẩu tin đầu tiên trên mỗi trang
$offset = ($_GET['p'] - 1) * $rowsPerPage;
//lấy $rowsPerPage mẩu tin, bắt đầu từ vị trí $offset

$sqlTimKiem =
    "select *, TenPhong, TenChucVu from nhan_vien, chuc_vu, phong_ban
            where nhan_vien.MaPhong = phong_ban.MaPhong 
            and nhan_vien.MaChucVu = chuc_vu.MaChucVu
        ";

if (isset($_GET['timkiem'])) {
    if ($maNV != "") {
        $sqlTimKiem .= "and MaNV = '$maNV'";
    }
    if ($hoTen != "") {
        $sqlTimKiem .= "and concat(HoNV,' ',TenNV) like '%$hoTen%'";
    }
    if ($maPhong != "") {
        $sqlTimKiem .= "and nhan_vien.MaPhong = '$maPhong'";
    }
    if ($maChucVu != "") {
        $sqlTimKiem .= "and nhan_vien.MaChucVu = '$maChucVu'";
    }
    if ($gioiTinh != "-1" && $gioiTinh != "") {
        $sqlTimKiem .= "and GioiTinh = '$gioiTinh'";
    }



    $resultTimKiem = mysqli_query($conn, $sqlTimKiem);
}
$sqlTimKiem .= "order by MaNV";
$resultTimKiem = mysqli_query($conn, $sqlTimKiem);
$numRows = mysqli_num_rows($resultTimKiem);
$sqlTimKiem .= " LIMIT $offset,$rowsPerPage";
$resultTimKiem = mysqli_query($conn, $sqlTimKiem);

?>
<!-- Card stats -->
<div class="g-6 mb-6 w-100 search-container mt-5">
    <div class="col-xl-12 col-sm-12 col-12">
        <div class="card shadow border-0 d-flex">
            <nav class="navbar navbar-light bg-light d-flex ">
                <form action="" method="get">
                    <table>
                        <tr>
                            <td>
                                <p>Mã nhân viên</p>
                            </td>
                            <td><input class="form-control me-2 search-input" type="text" name="maNV" value="<?php echo $maNV; ?>"></td>
                            <td>
                                <p>Phòng</p>
                            </td>
                            <td>

                                <select name="phong" class="form-select search-option" id="inputGroupSelect02">
                                    <option value="">Trống</option>
                                    <?php
                                    if (mysqli_num_rows($resultPhong) <> 0) {

                                        while ($rows = mysqli_fetch_array($resultPhong)) {
                                            echo "<option value='$rows[MaPhong]'";
                                            if (isset($_GET['phong']) && $_GET['phong'] == $rows['MaPhong']) echo "selected";
                                            echo ">$rows[TenPhong]</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </td>
                            <td  >
                                <p>Giới tính</p>
                                <div style="display: flex; justify-content:space-between; font-size: 18px;">
                                    <input  type="radio" name="radGT" id="nam" value="1" <?php if (isset($_GET['radGT']) && $_GET['radGT'] == "1") echo "checked" ?>> 
                                    <label for="nam">
                                        Nam
                                    </label>
                                    <input type="radio" name="radGT" id="nu" value="0" <?php if (isset($_GET['radGT']) && $_GET['radGT'] == "0") echo "checked" ?>> 
                                    <label  for="nu">
                                        Nữ
                                    </label>
                                    <input type="radio" name="radGT" id="none" value="-1" <?php if (isset($_GET['radGT']) && $_GET['radGT'] == "-1") echo "checked" ?>> 
                                    <label  for="none">
                                        Không
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>Họ tên nhân viên</p>
                            </td>
                            <td><input class="form-control me-2 search-input" type="text" name="hoTen" value="<?php echo $hoTen; ?>"></td>
                            <td>
                                <p>Chức vụ</p>
                            </td>
                            <td>

                                <select name="chucVu" class="form-select search-option" id="inputGroupSelect02">
                                    <option value="">Trống</option>
                                    <?php
                                    if (mysqli_num_rows($resultChucVu) <> 0) {
                                        while ($rows = mysqli_fetch_array($resultChucVu)) {
                                            echo "<option value='$rows[MaChucVu]'";
                                            if (isset($_GET['chucVu']) && $_GET['chucVu'] == $rows['MaChucVu']) echo "selected";
                                            echo ">$rows[TenChucVu]</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </td>
                            <td align="center" rowspan="3">
                                <input class="btn btn-outline-success search-btn" name="timkiem" type="submit" value="Tìm kiếm" />
                            </td>
                        </tr>
                    </table>

                </form>
            </nav>
        </div>
    </div>
</div>
<div class="card shadow border-0 mb-7">
    <div class="card-header">
        <h5 class="mb-0">THÔNG TIN NHÂN VIÊN</h5>
    </div>
    <div>
        <table class="table table-hover table-nowrap">
            <thead class="thead-light">
                <tr>
                    <th scope="col">mã nhân viên</th>
                    <th scope="col">họ tên</th>
                    <th scope="col">ảnh</th>
                    <th scope="col">giới tính</th>
                    <th scope="col">chức vụ</th>
                    <th scope="col">phòng</th>
                    <th scope="col"></th>
                </tr>
            </thead>

            <tbody>
                <?php

                //tổng số trang
                $maxPage = floor($numRows / $rowsPerPage) + 1;
                if (mysqli_num_rows($resultTimKiem) <> 0) {

                    while ($rows = mysqli_fetch_array($resultTimKiem)) {
                        if ($rows['GioiTinh'] == 0) $gt = "Nữ";
                        else $gt = "Nam";
                        echo "<tr>
                        <td>{$rows['MaNV']}</td>
                        <td>{$rows['HoNV']} {$rows['TenNV']}</td>
                        <td><img src='" . "/" . explode('/', $_SERVER['PHP_SELF'])[1] . "/assets/images/imgnv/$rows[Hinh]" . "' alt='Avatar'></td>
                        <td>{$gt}</td>
                        <td>{$rows['TenChucVu']}</td>
                        <td>{$rows['TenPhong']}</td>
                        <td><a href=''>Xem chi tiết</a></td>
                        </tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<?php
echo '<p align="center">';
echo "<a class='pagination-link' href=" . $_SERVER['PHP_SELF'] . "?maNV=$maNV&phong=$maPhong&timkiem=Tìm+kiếm&hoTen=$hoTen&chucVu=$maChucVu&radGT=$gioiTinh&p=" . (1) . ">Về đầu</a> ";
echo "<a class='pagination-link' href=" . $_SERVER['PHP_SELF'] . "?maNV=$maNV&phong=$maPhong&timkiem=Tìm+kiếm&hoTen=$hoTen&chucVu=$maChucVu&radGT=$gioiTinh&p=" . ($_GET['p'] > 1 ? $_GET['p'] - 1 : 1) . ">Back</a> ";
for ($i = 1; $i <= $maxPage; $i++) {
    if ($i == $_GET['p']) {
        echo '<a class="pagination-link active">' . $i . '</a>'; //trang hiện tại sẽ được bôi đậm
    } else
        echo "<a class='pagination-link'  href=" . $_SERVER['PHP_SELF'] . "?maNV=$maNV&phong=$maPhong&timkiem=Tìm+kiếm&hoTen=$hoTen&chucVu=$maChucVu&radGT=$gioiTinh&p=" . $i . ">" . $i . "</a> ";
}
echo "<a class='pagination-link' href=" . $_SERVER['PHP_SELF'] . "?maNV=$maNV&phong=$maPhong&timkiem=Tìm+kiếm&hoTen=$hoTen&chucVu=$maChucVu&radGT=$gioiTinh&p=" . ($_GET['p'] < $maxPage ? $_GET['p'] + 1 : $maxPage) . ">Next</a>";
echo "<a class='pagination-link' href=" . $_SERVER['PHP_SELF'] . "?maNV=$maNV&phong=$maPhong&timkiem=Tìm+kiếm&hoTen=$hoTen&chucVu=$maChucVu&radGT=$gioiTinh&p=" . ($maxPage) . ">Về cuối</a> ";
echo "</p>";
?>
<?php $this->end(); ?>