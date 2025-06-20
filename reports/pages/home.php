<?php
    ini_set("error_reporting", 1);
    session_start();
    include '../koneksi.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Laporan Produksi Finishing</title>
  <script>
    function ganti() {
      var lprn = document.forms['form1']['jns'].value;
      if (lprn == "Adm Finishing") {
        window.location.href = "?p=home2";
      } else if (lprn == "Detail In-Out") {
        window.location.href = "?p=home3";
      } else if (lprn == "Grafik") {
        window.location.href = "?p=home4";
      } else if (lprn == "Detail Proses") {
        window.location.href = "?p=home5";
      } else if (lprn == "Stoppage Mesin") {
        window.location.href = "?p=home6";
      }else if (lprn == "Produksi Finishing NOW"){
        window.location.href = "?p=home7";
      }else if (lprn == "Kartu Stock Obat"){
        window.location.href = "?p=home8";
      }
    }
  </script>
</head>

<body>
  <form id="form1" name="form1" method="post" action="index.php?p=reports">
    <table width="470" border="0">
      <tr>
        <td colspan="3">
          <div align="center"><strong>LAPORAN PRODUKSI FINISHING</strong></div>
          </div>
          <?php
              $user_name = $_SESSION['username'];
              date_default_timezone_set('Asia/Jakarta');
          $tgl = date("Y-M-d h:i:s A");
          echo $tgl; ?><br />
        </td>
      </tr>
      <tr>
        <td><strong>Jenis Laporan</strong></td>
        <td>:</td>
        <td><label for="jns"></label>
          <select name="jns" id="jns" onchange="ganti();">
            <option value="Produksi Finishing" selected="selected">Produksi Finishing</option>
            <option value="Produksi Finishing NOW">Produksi Finishing NOW</option>
            <!-- <option value="Adm Finishing">Adm Finishing</option> -->
            <!-- <option value="Detail In-Out">Detail In-Out</option> -->
            <!-- <option value="Grafik">Grafik</option> -->
            <!-- <option value="Detail Proses">Detail Proses</option> -->
            <option value="Stoppage Mesin">Stoppage Mesin</option>
            <option value="Kartu Stock Obat">Kartu Stock Obat</option>
          </select>
        </td>
      </tr>
      <tr valign="middle">
        <td><strong>Jenis Mesin</strong></td>
        <td>:</td>
        <td>
          <select name="jnsmesin" id="jnsmesin" onChange="window.location='?p=home&jns='+this.value" required>
            <option value="">Pilih</option>
			<option value="ALL" <?php if ($_GET['jns'] == "ALL") {
                                                                       echo "SELECTED";
                                                                   }?>>All</option>  
            <option value="belah"                                                                   <?php if ($_GET['jns'] == "belah") {
                                                                       echo "SELECTED";
                                                                   }?>>Belah</option>
            <option value="compact"                                                                       <?php if ($_GET['jns'] == "compact") {
                                                                           echo "SELECTED";
                                                                       }?>>Compact</option>
            <option value="lipat"                                                                   <?php if ($_GET['jns'] == "lipat") {
                                                                       echo "SELECTED";
                                                                   }?>>Lipat</option>
            <option value="oven"                                                                 <?php if ($_GET['jns'] == "oven") {
                                                                     echo "SELECTED";
                                                                 }?>>Oven</option>
            <option value="stenter"                                                                       <?php if ($_GET['jns'] == "stenter") {
                                                                           echo "SELECTED";
                                                                       }?>>Stenter</option>
            <option value="steamer"                                                                       <?php if ($_GET['jns'] == "steamer") {
                                                                           echo "SELECTED";
                                                                       }?>>Steamer</option>
          </select>
        </td>
      </tr>
      <tr valign="middle">
        <td width="127"><strong>Tanggal Awal</strong></td>
        <td width="3">:</td>
        <td width="280"><input name="awal" type="text" id="awal" onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.awal);return false;" size="14" required="required" /><a href="javascript:void(0)" onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.awal);return false;"><img src="../calender/calender.jpeg" alt="" name="popcal" width="30" height="25" id="popcal" style="border:none" align="absmiddle" border="0" /></a></td>
      </tr>
      <tr>

        <td><strong>Tanggal Akhir</strong></td>
        <td>:</td>
        <td width="280"><input name="akhir" type="text" id="akhir" onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.akhir);return false;" size="14" required="required" /><a href="javascript:void(0)" onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.akhir);return false;"><img src="../calender/calender.jpeg" alt="" name="popcal" width="30" height="25" id="popcal" style="border:none" align="absmiddle" border="0" /></a></td>
      </tr>
      <tr>
        <td><strong>Mesin</strong></td>
        <td>:</td>
        <td><select name="nama_mesin" id="nama_mesin" onchange="myFunction();">
            <option value="">Pilih</option>
            <?php $qry1 = sqlsrv_query($con, "SELECT no_mesin FROM db_finishing.tbl_no_mesin WHERE jenis LIKE '$_GET[jns]%' ORDER BY no_mesin ASC");
                while ($r = sqlsrv_fetch_array($qry1)) {
                ?>
              <option value="<?php echo $r['no_mesin']; ?>"><?php echo $r['no_mesin']; ?></option>
            <?php
            }?>
          </select></td>
      </tr>
      <tr>
        <td><strong>Shift</strong></td>
        <td>:</td>
        <td><label for="shift"></label>
          <select name="shift" id="shift">
            <option value="ALL">ALL</option>
            <option value="A">A</option>
            <option value="B">B</option>
            <option value="C">C</option>
          </select>
        </td>
      </tr>
      <tr>
        <td colspan="3">*) Data satu hari dihitung dari jam 23:01 dan jam 23:00 di hari setelahnya</td>
      </tr>
      <tr>
        <td colspan="3"><input type="submit" name="button" id="button" value="Lihat Data" class="art-button" /> <input type="button" name="button2" id="button2" value="Kembali" onclick="window.location.href='../index.php'" class="art-button" /></td>
      </tr>
    </table>
  </form>
</body>

</html>