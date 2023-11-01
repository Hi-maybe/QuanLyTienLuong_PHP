<?php $this->layout('layout_admin') ?>
<?php $this->section('content'); ?>
<?php 
include_once($_SERVER['DOCUMENT_ROOT'] . '/' . explode('/', $_SERVER['PHP_SELF'])[1] . "/connect.php");

        $conn = mysqli_connect ('localhost', 'root', '', 'quan_ly_tien_luong') 
        OR die ('Could not connect to MySQL: ' . mysqli_connect_error() );
    $maPhieu = $_GET["MaPhieu"];
    $getPhieuUngLuong= "select * from phieu_ung_luong where MaPhieu='$maPhieu'";   
    $resultPhieuUngLuong = mysqli_query($conn, $getPhieuUngLuong);
    $row = mysqli_fetch_array($resultPhieuUngLuong, MYSQLI_ASSOC);

    $getmanv = "SELECT MaNV FROM `nhan_vien` 
    order by MaNV";
    $resultmanv = mysqli_query($conn, $getmanv);


    if (isset($_POST['ngayUng']))
    $ngayUng = trim($_POST['ngayUng']);
    else $ngayUng = $row['NgayUng'];

    if (isset($_POST['lyDo']))
    $lyDo = trim($_POST['lyDo']);
    else $lyDo = $row['LyDo'];

    if (isset($_POST['soTien']))
    $soTien = trim($_POST['soTien']);
    else $soTien = $row['SoTien'];

    if (isset($_POST['duyet']))
    $duyet = trim($_POST['duyet']);
    else $duyet = $row['Duyet'];

    if (isset($_POST['delete'])) {
        $sqldelete = "delete from phieu_ung_luong
        where MaPhieu = '$_GET[MaPhieu]'";
        $deleteResult = mysqli_query($conn, $sqldelete);
        if ($deleteResult) {
            echo '<div class="alert alert-success">Xóa thành công!</div>';
        } else {
            echo '<div class="alert alert-danger">Xóa thất bại!</div>';
        }
    }

?>
<style>
    .form-control.form-select{
        padding-top: 0.3rem !important;
        padding-bottom: 0.3rem !important;
        
    }
    .form-select{
        width: 100%;
        padding-left: 20px;
        padding-left: 50px;
    } 
    /* tbody{
        
        font-weight: bold;
        height: 597px;
    } */
</style>

<div class="g-6 mb-6 w-100 search-container mt-5">
    <div class="col-xl-12 col-sm-12 col-12">
        <div class="card shadow border-0 mb-7">
            <div class="card-header">
                <h5 class="mb-0">CHỈNH SỬA PHIẾU ỨNG LƯƠNG</h5>
            </div>
            <div class="table-responsive">
            <form align='center' action="" method="post" enctype="multipart/form-data">
                <table class="table table-hover table-nowrap">
                    <tr>
                    <td>Mã Phiếu</td>                    
                    <td> 
                        <input class="form-control py-2" type="text" size="20" name="MaPhieu" value="<?php echo $row["MaPhieu"]; ?> "disabled/></td>
                    </td>
                    <td>Mã Nhân Viên</td>
                    <td>            
                        <input class="form-control py-2" type="text" size="20" name="MaNV" value="<?php echo $row["MaNV"]; ?> "disabled/></td>
                    </td>
                        
                    </tr>
                    <tr>
                            <td>
                                <p>Số tiền</p>
                            </td>
                            <td class="<?php if($soTien == "") echo 'required'; ?>">
                            <input class="td-control py-2" type="text" size="20" name="soTien" value="<?php echo $soTien; ?>"disabled>VND</td>
                            
                            
                            <td>
                                <p>Duyệt</p>
                            </td>
                            <td class="<?php if($duyet == "") echo 'required'; ?>">
                            <input class="form-control me-2 search-input" type="text" name="duyet" value="<?php echo $duyet; ?>"disabled></td>
                        </tr>

                        <tr>
                            <td>Lý do</td>
                            <td id="no_color">
                                <div class="input-group input-group-lg">
                                 <textarea class="form-control" name="lyDo"  rows="2" maxlength="300" disabled> <?php echo $lyDo;?></textarea>
                                </div>
                            </td>

                            <td>Ngày ứng</td>
                            <td class="<?php if($ngayUng == "") echo 'required'; ?>">
                            <input class="form-date-control py-2" type="date" name="ngayUng" value="<?php echo $ngayUng; ?>"disabled /></td>
                        </tr>
                    <tr>
                    
                        <td id="no_color" colspan="5" align="center">
                            <input type="submit" value="Xóa" name="delete" class="btn btn-outline-purple deleteSalarySlip-btn mb-5 w-25"/>
                            <a class="btn btn-outline-purple deleteSalarySlip-btn mb-5 w-25"
                                        href="index.php?page=admin-salary-slip"> Quay Lại</a>
                        </td>
                    </tr>
                </table>
                </form>
            </div>
        </div>     
    </div>
</div>
<?php $this->end(); ?>  