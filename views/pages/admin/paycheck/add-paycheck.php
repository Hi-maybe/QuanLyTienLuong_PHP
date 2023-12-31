<?php $this->layout('layout_admin') ?>
<?php $this->section('content'); ?>


<?php
//Ket noi CSDL
include_once($_SERVER['DOCUMENT_ROOT'] . '/' . explode('/', $_SERVER['PHP_SELF'])[1] . "/connect.php");

$getNhanVien = 'select * from nhan_vien ';
$resultNhanVien = mysqli_query($conn, $getNhanVien);

function CheckMaPL($conn, $maPL) {
    $sqlMaPL = "SELECT * FROM phieu_luong WHERE MaPhieuLuong = '$maPL'";
    $resulMaPL = mysqli_query($conn, $sqlMaPL);

    if (mysqli_num_rows($resulMaPL) > 0) {
        return true;
    }
    return false;
}

if (isset($_POST['maPL']))
    $maPL = trim($_POST['maPL']);
else $maPL = "";

if (isset($_POST['maNV']))
    $maNV = trim($_POST['maNV']);
else $maNV = "";

if (isset($_POST['thang'])) 
    $thang = $_POST['thang'];
else $thang = "";
if (isset($_POST['nam'])) 
    $nam = $_POST['nam'];
else $nam = "";

if (isset($_POST['soNgayCong']))
    $soNgayCong = trim($_POST['soNgayCong']);
else $soNgayCong = "";

if (isset($_POST['soNgayVang']))
    $soNgayVang = trim($_POST['soNgayVang']);
else $soNgayVang = "";

if (isset($_POST['luongTangCa']))
    $luongTangCa = trim($_POST['luongTangCa']);
else $luongTangCa = "";

if (isset($_POST['luongTamUng']))
    $luongTamUng = trim($_POST['luongTamUng']);
else $luongTamUng = "";

if (isset($_POST['thue']))
    $thue = trim($_POST['thue']);
else $thue = "";
if (isset($_POST['truBaoHiem']))
    $truBaoHiem = trim($_POST['truBaoHiem']);
else $truBaoHiem = "";

if (isset($_POST['troCap']))
    $troCap = $_POST['troCap'];
else $troCap = "";

if (isset($_POST['thuong']))
    $thuong = trim($_POST['thuong']);
else $thuong = "";
if (isset($_POST['phat']))
    $phat = trim($_POST['phat']);
else $phat = "";

if (isset($_POST['tienLuongThang']))
    $tienLuongThang = trim($_POST['tienLuongThang']);
else $tienLuongThang = "";

if (isset($_POST['tongThuNhap']))
    $tongThuNhap = trim($_POST['tongThuNhap']);
else $tongThuNhap = "";
if (isset($_POST['thucLinh']))
    $thucLinh = trim($_POST['thucLinh']);
else $thucLinh = "";

if (isset($_POST['ghiChu']))
    $ghiChu = trim($_POST['ghiChu']);
else $ghiChu = "";


if (isset($_POST['them'])) {

    $err = array();

    if (empty($maPL)) {
        $err[] = "Mã phiếu lương không được để trống";
    } 
    if(CheckMaPL($conn, $maPL)) {
        $err[] = "Đã có mã phiếu lương này rồi!!";
    }

    if (empty($thang) && $thang != 0) {
        $err[] = "Tháng không được để trống";
    }else if($thang < 1 || $thang > 12){
        $err[] = "Tháng từ 1 đến 12 ";
    }

    if (empty($nam) && $nam != 0) {
        $err[] = "Vui lòng nhập hệ số năm";
    } else if ( !is_numeric($nam)) {
        $err[] = "Năm là số";
    } 

    if (empty($soNgayCong) && $soNgayCong != 0) {
        $err[] = "Số ngày công không được để trống";
    }else if (!is_numeric($_POST["soNgayCong"])) {
        $err[] = "Số ngày công phải là số";
    }

    if (empty($soNgayVang) && $soNgayVang != 0) {
        $err[] = "Số ngày vắng không được để trống";
    } else if (!is_numeric($soNgayVang)) {
        $err[] = "Số ngày vắng phải là số";
    }

    if (empty($luongTangCa )&& $luongTangCa != 0) {
        $err[] = "Lương tăng ca không được để trống";
    } elseif (!is_numeric($_POST["luongTangCa"])) {
        $err[] = "Lương tăng ca phải là số";
    }

    if (empty($luongTamUng )&& $luongTamUng != 0) {
        $err[] = "Lương tạm ứng không được để trống";
    }else if (!is_numeric($_POST["luongTamUng"])) {
        $err[] = "Lương tạm ứng phải là số";
    }

    if (empty($thue )&& $thue != 0) {
        $err[] = "Thuế không được để trống";
    }else if (!is_numeric($_POST["thue"])) {
        $err[] = "Thuế phải là số";
    }

    if (empty($truBaoHiem) && $truBaoHiem != 0) {
        $err[] = "Trừ bảo hiểm không được để trống";
    } else if ( !is_numeric($truBaoHiem)) {
        $err[] = "Trừ bảo hiểm là số";
    } 
    if (empty($troCap ) && $troCap != 0) {
        $err[] = "Trợ cấp không được để trống";
    }elseif (!is_numeric($_POST["troCap"])) {
        $err[] = "Trợ cấp phải là số";
    }
    if (empty($thuong ) && $thuong != 0) {
        $err[] = "Thưởng không được để trống";
    }else if (!is_numeric($_POST["thuong"])) {
        $err[] = "Thưởng phải là số";
    }

    if (empty($phat) && $phat != 0) {
        $err[] = "Vui lòng nhập số phạt";
    } else if ( !is_numeric($phat)) {
        $err[] = "Phạt số lương là số";
    } 

    if (empty($tienLuongThang) && $tienLuongThang != 0) {
        $err[] = "Tiền lương tháng không được để trống";
    }elseif (!is_numeric($_POST["tienLuongThang"])) {
        $err[] = "Tiền lương tháng phải là số";
    }

    if (empty($tongThuNhap) && $tongThuNhap != 0) {
        $err[] = "Tổng thu nhập không được để trống";
    }elseif (!is_numeric($_POST["tongThuNhap"])) {
        $err[] = "Tổng thu nhập phải là số";
    }

    if (empty($thucLinh) && $thucLinh != 0) {
        $err[] = "Thực lĩnh không được để trống";
    }

    if (empty($err)) {
        $sqlInsert = "INSERT INTO `phieu_luong`(`MaPhieuLuong`, `MaNV`, `Thang`, `Nam`, `SoNgayCong`, `SoNgayVang`, `LuongTangCa`, `TienTamUng`, `Thue`, `TruBaoHiem`, `TroCap`, `Thuong`, `Phat`, `TienLuongThang`, `TongThuNhap`, `ThucLinh`, `GhiChu`) VALUES ('$maPL','$maNV','$thang','$nam','$soNgayCong','$soNgayVang','$luongTangCa','$luongTamUng','$thue','$truBaoHiem','$troCap','$thuong','$phat','$tienLuongThang','$tongThuNhap','$thucLinh','$ghiChu')";
        $resultInsert = mysqli_query($conn, $sqlInsert);

        if ($resultInsert) {
            echo "<script type='text/javascript'>toastr.success('Thêm thành công'); toastr.options.timeOut = 3000;</script>";
            
        } else {
            echo "<script type='text/javascript'>toastr.error('Thêm không thành công'); toastr.options.timeOut = 3000;</script>";
        }
    } else {
        foreach ($err as $error) {
            echo "<script type='text/javascript'>toastr.error(' $error'); toastr.options.timeOut = 3000;</script>";
        }
    }
}
?>
<div class="g-6 mb-6 w-100 search-container mt-5" style="height: 665px;">
    <div class="col-xl-12 col-sm-12 col-12">
        <div class="card shadow border-0 mb-7">
            <div class="card-header">
                <h3 class="mb-0">THÊM PHIẾU LƯƠNG</h3>
            </div>
            <div class="table-responsive">
                <form align='center' action="" method="post" enctype="multipart/form-data">
                    <table class="table table-hover table-nowrap">
                        <tr class="tr">
                            <td>Mã phiếu lương</td>
                            <td><input class="form-control py-2" type="text" size="20" name="maPL" value="<?php echo $maPL; ?> " /></td>
                            <td>Mã nhân viên</td>
                            <td>
                                <select name="maNV" class="form-select search-option">
                                    <?php
                                    if (mysqli_num_rows($resultNhanVien) <> 0) {
                                        while ($rows = mysqli_fetch_array($resultNhanVien)) {
                                            echo "<option ";
                                            if (isset($_POST['maNV']) && $_POST['maNV'] == $rows['MaNV'] ) echo "selected";
                                            echo ">$rows[MaNV]</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr class="tr">
                            <td>Tháng</td>
                            <td><input class="form-control py-2" type="text" size="20" name="thang" value="<?php echo $thang; ?>" /></td>
                            <td>Năm</td>
                            <td><input class="form-control py-2" type="text" name="nam" value="<?php echo $nam; ?>" /></td>
                        </tr>
                        <tr class="tr">
                            <td>Số ngày công</td>
                            <td><input class="form-control py-2" type="text" size="20" name="soNgayCong" value="<?php echo $soNgayCong; ?> " /></td>
                            <td>Số ngày vắng</td>
                            <td><input class="form-control py-2" type="text" name="soNgayVang" value="<?php echo $soNgayVang; ?> " /></td>
                        </tr>
                        <tr class="tr">
                            <td>Lương tăng ca</td>
                            <td><input class="form-control py-2" type="text" size="20" name="luongTangCa" value="<?php echo $luongTangCa; ?> " /></td>
                            <td>Lương tạm ứng</td>
                            <td><input class="form-control py-2" type="text" name="luongTamUng" value="<?php echo $luongTamUng; ?> " /></td>
                        </tr>
                        <tr class="tr">
                            <td>Thuế</td>
                            <td><input class="form-control py-2" type="text" size="20" name="thue" value="<?php echo $thue; ?> " /></td>
                            <td>Trừ bảo hiểm</td>
                            <td><input class="form-control py-2" type="text" name="truBaoHiem" value="<?php echo $truBaoHiem; ?> " /></td>
                        </tr>
                        <tr class="tr">
                            <td>Trợ cấp</td>
                            <td><input class="form-control py-2" type="text" size="20" name="troCap" value="<?php echo $troCap; ?> " /></td>
                            <td>Thưởng</td>
                            <td><input class="form-control py-2" type="text" name="thuong" value="<?php echo $thuong; ?> " /></td>
                        </tr>
                        <tr class="tr">
                            <td>Phạt</td>
                            <td><input class="form-control py-2" type="text" size="20" name="phat" value="<?php echo $phat; ?> " /></td>
                            <td>Tiền lương tháng</td>
                            <td><input class="form-control py-2" type="text" name="tienLuongThang" value="<?php echo $tienLuongThang; ?> " /></td>
                        </tr>
                        <tr class="tr">
                            <td>Tổng thu nhập</td>
                            <td><input class="form-control py-2" type="text" size="20" name="tongThuNhap" value="<?php echo $tongThuNhap; ?> " /></td>
                            <td>Thực lĩnh</td>
                            <td><input class="form-control py-2" type="text" name="thucLinh" value="<?php echo $thucLinh; ?> " /></td>
                        </tr>
                        <tr class="tr">
                            <td>Ghi chú</td>
                            <td id="no_colo" r>
                                <div class="input-group input-group-lg">
                                    <textarea class="form-control" name="ghiChu" rows="3" maxlength="300"> <?php echo $ghiChu; ?></textarea>
                                </div>
                            </td>
                            <td align="center" id="no_color" colspan="2">
                                <input type="submit" value="Thêm" name="them" class="btn btn-outline-success themnhanvien-btn mb-5 w-25" />
                                <a class="btn btn-outline-purple themnhanvien-btn mb-5 w-25" href="index.php?page=admin-paycheck"> Quay Lại</a>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>

<?php $this->end(); ?>