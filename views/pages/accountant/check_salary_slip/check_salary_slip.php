<?php $this->layout('layout_accountant') ?>
<?php $this->section('content'); ?>
<style>
    table {
        border-collapse: collapse;
        width: 100%;
    }

    td {
        padding: 5px;
        padding-right: 20px;

    }

    .table-hover tbody td {
        padding: 13px 10px 13px 25px;

    }

    .table-hover tbody td a i {
        font-size: 22px;
        margin-right: 8px;
    }

    p {
        font-size: 18px;
        font-weight: bold;
        height: 30px;
    }

    label {
        margin-right: 5px;
    }

    .form-select {
        padding: 0.375rem 2.25rem 0.375rem 0.75rem;
    }

    .card .navbar {
        padding: 0;
        border-radius: 10px;
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
        padding: 3px 5px;
        margin: 1PX;
        border: 1px solid #ccc;
        text-decoration: none;
        color: #333;
        font-size: 12px;
        border-radius: 15px;
    }

    .pagination-link.active {
        background-color: #333;
        color: #fff;

    }

    .pagination-link:not(.active) {
        font-weight: 400;
        font-size: 12px;
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

if (isset($_GET['thang']))
    $thang = $_GET['thang'];
else $thang = "";

if (isset($_GET['nam']))
    $nam = $_GET['nam'];
else $nam = "";

$rowsPerPage = 5; //số mẩu tin trên mỗi trang, giả sử là 10
if (!isset($_GET['p'])) {
    $_GET['p'] = 1;
}
//vị trí của mẩu tin đầu tiên trên mỗi trang
$offset = ($_GET['p'] - 1) * $rowsPerPage;
//lấy $rowsPerPage mẩu tin, bắt đầu từ vị trí $offset

$sqlTimKiem =
    "select *, TenPhong, TenChucVu from nhan_vien, chuc_vu, phong_ban,phieu_luong
            where nhan_vien.MaPhong = phong_ban.MaPhong 
            and nhan_vien.MaChucVu = chuc_vu.MaChucVu
            and nhan_vien.MaNV = phieu_luong.MaNV
        ";

if (isset($_GET['timkiem'])) {
    if ($maNV != "") {
        $sqlTimKiem .= " and nhan_vien.MaNV = '$maNV'";
    }
    if ($hoTen != "") {
        $sqlTimKiem .= " and concat(HoNV,' ',TenNV) like '%$hoTen%'";
    }
    if ($maPhong != "") {
        $sqlTimKiem .= " and nhan_vien.MaPhong = '$maPhong'";
    }
    if ($maChucVu != "") {
        $sqlTimKiem .= " and nhan_vien.MaChucVu = '$maChucVu'";
    }
    if ($thang != "") {
        $sqlTimKiem .= " and Thang = $thang";
    }
    if ($nam != "") {
        $sqlTimKiem .= " and Nam = $nam";
    }


    $resultTimKiem = mysqli_query($conn, $sqlTimKiem);
}
$sqlTimKiem .= " order by nhan_vien.MaNV";
$resultTimKiem = mysqli_query($conn, $sqlTimKiem);
$numRows = mysqli_num_rows($resultTimKiem);
$sqlTimKiem .= " LIMIT $offset,$rowsPerPage";
$resultTimKiem = mysqli_query($conn, $sqlTimKiem);

?>
<!-- Card stats -->
<div class="g-6 mb-3 w-100 search-container mt-5">
    <div class="col-xl-12 col-sm-12 col-12">
        <div class="card shadow border-0 d-flex">
            <nav class="navbar navbar-light bg-light d-flex justify-content-center py-1">
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
                            <td>
                                <p>Tháng</p>
                            </td>
                            <td><input class="form-control me-2 search-input" type="text" name="thang" value="<?php echo $thang; ?>"></td>
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
                            <td>
                                <p>Năm</p>
                            </td>
                            <td><input class="form-control me-2 search-input" type="text" name="nam" value="<?php echo $nam; ?>"></td>
                        </tr>
                        <tr>
                            <td align="center" colspan="6">
                                <!-- <button type="submit" name="timkiem">timkiem</button> -->
                                <input type="text" name="page" value="accountant-check-salary-slip" style="display: none"> 
                                <input style="width:150" class="btn btn-outline-success search-btn" name="timkiem" type="submit" value="Tìm kiếm" />
                            </td>
                        </tr>
                    </table>
                </form>
            </nav>
        </div>
    </div>
</div>
<div style="height:490px">

    <div class="card shadow border-0 mb-3">
        <table class="table table-hover table-nowrap">
            <thead>
                <tr>
                    <th scope="col">mã phiếu lương</th>
                    <th scope="col">mã nhân viên</th>
                    <th scope="col">họ tên</th>
                    <th scope="col">chức vụ</th>
                    <th scope="col">phòng</th>
                    <th scope="col">số ngày công</th>
                    <th scope="col">số ngày vắng</th>
                </tr>
            </thead>

            <tbody>
                <?php

                //tổng số trang
                $maxPage = floor($numRows / $rowsPerPage) + 1;
                if (mysqli_num_rows($resultTimKiem) <> 0) {

                    while ($rows = mysqli_fetch_array($resultTimKiem)) {
                        echo "<tr  >
                         <td >{$rows['MaPhieuLuong']}</td>
                            <td >{$rows['MaNV']}</td>
                            <td >{$rows['HoNV']} {$rows['TenNV']}</td>
                            <td >{$rows['TenChucVu']}</td>
                            <td >{$rows['TenPhong']}</td>
                            <td >{$rows['SoNgayCong']}</td>
                            <td >{$rows['SoNgayVang']}</td>
                            <td ><a href='index.php?page=accountant-detail-salary-slip'><i style='color:green' class='bi bi-person-lines-fill'></i></a></td>
                            <td ><a href='index.php?page=accountant-edit-salary-slip'><i style='color:blue' class='bi bi-pencil-square'></i></a></td>
                            </tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<?php
echo '<div align="center">';
echo "<a class='pagination-link' href=" . $_SERVER['PHP_SELF'] . "?page=accountant-check-salary-slip&maNV=$maNV&phong=$maPhong&timkiem=Tìm+kiếm&hoTen=$hoTen&chucVu=$maChucVu&thang=$thang&nam=$nam&p=" . (1) . ">Về đầu</a> ";
echo "<a class='pagination-link' href=" . $_SERVER['PHP_SELF'] . "?page=accountant-check-salary-slip&maNV=$maNV&phong=$maPhong&timkiem=Tìm+kiếm&hoTen=$hoTen&chucVu=$maChucVu&thang=$thang&nam=$nam&p=" . ($_GET['p'] > 1 ? $_GET['p'] - 1 : 1) . "><</a> ";
for ($i = 1; $i <= $maxPage; $i++) {
    if ($i == $_GET['p']) {
        echo '<a class="pagination-link active">' . $i . '</a>'; //trang hiện tại sẽ được bôi đậm
    } else
        echo "<a class='pagination-link'  href=" . $_SERVER['PHP_SELF'] . "?page=accountant-check-salary-slip&maNV=$maNV&phong=$maPhong&timkiem=Tìm+kiếm&hoTen=$hoTen&chucVu=$maChucVu&thang=$thang&nam=$nam&p=" . $i . ">" . $i . "</a> ";
}
echo "<a class='pagination-link' href=" . $_SERVER['PHP_SELF'] . "?page=accountant-check-salary-slip&maNV=$maNV&phong=$maPhong&timkiem=Tìm+kiếm&hoTen=$hoTen&chucVu=$maChucVu&thang=$thang&nam=$nam&p=" . ($_GET['p'] < $maxPage ? $_GET['p'] + 1 : $maxPage) . ">></a>";
echo "<a class='pagination-link' href=" . $_SERVER['PHP_SELF'] . "?page=accountant-check-salary-slip&maNV=$maNV&phong=$maPhong&timkiem=Tìm+kiếm&hoTen=$hoTen&chucVu=$maChucVu&thang=$thang&nam=$nam&p=" . ($maxPage) . ">Về cuối</a> ";
echo "</div>";
?>
<?php $this->end(); ?>