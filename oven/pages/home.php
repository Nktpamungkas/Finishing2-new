<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Home</title>
  <script>
    function roundToTwo(num) {
      return +(Math.round(num + "e+2") + "e-2");
    }

    function jumlah() {
      var lebar = document.forms['form1']['lebar'].value;
      var berat = document.forms['form1']['gramasi'].value;
      var netto = document.forms['form1']['qty'].value;
      var x, yard;
      x = ((parseInt(lebar)) * parseInt(berat)) / 43.056;
      x1 = (1000 / x);
      yard = x1 * parseFloat(netto);
      document.form1.qty2.value = roundToTwo(yard).toFixed(2);

    }

    function jumlah1() {
      var lebar1 = document.forms['form1']['h_lebar'].value;
      var berat1 = document.forms['form1']['h_gramasi'].value;
      var netto1 = document.forms['form1']['qty'].value;
      var x1, yard1;
      x1 = ((parseInt(lebar1)) * parseInt(berat1)) / 43.056;
      x2 = (1000 / x1);
      yard1 = x2 * parseFloat(netto1);
      document.form1.qty3.value = roundToTwo(yard1).toFixed(2);

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
      background: #355FE7;
      /* Green */
      color: #FFFFFF;
      /* White */
      margin-bottom: 10px;
      padding: 0.5em 1em;
    }
  </style>
</head>

<body>
  <?php
    ini_set("error_reporting", 1);
    session_start();
    include('../koneksi.php');
    function nourut()
    {
      include('../koneksi.php');
      $format = date("ymd");
      $sql = mysqli_query($con, "SELECT nokk FROM tbl_produksi WHERE substr(nokk,1,6) like '%" . $format . "%' ORDER BY nokk DESC LIMIT 1 ") or die(mysqli_error());
      $d = mysqli_num_rows($sql);
      if ($d > 0) {
        $r = mysqli_fetch_array($sql);
        $d = $r['nokk'];
        $str = substr($d, 6, 2);
        $Urut = (int)$str;
      } else {
        $Urut = 0;
      }
      $Urut = $Urut + 1;
      $Nol = "";
      $nilai = 2 - strlen($Urut);
      for ($i = 1; $i <= $nilai; $i++) {
        $Nol = $Nol . "0";
      }
      $nipbr = $format . $Nol . $Urut;
      return $nipbr;
    }
    $nou = nourut();
    if ($_REQUEST['kk'] != '') {
      $idkk = "";
    } else {
      $idkk = $_GET['idkk'];
    }
    if ($_GET['typekk'] == "KKLama") {
      echo 	"<script>
						swal({
							title: 'SYSTEM OFFLINE',   
							text: 'Klik Ok untuk input data kembali',
							type: 'success',
						}).then((result) => {
							if (result.value) {
								window.location.href = 'http://online.indotaichen.com/finishing2-new/oven/?typekk=NOW'; 
							}
						});
					</script>";
    } elseif ($_GET['typekk'] == "NOW") {
      if ($idkk != "") {
        include_once("../now.php");
      }
    } elseif ($_GET['typekk'] == "SCHEDULE") {
			if ($idkk != "") {
				if ($_GET['demand'] != "") {
					$nomordemand = $_GET['demand'];
					$anddemand = "AND nodemand = '$nomordemand'";
				}else{
					$anddemand = "";
				}
				$q_kkmasuk		= mysqli_query($con, "SELECT * FROM tbl_schedule_new WHERE nokk = '$idkk' $anddemand");
				$row_kkmasuk	= mysqli_fetch_assoc($q_kkmasuk);
			}
		}
  ?>

  <?php
    if (isset($_POST['btnSimpan']) and $_POST['shift'] == $rw['shift'] and $_POST['shift2'] == $rw['shift2'] and $_POST['proses'] == $rw['proses']) {
      $shift = $_POST['shift'];
      $shift2 = $_POST['shift2'];
      $langganan = $_POST['buyer'];
      $buyer = $_POST['kd_buyer'];
      $order = $_POST['no_order'];
      $item = $_POST['no_item'];
      $jenis_kain = str_replace("'", "''", $_POST['jenis_kain']);
      $kain = $_POST['kondisi_kain'];
      $bahan = $_POST['jenis_bahan'];
      $warna = str_replace("'", "''", $_POST['warna']);
      $nowarna = $_POST['no_warna'];
      $lot = $_POST['lot'];
      $qty = $_POST['qty'];
      $qty2 = $_POST['qty2'];
      $qty3 = $_POST['qty3'];
      $rol = $_POST['rol'];
      $mesin = str_replace("'", "''", $_POST['no_mesin']);
      $nmmesin = str_replace("'", "''", $_POST['nama_mesin']);
      $proses = $_POST['proses'];
      $gerobak = $_POST['no_gerobak'];
      $jam_in = $_POST['proses_in'];
      $jam_out = $_POST['proses_out'];
      $proses_jam = $_POST['proses_jam'];
      $proses_menit = $_POST['proses_menit'];
      $tgl_proses_in = $_POST['tgl_proses_m'];
      $tgl_proses_out = $_POST['tgl_proses_k'];
      $mulai = $_POST['stop_mulai'];
      $mulai2 = $_POST['stop_mulai2'];
      $mulai3 = $_POST['stop_mulai3'];
      $selesai = $_POST['stop_selesai'];
      $selesai2 = $_POST['stop_selesai2'];
      $selesai3 = $_POST['stop_selesai3'];
      $stop_jam = $_POST['stop_jam'];
      $stop_menit = $_POST['stop_menit'];
      $tgl_stop_m = $_POST['tgl_stop_m'];
      $tgl_stop_m2 = $_POST['tgl_stop_m2'];
      $tgl_stop_m3 = $_POST['tgl_stop_m3'];
      $tgl_stop_s = $_POST['tgl_stop_s'];
      $tgl_stop_s2 = $_POST['tgl_stop_s2'];
      $tgl_stop_s3 = $_POST['tgl_stop_s3'];
      $kd = $_POST['kd_stop'];
      $kd2 = $_POST['kd_stop2'];
      $kd3 = $_POST['kd_stop3'];
      $tgl = $_POST['tgl'];
      $acc_kain = str_replace("'", "''", $_POST['acc_kain']);
      $catatan = str_replace("'", "''", $_POST['catatan']);
      $suhu = $_POST['suhu'];
      $speed = $_POST['speed'];
      $omt = $_POST['omt'];
      $vmt = $_POST['vmt'];
      $vmt_time = $_POST['vmt_time'];
      $buka = $_POST['buka_rantai'];
      $overfeed = $_POST['overfeed'];
      $hlebar = $_POST['h_lebar'];
      $hgramasi = $_POST['h_gramasi'];
      $lebar = $_POST['lebar'];
      $gramasi = $_POST['gramasi'];
      $phlarutan = $_POST['pH_larutan'];
      $chemical1 = $_POST['chemical_1'];
      $chemical2 = $_POST['chemical_2'];
      $chemical3 = $_POST['chemical_3'];
      $chemical4 = $_POST['chemical_4'];
      $chemical5 = $_POST['chemical_5'];
      $chemical6 = $_POST['chemical_6'];
      $chemical7 = $_POST['chemical_7'];
      $jmlKonsen1 = $_POST['jmlKonsen1'];
      $jmlKonsen2 = $_POST['jmlKonsen2'];
      $jmlKonsen3 = $_POST['jmlKonsen3'];
      $jmlKonsen4 = $_POST['jmlKonsen4'];
      $jmlKonsen5 = $_POST['jmlKonsen5'];
      $jmlKonsen6 = $_POST['jmlKonsen6'];
      $jmlKonsen7 = $_POST['jmlKonsen7'];
      $overfeed = $_POST['overfeed'];
      $overfeedjt = $_POST['overfeed2'];
      $overfeedjk = $_POST['overfeed3'];

      $simpanSql = "UPDATE tbl_produksi SET 
            `shift`='$shift',
            `shift2`='$shift2',
            `buyer`='$buyer',
            `no_item`='$item',
            `no_warna`='$nowarna',
            `jenis_bahan`='$bahan',
            `kondisi_kain`='$kain',
            `panjang`='$qty2',
            `panjang_h`='$qty3',
            `no_gerobak`='$gerobak',
            `no_mesin`='$mesin',
            `nama_mesin`='$nmmesin',
            `langganan`='$langganan',
            `no_order`='$order',
            `jenis_kain`='$jenis_kain',
            `warna`='$warna',
            `lot`='$lot',
            `rol`='$rol',
            `qty`='$qty',
            `proses`='$proses',
            `jam_in`='$jam_in',
            `jam_out`='$jam_out',
            `tgl_proses_in`='$tgl_proses_in',
            `tgl_proses_out`='$tgl_proses_out',
            `stop_l`='$mulai',
            `stop_l2`='$mulai2',
            `stop_l3`='$mulai3',
            `stop_r`='$selesai',
            `stop_r2`='$selesai2',
            `stop_r3`='$selesai3',
            `tgl_stop_l`='$tgl_stop_m',
            `tgl_stop_l2`='$tgl_stop_m2',
            `tgl_stop_l3`='$tgl_stop_m3',
            `tgl_stop_r`='$tgl_stop_s',
            `tgl_stop_r2`='$tgl_stop_s2',
            `tgl_stop_r3`='$tgl_stop_s3',
            `kd_stop`='$kd',
            `kd_stop2`='$kd2',
            `kd_stop3`='$kd3',
            `acc_staff`='$acc_kain',
            `catatan`='$catatan',
            `suhu`='$suhu',
            `speed`='$speed',
            `omt`='$omt',
            `vmt`='$vmt',
            `t_vmt`='$vmt_time',
            `buka_rantai`='$buka',
            `overfeed`='$overfeed',
            `overfeedjt`='$overfeedjt',
            `overfeedjk`='$overfeedjk',
            `lebar`='$lebar',
            `gramasi`='$gramasi',
            `lebar_h`='$hlebar',
            `gramasi_h`='$hgramasi',
            `ph_larut`='$phlarutan',
            `chemical_1`='$chemical1',
            `chemical_2`='$chemical2',
            `chemical_3`='$chemical3',
            `chemical_4`='$chemical4',
            `chemical_5`='$chemical5',
            `chemical_6`='$chemical6',
            `chemical_7`='$chemical7',
            `konsen_1`='$jmlKonsen1',
            `konsen_2`='$jmlKonsen2',
            `konsen_3`='$jmlKonsen3',
            `konsen_4`='$jmlKonsen4',
            `konsen_5`='$jmlKonsen5',
            `konsen_6`='$jmlKonsen6',
            `konsen_7`='$jmlKonsen7',
            `tgl_update`='$tgl'
          WHERE `id`='$_POST[id]'";
      mysqli_query($con, $simpanSql) or die("Gagal Ubah" . mysqli_error());

      // Refresh form
      echo "<meta http-equiv='refresh' content='0; url=?idkk=$idkk&status=Data Sudah DiUbah'>";
    } else if (isset($_POST['btnSimpan'])) {
      if ($_POST['nokk'] != "") {
        $nokk = $_POST['nokk'];
        $idkk = $_POST['nokk'];
      } else {
        $nokk = $nou;
        $idkk = $nou;
      }
      $shift = $_POST['shift'];
      $demand = $_POST['demand'];
      $shift2 = $_POST['shift2'];
      $langganan = $_POST['buyer'];
      $buyer = $_POST['kd_buyer'];
      $order = $_POST['no_order'];
      $item = $_POST['no_item'];
      $jenis_kain = str_replace("'", "''", $_POST['jenis_kain']);
      $kain = $_POST['kondisi_kain'];
      $bahan = $_POST['jenis_bahan'];
      $warna = str_replace("'", "''", $_POST['warna']);
      $nowarna = $_POST['no_warna'];
      $lot = $_POST['lot'];
      $qty = $_POST['qty'];
      $qty2 = $_POST['qty2'];
      $qty3 = $_POST['qty3'];
      $rol = $_POST['rol'];
      $mesin = str_replace("'", "''", $_POST['no_mesin']);
      $nmmesin = str_replace("'", "''", $_POST['nama_mesin']);
      $proses = $_POST['proses'];
      $gerobak = $_POST['no_gerobak'];
      $jam_in = $_POST['proses_in'];
      $jam_out = $_POST['proses_out'];
      $proses_jam = $_POST['proses_jam'];
      $proses_menit = $_POST['proses_menit'];
      $tgl_proses_in = $_POST['tgl_proses_m'];
      $tgl_proses_out = $_POST['tgl_proses_k'];
      $mulai = $_POST['stop_mulai'];
      $mulai2 = $_POST['stop_mulai2'];
      $mulai3 = $_POST['stop_mulai3'];
      $selesai = $_POST['stop_selesai'];
      $selesai2 = $_POST['stop_selesai2'];
      $selesai3 = $_POST['stop_selesai3'];
      $stop_jam = $_POST['stop_jam'];
      $stop_menit = $_POST['stop_menit'];
      $tgl_stop_m = $_POST['tgl_stop_m'];
      $tgl_stop_m2 = $_POST['tgl_stop_m2'];
      $tgl_stop_m3 = $_POST['tgl_stop_m3'];
      $tgl_stop_s = $_POST['tgl_stop_s'];
      $tgl_stop_s2 = $_POST['tgl_stop_s2'];
      $tgl_stop_s3 = $_POST['tgl_stop_s3'];
      $kd = $_POST['kd_stop'];
      $kd2 = $_POST['kd_stop2'];
      $kd3 = $_POST['kd_stop3'];
      $tgl = $_POST['tgl'];
      $acc_kain = str_replace("'", "''", $_POST['acc_kain']);
      $catatan = str_replace("'", "''", $_POST['catatan']);
      $suhu = $_POST['suhu'];
      $speed = $_POST['speed'];
      $omt = $_POST['omt'];
      $vmt = $_POST['vmt'];
      $vmt_time = $_POST['vmt_time'];
      $buka = $_POST['buka_rantai'];
      $overfeed = $_POST['overfeed'];
      $overfeedjt = $_POST['overfeed2'];
      $overfeedjk = $_POST['overfeed3'];
      $hlebar = $_POST['h_lebar'];
      $hgramasi = $_POST['h_gramasi'];
      $lebar = $_POST['lebar'];
      $gramasi = $_POST['gramasi'];
      $phlarutan = $_POST['pH_larutan'];
      $chemical1 = $_POST['chemical_1'];
      $chemical2 = $_POST['chemical_2'];
      $chemical3 = $_POST['chemical_3'];
      $chemical4 = $_POST['chemical_4'];
      $chemical5 = $_POST['chemical_5'];
      $chemical6 = $_POST['chemical_6'];
      $chemical7 = $_POST['chemical_7'];
      $jmlKonsen1 = $_POST['jmlKonsen1'];
      $jmlKonsen2 = $_POST['jmlKonsen2'];
      $jmlKonsen3 = $_POST['jmlKonsen3'];
      $jmlKonsen4 = $_POST['jmlKonsen4'];
      $jmlKonsen5 = $_POST['jmlKonsen5'];
      $jmlKonsen6 = $_POST['jmlKonsen6'];
      $jmlKonsen7 = $_POST['jmlKonsen7'];

      $simpanSql = "INSERT INTO tbl_produksi SET 
          `nokk`='$nokk',
          `demandno`='$demand',
          `shift`='$shift',
          `shift2`='$shift2',
          `buyer`='$buyer',
          `no_item`='$item',
          `no_warna`='$nowarna',
          `jenis_bahan`='$bahan',
          `kondisi_kain`='$kain',
          `panjang`='$qty2',
          `panjang_h`='$qty3',
          `no_gerobak`='$gerobak',
          `no_mesin`='$mesin',
          `nama_mesin`='$nmmesin',
          `langganan`='$langganan',
          `no_order`='$order',
          `jenis_kain`='$jenis_kain',
          `warna`='$warna',
          `lot`='$lot',
          `rol`='$rol',
          `qty`='$qty',
          `proses`='$proses',
          `jam_in`='$jam_in',
          `jam_out`='$jam_out',
          `tgl_proses_in`='$tgl_proses_in',
          `tgl_proses_out`='$tgl_proses_out',
          `stop_l`='$mulai',
          `stop_l2`='$mulai2',
          `stop_l3`='$mulai3',
          `stop_r`='$selesai',
          `stop_r2`='$selesai2',
          `stop_r3`='$selesai3',
          `tgl_stop_l`='$tgl_stop_m',
          `tgl_stop_l2`='$tgl_stop_m2',
          `tgl_stop_l3`='$tgl_stop_m3',
          `tgl_stop_r`='$tgl_stop_s',
          `tgl_stop_r2`='$tgl_stop_s2',
          `tgl_stop_r3`='$tgl_stop_s3',
          `kd_stop`='$kd',
          `kd_stop2`='$kd2',
          `kd_stop3`='$kd3',
          `tgl_buat`=now(),
          `tgl_pro`=now(),
          `acc_staff`='$acc_kain',
          `catatan`='$catatan',
          `suhu`='$suhu',
          `speed`='$speed',
          `omt`='$omt',
          `vmt`='$vmt',
          `t_vmt`='$vmt_time',
          `buka_rantai`='$buka',
          `overfeed`='$overfeed',
          `overfeedjt`='$overfeedjt',
          `overfeedjk`='$overfeedjk',
          `lebar`='$lebar',
          `gramasi`='$gramasi',
          `lebar_h`='$hlebar',
          `gramasi_h`='$hgramasi',
          `ph_larut`='$phlarutan',
          `chemical_1`='$chemical1',
          `chemical_2`='$chemical2',
          `chemical_3`='$chemical3',
          `chemical_4`='$chemical4',
          `chemical_5`='$chemical5',
          `chemical_6`='$chemical6',
          `chemical_7`='$chemical7',
          `konsen_1`='$jmlKonsen1',
          `konsen_2`='$jmlKonsen2',
          `konsen_3`='$jmlKonsen3',
          `konsen_4`='$jmlKonsen4',
          `konsen_5`='$jmlKonsen5',
          `konsen_6`='$jmlKonsen6',
          `konsen_7`='$jmlKonsen7',
          `jns_mesin`='oven',
          `tgl_update`='$tgl'";
      mysqli_query($con, $simpanSql) or die("Gagal Simpan" . mysqli_error());
      //Simpan ke schedule
      $posisi = strpos($langganan, "/");
      $cus = substr($langganan, 0, $posisi);
      $byr = substr($langganan, ($posisi - 1), 100);
      $sqlData = mysqli_query($con, "INSERT INTO tbl_schedule SET
          nokk='$nokk',
          nodemand='$demand',
          langganan='$cus',
          buyer='$byr',
          no_order='$order',
          no_hanger='$item',
          no_item='$item',
          jenis_kain='$jenis_kain',
          lebar='$lebar',
          gramasi='$gramasi',
          warna='$warna',
          no_warna='$nowarna',
          bruto='$qty',
          lot='$lot',
          rol='$rol',
          shift='$shift',
          g_shift='$shift2',
          no_mesin='$mesin',
          proses='$proses',
          revisi='0',
          tgl_masuk=now(),
          personil='Operator Fin',
          target='0',
          catatan='data diinput dari finishing',
          tgl_update=now(),
          tampil='1'");

      // Refresh form
      echo "<meta http-equiv='refresh' content='0; url=?idkk=$idkk&status=Data Sudah DiSimpan'>";
    }
  ?>
  <form id="form1" name="form1" method="post" action="">
    <fieldset>
      <legend>Data Produksi Harian Oven</legend>
      <table width="100%" border="0">
        <tr>
          <th colspan="7" scope="row">
            <font color="#FF0000"><?php echo $_GET['status']; ?></font>
          </th>
        </tr>
        <tr>
          <td scope="row">
            <h4>Pilih Asal Kartu Kerja</h4>
          </td>
          <td width="1%">:</td>
          <td>
            <select style="width: 50%" id="typekk" name="typekk" onchange="window.location='?typekk='+this.value" required>
              <option value="" disabled selected>-Pilih Tipe Kartu Kerja-</option>
              <option value="KKLama" <?php if ($_GET['typekk'] == "KKLama") {
                                        echo "SELECTED";
                                      } ?>>KK Lama</option>
              <option value="NOW" <?php if ($_GET['typekk'] == "NOW") {
                                    echo "SELECTED";
                                  } ?>>KK NOW</option>
              <option value="SCHEDULE" <?php if ($_GET['typekk'] == "SCHEDULE") {
                                    echo "SELECTED";
                                  } ?>>SCHEDULE</option>
            </select>
          </td>
        </tr>
        <tr>
          <td width="13%" scope="row">
            <h4>Nokk</h4>
          </td>
          <td width="1%">:</td>
          <td width="26%">
            <input name="nokk" type="text" id="nokk" size="17" onchange="window.location='?typekk='+document.getElementById(`typekk`).value+'&idkk='+this.value" value="<?php echo $_GET['idkk']; ?>" /><input type="hidden" value="<?php echo $rw['id']; ?>" name="id" />

            <?php if ($_GET['typekk'] == 'NOW' OR $_GET['typekk'] == 'SCHEDULE') { ?>
              <select style="width: 40%" name="demand" id="demand" onchange="window.location='?typekk='+document.getElementById(`typekk`).value+'&idkk='+document.getElementById(`nokk`).value+'&demand='+this.value" required>
                <option value="" disabled selected>Pilih Nomor Demand</option>
                <?php
                $sql_ITXVIEWKK_demand  = db2_exec($conn_db2, "SELECT DEAMAND AS DEMAND FROM ITXVIEWKK WHERE PRODUCTIONORDERCODE = '$idkk'");
                while ($r_demand = db2_fetch_assoc($sql_ITXVIEWKK_demand)) :
                ?>
                  <option value="<?= $r_demand['DEMAND']; ?>" <?php if ($r_demand['DEMAND'] == $_GET['demand']) {
                                                                echo 'SELECTED';
                                                              } ?>><?= $r_demand['DEMAND']; ?></option>
                <?php endwhile; ?>
              </select>
            <?php } else { ?>
              <input name="demand" id="demand" type="text" placeholder="Nomor Demand">
            <?php } ?>
          </td>
          <td width="14%">
            <h4>Group Shift</h4>
          </td>
          <td width="1%">:</td>
          <td colspan="2"><select name="shift" id="shift" required>
              <option value="">Pilih</option>
              <option value="A">A</option>
              <option value="B">B</option>
              <option value="C">C</option>
            </select></td>
        </tr>
        <tr>
          <td>
            <h4>Operation</h4>
          </td>
          <td>:</td>
          <td>
            <select name="nama_mesin" id="nama_mesin" onchange="window.location='?typekk='+document.getElementById(`typekk`).value+'&idkk='+document.getElementById(`nokk`).value+'&demand='+document.getElementById(`demand`).value+'&shift=<?php echo $_GET['shift']; ?>&shift2=<?php echo $_GET['shift2']; ?>&operation='+this.value" required="required">
              <option value="">Pilih</option>
              <?php
              $qry1 = db2_exec($conn_db2, "SELECT DISTINCT 
                                                    TRIM(OPERATIONCODE) AS OPERATIONCODE,
                                                    LONGDESCRIPTION 
                                                  FROM 
                                                    WORKCENTERANDOPERATTRIBUTES
                                                  WHERE
                                                    (SUBSTR(WORKCENTERCODE, 1,4) = 'P3ST' OR SUBSTR(WORKCENTERCODE, 1,4) = 'P3DR')
                                                    AND NOT LONGDESCRIPTION = 'JANGAN DIPAKE'
                                                  ORDER BY
                                                    OPERATIONCODE ASC");
              while ($r = db2_fetch_assoc($qry1)) {
              ?>
                <option value="<?php echo $r['OPERATIONCODE']; ?>" <?php if ($_GET['operation'] == $r['OPERATIONCODE']) {
                                                                      echo "SELECTED";
                                                                    } ?>><?php echo $r['OPERATIONCODE']; ?> <?php echo $r['LONGDESCRIPTION']; ?></option>
              <?php } ?>
            </select>
            <?php if ($_SESSION['lvl'] == "SPV") { ?>
              <input type="button" name="btnmesin2" id="btnmesin2" value="..." onclick="window.open('pages/mesin.php','MyWindow','height=400,width=650');" />
            <?php } ?>
          </td>
          <td width="14%">
            <h4>Shift</h4>
          </td>
          <td>:</td>
          <td colspan="2"><select name="shift2" id="shift2" required="required">
              <option value="">Pilih</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
            </select></td>
        </tr>
        <tr>
          <td><strong>No. Mesin</strong></td>
          <td>:</td>
          <td>
            <select name="no_mesin" id="no_mesin" onchange="myFunction();" required="required">
              <option value="">Pilih</option>
              <?php
              $q_mesin = db2_exec($conn_db2, "SELECT
                                              p.WORKCENTERCODE,
                                              CASE
                                                WHEN p.PRODRESERVATIONLINKGROUPCODE IS NULL THEN TRIM(p.OPERATIONCODE) 
                                                WHEN TRIM(p.PRODRESERVATIONLINKGROUPCODE) = '' THEN TRIM(p.OPERATIONCODE) 
                                                ELSE p.PRODRESERVATIONLINKGROUPCODE
                                              END	AS OPERATIONCODE,
                                              TRIM(o.OPERATIONGROUPCODE) AS OPERATIONGROUPCODE,
                                              o.LONGDESCRIPTION,
                                              iptip.MULAI,
                                              iptop.SELESAI,
                                              p.PRODUCTIONORDERCODE,
                                              p.PRODUCTIONDEMANDCODE,
                                              p.GROUPSTEPNUMBER AS STEPNUMBER,
                                              CASE
                                                WHEN iptip.MACHINECODE = iptop.MACHINECODE THEN iptip.MACHINECODE
                                                ELSE iptip.MACHINECODE || '-' ||iptop.MACHINECODE
                                              END AS MESIN   
                                            FROM 
                                              PRODUCTIONDEMANDSTEP p 
                                            LEFT JOIN OPERATION o ON o.CODE = p.OPERATIONCODE 
                                            LEFT JOIN ITXVIEW_POSISIKK_TGL_IN_PRODORDER iptip ON iptip.PRODUCTIONORDERCODE = p.PRODUCTIONORDERCODE AND iptip.DEMANDSTEPSTEPNUMBER = p.STEPNUMBER
                                            LEFT JOIN ITXVIEW_POSISIKK_TGL_OUT_PRODORDER iptop ON iptop.PRODUCTIONORDERCODE = p.PRODUCTIONORDERCODE AND iptop.DEMANDSTEPSTEPNUMBER = p.STEPNUMBER
                                            WHERE
                                              p.PRODUCTIONORDERCODE  = '$_GET[idkk]' AND p.PRODUCTIONDEMANDCODE = '$_GET[demand]' 
                                              AND 
                                              CASE
                                                WHEN p.PRODRESERVATIONLINKGROUPCODE IS NULL THEN TRIM(p.OPERATIONCODE) 
                                                WHEN TRIM(p.PRODRESERVATIONLINKGROUPCODE) = '' THEN TRIM(p.OPERATIONCODE) 
                                                ELSE p.PRODRESERVATIONLINKGROUPCODE
                                              END = '$_GET[operation]'
                                            ORDER BY iptip.MULAI ASC");
              $row_mesin = db2_fetch_assoc($q_mesin);

              $qry1 = db2_exec($conn_db2, "SELECT
                                              *
                                            FROM
                                              RESOURCES r
                                            WHERE
                                              SUBSTR(CODE, 1,4) = 'P3ST' OR SUBSTR(CODE, 1,4) = 'P3DR'
                                            ORDER BY 
                                              SUBSTR(CODE, 6,2) 
                                            ASC");
              while ($r = db2_fetch_assoc($qry1)) {
              ?>
                <option value="<?php echo $r['CODE']; ?>" <?php if ($row_mesin['MESIN'] == $r['CODE']) {
                                                            echo "SELECTED";
                                                          } ?>><?php echo $r['CODE']; ?></option>
              <?php } ?>
            </select>
            <?php if ($_SESSION['lvl'] == "SPV") { ?>
              <input type="button" name="btnmesin" id="btnmesin" value="..." onclick="window.open('pages/data-mesin.php','MyWindow','height=400,width=650');" />
            <?php } ?>
          </td>
          <td>
            <h4>Tgl Proses</h4>
          </td>
          <td>:</td>
          <td colspan="2"><input name="tgl" type="text" id="tgl" onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.tgl);return false;" size="10" placeholder="0000-00-00" required="required" />
            <a href="javascript:void(0)" onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.tgl);return false;"><img src="../calender/calender.jpeg" alt="" name="popcal" width="30" height="25" id="popcal" style="border:none" align="absmiddle" border="0" /></a>
          </td>
        </tr>
        <tr>
          <td scope="row">
            <h4>Langganan/Buyer</h4>
          </td>
          <td>:</td>
          <td>
            <?php if ($_GET['typekk'] == "NOW") : ?>
              <?php $langganan_buyer =  $dt_pelanggan_buyer['PELANGGAN'] . '/' . $dt_pelanggan_buyer['BUYER']; ?>
            <?php else : ?>
              <?php if ($cek > 0) {
                $langganan_buyer =  $ssr1['partnername'] . "/" . $ssr2['partnername'];
              } else {
                $langganan_buyer =  $rw['langganan'];
              } ?>
            <?php endif; ?>
            <input name="buyer" type="text" id="buyer" size="30" value="<?= $langganan_buyer; ?>">
          </td>
          <td>
            <h4>Proses</h4>
          </td>
          <td>:</td>
          <td colspan="2"><select name="proses" id="proses" required>
              <option value="">Pilih</option>
              <?php $qry1 = mysqli_query($con, "SELECT proses,jns FROM tbl_proses WHERE ket='oven' ORDER BY id ASC");
              while ($r = mysqli_fetch_array($qry1)) {
              ?>
                <option value="<?php echo $r['proses'] . " (" . $r['jns'] . ")"; ?>" <?php if ($rw['proses'] == $r['proses'] . " (" . $r['jns'] . ")") {
                                                                                        echo "SELECTED";
                                                                                      } ?>><?php echo $r['proses'] . " (" . $r['jns'] . ")"; ?></option>
              <?php } ?>
            </select>
            <?php if ($_SESSION['lvl'] == "SPV") { ?>
              <input type="button" name="btnproses" id="btnproses" value="..." onclick="window.open('pages/data-proses.php','MyWindow','height=400,width=650');" />
            <?php } ?>
          </td>
        </tr>
        <tr>
          <td scope="row">
            <h4>Kode Buyer</h4>
          </td>
          <td>:</td>
          <td><select name="kd_buyer" id="kd_buyer" required="required">
              <option value="">Pilih</option>
              <option value="ADIDAS" <?php if ($ssr2['partnername'] == "ADIDAS") {
                                        echo "SELECTED";
                                      } ?>>ADIDAS</option>
              <option value="NIKE" <?php if ($ssr2['partnername'] == "NIKE") {
                                      echo "SELECTED";
                                    } ?>>NIKE</option>
              <option value="CAMPURAN" <?php if ($ssr2['partnername'] == "NIKE") {
                                        } else if ($ssr2['partnername'] == "ADIDAS") {
                                        } else {
                                          echo "SELECTED";
                                        } ?>>CAMPURAN</option>
            </select></td>
          <td>
            <h4>Kondisi Kain</h4>
          </td>
          <td>:</td>
          <td colspan="2"><select name="kondisi_kain" id="kondisi_kain" required="required">
              <option value="">Pilih</option>
              <option value="BASAH" <?php if ($rw['kondisi_kain'] == "BASAH") {
                                      echo "SELECTED";
                                    } ?>>BASAH</option>
              <option value="KERING" <?php if ($rw['kondisi_kain'] == "KERING") {
                                        echo "SELECTED";
                                      } ?>>KERING</option>
            </select></td>
        </tr>
        <tr>
          <td scope="row">
            <h4>No. Order</h4>
          </td>
          <td>:</td>
          <td>
            <?php if ($_GET['typekk'] == "NOW") : ?>
              <?php $no_order =  $dt_ITXVIEWKK['PROJECTCODE']; ?>
            <?php else : ?>
              <?php if ($cek > 0) {
                $no_order =  $ssr['documentno'];
              } else if ($rc > 0) {
                $no_order =  $rw['no_order'];
              } else if ($rcAdm > 0) {
                $no_order = $rwAdm['no_order'];
              } ?>
            <?php endif; ?>
            <input type="text" name="no_order" id="no_order" value="<?= $no_order; ?>" />
          </td>
          <td>
            <h4>No. Gerobak</h4>
          </td>
          <td>:</td>
          <td colspan="2"><input type="text" name="no_gerobak" id="no_gerobak" value="<?php echo $rw['no_gerobak']; ?>" /></td>
        </tr>
        <tr>
          <td valign="top" scope="row">
            <h4>Jenis Kain</h4>
          </td>
          <td valign="top">:</td>
          <td>
            <?php if ($_GET['typekk'] == "NOW") : ?>
              <?php $jk = $dt_ITXVIEWKK['ITEMDESCRIPTION']; ?>
            <?php else : ?>
              <?php if ($cek > 0) {
                $jk = $ssr['productcode'] . " / " . $ssr['description'];
              } else if ($rc > 0) {
                $jk = $rw['jenis_kain'];
              } else if ($rcAdm > 0) {
                $jk = $rwAdm['jenis_kain'];
              } ?>
            <?php endif; ?>
            <textarea name="jenis_kain" cols="35" id="jenis_kain"><?= $jk; ?></textarea>
          </td>
          <td valign="top">
            <h4>Catatan</h4>
          </td>
          <td valign="top">:</td>
          <td colspan="2" valign="top"><textarea name="catatan" cols="35" id="catatan"><?php echo $rw['catatan']; ?></textarea></td>
        </tr>
        <tr>
          <td scope="row">
            <h4>Hanger/Item</h4>
          </td>
          <td>:</td>
          <td>
            <?php if ($_GET['typekk'] == "NOW") : ?>
              <?php $hanger = $dt_ITXVIEWKK['NO_HANGER']; ?>
            <?php else : ?>
              <?php if ($cek > 0) {
                $hanger = $ssr['productcode'];
              } else if ($rc > 0) {
                $hanger = $rw['no_item'];
              } else if ($rcAdm > 0) {
                $hanger = $rwAdm['no_item'];
              } ?>
            <?php endif; ?>
            <input type="text" name="no_item" id="no_item" value="<?= $hanger; ?>" />
          </td>
          <td width="14%"><strong>Quantity (Kg)</strong></td>
          <td width="1%">:</td>
          <td colspan="2"><input name="qty" type="text" id="qty" size="5" value="<?= $dt_qtyorder['QTY_ORDER']; ?><?php if ($cLot > 0) {
                                                                                                                    echo round($sLot['Weight'], 2);
                                                                                                                  } else if ($rc > 0) {
                                                                                                                    echo round($rw['qty'], 2);
                                                                                                                  } else if ($rcAdm > 0) {
                                                                                                                    echo round($rwAdm['qty'], 2);
                                                                                                                  } ?>" placeholder="0.00" />
            &nbsp;&nbsp;&nbsp;
            <strong>Gramasi</strong>:
            <input name="lebar" type="text" id="lebar" size="6" value="<?= floor($dt_lg['LEBAR']); ?><?php if ($cek > 0) {
                                                                                                        echo round($ssr['cuttablewidth'], 2);
                                                                                                      } else if ($rcAdm > 0) {
                                                                                                        echo $rwAdm['lebar'];
                                                                                                      } ?>" placeholder="0" />
            <input name="gramasi" type="text" id="gramasi" size="6" value="<?= floor($dt_lg['GRAMASI']); ?><?php if ($cek > 0) {
                                                                                                              echo round($ssr['weight'], 2);
                                                                                                            } else if ($rcAdm > 0) {
                                                                                                              echo $rwAdm['gramasi'];
                                                                                                            } ?>" placeholder="0" />
          </td>
        </tr>
        <tr>
          <td scope="row">
            <h4>No. Warna</h4>
          </td>
          <td>:</td>
          <td>
            <?php if ($_GET['typekk'] == "NOW") : ?>
              <?php $nomor_warna = $dt_ITXVIEWKK['NO_WARNA']; ?>
            <?php else : ?>
              <?php if ($cek > 0) {
                $nomor_warna = $ssr['colorno'];
              } else if ($rc > 0) {
                $nomor_warna = $rw['no_warna'];
              } else if ($rcAdm > 0) {
                $nomor_warna = $rwAdm['no_warna'];
              } ?>
            <?php endif; ?>
            <input name="no_warna" type="text" id="no_warna" size="30" value="<?= $nomor_warna; ?>" />
          </td>
          <td width="14%"><strong>Panjang (Yard)</strong></td>
          <td>:</td>
          <td colspan="2"><input name="qty2" type="text" id="qty2" size="8" value="<?= $dt_qtyorder['QTY_ORDER_YARD']; ?><?php echo $rw['panjang']; ?>" placeholder="0.00" onfocus="jumlah();" /></td>
        </tr>
        <tr>
          <td scope="row">
            <h4>Warna</h4>
          </td>
          <td>:</td>
          <td><input name="warna" type="text" id="warna" size="30" value="<?= $dt_warna['WARNA']; ?><?php if ($cek > 0) {
                                                                                                      echo $ssr['color'];
                                                                                                    } else if ($rc > 0) {
                                                                                                      echo $rw['warna'];
                                                                                                    } else if ($rcAdm > 0) {
                                                                                                      echo $rwAdm['warna'];
                                                                                                    } ?>" /></td>

        </tr>
        <tr>
          <td scope="row">
            <h4>Jenis Bahan</h4>
          </td>
          <td>:</td>
          <td><select name="jenis_bahan" id="jenis_bahan" required="required">
              <option value="">Pilih</option>
              <option value="Polyesyer" <?php if ($rw['jenis_bahan'] == "Polyesyer") {
                                          echo "SELECTED";
                                        } ?>>Polyesyer</option>
              <option value="Cotton" <?php if ($rw['janis_bahan'] == "Cotton") {
                                        echo "SELECTED";
                                      } ?>>Cotton</option>
            </select></td>

        </tr>
        <tr>
          <td scope="row">
            <h4>Lot</h4>
          </td>
          <td>:</td>
          <td><input name="lot" type="text" id="lot" size="5" value="<?php if ($cLot > 0) {
                                                                        echo $rowLot['TotalLot'] . "-" . $nomorLot;
                                                                      } else if ($rc > 0) {
                                                                        echo $rw['lot'];
                                                                      } else if ($rcAdm > 0) {
                                                                        echo $rwAdm['lot'];
                                                                      } ?>" /></td>

        </tr>
        <tr>
          <td scope="row">
            <h4>Roll</h4>
          </td>
          <td>:</td>
          <td><input name="rol" type="text" id="rol" size="3" placeholder="0" pattern="[0-9]{1,}" value="<?= $dt_roll['ROLL']; ?><?php if ($cLot > 0) {
                                                                                                                                    echo $sLot['RollCount'];
                                                                                                                                  } else if ($rc > 0) {
                                                                                                                                    echo $rw['rol'];
                                                                                                                                  } else if ($rcAdm > 0) {
                                                                                                                                    echo $rwAdm['rol'];
                                                                                                                                  } ?>" /></td>

        </tr>
        <tr>
          <td scope="row">
            <h4>Mulai Proses</h4>
          </td>
          <td>:</td>
          <td><input name="proses_in" type="text" required="required" id="proses_in" placeholder="00:00" pattern="[0-9]{2}:[0-9]{2}$" title=" e.g 14:25" onkeyup="
              var time = this.value;
              if (time.match(/^\d{2}$/) !== null) {
                this.value = time + ':';
              } else if (time.match(/^\d{2}\:\d{2}$/) !== null) {
                this.value = time + '';
              }" value="<?php echo $rw['jam_in'] ?>" size="5" maxlength="5" />
            <input name="tgl_proses_m" type="text" required="required" id="tgl_proses_m" placeholder="0000-00-00" onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.tgl_proses_m);return false;" value="<?php echo $rw['tgl_proses_in']; ?>" size="10" />
            <a href="javascript:void(0)" onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.tgl_proses_m);return false;"><img src="../calender/calender.jpeg" alt="" name="popcal" width="30" height="25" id="popcal2" style="border:none" align="absmiddle" border="0" /></a>
          </td>
          <td>
            <h4>Selesai Proses</h4>
          </td>
          <td>:</td>
          <td colspan="2"><input name="proses_out" type="text" required="required" id="proses_out" placeholder="00:00" pattern="[0-9]{2}:[0-9]{2}$" title=" e.g 14:25 " onkeyup="
              var time = this.value;
              if (time.match(/^\d{2}$/) !== null) {
                this.value = time + ':';
              } else if (time.match(/^\d{2}\:\d{2}$/) !== null) {
                this.value = time + '';
              }" value="<?php echo $rw['jam_out'] ?>" size="5" maxlength="5" />
            <input name="tgl_proses_k" type="text" required="required" id="tgl_proses_k" placeholder="0000-00-00" onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.tgl_proses_k);return false;" value="<?php echo $rw['tgl_proses_out']; ?>" size="10" />
            <a href="javascript:void(0)" onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.tgl_proses_k);return false;"><img src="../calender/calender.jpeg" alt="" name="popcal" width="30" height="25" id="popcal3" style="border:none" align="absmiddle" border="0" /></a>
          </td>
        </tr>
        <tr>
          <td scope="row">
            <h4>Mulai Stop Mesin 1</h4>
          </td>
          <td>:</td>
          <td><input name="stop_mulai" type="text" id="stop_mulai" placeholder="00:00" pattern="[0-9]{2}:[0-9]{2}$" title=" e.g 14:25 " onkeyup="
              var time = this.value;
              if (time.match(/^\d{2}$/) !== null) {
                this.value = time + ':';
              } else if (time.match(/^\d{2}\:\d{2}$/) !== null) {
                this.value = time + '';
              }" value="<?php echo $rw['stop_l'] ?>" size="5" maxlength="5" />
            <input name="tgl_stop_m" type="text" id="tgl_stop_m" placeholder="0000-00-00" onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.tgl_stop_m);return false;" value="<?php echo $rw['tgl_stop_l']; ?>" size="10" />
            <a href="javascript:void(0)" onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.tgl_stop_m);return false;"><img src="../calender/calender.jpeg" alt="" name="popcal" width="30" height="25" id="popcal4" style="border:none" align="absmiddle" border="0" /></a>
          </td>
          <td>
            <h4>Selesai Stop Mesin 1</h4>
          </td>
          <td>:</td>
          <td width="21%"><input name="stop_selesai" type="text" id="stop_selesai" placeholder="00:00" pattern="[0-9]{2}:[0-9]{2}$" title=" e.g 14:25 " onkeyup="
              var time = this.value;
              if (time.match(/^\d{2}$/) !== null) {
                this.value = time + ':';
              } else if (time.match(/^\d{2}\:\d{2}$/) !== null) {
                this.value = time + '';
              }" value="<?php echo $rw['stop_r'] ?>" size="5" maxlength="5" />
            <input name="tgl_stop_s" type="text" id="tgl_stop_s" placeholder="0000-00-00" onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.tgl_stop_s);return false;" value="<?php echo $rw['tgl_stop_r']; ?>" size="10" />
            <a href="javascript:void(0)" onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.tgl_stop_s);return false;"><img src="../calender/calender.jpeg" alt="" name="popcal" width="30" height="25" id="popcal5" style="border:none" align="absmiddle" border="0" /></a>
          </td>
          <td width="24%">
            <h4>Kode1:
              <select name="kd_stop" id="kd_stop">
                <option value="">Pilih</option>
                <?php $qry1 = mysqli_query($con, "SELECT kode FROM tbl_stop_mesin ORDER BY id ASC");
                while ($r = mysqli_fetch_array($qry1)) {
                ?>
                  <option value="<?php echo $r['kode']; ?>" <?php if ($rw['kd_stop'] == $r['kode']) {
                                                              echo "SELECTED";
                                                            } ?>><?php echo $r['kode']; ?></option>
                <?php } ?>
              </select>
              <?php if ($_SESSION['lvl'] == "SPV") { ?>
                <input type="button" name="btnstop" id="btnstop" value="..." onclick="window.open('pages/data-stop.php','MyWindow','height=400,width=650');" />
              <?php } ?>
            </h4>
          </td>
        </tr>
        <tr>
          <td scope="row">
            <h4>Mulai Stop Mesin 2</h4>
          </td>
          <td>:</td>
          <td><input name="stop_mulai2" type="text" id="stop_mulai2" placeholder="00:00" pattern="[0-9]{2}:[0-9]{2}$" title=" e.g 14:25 " onkeyup="
            var time = this.value;
            if (time.match(/^\d{2}$/) !== null) {
              this.value = time + ':';
            } else if (time.match(/^\d{2}\:\d{2}$/) !== null) {
              this.value = time + '';
            }" value="<?php echo $rw['stop_l'] ?>" size="5" maxlength="5" />
            <input name="tgl_stop_m2" type="text" id="tgl_stop_m2" placeholder="0000-00-00" onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.tgl_stop_m2);return false;" value="<?php echo $rw['tgl_stop_l']; ?>" size="10" />
            <a href="javascript:void(0)" onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.tgl_stop_m2);return false;"><img src="../calender/calender.jpeg" alt="" name="popcal" width="30" height="25" id="popcal6" style="border:none" align="absmiddle" border="0" /></a>
          </td>
          <td>
            <h4>Selesai Stop Mesin 2</h4>
          </td>
          <td>:</td>
          <td><input name="stop_selesai2" type="text" id="stop_selesai2" placeholder="00:00" pattern="[0-9]{2}:[0-9]{2}$" title=" e.g 14:25 " onkeyup="
            var time = this.value;
            if (time.match(/^\d{2}$/) !== null) {
              this.value = time + ':';
            } else if (time.match(/^\d{2}\:\d{2}$/) !== null) {
              this.value = time + '';
            }" value="<?php echo $rw['stop_r'] ?>" size="5" maxlength="5" />
            <input name="tgl_stop_s2" type="text" id="tgl_stop_s2" placeholder="0000-00-00" onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.tgl_stop_s2);return false;" value="<?php echo $rw['tgl_stop_r']; ?>" size="10" />
            <a href="javascript:void(0)" onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.tgl_stop_s2);return false;"><img src="../calender/calender.jpeg" alt="" name="popcal" width="30" height="25" id="popcal7" style="border:none" align="absmiddle" border="0" /></a>
          </td>
          <td>
            <h4>Kode2:
              <select name="kd_stop2" id="kd_stop2">
                <option value="">Pilih</option>
                <?php $qry1 = mysqli_query($con, "SELECT kode FROM tbl_stop_mesin ORDER BY id ASC");
                while ($r = mysqli_fetch_array($qry1)) {
                ?>
                  <option value="<?php echo $r['kode']; ?>" <?php if ($rw['kd_stop'] == $r['kode']) {
                                                              echo "SELECTED";
                                                            } ?>><?php echo $r['kode']; ?></option>
                <?php } ?>
              </select>
              <?php if ($_SESSION['lvl'] == "SPV") { ?>
                <input type="button" name="btnstop2" id="btnstop2" value="..." onclick="window.open('pages/data-stop.php','MyWindow','height=400,width=650');" />
              <?php } ?>
            </h4>
          </td>
        </tr>
        <tr>
          <td scope="row">
            <h4>Mulai Stop Mesin 3</h4>
          </td>
          <td>:</td>
          <td><input name="stop_mulai3" type="text" id="stop_mulai3" placeholder="00:00" pattern="[0-9]{2}:[0-9]{2}$" title=" e.g 14:25 " onkeyup="
            var time = this.value;
            if (time.match(/^\d{2}$/) !== null) {
              this.value = time + ':';
            } else if (time.match(/^\d{2}\:\d{2}$/) !== null) {
              this.value = time + '';
            }" value="<?php echo $rw['stop_l'] ?>" size="5" maxlength="5" />
            <input name="tgl_stop_m3" type="text" id="tgl_stop_m3" placeholder="0000-00-00" onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.tgl_stop_m3);return false;" value="<?php echo $rw['tgl_stop_l']; ?>" size="10" />
            <a href="javascript:void(0)" onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.tgl_stop_m3);return false;"><img src="../calender/calender.jpeg" alt="" name="popcal" width="30" height="25" id="popcal8" style="border:none" align="absmiddle" border="0" /></a>
          </td>
          <td>
            <h4>Selesai Stop Mesin 3</h4>
          </td>
          <td>:</td>
          <td><input name="stop_selesai3" type="text" id="stop_selesai3" placeholder="00:00" pattern="[0-9]{2}:[0-9]{2}$" title=" e.g 14:25 " onkeyup="
            var time = this.value;
            if (time.match(/^\d{2}$/) !== null) {
              this.value = time + ':';
            } else if (time.match(/^\d{2}\:\d{2}$/) !== null) {
              this.value = time + '';
            }" value="<?php echo $rw['stop_r'] ?>" size="5" maxlength="5" />
            <input name="tgl_stop_s3" type="text" id="tgl_stop_s3" placeholder="0000-00-00" onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.tgl_stop_s3);return false;" value="<?php echo $rw['tgl_stop_r']; ?>" size="10" />
            <a href="javascript:void(0)" onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.tgl_stop_s3);return false;"><img src="../calender/calender.jpeg" alt="" name="popcal" width="30" height="25" id="popcal9" style="border:none" align="absmiddle" border="0" /></a>
          </td>
          <td>
            <h4>Kode3:
              <select name="kd_stop3" id="kd_stop3">
                <option value="">Pilih</option>
                <?php $qry1 = mysqli_query($con, "SELECT kode FROM tbl_stop_mesin ORDER BY id ASC");
                while ($r = mysqli_fetch_array($qry1)) {
                ?>
                  <option value="<?php echo $r['kode']; ?>" <?php if ($rw['kd_stop'] == $r['kode']) {
                                                              echo "SELECTED";
                                                            } ?>><?php echo $r['kode']; ?></option>
                <?php } ?>
              </select>
              <?php if ($_SESSION['lvl'] == "SPV") { ?>
                <input type="button" name="btnstop3" id="btnstop3" value="..." onclick="window.open('pages/data-stop.php','MyWindow','height=400,width=650');" />
              <?php } ?>
            </h4>
          </td>
        </tr>
        <tr>
          <td scope="row">&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>
            <h4>Operator</h4>
          </td>
          <td>:</td>
          <td colspan="2"><select name="acc_kain" id="acc_kain" required>
              <option value="">Pilih</option>
              <?php $qryacc = mysqli_query($con, "SELECT nama FROM tbl_staff ORDER BY id ASC");
              while ($racc = mysqli_fetch_array($qryacc)) {
              ?>
                <option value="<?php echo $racc['nama']; ?>" <?php if ($racc['nama'] == $rw['acc_staff']) {
                                                                echo "SELECTED";
                                                              } ?>><?php echo $racc['nama']; ?></option>
              <?php } ?>
            </select>
            <?php if ($_SESSION['lvl'] == "SPV") { ?>
              <input type="button" name="btnacc" id="btnacc" value="..." onclick="window.open('pages/data-operator.php','MyWindow','height=400,width=650');" />
            <?php } ?>
          </td>
        </tr>
      </table>
    </fieldset>
    <br>
    <!-- <fieldset>
      <legend>Data Proses Actual</legend>
      <table width="100%" border="0">
        <tr>
          <td width="17%" scope="row">
            <h4>Suhu Proses</h4>
          </td>
          <td width="1%">:</td>
          <td width="20%"><input name="suhu" type="text" required id="suhu" value="<?php echo $rw['suhu']; ?>" size="10" /></td>
          <td width="17%">&nbsp;</td>
          <td width="1%">&nbsp;</td>
          <td width="44%">&nbsp;</td>
        </tr>
        <tr>
          <td scope="row">
            <h4>Speed Proses</h4>
          </td>
          <td>:</td>
          <td><input name="speed" type="text" required id="speed" value="<?php echo $rw['speed']; ?>" size="10" /></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td scope="row">
            <h4>Buka Rantai</h4>
          </td>
          <td>:</td>
          <td><input name="buka_rantai" type="text" required id="buka_rantai" value="<?php echo $rw['buka_rantai']; ?>" size="10" /></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td scope="row">
            <h4>Overfeed Tengah</h4>
          </td>
          <td>:</td>
          <td><input name="overfeed" type="text" required id="overfeed" value="<?php echo $rw['overfeed']; ?>" size="10" /></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td scope="row">
            <h4>Overfeed Jaring Tengah</h4>
          </td>
          <td>:</td>
          <td><input name="overfeed2" type="text" required="required" id="overfeed2" value="<?php echo $rw['overfeed']; ?>" size="10" /></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td scope="row">
            <h4>Overfeed Jaring Keluar</h4>
          </td>
          <td>:</td>
          <td><input name="overfeed3" type="text" required="required" id="overfeed3" value="<?php echo $rw['overfeed']; ?>" size="10" /></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td scope="row">
            <h4>Lebar X Gramasi</h4>
          </td>
          <td>:</td>
          <td><input name="h_lebar" type="text" required id="h_lebar" value="<?php echo $rw['lebar_h']; ?>" size="5" />
            &quot;X
            <input name="h_gramasi" type="text" required id="h_gramasi" value="<?php echo $rw['gramasi_h']; ?>" size="5" />
          </td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td scope="row"><strong>Panjang (Yard)</strong></td>
          <td>:</td>
          <td><input name="qty3" type="text" id="qty3" size="8" value="<?php echo $rw['panjang_h']; ?>" placeholder="0.00" onfocus="jumlah1();" /></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td scope="row">
            <h4>Pemakaian Chemical</h4>
          </td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td scope="row">
            <h4>Chemical I</h4>
          </td>
          <td>:</td>
          <td><select name="chemical_1" id="chemical_1" required="required">
              <option value="">Pilih</option>
              <?php $qryche1 = mysqli_query($con, "SELECT kode FROM tbl_chemical ORDER BY kode ASC");
              while ($rch1 = mysqli_fetch_array($qryche1)) {
              ?>
                <option value="<?php echo $rch1['kode']; ?>" <?php if ($rch1['kode'] == $rw['chemical_1']) {
                                                                echo "SELECTED";
                                                              } ?>><?php echo $rch1['kode']; ?></option>
              <?php } ?>
            </select>
            <?php if ($_SESSION['lvl'] == "SPV") { ?>
              <input type="button" name="btnChemical" id="btnChemical" value="..." onclick="window.open('pages/data-chemical.php','MyWindow','height=400,width=650');" />
            <?php } ?>
          </td>
          <td>
            <h4>Jumlah Konsentrasi I</h4>
          </td>
          <td>:</td>
          <td><input name="jmlKonsen1" type="text" required="required" id="jmlKonsen1" value="<?php echo $rw['konsen_1']; ?>" size="5" /></td>
        </tr>
        <tr>
          <td scope="row">
            <h4>Chemical II</h4>
          </td>
          <td>:</td>
          <td><select name="chemical_2" id="chemical_2" required="required">
              <option value="">Pilih</option>
              <?php $qryche2 = mysqli_query($con, "SELECT kode FROM tbl_chemical ORDER BY kode ASC");
              while ($rch2 = mysqli_fetch_array($qryche2)) {
              ?>
                <option value="<?php echo $rch2['kode']; ?>" <?php if ($rch2['kode'] == $rw['chemical_2']) {
                                                                echo "SELECTED";
                                                              } ?>><?php echo $rch2['kode']; ?></option>
              <?php } ?>
            </select>
            <?php if ($_SESSION['lvl'] == "SPV") { ?>
              <input type="button" name="btnChemical2" id="btnChemical2" value="..." onclick="window.open('pages/data-chemical.php','MyWindow','height=400,width=650');" />
            <?php } ?>
          </td>
          <td>
            <h4>Jumlah Konsentrasi II</h4>
          </td>
          <td>:</td>
          <td><input name="jmlKonsen2" type="text" required="required" id="jmlKonsen2" value="<?php echo $rw['konsen_2']; ?>" size="5" /></td>
        </tr>
        <tr>
          <td scope="row">
            <h4>Chemical III</h4>
          </td>
          <td>:</td>
          <td><select name="chemical_3" id="chemical_3" required="required">
              <option value="">Pilih</option>
              <?php $qryche3 = mysqli_query($con, "SELECT kode FROM tbl_chemical ORDER BY kode ASC");
              while ($rch3 = mysqli_fetch_array($qryche3)) {
              ?>
                <option value="<?php echo $rch3['kode']; ?>" <?php if ($rch3['kode'] == $rw['chemical_3']) {
                                                                echo "SELECTED";
                                                              } ?>><?php echo $rch3['kode']; ?></option>
              <?php } ?>
            </select>
            <?php if ($_SESSION['lvl'] == "SPV") { ?>
              <input type="button" name="btnChemical3" id="btnChemical3" value="..." onclick="window.open('pages/data-chemical.php','MyWindow','height=400,width=650');" />
            <?php } ?>
          </td>
          <td>
            <h4>Jumlah Konsentrasi III</h4>
          </td>
          <td>:</td>
          <td><input name="jmlKonsen3" type="text" required="required" id="jmlKonsen3" value="<?php echo $rw['konsen_3']; ?>" size="5" /></td>
        </tr>
        <tr>
          <td scope="row">
            <h4>Chemical IV</h4>
          </td>
          <td>:</td>
          <td><select name="chemical_4" id="chemical_4" required="required">
              <option value="">Pilih</option>
              <?php $qryche4 = mysqli_query($con, "SELECT kode FROM tbl_chemical ORDER BY kode ASC");
              while ($rch4 = mysqli_fetch_array($qryche4)) {
              ?>
                <option value="<?php echo $rch4['kode']; ?>" <?php if ($rch4['kode'] == $rw['chemical_4']) {
                                                                echo "SELECTED";
                                                              } ?>><?php echo $rch4['kode']; ?></option>
              <?php } ?>
            </select>
            <?php if ($_SESSION['lvl'] == "SPV") { ?>
              <input type="button" name="btnChemical4" id="btnChemical4" value="..." onclick="window.open('pages/data-chemical.php','MyWindow','height=400,width=650');" />
            <?php } ?>
          </td>
          <td>
            <h4>Jumlah Konsentrasi IV</h4>
          </td>
          <td>:</td>
          <td><input name="jmlKonsen4" type="text" required="required" id="jmlKonsen4" value="<?php echo $rw['konsen_4']; ?>" size="5" /></td>
        </tr>
        <tr>
          <td scope="row">
            <h4>Chemical V</h4>
          </td>
          <td>&nbsp;</td>
          <td><select name="chemical_5" id="chemical_5" required="required">
              <option value="">Pilih</option>
              <?php $qryche5 = mysqli_query($con, "SELECT kode FROM tbl_chemical ORDER BY kode ASC");
              while ($rch5 = mysqli_fetch_array($qryche5)) {
              ?>
                <option value="<?php echo $rch5['kode']; ?>" <?php if ($rch5['kode'] == $rw['chemical_5']) {
                                                                echo "SELECTED";
                                                              } ?>><?php echo $rch5['kode']; ?></option>
              <?php } ?>
            </select>
            <?php if ($_SESSION['lvl'] == "SPV") { ?>
              <input type="button" name="btnChemical5" id="btnChemical5" value="..." onclick="window.open('pages/data-chemical.php','MyWindow','height=400,width=650');" />
            <?php } ?>
          </td>
          <td>
            <h4>Jumlah Konsentrasi V</h4>
          </td>
          <td>:</td>
          <td><input name="jmlKonsen5" type="text" required="required" id="jmlKonsen5" value="<?php echo $rw['konsen_5']; ?>" size="5" /></td>
        </tr>
        <tr>
          <td scope="row">
            <h4>Chemical VI</h4>
          </td>
          <td>&nbsp;</td>
          <td><select name="chemical_6" id="chemical_6" required>
              <option value="">Pilih</option>
              <?php $qryche6 = mysqli_query($con, "SELECT kode FROM tbl_chemical ORDER BY kode ASC");
              while ($rch6 = mysqli_fetch_array($qryche6)) {
              ?>
                <option value="<?php echo $rch6['kode']; ?>" <?php if ($rch6['kode'] == $rw['chemical_6']) {
                                                                echo "SELECTED";
                                                              } ?>><?php echo $rch6['kode']; ?></option>
              <?php } ?>
            </select>
            <?php if ($_SESSION['lvl'] == "SPV") { ?>
              <input type="button" name="btnChemical6" id="btnChemical6" value="..." onclick="window.open('pages/data-chemical.php','MyWindow','height=400,width=650');" />
            <?php } ?>
          </td>
          <td>
            <h4>Jumlah Konsentrasi VI</h4>
          </td>
          <td>:</td>
          <td><input name="jmlKonsen5" type="text" required id="jmlKonsen6" value="<?php echo $rw['konsen_6']; ?>" size="5" /></td>
        </tr>
        <tr>
          <td scope="row">
            <h4>Chemical VII</h4>
          </td>
          <td>&nbsp;</td>
          <td><select name="chemical_7" id="chemical_7" required>
              <option value="">Pilih</option>
              <?php $qryche7 = mysqli_query($con, "SELECT kode FROM tbl_chemical ORDER BY kode ASC");
              while ($rch7 = mysqli_fetch_array($qryche7)) {
              ?>
                <option value="<?php echo $rch7['kode']; ?>" <?php if ($rch7['kode'] == $rw['chemical_7']) {
                                                                echo "SELECTED";
                                                              } ?>><?php echo $rch7['kode']; ?></option>
              <?php } ?>
            </select>
            <?php if ($_SESSION['lvl'] == "SPV") { ?>
              <input type="button" name="btnChemical7" id="btnChemical7" value="..." onclick="window.open('pages/data-chemical.php','MyWindow','height=400,width=650');" />
            <?php } ?>
          </td>
          <td>
            <h4>Jumlah Konsentrasi VII</h4>
          </td>
          <td>:</td>
          <td><input name="jmlKonsen7" type="text" required id="jmlKonsen7" value="<?php echo $rw['konsen_7']; ?>" size="5" /></td>
        </tr>
        <tr>
          <td scope="row">&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table>
    </fieldset><br> -->
    <input type="submit" name="btnSimpan" id="btnSimpan" value="Simpan" class="art-button" />
    <input type="button" name="batal" id="batal" value="Batal" onclick="window.location.href='index.php'" class="art-button" />
    <input type="button" name="button2" id="button2" value="Kembali" onclick="window.location.href='../index.php'" class="art-button" />
  </form>
</body>

</html>