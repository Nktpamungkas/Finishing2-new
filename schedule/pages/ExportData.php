<?php
    header("Content-type: application/octet-stream");
    header("Content-Disposition: attachment; filename=laporan-SCHEDULE.xls"); //ganti nama sesuai keperluan
    header("Pragma: no-cache");
    header("Expires: 0");
?>
<table border="1">
    <thead>
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
            $query_schedule = "SELECT * FROM `tbl_schedule_new` WHERE `status` = 'SCHEDULE' $where_nourut $where_tgl $where_nama_mesin $where_proses $where_no_mesin";
            $q_schedule     = mysqli_query($con, $query_schedule);
        ?>
        <?php while ($row_schedule  = mysqli_fetch_array($q_schedule)) : ?>
            <?php
                $cek_proses   = mysqli_query($con, "SELECT COUNT(*) AS jml FROM tbl_produksi WHERE nokk = '$row_schedule[nokk]' AND demandno = '$row_schedule[nodemand]' AND no_mesin = '$row_schedule[no_mesin]' AND nama_mesin = '$row_schedule[operation]'");
                $data_proses  = mysqli_fetch_assoc($cek_proses);
            ?>
            <?php if(empty($data_proses['jml']) AND $_GET['kksudahproses'] == '3') : ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $row_schedule['nourut'] ?></td>
                    <td><?= substr(TRIM($row_schedule['no_mesin']), -5, 2).substr(TRIM($row_schedule['no_mesin']), -2); ?></td>
                    <td><?= $row_schedule['nama_mesin'] ?></td>
                    <td><?= $row_schedule['group_shift'] ?></td>
                    <td>`<?= $row_schedule['nokk'] ?></td>
                    <td>`<?= $row_schedule['nodemand'] ?></td>
                    <td><?= $row_schedule['langganan'] ?></td>
                    <td><?= $row_schedule['buyer'] ?></td>
                    <td><?= $row_schedule['no_order'] ?></td>
                    <td><?= $row_schedule['tgl_delivery'] ?></td>
                    <td><?= $row_schedule['jenis_kain'] ?></td>
                    <td><?= $row_schedule['lebar'] ?></td>
                    <td><?= $row_schedule['gramasi'] ?></td>
                    <td><?= $row_schedule['warna'] ?></td>
                    <td><?= $row_schedule['no_warna'] ?></td>
                    <td><?= $row_schedule['lot'] ?></td>
                    <td><?= $row_schedule['roll'] ?></td>
                    <td><?= $row_schedule['qty_order'] ?></td>
                    <td><?= $row_schedule['qty_order_yd'] ?></td>
                    <td><?= $row_schedule['operation'] ?></td>
                    <td><?= $row_schedule['proses'] ?></td>
                    <td><?= $row_schedule['personil'] ?></td>
                    <td><?= $row_schedule['catatan'] ?></td>
                    <td><?= $row_schedule['creationdatetime'] ?></td>
                    <td>
                        <?php
                            // CEK JIKA SUDAH PROSES MAKA MUNCULIN DI KETERANGAN
                            $cek_hasilproses   = mysqli_query($con, "SELECT * FROM tbl_produksi WHERE nokk = '$row_schedule[nokk]' AND demandno = '$row_schedule[nodemand]' AND no_mesin = '$row_schedule[no_mesin]' AND nama_mesin = '$row_schedule[operation]'");
                            $data_hasilproses  = mysqli_fetch_assoc($cek_hasilproses);
                        ?>
                        <?php if($data_hasilproses){ echo "Sudah Jalan"; } ?><br>
                        <?= $data_hasilproses['tgl_buat']; ?><br>
                        <?= $data_hasilproses['no_mesin']; ?><br>
                        <?= $data_hasilproses['nama_mesin']; ?>-<?= $data_hasilproses['proses']; ?><br>
                    </td>
                </tr>
            <?php elseif (!empty($data_proses['jml']) AND $_GET['kksudahproses'] == '2') : ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $row_schedule['nourut'] ?></td>
                    <td><?= substr(TRIM($row_schedule['no_mesin']), -5, 2).substr(TRIM($row_schedule['no_mesin']), -2); ?></td>
                    <td><?= $row_schedule['nama_mesin'] ?></td>
                    <td><?= $row_schedule['group_shift'] ?></td>
                    <td>`<?= $row_schedule['nokk'] ?></td>
                    <td>`<?= $row_schedule['nodemand'] ?></td>
                    <td><?= $row_schedule['langganan'] ?></td>
                    <td><?= $row_schedule['buyer'] ?></td>
                    <td><?= $row_schedule['no_order'] ?></td>
                    <td><?= $row_schedule['tgl_delivery'] ?></td>
                    <td><?= $row_schedule['jenis_kain'] ?></td>
                    <td><?= $row_schedule['lebar'] ?></td>
                    <td><?= $row_schedule['gramasi'] ?></td>
                    <td><?= $row_schedule['warna'] ?></td>
                    <td><?= $row_schedule['no_warna'] ?></td>
                    <td><?= $row_schedule['lot'] ?></td>
                    <td><?= $row_schedule['roll'] ?></td>
                    <td><?= $row_schedule['qty_order'] ?></td>
                    <td><?= $row_schedule['qty_order_yd'] ?></td>
                    <td><?= $row_schedule['operation'] ?></td>
                    <td><?= $row_schedule['proses'] ?></td>
                    <td><?= $row_schedule['personil'] ?></td>
                    <td><?= $row_schedule['catatan'] ?></td>
                    <td><?= $row_schedule['creationdatetime'] ?></td>
                    <td>
                        <?php
                            // CEK JIKA SUDAH PROSES MAKA MUNCULIN DI KETERANGAN
                            $cek_hasilproses   = mysqli_query($con, "SELECT * FROM tbl_produksi WHERE nokk = '$row_schedule[nokk]' AND demandno = '$row_schedule[nodemand]' AND no_mesin = '$row_schedule[no_mesin]' AND nama_mesin = '$row_schedule[operation]'");
                            $data_hasilproses  = mysqli_fetch_assoc($cek_hasilproses);
                        ?>
                        <?php if($data_hasilproses){ echo "Sudah Jalan"; } ?><br>
                        <?= $data_hasilproses['tgl_buat']; ?><br>
                        <?= $data_hasilproses['no_mesin']; ?><br>
                        <?= $data_hasilproses['nama_mesin']; ?>-<?= $data_hasilproses['proses']; ?><br>
                    </td>
                </tr>
            <?php elseif ((!empty($data_proses['jml']) OR empty($data_proses['jml'])) AND $_GET['kksudahproses'] == '1') : ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $row_schedule['nourut'] ?></td>
                    <td><?= substr(TRIM($row_schedule['no_mesin']), -5, 2).substr(TRIM($row_schedule['no_mesin']), -2); ?></td>
                    <td><?= $row_schedule['nama_mesin'] ?></td>
                    <td><?= $row_schedule['group_shift'] ?></td>
                    <td>`<?= $row_schedule['nokk'] ?></td>
                    <td>`<?= $row_schedule['nodemand'] ?></td>
                    <td><?= $row_schedule['langganan'] ?></td>
                    <td><?= $row_schedule['buyer'] ?></td>
                    <td><?= $row_schedule['no_order'] ?></td>
                    <td><?= $row_schedule['tgl_delivery'] ?></td>
                    <td><?= $row_schedule['jenis_kain'] ?></td>
                    <td><?= $row_schedule['lebar'] ?></td>
                    <td><?= $row_schedule['gramasi'] ?></td>
                    <td><?= $row_schedule['warna'] ?></td>
                    <td><?= $row_schedule['no_warna'] ?></td>
                    <td><?= $row_schedule['lot'] ?></td>
                    <td><?= $row_schedule['roll'] ?></td>
                    <td><?= $row_schedule['qty_order'] ?></td>
                    <td><?= $row_schedule['qty_order_yd'] ?></td>
                    <td><?= $row_schedule['operation'] ?></td>
                    <td><?= $row_schedule['proses'] ?></td>
                    <td><?= $row_schedule['personil'] ?></td>
                    <td><?= $row_schedule['catatan'] ?></td>
                    <td><?= $row_schedule['creationdatetime'] ?></td>
                    <td>
                        <?php
                            // CEK JIKA SUDAH PROSES MAKA MUNCULIN DI KETERANGAN
                            $cek_hasilproses   = mysqli_query($con, "SELECT * FROM tbl_produksi WHERE nokk = '$row_schedule[nokk]' AND demandno = '$row_schedule[nodemand]' AND no_mesin = '$row_schedule[no_mesin]' AND nama_mesin = '$row_schedule[operation]'");
                            $data_hasilproses  = mysqli_fetch_assoc($cek_hasilproses);
                        ?>
                        <?php if($data_hasilproses){ echo "Sudah Jalan"; } ?><br>
                        <?= $data_hasilproses['tgl_buat']; ?><br>
                        <?= $data_hasilproses['no_mesin']; ?><br>
                        <?= $data_hasilproses['nama_mesin']; ?>-<?= $data_hasilproses['proses']; ?><br>
                    </td>
                </tr>
            <?php endif; ?>
        <?php endwhile; ?>
    </tbody>
</table