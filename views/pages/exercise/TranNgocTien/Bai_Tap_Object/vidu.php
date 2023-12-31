<?php $this->layout('layout_exercise') ?>
<?php $this->section('content'); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">

<html>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<title>Tinh chu vi va dien tich</title>

<style>

fieldset {

  background-color: #eeeeee;

}



legend {

  background-color: gray;

  color: white;

  padding: 5px 10px;

}



input {

  margin: 5px;

}

</style>

</head>

<body>

<?php 

abstract class HinhTNT{

	protected $ten, $dodai;

	public function setTen($ten){

		$this->ten=$ten;

	}

	public function getTen(){

		return $this->ten;

	}

	public function setDodai($doDai){

		$this->dodai=$doDai;

	}

	public function getDodai(){

		return $this->dodai;

	}

	abstract public function tinh_CV();

	abstract public function tinh_DT();

}

class HinhTronTNT extends HinhTNT{

	const PI=3.14;

	function tinh_CV(){

		return $this->dodai*2*self::PI;

	}

	function tinh_DT(){

		return pow($this->dodai,2)*self::PI;

	}

}

class HinhVuongTNT extends HinhTNT{

	public function tinh_CV(){

		return $this->dodai*4;

	}

	public function tinh_DT(){

		return pow($this->dodai,2);

	}

}

class TamGiacDeuTNT extends HinhTNT{

	public function tinh_CV(){

		return $this->dodai*3;

	}

	public function tinh_DT(){
        $p = ($this->dodai*3)/2;
		return round(sqrt($p*3*($p-$this->dodai)),2);

	}

}

class TamGiacThuongTNT extends HinhTNT{
    public $b;
    public $c;
	public function tinh_CV(){

		return $this->dodai+$this->b+$this->c;

	}

	public function tinh_DT(){
        $p = ($this->dodai + $this->b + $this->c)/2;
        return round(sqrt($p*($p-$this->dodai)*($p-$this->b)*($p-$this->c)),2);
	}

}
class HinhChuNhatTNT extends HinhTNT{
    public $b;
	public function tinh_CV(){

		return ($this->dodai+$this->b)*2;

	}

	public function tinh_DT(){
		return $this->dodai*$this->b;

	}

}

$str=NULL;

if(isset($_POST['tinh'])){

	if(isset($_POST['hinh']) && ($_POST['hinh'])=="hv"){

		$hv=new HinhVuongTNT();

		$hv->setTen($_POST['ten']);

		$hv->setDodai($_POST['dodai']);

		$str= "Diện tích hình vuông ".$hv->getTen()." là: ".$hv->tinh_DT()." \n".

		 		"Chu vi của hình vuông ".$hv->getTen()." là: ".$hv->tinh_CV();

	}

	if(isset($_POST['hinh']) && ($_POST['hinh'])=="ht"){

		$ht=new HinhTronTNT();

		$ht->setTen($_POST['ten']);

		$ht->setDodai($_POST['dodai']);

		$str= "Diện tích của hình tròn ".$ht->getTen()." là: ".$ht->tinh_DT()." \n".

				"Chu vi của hình tròn ".$ht->getTen()." là: ".$ht->tinh_CV();

	}

    if(isset($_POST['hinh']) && ($_POST['hinh'])=="tgd"){

		$tgd=new TamGiacDeuTNT();

		$tgd->setTen($_POST['ten']);

		$tgd->setDodai($_POST['dodai']);

		$str= "Diện tích của tam giác đều ".$tgd->getTen()." là: ".$tgd->tinh_DT()." \n".

				"Chu vi của tam giác đều ".$tgd->getTen()." là: ".$tgd->tinh_CV();

	}

    if(isset($_POST['hinh']) && ($_POST['hinh'])=="tgt"){

		$tgt=new TamGiacThuongTNT();
        
		$tgt->setTen($_POST['ten']);

		$tgt->setDodai($_POST['dodai']);

        $tgt->b = $tgt->getDodai()+2;
        $tgt->c = $tgt->getDodai()+3;

		$str= "Diện tích của tam giác thường ".$tgt->getTen()." có độ dài 3 cạnh lần lượt  ". $tgt->getDodai() .", " . $tgt->b . ", " . $tgt->c . " là: ".$tgt->tinh_DT()." \n".

				"Chu vi của tam giác thường ".$tgt->getTen()." là: ".$tgt->tinh_CV();

	}
    if(isset($_POST['hinh']) && ($_POST['hinh'])=="hcn"){

		$hcn=new HinhChuNhatTNT();
        
		$hcn->setTen($_POST['ten']);

		$hcn->setDodai($_POST['dodai']);

        $hcn->b = $hcn->getDodai()*2;

		$str= "Diện tích của hình chữ nhật ".$hcn->getTen() ." có độ chiều dài " .$hcn->getDodai() . " và chiều rộng " .$hcn->b ." là: ".$hcn->tinh_DT()." \n".

				"Chu vi của hình chữ nhật ".$hcn->getTen()." là: ".$hcn->tinh_CV();

	}

}

?>

<form action="" method="post">

<fieldset>

	<legend>Tính chu vi và diện tích các hình đơn giản</legend>

	<table border='0'>

		<tr>

			<td>Chọn hình</td>

			<td><input type="radio" name="hinh" value="hv" 

					<?php if(isset($_POST['hinh'])&&($_POST['hinh'])=="hv") echo 'checked'?>/>Hình vuông

				<input type="radio" name="hinh" value="ht"

					<?php if(isset($_POST['hinh'])&&($_POST['hinh'])=="ht") echo 'checked'?>/>Hình tròn
                <input type="radio" name="hinh" value="tgd"

					<?php if(isset($_POST['hinh'])&&($_POST['hinh'])=="tgd") echo 'checked'?>/>Tam Giác Đều
                <input type="radio" name="hinh" value="tgt"

					<?php if(isset($_POST['hinh'])&&($_POST['hinh'])=="tgt") echo 'checked'?>/>Tam Giác Thường
                <input type="radio" name="hinh" value="hcn"

					<?php if(isset($_POST['hinh'])&&($_POST['hinh'])=="hcn") echo 'checked'?>/>Hình Chữ Nhật

			</td>

		</tr>

		<tr>

			<td>Nhập tên:</td>

			<td><input type="text"  name="ten" value="<?php if(isset($_POST['ten'])) echo $_POST['ten'];?>"/></td>

		</tr>

		<tr>

			<td>Nhập độ dài:</td>

			<td><input type="text"  name="dodai" value="<?php if(isset($_POST['dodai'])) echo $_POST['dodai'];?>"/></td>

		</tr>

		<tr><td>Kết quả:</td>

			<td><textarea name="ketqua" cols="70" rows="4" disabled="disabled"><?php echo $str;?></textarea></td>

		</tr>

		<tr>

			<td colspan="2" align="center"><input type="submit" name="tinh" value="Tính"/></td>

		</tr>

	</table>

</fieldset>

</form>
<p align="left"><a href="?page=">Quay lại</a></p>
</body>

</html>
<?php $this->end(); ?>