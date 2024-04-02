<?php
    header("Content-type: application/octet-stream");
    header("Content-Disposition: attachment; filename=laporan-SCHEDULE.xls"); //ganti nama sesuai keperluan
    header("Pragma: no-cache");
    header("Expires: 0");
?>
<table>
    <thead>
        <tr>
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
        </tr>
    </thead>
    <tbody>
        <?php
            include('../../koneksi.php');
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

            if ($_GET['awal']) {
                $where_tgl  = "AND SUBSTR(creationdatetime, 1, 10) BETWEEN '$_GET[awal]' AND '$_GET[akhir]'";
            } else {
                $where_tgl  = "";
            }
            $q_schedule     = mysqli_query($con, "SELECT * FROM `tbl_schedule_new` WHERE `status` = 'SCHEDULE' $where_tgl $where_nama_mesin $where_no_mesin");
        ?>
        <?php while ($row_schedule  = mysqli_fetch_array($q_schedule)) : ?>
            <tr>
                <td><?= $row_schedule['nourut'] ?></td>
                <td><?= $row_schedule['no_mesin'] ?></td>
                <td><?= $row_schedule['nama_mesin'] ?></td>
                <td><?= $row_schedule['group_shift'] ?></td>
                <td><?= $row_schedule['nodemand'] ?></td>
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
            </tr>
        <?php endwhile; ?>
    </tbody>
</table