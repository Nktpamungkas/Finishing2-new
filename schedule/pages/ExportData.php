<?php
    header("Content-type: application/octet-stream");
    header("Content-Disposition: attachment; filename=laporan-SCHEDULE.xls"); //ganti nama sesuai keperluan
    header("Pragma: no-cache");
    header("Expires: 0");
?>
<table border="1">
    <thead>
        <tr>
            <th colspan="3" align="center">
                <img src="../../indo.jpg" width="40" height="40">
            </th>
            <th colspan="23" align="center" valign="middle">
                <strong>
                    <font size="+1">
                        SCHEDULE FINISHING <?php if(empty($_GET['no_mesin'])){ echo "SEMUA MESIN"; } ?>
                    </font>
                    <br>
                    FW-14-PPC-11/00
                </strong>
            </th>
        </tr>
        <tr>
            <th>NO</th>
            <th>NO URUT</th>
            <th>NO MESIN</th>
            <th>MESIN</th>
            <th>GROUP SHIFT</th>
            <th>NO KK</th>
            <th>NO DEMAND</th>
            <th>LANGGANAN</th>
            <th>BUYER</th>
            <th>NO ORDER</th>
            <th>TGL DELIVERY</th>
            <th>JENIS KAIN</th>
            <th>LEBAR</th>
            <th>GRAMASI</th>
            <th>WARNA</th>
            <th>NO WARNA</th>
            <th>LOT</th>
            <th>ROLL</th>
            <th>QTY ORDER</th>
            <th>QTY ORDER YARD</th>
            <th>OPERATION</th>
            <th>PROSES</th>
            <th>PERSONIL</th>
            <th>CATATAN</th>
            <th>CREATION DATE TIME</th>
            <th>KETERANGAN</th>
        </tr>
    </thead>
    <tbody>
        <?php
            include('../../koneksi.php');
            ini_set("error_reporting", 0);
            if($_GET['nourut'] == 'without0'){
                $where_nourut  = "AND NOT nourut = '0'";
            }else{
                $where_nourut  = "";
            }
            
            if ($_GET['no_mesin']) {
                $where_no_mesin  = "AND no_mesin = '$_GET[no_mesin]'";
            } else {
                $where_no_mesin  = "";
            }

            if ($_GET['nama_mesin']) {
                $where_nama_mesin  = "AND nama_mesin = '$_GET[nama_mesin]'";
            } else {
                $where_nama_mesin  = "";
            }
            
            if ($_GET['proses']) {
                $where_proses  = "AND proses = '$_GET[proses]'";
            } else {
                $where_proses  = "";
            }

            if ($_GET['awal']) {
                $where_tgl  = "AND SUBSTR(creationdatetime, 1, 10) BETWEEN '$_GET[awal]' AND '$_GET[akhir]'";
            } else {
                $where_tgl  = "";
            }
            $no = 1;
            $query_schedule = "SELECT * FROM `tbl_schedule_new` WHERE `status` = 'SCHEDULE' $where_nourut $where_tgl $where_nama_mesin $where_proses $where_no_mesin ORDER BY CONCAT(SUBSTR(TRIM(no_mesin), -5,2), SUBSTR(TRIM(no_mesin), -2)) ASC, nourut ASC";
            $q_schedule     = mysqli_query($con, $query_schedule);
        ?>
        <?php while ($row_schedule  = mysqli_fetch_array($q_schedule)) : ?>
            <?php
                $cek_proses   = mysqli_query($con, "SELECT COUNT(*) AS jml FROM tbl_produksi WHERE nokk = '$row_schedule[nokk]' AND demandno = '$row_schedule[nodemand]' AND no_mesin = '$row_schedule[no_mesin]' AND nama_mesin = '$row_schedule[operation]'");
                $data_proses  = mysqli_fetch_assoc($cek_proses);
            ?>
            <?php if(empty($data_proses['jml']) AND $_GET['kksudahproses'] == '3') : ?>
                <tr>
                    <td style="white-space: nowrap;"><?= $no++; ?></td>
                    <td style="white-space: nowrap;"><?= $row_schedule['nourut'] ?></td>
                    <td style="white-space: nowrap;"><?= substr(TRIM($row_schedule['no_mesin']), -5, 2).substr(TRIM($row_schedule['no_mesin']), -2); ?></td>
                    <td style="white-space: nowrap;"><?= $row_schedule['nama_mesin'] ?></td>
                    <td style="white-space: nowrap;"><?= $row_schedule['group_shift'] ?></td>
                    <td style="white-space: nowrap;">`<?= $row_schedule['nokk'] ?></td>
                    <td style="white-space: nowrap;">`<a target="_BLANK" href="http://online.indotaichen.com/laporan/ppc_filter_steps.php?demand=<?= $row_schedule['nodemand']; ?>&prod_order=<?= $row_schedule['nokk']; ?>"><?= $row_schedule['nodemand'] ?></a></td>
                    <td style="white-space: nowrap;"><?= $row_schedule['langganan'] ?></td>
                    <td style="white-space: nowrap;"><?= $row_schedule['buyer'] ?></td>
                    <td style="white-space: nowrap;"><?= $row_schedule['no_order'] ?></td>
                    <td style="white-space: nowrap;"><?= $row_schedule['tgl_delivery'] ?></td>
                    <td style="white-space: nowrap;" style="white-space: nowrap;"><?= $row_schedule['jenis_kain'] ?></td>
                    <td style="white-space: nowrap;"><?= $row_schedule['lebar'] ?></td>
                    <td style="white-space: nowrap;"><?= $row_schedule['gramasi'] ?></td>
                    <td style="white-space: nowrap;"><?= $row_schedule['warna'] ?></td>
                    <td style="white-space: nowrap;"><?= $row_schedule['no_warna'] ?></td>
                    <td style="white-space: nowrap;"><?= $row_schedule['lot'] ?></td>
                    <td style="white-space: nowrap;"><?= $row_schedule['roll'] ?></td>
                    <td style="white-space: nowrap;"><?= $row_schedule['qty_order'] ?></td>
                    <td style="white-space: nowrap;"><?= $row_schedule['qty_order_yd'] ?></td>
                    <td style="white-space: nowrap;"><?= $row_schedule['operation'] ?></td>
                    <td style="white-space: nowrap;"><?= $row_schedule['proses'] ?></td>
                    <td style="white-space: nowrap;"><?= $row_schedule['personil'] ?></td>
                    <td style="white-space: nowrap;"><?= $row_schedule['catatan'] ?></td>
                    <td style="white-space: nowrap;"><?= $row_schedule['creationdatetime'] ?></td>
                    <td  style="white-space: nowrap;">
                        <?php
                            // CEK JIKA SUDAH PROSES MAKA MUNCULIN DI KETERANGAN
                            $cek_hasilproses   = mysqli_query($con, "SELECT * FROM tbl_produksi WHERE nokk = '$row_schedule[nokk]' AND demandno = '$row_schedule[nodemand]' AND no_mesin = '$row_schedule[no_mesin]' AND nama_mesin = '$row_schedule[operation]'");
                            $data_hasilproses  = mysqli_fetch_assoc($cek_hasilproses);
                        ?>
                        <?php if($data_hasilproses){ echo "Sudah Jalan"; } ?>,
                        <?= $data_hasilproses['tgl_buat']; ?>,
                        <?= $data_hasilproses['no_mesin']; ?>,
                        <?= $data_hasilproses['nama_mesin']; ?>-<?= $data_hasilproses['proses']; ?>
                    </td>
                </tr>
            <?php elseif (!empty($data_proses['jml']) AND $_GET['kksudahproses'] == '2') : ?>
                <tr>
                    <td style="white-space: nowrap;"><?= $no++; ?></td>
                    <td style="white-space: nowrap;"><?= $row_schedule['nourut'] ?></td>
                    <td style="white-space: nowrap;"><?= substr(TRIM($row_schedule['no_mesin']), -5, 2).substr(TRIM($row_schedule['no_mesin']), -2); ?></td>
                    <td style="white-space: nowrap;"><?= $row_schedule['nama_mesin'] ?></td>
                    <td style="white-space: nowrap;"><?= $row_schedule['group_shift'] ?></td>
                    <td style="white-space: nowrap;">`<?= $row_schedule['nokk'] ?></td>
                    <td style="white-space: nowrap;">`<?= $row_schedule['nodemand'] ?></td>
                    <td style="white-space: nowrap;"><?= $row_schedule['langganan'] ?></td>
                    <td style="white-space: nowrap;"><?= $row_schedule['buyer'] ?></td>
                    <td style="white-space: nowrap;"><?= $row_schedule['no_order'] ?></td>
                    <td style="white-space: nowrap;"><?= $row_schedule['tgl_delivery'] ?></td>
                    <td style="white-space: nowrap;"><?= $row_schedule['jenis_kain'] ?></td>
                    <td style="white-space: nowrap;"><?= $row_schedule['lebar'] ?></td>
                    <td style="white-space: nowrap;"><?= $row_schedule['gramasi'] ?></td>
                    <td style="white-space: nowrap;"><?= $row_schedule['warna'] ?></td>
                    <td style="white-space: nowrap;"><?= $row_schedule['no_warna'] ?></td>
                    <td style="white-space: nowrap;"><?= $row_schedule['lot'] ?></td>
                    <td style="white-space: nowrap;"><?= $row_schedule['roll'] ?></td>
                    <td style="white-space: nowrap;"><?= $row_schedule['qty_order'] ?></td>
                    <td style="white-space: nowrap;"><?= $row_schedule['qty_order_yd'] ?></td>
                    <td style="white-space: nowrap;"><?= $row_schedule['operation'] ?></td>
                    <td style="white-space: nowrap;"><?= $row_schedule['proses'] ?></td>
                    <td style="white-space: nowrap;"><?= $row_schedule['personil'] ?></td>
                    <td style="white-space: nowrap;"><?= $row_schedule['catatan'] ?></td>
                    <td style="white-space: nowrap;"><?= $row_schedule['creationdatetime'] ?></td>
                    <td style="white-space: nowrap;">
                        <?php
                            // CEK JIKA SUDAH PROSES MAKA MUNCULIN DI KETERANGAN
                            $cek_hasilproses   = mysqli_query($con, "SELECT * FROM tbl_produksi WHERE nokk = '$row_schedule[nokk]' AND demandno = '$row_schedule[nodemand]' AND no_mesin = '$row_schedule[no_mesin]' AND nama_mesin = '$row_schedule[operation]'");
                            $data_hasilproses  = mysqli_fetch_assoc($cek_hasilproses);
                        ?>
                        <?php if($data_hasilproses){ echo "Sudah Jalan"; } ?>,
                        <?= $data_hasilproses['tgl_buat']; ?>,
                        <?= $data_hasilproses['no_mesin']; ?>,
                        <?= $data_hasilproses['nama_mesin']; ?>-<?= $data_hasilproses['proses']; ?>
                    </td>
                </tr>
            <?php elseif ((!empty($data_proses['jml']) OR empty($data_proses['jml'])) AND $_GET['kksudahproses'] == '1') : ?>
                <tr>
                    <td style="white-space: nowrap;"><?= $no++; ?></td>
                    <td style="white-space: nowrap;"><?= $row_schedule['nourut'] ?></td>
                    <td style="white-space: nowrap;"><?= substr(TRIM($row_schedule['no_mesin']), -5, 2).substr(TRIM($row_schedule['no_mesin']), -2); ?></td>
                    <td style="white-space: nowrap;"><?= $row_schedule['nama_mesin'] ?></td>
                    <td style="white-space: nowrap;"><?= $row_schedule['group_shift'] ?></td>
                    <td style="white-space: nowrap;">`<?= $row_schedule['nokk'] ?></td>
                    <td style="white-space: nowrap;">`<?= $row_schedule['nodemand'] ?></td>
                    <td style="white-space: nowrap;"><?= $row_schedule['langganan'] ?></td>
                    <td style="white-space: nowrap;"><?= $row_schedule['buyer'] ?></td>
                    <td style="white-space: nowrap;"><?= $row_schedule['no_order'] ?></td>
                    <td style="white-space: nowrap;"><?= $row_schedule['tgl_delivery'] ?></td>
                    <td style="white-space: nowrap;"><?= $row_schedule['jenis_kain'] ?></td>
                    <td style="white-space: nowrap;"><?= $row_schedule['lebar'] ?></td>
                    <td style="white-space: nowrap;"><?= $row_schedule['gramasi'] ?></td>
                    <td style="white-space: nowrap;"><?= $row_schedule['warna'] ?></td>
                    <td style="white-space: nowrap;"><?= $row_schedule['no_warna'] ?></td>
                    <td style="white-space: nowrap;"><?= $row_schedule['lot'] ?></td>
                    <td style="white-space: nowrap;"><?= $row_schedule['roll'] ?></td>
                    <td style="white-space: nowrap;"><?= $row_schedule['qty_order'] ?></td>
                    <td style="white-space: nowrap;"><?= $row_schedule['qty_order_yd'] ?></td>
                    <td style="white-space: nowrap;"><?= $row_schedule['operation'] ?></td>
                    <td style="white-space: nowrap;"><?= $row_schedule['proses'] ?></td>
                    <td style="white-space: nowrap;"><?= $row_schedule['personil'] ?></td>
                    <td style="white-space: nowrap;"><?= $row_schedule['catatan'] ?></td>
                    <td style="white-space: nowrap;"><?= $row_schedule['creationdatetime'] ?></td>
                    <td style="white-space: nowrap;">
                        <?php
                            // CEK JIKA SUDAH PROSES MAKA MUNCULIN DI KETERANGAN
                            $cek_hasilproses   = mysqli_query($con, "SELECT * FROM tbl_produksi WHERE nokk = '$row_schedule[nokk]' AND demandno = '$row_schedule[nodemand]' AND no_mesin = '$row_schedule[no_mesin]' AND nama_mesin = '$row_schedule[operation]'");
                            $data_hasilproses  = mysqli_fetch_assoc($cek_hasilproses);
                        ?>
                        <?php if($data_hasilproses){ echo "Sudah Jalan"; } ?>,
                        <?= $data_hasilproses['tgl_buat']; ?>,
                        <?= $data_hasilproses['no_mesin']; ?>,
                        <?= $data_hasilproses['nama_mesin']; ?>-<?= $data_hasilproses['proses']; ?>
                    </td>
                </tr>
            <?php endif; ?>
        <?php endwhile; ?>
    </tbody>
</table