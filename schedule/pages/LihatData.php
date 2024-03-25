<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
    include('../koneksi.php');
?>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>SCHEDULE FINISHING</title>
    <link rel="stylesheet" type="text/css" href="../css/datatable.css" />
    <link rel="stylesheet" type="text/css" href="../css/jquery-ui.css" />
    <script src="../js/jquery.js" type="text/javascript"></script>
    <script src="../js/jquery.dataTables.js" type="text/javascript"></script>
    <script>
        $(document).ready(function() {
            $('#datatables').dataTable({
                "sScrollY": "500px",
                "sScrollX": "100%",
                "bScrollCollapse": false,
                "bPaginate": false,
                "bJQueryUI": true
            });
        })
    </script>
</head>

<body>
    <form id="form1" name="form1" method="post" action="">
        <table width="650" border="0">
            <tr>
                <td colspan="3">
                    <div align="center"><strong>KK MASUK FINISHING</strong></div>
                    <?php
                        $user_name = $_SESSION['username'];
                        date_default_timezone_set('Asia/Jakarta');
                        $tgl = date("Y-M-d h:i:s A");
                        echo $tgl; 
                    ?>
                    <br>
                </td>
            </tr>
            <tr>
                <td><strong>Nomor Mesin</strong></td>
                <td>:</td>
                <td>
                    <select name="no_mesin" class="form-control select2">
                        <option value="-" disabled selected>Pilih</option>
                        <?php
                            $q_mesin    = mysqli_query($con, "SELECT
                                                                    DISTINCT
                                                                    no_mesin 
                                                                FROM
                                                                    `tbl_schedule_new`");
                        ?>
                        <?php while ($row_mesin = mysqli_fetch_array($q_mesin)) : ?>
                            <option value="<?= $row_mesin['no_mesin']; ?>" <?php if($row_mesin['no_mesin'] == $_POST['no_mesin']){ echo 'SELECTED'; } ?>><?= $row_mesin['no_mesin']; ?></option>
                        <?php endwhile; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td><strong>Nama Mesin</strong></td>
                <td>:</td>
                <td>
                    <select name="nama_mesin" class="form-control select2">
                        <option value="-" disabled selected>Pilih</option>
                        <?php
                            $q_mesin    = mysqli_query($con, "SELECT
                                                                    DISTINCT
                                                                    nama_mesin 
                                                                FROM
                                                                    `tbl_schedule_new`");
                        ?>
                        <?php while ($row_mesin = mysqli_fetch_array($q_mesin)) : ?>
                            <option value="<?= $row_mesin['nama_mesin']; ?>" <?php if($row_mesin['nama_mesin'] == $_POST['nama_mesin']){ echo 'SELECTED'; } ?>><?= $row_mesin['nama_mesin']; ?></option>
                        <?php endwhile; ?>
                    </select>
                </td>
            </tr>
            <tr valign="middle">
                <td width="127"><strong>Tanggal Awal</strong></td>
                <td width="3">:</td>
                <td width="280"><input name="awal" type="text" id="awal" value="<?= $_POST['awal'] ?>" onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.awal);return false;" size="14" /><a href="javascript:void(0)" onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.awal);return false;"><img src="../calender/calender.jpeg" alt="" name="popcal" width="30" height="25" id="popcal" style="border:none" align="absmiddle" border="0" /></a></td>
            </tr>
            <tr>
                <td><strong>Tanggal Akhir</strong></td>
                <td>:</td>
                <td width="280"><input name="akhir" type="text" id="akhir" value="<?= $_POST['akhir'] ?>" onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.akhir);return false;" size="14" /><a href="javascript:void(0)" onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.akhir);return false;"><img src="../calender/calender.jpeg" alt="" name="popcal" width="30" height="25" id="popcal" style="border:none" align="absmiddle" border="0" /></a></td>
            </tr>
            <tr>
                <td colspan="3">
                    <input type="submit" name="button" id="button" value="Cari data" class="art-button" /> 
                </td>
            </tr>
        </table>
    </form>
    <table width="100%" border="1" id="datatables" class="display">
    <thead>
        <tr>
            <th style="border:1px solid;vertical-align:middle; font-weight: bold;">NO URUT</th>
            <th style="border:1px solid;vertical-align:middle; font-weight: bold;">NO MESIN</th>
            <th style="border:1px solid;vertical-align:middle; font-weight: bold;">NAMA MESIN</th>
            <th style="border:1px solid;vertical-align:middle; font-weight: bold;">OPERATION</th>
            <th style="border:1px solid;vertical-align:middle; font-weight: bold;">NO KK</th>
            <th style="border:1px solid;vertical-align:middle; font-weight: bold;">NO DEMAND</th>
            <th style="border:1px solid;vertical-align:middle; font-weight: bold;">LANGGANAN</th>
            <th style="border:1px solid;vertical-align:middle; font-weight: bold;">BUYER</th>
            <th style="border:1px solid;vertical-align:middle; font-weight: bold;">NO ORDER</th>
            <th style="border:1px solid;vertical-align:middle; font-weight: bold;">JENIS KAIN</th>
            <th style="border:1px solid;vertical-align:middle; font-weight: bold;">NO WARNA</th>
            <th style="border:1px solid;vertical-align:middle; font-weight: bold;">WARNA</th>
            <th style="border:1px solid;vertical-align:middle; font-weight: bold;">ROL</th>
            <th style="border:1px solid;vertical-align:middle; font-weight: bold;">QTY</th>
            <th style="border:1px solid;vertical-align:middle; font-weight: bold;">QTY YD</th>
            <th style="border:1px solid;vertical-align:middle; font-weight: bold;">PROSES</th>
            <th style="border:1px solid;vertical-align:middle; font-weight: bold;">OPSI</th>
        </tr>
    </thead>
    <tbody>
        <?php
            if($_POST['no_mesin']){
                $where_no_mesin  = "AND no_mesin = '$_POST[no_mesin]'";
            }else{
                $where_no_mesin  = "";
            }
            
            if($_POST['nama_mesin']){
                $where_nama_mesin  = "AND nama_mesin = '$_POST[nama_mesin]'";
            }else{
                $where_nama_mesin  = "";
            }
            
            if($_POST['awal']){
                $where_tgl  = "AND creationdatetime BETWEEN '$_POST[awal]' AND '$_POST[akhir]'";
            }else{
                $where_tgl  = "";
            }

            // $q_tblmasuk     = mysqli_query($con, "SELECT * FROM tbl_schedule_new WHERE `status` = 'SCHEDULE' $where_tgl $where_nama_mesin $where_no_mesin");
            // $q_tblmasuk     = mysqli_query($con, "SELECT DISTINCT
            //                                             nama_mesin,
            //                                             GROUP_CONCAT( nokk ORDER BY id SEPARATOR ', ' ) AS nokk,
            //                                             GROUP_CONCAT( TRIM( nodemand ) ORDER BY id SEPARATOR ', ' ) AS nodemand,
            //                                             GROUP_CONCAT( DISTINCT no_order ORDER BY id SEPARATOR ', ' ) AS no_order,
	        //                                             GROUP_CONCAT( DISTINCT jenis_kain ORDER BY id SEPARATOR ', ' ) AS jenis_kain,
            //                                             GROUP_CONCAT( DISTINCT langganan ORDER BY id SEPARATOR ', ' ) AS langganan,
	        //                                             GROUP_CONCAT( DISTINCT buyer ORDER BY id SEPARATOR ', ' ) AS buyer
            //                                         FROM
            //                                             `tbl_schedule_new` 
            //                                         WHERE 
            //                                             `status` = 'SCHEDULE' $where_tgl $where_nama_mesin $where_no_mesin");
            $q_tblmasuk     = mysqli_query($con, "SELECT * FROM
                                                        `tbl_schedule_new`  
                                                    WHERE 
                                                        `status` = 'SCHEDULE' $where_tgl $where_nama_mesin $where_no_mesin");
        ?>
        <?php while ($row_tblmasuk  = mysqli_fetch_array($q_tblmasuk)) : ?>
            <tr>
                <td style="border:1px solid;vertical-align:middle; text-align: center;"><?= $row_tblmasuk['nourut'] ?></td>
                <td style="border:1px solid;vertical-align:middle; text-align: center;"><?= $row_tblmasuk['no_mesin'] ?></td>
                <td style="border:1px solid;vertical-align:middle; text-align: center;"><?= $row_tblmasuk['nama_mesin'] ?></td>
                <td style="border:1px solid;vertical-align:middle; text-align: center;"><?= $row_tblmasuk['operation'] ?></td>
                <td style="border:1px solid;vertical-align:middle;"><?= $row_tblmasuk['nokk'] ?></td>
                <td style="border:1px solid;vertical-align:middle;"><?= $row_tblmasuk['nodemand'] ?></td>
                <td style="border:1px solid;vertical-align:middle;"><?= $row_tblmasuk['langganan'] ?></td>
                <td style="border:1px solid;vertical-align:middle;"><?= $row_tblmasuk['buyer'] ?></td>
                <td style="border:1px solid;vertical-align:middle;"><?= $row_tblmasuk['no_order'] ?></td>
                <td style="border:1px solid;vertical-align:middle;"><?= $row_tblmasuk['jenis_kain'] ?></td>
                <td style="border:1px solid;vertical-align:middle;"><?= $row_tblmasuk['no_warna'] ?></td>
                <td style="border:1px solid;vertical-align:middle;"><?= $row_tblmasuk['warna'] ?></td>
                <td style="border:1px solid;vertical-align:middle;"><?= $row_tblmasuk['rol'] ?></td>
                <td style="border:1px solid;vertical-align:middle;"><?= $row_tblmasuk['qty_order'] ?></td>
                <td style="border:1px solid;vertical-align:middle;"><?= $row_tblmasuk['qty_order_yd'] ?></td>
                <td style="border:1px solid;vertical-align:middle;"><?= $row_tblmasuk['proses'] ?></td>
                <td style="border:1px solid;vertical-align:middle;"></td>
            </tr>
        <?php endwhile; ?>
    </tbody>
    </table>
</body>
</html>