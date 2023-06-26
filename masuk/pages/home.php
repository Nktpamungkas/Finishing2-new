<?php 
	if( !isset($_SESSION['usr']) || !isset($_SESSION['pass'])){
		echo "<script>window.location='../login.php';</script>"; 
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Home</title>
	<script>
		function roundToTwo(num) {    
			return +(Math.round(num + "e+2")  + "e-2");
		}
		function jumlah(){
			var lebar = document.forms['form1']['lebar'].value;
			var berat = document.forms['form1']['gramasi'].value;
			var netto = document.forms['form1']['qty'].value;        
			var x,yard;
			x=((parseInt(lebar))*parseInt(berat))/43.056;
			x1=(1000/x);
			yard=x1*parseFloat(netto);
			document.form1.qty2.value=roundToTwo(yard).toFixed(2);
							
		}	
	</script>
	<style>
		fieldset {
			width: 80%;
			border: 4px solid #C0BBBB;
			display: inline-block;
			font-size: 14px;
			padding: 1em 2em;
		}
		legend {
			background: #355FE7;  /* Green */
			color: #FFFFFF;          /* White */
			margin-bottom: 10px;
			padding: 0.5em 1em;
		}
	</style>
</head>

<body>
	<?php
		ini_set("error_reporting", 1);
		session_start();
		include ('../koneksi.php');

		function nourut(){
			include('../koneksi.php');
			$format	= date("Ymd");
			$sql	= mysqli_query($con,"SELECT nokk FROM tbl_adm WHERE substr(nokk,1,8) like '%".$format."%' ORDER BY nokk DESC LIMIT 1 ") or die (mysqli_error());
			$d		= mysqli_num_rows($sql);

			if( $d>0 ){
				$r		= mysqli_fetch_array($sql);
				$d		= $r['nokk'];
				$str	= substr($d,8,2);
				$Urut	= (int)$str;
			}else{
				$Urut = 0;
			}
			$Urut = $Urut + 1;
			$Nol="";
			$nilai=2-strlen($Urut);

			for ($i=1;$i<=$nilai;$i++){
				$Nol= $Nol."0";
			}
			$nipbr =$format.$Nol.$Urut;
			return $nipbr;
		}
		$nou=nourut();
		if($_REQUEST['kk']!=''){
			$idkk="";
		}else{
			$idkk=$_GET['idkk'];
		}
		
		if($_GET['typekk'] == "KKLama"){
			if($idkk!=""){
				date_default_timezone_set('Asia/Jakarta');
				$qry=mysqli_query($con,"SELECT * FROM tbl_adm WHERE nokk='$idkk' and status='1' and ISNULL(tgl_out) ORDER BY id DESC LIMIT 1");
				$rw=mysqli_fetch_array($qry);
				$rc=mysqli_num_rows($qry);
				$tglsvr= sqlsrv_query($conn,"select CONVERT(VARCHAR(10),GETDATE(),105) AS  tgk");
				$sr=sqlsrv_fetch_array($tglsvr);
				
				$sqlLot=sqlsrv_query($conn," SELECT
							x.*,dbo.fn_StockMovementDetails_GetTotalWeightPCC(0, x.PCBID) as Weight,
							dbo.fn_StockMovementDetails_GetTotalRollPCC(0, x.PCBID) as RollCount
						FROM( SELECT
							so.CustomerID, so.BuyerID, 
							sod.ID as SODID, sod.ProductID, sod.UnitID, sod.WeightUnitID, 
							pcb.ID as PCBID,pcb.UnitID as BatchUnitID,
							pcblp.DepartmentID,pcb.PCID,pcb.LotNo,pcb.ChildLevel,pcb.RootID
						FROM
							SalesOrders so INNER JOIN
							JobOrders jo ON jo.SOID=so.ID INNER JOIN
							SODetails sod ON so.ID = sod.SOID INNER JOIN
							SODetailsAdditional soda ON sod.ID = soda.SODID LEFT JOIN
							ProcessControlJO pcjo ON sod.ID = pcjo.SODID LEFT JOIN
							ProcessControlBatches pcb ON pcjo.PCID = pcb.PCID LEFT JOIN
							ProcessControlBatchesLastPosition pcblp ON pcb.ID = pcblp.PCBID LEFT JOIN
							ProcessFlowProcessNo pfpn ON pfpn.EntryType = 2 and pcb.ID = pfpn.ParentID AND pfpn.MachineType = 24 LEFT JOIN
							ProcessFlowDetailsNote pfdn ON pfpn.EntryType = pfdn.EntryType AND pfpn.ID = pfdn.ParentID
						WHERE pcb.DocumentNo='$idkk' AND pcb.Gross<>'0'
							GROUP BY
								so.SONumber, so.SODate, so.CustomerID, so.BuyerID, so.PONumber, so.PODate,jo.DocumentNo,
								sod.ID, sod.ProductID, sod.Quantity, sod.UnitID, sod.Weight, sod.WeightUnitID,
								soda.RefNo,pcb.DocumentNo,pcb.Dated,sod.RequiredDate,
								pcb.ID, pcb.DocumentNo, pcb.Gross,
								pcb.Quantity, pcb.UnitID, pcb.ScheduledDate, pcb.ProductionScheduledDate,
								pcblp.DepartmentID,pcb.LotNo,pcb.PCID,pcb.ChildLevel,pcb.RootID
							) x INNER JOIN
							ProductMaster pm ON x.ProductID = pm.ID LEFT JOIN
							Departments dep ON x.DepartmentID  = dep.ID LEFT JOIN
							Departments pdep ON dep.RootID = pdep.ID LEFT JOIN				
							Partners cust ON x.CustomerID = cust.ID LEFT JOIN
							Partners buy ON x.BuyerID = buy.ID LEFT JOIN
							UnitDescription udq ON x.UnitID = udq.ID LEFT JOIN
							UnitDescription udw ON x.WeightUnitID = udw.ID LEFT JOIN
							UnitDescription udb ON x.BatchUnitID = udb.ID
						ORDER BY
							x.SODID, x.PCBID ", array(), array( "Scrollable" => 'static' ));
				$sLot=sqlsrv_fetch_array($sqlLot);
				$cLot=sqlsrv_num_rows($sqlLot);
				$child=$sLot['ChildLevel'];
					
					if($child > 0){
						$sqlgetparent=sqlsrv_query($conn,"select ID,LotNo from ProcessControlBatches where ID='$sLot[RootID]' and ChildLevel='0'");
						$rowgp=sqlsrv_fetch_array($sqlgetparent);
						
						//$nomLot=substr("$row2[LotNo]",0,1);
						$nomLot=$rowgp['LotNo'];
						$nomorLot="$nomLot/K$sLot[ChildLevel]&nbsp;";				
											
					}else{
						$nomorLot=$sLot['LotNo'];
							
					}
				
					$sqlLot1="Select count(*) as TotalLot From ProcessControlBatches where PCID='$sLot[PCID]' and RootID='0' and LotNo < '1000'";
					$qryLot1 = sqlsrv_query($conn,$sqlLot1) or die('A error occured : ');							
					$rowLot=sqlsrv_fetch_array($qryLot1);	
										
				$sqls=sqlsrv_query($conn,"select processcontrolJO.SODID,salesorders.ponumber,processcontrol.productid,salesorders.customerid,joborders.documentno,
											salesorders.buyerid,processcontrolbatches.lotno,productcode,productmaster.color,colorno,description,weight,cuttablewidth from Joborders 
											left join processcontrolJO on processcontrolJO.joid = Joborders.id
											left join salesorders on soid= salesorders.id
											left join processcontrol on processcontrolJO.pcid = processcontrol.id
											left join processcontrolbatches on processcontrolbatches.pcid = processcontrol.id
											left join productmaster on productmaster.id= processcontrol.productid
											left join productpartner on productpartner.productid= processcontrol.productid
											where processcontrolbatches.documentno='$idkk'", array(), array( "Scrollable" => 'static' ));
						$ssr=sqlsrv_fetch_array($sqls);
						$cek=sqlsrv_num_rows($sqls);
						$lgn1=sqlsrv_query($conn,"select partnername from partners where id='$ssr[customerid]'");
						$ssr1=sqlsrv_fetch_array($lgn1);
						$lgn2=sqlsrv_query($conn,"select partnername from partners where id='$ssr[buyerid]'");
						$ssr2=sqlsrv_fetch_array($lgn2);
			}
		}elseif ($_GET['typekk'] == "NOW") {
		if ($idkk != "") {
			include_once("../now.php");
		}
		}
	?>
	<?php
		if(isset($_POST['btnSimpan']) and $_POST['proses']!=$rw['proses']){
			if($_POST['nokk']!=""){
			$nokk=$_POST['nokk'];
			$idkk=$_POST['nokk'];
			}else{$nokk=$nou;$idkk=$nou;}
			$shift=$_POST['shift'];
			$shift1=$_POST['shift2'];
			$langganan=str_replace("'","''",$_POST['buyer']);
			$order=$_POST['no_order'];
			$jenis_kain=str_replace("'","''",$_POST['jenis_kain']);
			$noitem=$_POST['no_item'];
			$nowarna=str_replace("'","''",$_POST['no_warna']);
			$warna=str_replace("'","''",$_POST['warna']);
			$note=str_replace("'","''",$_POST['catatan']);
			$lot=$_POST['lot'];
			$qty=$_POST['qty'];
			$rol=$_POST['rol'];
			$yard=$_POST['qty2'];
			$lebar=$_POST['lebar'];
			$gramasi=$_POST['gramasi'];
			$proses=$_POST['proses'];
			$kondisi=$_POST['kondisi'];
			//$tglin=$_POST[tgl_proses_m]." ".$_POST[proses_in];
			$simpanSql = "INSERT INTO tbl_adm SET 
										`nokk`='$nokk',
										`shift`='$shift',
										`shift1`='$shift1',
										`langganan`='$langganan',
										`no_order`='$order',
										`jenis_kain`='$jenis_kain',
										`warna`='$warna',
										`no_warna`='$nowarna',
										`no_item`='$noitem',
										`lebar`='$lebar',
										`gramasi`='$gramasi',
										`lot`='$lot',
										`rol`='$rol',
										`qty`='$qty',
										`panjang`='$yard',
										`proses`='$proses',
										`catatan`='$note',
										`kondisi_kain`='$kondisi',
										`tgl_buat`=now(),
										`tgl_update`=now(),
										`tgl_in`=now()
										";
				mysqli_query($con,$simpanSql) or die ("Gagal Simpan".mysqli_error());
				
				// Refresh form
				echo "<meta http-equiv='refresh' content='0; url=?idkk=$idkk&status=Data Sudah DiSimpan'>";
		}else if(isset($_POST['btnSimpan']) and $_POST['proses']==$rw['proses']){
			$shift=$_POST['shift'];
			$shift1=$_POST['shift2'];
			$langganan=str_replace("'","''",$_POST['buyer']);
			$order=$_POST['no_order'];
			$jenis_kain=str_replace("'","''",$_POST['jenis_kain']);
			$noitem=$_POST['no_item'];
			$nowarna=$_POST['no_warna'];
			$warna=str_replace("'","''",$_POST['warna']);
			$note=str_replace("'","''",$_POST['catatan']);
			$lot=$_POST['lot'];
			$qty=$_POST['qty'];
			$rol=$_POST['rol'];
			$yard=$_POST['qty2'];
			$lebar=$_POST['lebar'];
			$gramasi=$_POST['gramasi'];
			$proses=$_POST['proses'];
			$kondisi=$_POST['kondisi'];
			//$tglin=$_POST[tgl_proses_m]." ".$_POST[proses_in];
			$simpanSql = "UPDATE tbl_adm SET
								`shift`='$shift',
								`shift1`='$shift1',
								`langganan`='$langganan',
								`no_order`='$order',
								`jenis_kain`='$jenis_kain',
								`warna`='$warna',
								`no_warna`='$nowarna',
								`no_item`='$noitem',
								`lebar`='$lebar',
								`gramasi`='$gramasi',
								`lot`='$lot',
								`rol`='$rol',
								`qty`='$qty',
								`panjang`='$yard',
								`proses`='$proses',
								`catatan`='$note',
								`kondisi_kain`='$kondisi',
								`tgl_update`=now()
								WHERE `id`='$_POST[id]'";
			mysqli_query($con,$simpanSql) or die ("Gagal Ubah".mysqli_error());
			
			// Refresh form
			echo "<meta http-equiv='refresh' content='0; url=?idkk=$idkk&status=Data Sudah DiUbah'>";
		}
	?>
<form id="form1" name="form1" method="post" action="" >
 	<fieldset>
		<legend>Input Data Kartu Kerja Masuk</legend>
		<table width="100%" border="0">
			<tr>
				<th colspan="6" scope="row"><font color="#FF0000"><?php echo $_GET['status'];?></font></th>
			</tr>
			<tr>
				<td scope="row">
					<h4>Pilih Asal Kartu Kerja</h4>
				</td>
				<td width="1%">:</td>
				<td>
					<select style="width: 50%" id="typekk" name="typekk" onchange="window.location='?typekk='+this.value" required>
						<option value="" disabled selected>-Pilih Tipe Kartu Kerja-</option>
						<option value="KKLama" <?php if($_GET['typekk'] == "KKLama"){ echo "SELECTED"; }?>>KK Lama</option>
						<option value="NOW" <?php if($_GET['typekk'] == "NOW"){ echo "SELECTED"; } ?>>KK NOW</option> -->
					</select=>
				</td>
			</tr> 
			<tr>
				<td width="11%" scope="row"><h4>Nokk</h4></td>
				<td width="1%">:</td>
				<td width="28%">
					<input name="nokk" type="text" id="nokk" size="17" onchange="window.location='?typekk='+document.getElementById(`typekk`).value+'&idkk='+this.value" value="<?php echo $_GET['idkk'];?>"/><input type="hidden"  value="<?php echo $rw['id'];?>" name="id"/>
					
					<?php if($_GET['typekk'] == 'NOW') { ?>
						<select style="width: 40%" name="demand" id="demand" onchange="window.location='?typekk='+document.getElementById(`typekk`).value+'&idkk='+document.getElementById(`nokk`).value+'&demand='+this.value" required>
						<option value="" disabled selected>Pilih Nomor Demand</option>
						<?php while ($r_demand = db2_fetch_assoc($qrydemand)) { ?>
							<option value="<?= $r_demand['DEAMAND']; ?>" <?php if($_GET['demand'] == $r_demand['DEAMAND']){ echo "SELECTED"; } ?>><?= $r_demand['DEAMAND']; ?></option>
						<?php } ?>
						</select>
					<?php } ?>
				</td>
				<td width="14%"><h4>Group Shift</h4></td>
				<td width="1%">:</td>
				<td width="45%">
					<select name="shift" id="shift" required>
						<option value="">Pilih</option>
						<option value="A" <?php if($rw['shift']=="A"){echo "selected";}?>>A</option>
						<option value="B" <?php if($rw['shift']=="B"){echo "selected";}?>>B</option>
						<option value="C" <?php if($rw['shift']=="C"){echo "selected";}?>>C</option>
					</select>
				</td>
			</tr>
			<tr>
				<td scope="row"><h4>Langganan/Buyer</h4></td>
				<td>:</td>
				<td>
					<?php if($_GET['typekk'] == "NOW") : ?>
						<?php $langganan_buyer =  $rw_kk['LANGGANAN'].'/'.$rw_kk['BUYER']; ?>
					<?php else : ?>
						<?php if ($cek > 0) {
							$langganan_buyer =  $ssr1['partnername'] . "/" . $ssr2['partnername'];
						} else {
							$langganan_buyer =  $rw['langganan'];
						} ?>
					<?php endif; ?>
					<input name="buyer" type="text" id="buyer" size="45" value="<?= $langganan_buyer; ?>">
				</td>
				<td><strong>Shift</strong></td>
				<td>:</td>
				<td>
					<select name="shift2" id="shift2" required="required">
						<option value="">Pilih</option>
						<option value="1" <?php if($rw['shift1']=="1"){echo "selected";}?>>1</option>
						<option value="2" <?php if($rw['shift1']=="2"){echo "selected";}?>>2</option>
						<option value="3" <?php if($rw['shift1']=="3"){echo "selected";}?>>3</option>
					</select>
				</td>
			</tr>
			<tr>
				<td scope="row"><h4>No. Order</h4></td>
				<td>:</td>
				<td>
					<?php if($_GET['typekk'] == "NOW") : ?>
						<?php $no_order =  $rw_kk['BONORDER']; ?>
					<?php else : ?>
						<?php if ($cek > 0) {
								$no_order =  $ssr['documentno'];
							} else {
								$no_order =  $rw['no_order'];
							} ?>
					<?php endif; ?>
					<input type="text" name="no_order" id="no_order" value="<?= $no_order; ?>" />
				</td>
				<td><h4>Proses</h4></td>
				<td>:</td>
				<td>
					<select name="proses" id="proses" required>
						<option value="">Pilih</option>
						<?php $qry1=mysqli_query($con,"SELECT proses,jns FROM tbl_proses_masuk ORDER BY id ASC"); while($r=mysqli_fetch_array($qry1)){ ?>
							<option value="<?php echo $r['proses']." (".$r['jns'].")";?>" <?php if($rw['proses']==$r['proses']." (".$r['jns'].")"){echo "SELECTED";}?>><?php echo $r['proses']." (".$r['jns'].")";?></option>
						<?php } ?>
					</select>
				<input type="button" name="btnproses" id="btnproses" value="..."  onclick="window.open('pages/data-proses.php','MyWindow','height=400,width=650');"/></td>
			</tr>
			<tr>
				<td valign="top" scope="row"><h4>Jenis Kain</h4></td>
				<td valign="top">:</td>
				<td>
					<?php if($_GET['typekk'] == "NOW") : ?>
						<?php $jk = $rw_kk['JENIS_KAIN']; ?>
					<?php else : ?>
						<?php if ($cek > 0) {
							$jk = $ssr['productcode'] . " / " . $ssr['description'];
						} else {
							$jk = $rw['jenis_kain'];
						} ?>
					<?php endif; ?>
					<textarea name="jenis_kain" cols="35" id="jenis_kain"><?= $jk; ?></textarea></td>
				<td valign="top"><h4>Catatan</h4></td>
				<td valign="top">:</td>
				<td valign="top"><textarea name="catatan" cols="35" id="catatan"><?php echo $rw['catatan'];?></textarea></td>
			</tr>
			<tr>
				<td scope="row"><strong>Hanger/Item</strong></td>
				<td>:</td>
				<td>
					<?php if($_GET['typekk'] == "NOW") : ?>
						<?php $hanger = $rw_kk['NO_HANGER']; ?>
					<?php else : ?>
						<?php if ($cek > 0) {
								$hanger = $ssr['productcode'];
							} else {
								$hanger = $rw['no_item'];
							} ?>
					<?php endif; ?>
					<input type="text" name="no_item" id="no_item" value="<?= $hanger; ?>" />
				<td width="14%"><strong>Lebar X Gramasi</strong></td>
				<td width="1%">:</td>
				<td>
					<?php if($_GET['typekk'] == "NOW") : ?>
						<?php $nlebar = $rw_lebar['LEBAR']; ?>
					<?php else : ?>
						<?php if ($cek > 0) {
							$nlebar = $ssr['cuttablewidth'];
						} else {
							$nlebar = $rw['lebar'];
						} ?>
					<?php endif; ?>
					<input name="lebar" type="text" id="lebar" size="6" value="<?= $nlebar; ?>" placeholder="0" />
					&quot; X
					<?php if($_GET['typekk'] == "NOW") : ?>
						<?php $ngramasi = $rw_gramasi['GRAMASI']; ?>
					<?php else : ?>
						<?php if ($cek > 0) {
							$ngramasi = $ssr['weight'];
						} else {
							$ngramasi = $rw['gramasi'];
						} ?>
					<?php endif; ?>
					<input name="gramasi" type="text" id="gramasi" size="6" value="<?= $ngramasi; ?>" placeholder="0" />
				</td>
			</tr>
			<tr>
				<td scope="row"><strong>No Warna</strong></td>
				<td>:</td>
				<td>
					<?php if($_GET['typekk'] == "NOW") : ?>
						<?php $nomor_warna = $rw_kk['NO_WARNA']; ?>
					<?php else : ?>
						<?php if ($cek > 0) {
							$nomor_warna = $ssr['colorno'];
						} else {
							$nomor_warna = $rw['no_warna'];
						} ?>
					<?php endif; ?>
					<input name="no_warna" type="text" id="no_warna" size="35" value="<?= $nomor_warna; ?>" />
				</td>
				<td width="14%"><strong>Berat</strong></td>
				<td width="1%">:</td>
				<td>
					<?php if($_GET['typekk'] == "NOW") : ?>
						<?php $berat = $rw_berat['USERPRIMARYQUANTITY']; ?>
					<?php else : ?>
						<?php if ($cLot > 0) {
							$berat = $sLot['Weight'];
						} else {
							$berat = $rw['qty'];
						} ?>
					<?php endif; ?>
					<input name="qty" type="text" id="qty" size="8" value="<?= $berat; ?>" placeholder="0.00" />
				<strong>Kg</strong></td>
			</tr>
			<tr>
				<td scope="row"><h4>Warna</h4></td>
				<td>:</td>
				<td>
					<?php if($_GET['typekk'] == "NOW") : ?>
						<?php $nama_warna = $rw_kk['WARNA']; ?>
					<?php else : ?>
						<?php if ($cek > 0) {
							$nama_warna = $ssr['color'];
						} else {
							$nama_warna = $rw['warna'];
						} ?>
					<?php endif; ?>
					<input name="warna" type="text" id="warna" size="35" value="<?= $nama_warna; ?>" />
				</td>
				<td><strong>Panjang</strong></td>
				<td>:</td>
				<td><input name="qty2" type="text" id="qty2" size="8" value="<?php echo $rw['panjang'];?>" placeholder="0.00" onFocus="jumlah();"/>
				<strong>Yard</strong></td>
			</tr>
			<tr>
				<td scope="row"><h4>Lot</h4></td>
				<td>:</td>
				<td><input name="lot" type="text" id="lot" size="7" value="<?php if($cLot>0){echo $rowLot['TotalLot']."-".$nomorLot;}else{echo $rw['lot'];}?>"/></td>
				<td><h4>Kondisi Kain</h4></td>
				<td>:</td>
				<td>
					<select name="kondisi" id="kondisi" required="required">
						<option value="">Pilih</option>
						<option value="Basah"  <?php if($rw['kondisi_kain']=="Basah"){echo "selected";}?>>Basah</option>
						<option value="Kering" <?php if($rw['kondisi_kain']=="Kering"){echo "selected";}?>>Kering</option>
					</select>
				</td>
			</tr>
			<tr>
				<td scope="row"><h4>Roll</h4></td>
				<td>:</td>
				<td><input name="rol" type="text" id="rol" size="3" placeholder="0" pattern="[0-9]{1,}" value="<?php if($cLot>0){echo $sLot['RollCount'];}else{ echo $rw['rol'];}?>" /></td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
		</table>
  	</fieldset>
	<br>
  	<input type="submit" name="btnSimpan" id="btnSimpan" value="Simpan" class="art-button"/>
	<input type="button" name="batal" id="batal" value="Batal" onclick="window.location.href='index.php'" class="art-button"/>
	<?php if($rc > 0 ){ ?>
		<a href="pages/cetak_label.php?idkk=<?php echo $_GET['idkk']; ?>" class="art-button" target="_blank">cetak</a>
	<?php } ?>
	<input type="button" name="button2" id="button2" value="Kembali" onclick="window.location.href='../index.php'" class="art-button"/>
</form>
</body>
</html>