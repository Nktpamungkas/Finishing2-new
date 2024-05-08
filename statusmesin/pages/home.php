<!DOCTYPE html>
<html lang="en">
<?php
include('../koneksi.php');
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="23">
    <title>Navbar di Tengah dengan Kolom dan Kotak Box</title>
    <style>
        /* Ini hanya contoh styling untuk tampilan */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        nav {
            background-color: #ccc;
            color: black;
            text-align: center;
            padding: 5px 0;
            font-size: large;
        }

        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            /* Pusatkan item di dalam container */
            align-items: center;
            /* Pusatkan item secara vertikal */
            gap: 1px;
            /* Jarak antar item */
            border-radius: 8px;


        }

        /* Mengatur ukuran semua item menjadi sama */
        .container>div {
            flex: 1 1 3000px;
            /* flex-grow, flex-shrink, flex-basis */
            max-width: 100px;
            /* Lebar maksimum item */
            min-width: 90px;
            /* Lebar minimum item */
            height: 1px;
            /* Tinggi item */
            background-color: #f2f2f2;
            border: 2px solid #ccc;
            /* border-radius: 9px; */

            box-sizing: border-box;
            text-align: center;
            margin-bottom: 2px;
            /* Jarak bawah antar item */
        }

        .kolom1 {
            flex: 1 1 300px;
            background-color: #f2f2f2;
            padding: 20px;
            border: 1px solid #ddd;
            box-sizing: border-box;
            margin: 0;
            display: flex;
            justify-content: center;
            /* Memusatkan secara horizontal */
            align-items: center;
            /* Memusatkan secara vertikal */
            height: 0px;
            /* Tinggi elemen */
            text-align: center;
            /* Memusatkan teks secara horizontal */
        }

        .kolom {
            flex: 1 1 300px;
            /* Ubah ukuran relatif menjadi 5% dari lebar container */
            background-color: #f2f2f2;
            padding: 0px;
            border: 1px solid #ddd;
            box-sizing: border-box;
            margin: 2px;
            border-radius: 7px;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            /* position: relative; */
            /* text-align: center; */

            /* animation: blink 2s infinite; */

        }

        .kolom:hover::before {
            content: attr(title);
            position: absolute;
            top: -50px;
            /* Sesuaikan posisi popup */
            left: 50%;
            transform: translateX(-50%);
            background-color: rgba(0, 0, 0, 0.7);
            color: #fff;
            padding: 20px 30px;
            border-radius: 5px;
            font-size: 18px;
            white-space: nowrap;
            z-index: 999;
            opacity: 0;
            transition: opacity 0.3s ease;
            white-space: pre-line;
        }

        .kolom:hover::before {
            opacity: 1;
        }

        .card {
            position: relative;
            top: 1;
            right: 0;
            width: 100%;
            /* Menempati seluruh lebar container */
            background-color: white;
            border-radius: 5px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            padding: 10px;
            /* Atur padding sesuai kebutuhan */
            box-sizing: border-box;
            /* Padding dihitung dalam lebar total */

        }

        td {
            padding: 10px;
            border: 1px solid #ccc;
        }

        /* Gaya untuk kotak kecil */
        .small-box1 {
            display: inline-block;
            width: 20px;
            height: 20px;
            background-color: #FFFF00;
            margin-left: 10px;
            vertical-align: middle;
        }

        .small-box2 {
            display: inline-block;
            width: 20px;
            height: 20px;
            background-color: palegreen;
            margin-left: 10px;
            vertical-align: middle;
        }

        .small-box3 {
            display: inline-block;
            width: 20px;
            height: 20px;
            background-color: #FA8072;
            margin-left: 10px;
            vertical-align: middle;
        }

        .small-box4 {
            display: inline-block;
            width: 20px;
            height: 20px;
            background-color: #2471A3;
            margin-left: 10px;
            vertical-align: middle;
        }

        .notification {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 10px;
            background-color: #ffc107;
            /* Warna latar belakang kuning */
            color: #212529;
            /* Warna teks */
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <!-- NOT NO.URUT = 0 -->
    <nav>
        <h1>STATUS MESIN DEPART FINISHING SUDAH ATUR</h1>
    </nav>
    <hr>
    <div class="card">
        <div style="display: flex; width: 100%">
            <div style="flex: 1; margin-right: 5px;">
                <table border="0" width="5%">
                    <thead>
                        <tr>
                            <th>
                                <?php
                                $q_schedule_sum = mysqli_query($con, "SELECT
                                                                            SUM(qty_order) AS sum_qty
                                                                        FROM
                                                                            `tbl_schedule_new` a 
                                                                        WHERE
                                                                            NOT EXISTS (
                                                                            SELECT
                                                                                1 
                                                                            FROM
                                                                                `tbl_produksi` b 
                                                                            WHERE
                                                                                b.nokk = a.nokk 
                                                                                AND b.demandno = a.nodemand 
                                                                                AND b.nama_mesin = a.operation 
                                                                                AND b.no_mesin = a.no_mesin 
                                                                            ) 
                                                                            AND a.`status` = 'SCHEDULE' 
                                                                            AND a.no_mesin = 'P3ST301' 
                                                                            AND NOT a.nourut = 0 
                                                                        ORDER BY
                                                                            CONCAT(
                                                                                SUBSTR(TRIM(a.no_mesin), - 5, 2),
                                                                            SUBSTR(TRIM(a.no_mesin), - 2 )) ASC,
                                                                            nourut ASC
                                                                        LIMIT 10");
                                $row_sum_qty    = mysqli_fetch_assoc($q_schedule_sum);
                                ?>
                                <span style="font-size: 10px; color: red"><?= (number_format($row_sum_qty['sum_qty'])) ?> Kg</span></h2>
                                <div class="kolom1">ST 01</div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $q_schedule = mysqli_query($con, "SELECT
                                                                    * 
                                                                FROM
                                                                    `tbl_schedule_new` a 
                                                                WHERE
                                                                    NOT EXISTS (
                                                                    SELECT
                                                                        1 
                                                                    FROM
                                                                        `tbl_produksi` b 
                                                                    WHERE
                                                                        b.nokk = a.nokk 
                                                                        AND b.demandno = a.nodemand 
                                                                        AND b.nama_mesin = a.operation 
                                                                        AND b.no_mesin = a.no_mesin 
                                                                    ) 
                                                                    AND a.`status` = 'SCHEDULE' 
                                                                    AND a.no_mesin = 'P3ST301' 
                                                                    AND NOT a.nourut = 0 
                                                                ORDER BY
                                                                    CONCAT(
                                                                        SUBSTR(TRIM(a.no_mesin), - 5, 2),
                                                                    SUBSTR(TRIM(a.no_mesin), - 2 )) ASC,
                                                                    nourut ASC
                                                                LIMIT 10");
                        ?>
                        <?php while ($row_schedule  = mysqli_fetch_array($q_schedule)) : ?>
                            <?php
                            $q_proses   = mysqli_query($con, "SELECT * FROM tbl_proses WHERE CONCAT(proses, ' (', jns, ')') = '$row_schedule[proses]'");
                            $row_proses = mysqli_fetch_assoc($q_proses);
                            if ($row_proses['ket_proses'] == 'kk/kain belum final proses') {
                                $warna  = "background-color: #FFFF00;";
                            } elseif ($row_proses['ket_proses'] == 'kk/kain finishing final proses') {
                                $warna  = "background-color: palegreen;";
                            } elseif ($row_proses['ket_proses'] == 'pedder') {
                                $warna  = "background-color: #FA8072; color: white;";
                            } elseif ($row_proses['ket_proses'] == 'preset') {
                                $warna  = "background-color: #2471A3; color: white;";
                            } else {
                                $warna = "";
                            }
                            ?>
                            <tr>
                                <td>
                                    <?php
                                    $status_mesin = mysqli_query($con, "SELECT proses, langganan, no_order, qty_order FROM tbl_schedule_new WHERE nodemand = '$row_schedule[nodemand]'");
                                    $row_statusmesin = mysqli_fetch_assoc($status_mesin);
                                    ?>
                                    <div class="kolom" title="<?= (htmlspecialchars($row_statusmesin['proses'] . "\n" . $row_statusmesin['langganan'] . "\n" . $row_statusmesin['no_order'] . "\n" . $row_statusmesin['qty_order'])); ?>" style="<?= $warna; ?>"><?= $row_schedule['nodemand']; ?></div>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
            <div style="flex: 1; margin-right: 5px;">
                <table border="0" width="10%">
                    <thead>
                        <tr>
                            <th>
                                <?php
                                $q_schedule_sum = mysqli_query($con, "SELECT
                                                                            SUM(qty_order) AS sum_qty
                                                                        FROM
                                                                            `tbl_schedule_new` a 
                                                                        WHERE
                                                                            NOT EXISTS (
                                                                            SELECT
                                                                                1 
                                                                            FROM
                                                                                `tbl_produksi` b 
                                                                            WHERE
                                                                                b.nokk = a.nokk 
                                                                                AND b.demandno = a.nodemand 
                                                                                AND b.nama_mesin = a.operation 
                                                                                AND b.no_mesin = a.no_mesin 
                                                                            ) 
                                                                            AND a.`status` = 'SCHEDULE' 
                                                                            AND a.no_mesin = 'P3ST302' 
                                                                            AND NOT a.nourut = 0 
                                                                        ORDER BY
                                                                            CONCAT(
                                                                                SUBSTR(TRIM(a.no_mesin), - 5, 2),
                                                                            SUBSTR(TRIM(a.no_mesin), - 2 )) ASC,
                                                                            nourut ASC
                                                                        LIMIT 10");
                                $row_sum_qty    = mysqli_fetch_assoc($q_schedule_sum);
                                ?>
                                <span style="font-size: 10px; color: red"><?= (number_format($row_sum_qty['sum_qty'])) ?> Kg</span></h2>
                                <div class="kolom1">ST 02</div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $q_schedule = mysqli_query($con, "SELECT
                                                                    * 
                                                                FROM
                                                                    `tbl_schedule_new` a 
                                                                WHERE
                                                                    NOT EXISTS (
                                                                    SELECT
                                                                        1 
                                                                    FROM
                                                                        `tbl_produksi` b 
                                                                    WHERE
                                                                        b.nokk = a.nokk 
                                                                        AND b.demandno = a.nodemand 
                                                                        AND b.nama_mesin = a.operation 
                                                                        AND b.no_mesin = a.no_mesin 
                                                                    ) 
                                                                    AND a.`status` = 'SCHEDULE' 
                                                                    AND a.no_mesin = 'P3ST302' 
                                                                    AND NOT a.nourut = 0 
                                                                ORDER BY
                                                                    CONCAT(
                                                                        SUBSTR(TRIM(a.no_mesin), - 5, 2),
                                                                    SUBSTR(TRIM(a.no_mesin), - 2 )) ASC,
                                                                    nourut ASC
                                                                LIMIT 10");
                        ?>
                        <?php while ($row_schedule  = mysqli_fetch_array($q_schedule)) : ?>
                            <?php
                            $q_proses   = mysqli_query($con, "SELECT * FROM tbl_proses WHERE CONCAT(proses, ' (', jns, ')') = '$row_schedule[proses]'");
                            $row_proses = mysqli_fetch_assoc($q_proses);
                            if ($row_proses['ket_proses'] == 'kk/kain belum final proses') {
                                $warna  = "background-color: #FFFF00;";
                            } elseif ($row_proses['ket_proses'] == 'kk/kain finishing final proses') {
                                $warna  = "background-color: palegreen;";
                            } elseif ($row_proses['ket_proses'] == 'pedder') {
                                $warna  = "background-color: #FA8072; color: white;";
                            } elseif ($row_proses['ket_proses'] == 'preset') {
                                $warna  = "background-color: #2471A3; color: white;";
                            } else {
                                $warna = "";
                            }
                            ?>
                            <tr>
                                <td>
                                    <?php
                                    $status_mesin = mysqli_query($con, "SELECT proses, langganan, no_order, qty_order FROM tbl_schedule_new WHERE nodemand = '$row_schedule[nodemand]'");
                                    $row_statusmesin = mysqli_fetch_assoc($status_mesin);
                                    ?>
                                    <div class="kolom" title="<?= (htmlspecialchars($row_statusmesin['proses'] . "\n" . $row_statusmesin['langganan'] . "\n" . $row_statusmesin['no_order'] . "\n" . $row_statusmesin['qty_order'])); ?>" style="<?= $warna; ?>"><?= $row_schedule['nodemand']; ?></div>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
            <div style="flex: 1; margin-right: 5px;">
                <table border="0" width="5%">
                    <thead>
                        <tr>
                            <th>
                                <?php
                                $q_schedule_sum = mysqli_query($con, "SELECT
                                                                            SUM(qty_order) AS sum_qty
                                                                        FROM
                                                                            `tbl_schedule_new` a 
                                                                        WHERE
                                                                            NOT EXISTS (
                                                                            SELECT
                                                                                1 
                                                                            FROM
                                                                                `tbl_produksi` b 
                                                                            WHERE
                                                                                b.nokk = a.nokk 
                                                                                AND b.demandno = a.nodemand 
                                                                                AND b.nama_mesin = a.operation 
                                                                                AND b.no_mesin = a.no_mesin 
                                                                            ) 
                                                                            AND a.`status` = 'SCHEDULE' 
                                                                            AND a.no_mesin = 'P3ST103' 
                                                                            AND NOT a.nourut = 0 
                                                                        ORDER BY
                                                                            CONCAT(
                                                                                SUBSTR(TRIM(a.no_mesin), - 5, 2),
                                                                            SUBSTR(TRIM(a.no_mesin), - 2 )) ASC,
                                                                            nourut ASC
                                                                        LIMIT 10");
                                $row_sum_qty    = mysqli_fetch_assoc($q_schedule_sum);
                                ?>
                                <span style="font-size: 10px; color: red"><?= (number_format($row_sum_qty['sum_qty'])) ?> Kg</span></h2>
                                <div class="kolom1">ST 03</div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $q_schedule = mysqli_query($con, "SELECT
                                                                    * 
                                                                FROM
                                                                    `tbl_schedule_new` a 
                                                                WHERE
                                                                    NOT EXISTS (
                                                                    SELECT
                                                                        1 
                                                                    FROM
                                                                        `tbl_produksi` b 
                                                                    WHERE
                                                                        b.nokk = a.nokk 
                                                                        AND b.demandno = a.nodemand 
                                                                        AND b.nama_mesin = a.operation 
                                                                        AND b.no_mesin = a.no_mesin 
                                                                    ) 
                                                                    AND a.`status` = 'SCHEDULE' 
                                                                    AND a.no_mesin = 'P3ST103' 
                                                                    AND NOT a.nourut = 0 
                                                                ORDER BY
                                                                    CONCAT(
                                                                        SUBSTR(TRIM(a.no_mesin), - 5, 2),
                                                                    SUBSTR(TRIM(a.no_mesin), - 2 )) ASC,
                                                                    nourut ASC
                                                                LIMIT 10");
                        ?>
                        <?php while ($row_schedule  = mysqli_fetch_array($q_schedule)) : ?>
                            <?php
                            $q_proses   = mysqli_query($con, "SELECT * FROM tbl_proses WHERE CONCAT(proses, ' (', jns, ')') = '$row_schedule[proses]'");
                            $row_proses = mysqli_fetch_assoc($q_proses);
                            if ($row_proses['ket_proses'] == 'kk/kain belum final proses') {
                                $warna  = "background-color: #FFFF00;";
                            } elseif ($row_proses['ket_proses'] == 'kk/kain finishing final proses') {
                                $warna  = "background-color: palegreen;";
                            } elseif ($row_proses['ket_proses'] == 'pedder') {
                                $warna  = "background-color: #FA8072; color: white;";
                            } elseif ($row_proses['ket_proses'] == 'preset') {
                                $warna  = "background-color: #2471A3; color: white;";
                            } else {
                                $warna = "";
                            }
                            ?>
                            <tr>
                                <td>
                                    <?php
                                    $status_mesin = mysqli_query($con, "SELECT proses, langganan, no_order, qty_order FROM tbl_schedule_new WHERE nodemand = '$row_schedule[nodemand]'");
                                    $row_statusmesin = mysqli_fetch_assoc($status_mesin);
                                    ?>
                                    <div class="kolom" title="<?= (htmlspecialchars($row_statusmesin['proses'] . "\n" . $row_statusmesin['langganan'] . "\n" . $row_statusmesin['no_order'] . "\n" . $row_statusmesin['qty_order'])); ?>" style="<?= $warna; ?>"><?= $row_schedule['nodemand']; ?></div>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
            <div style="flex: 1; margin-right: 5px;">
                <table border="0" width="5%">
                    <thead>
                        <tr>
                            <th>
                                <?php
                                $q_schedule_sum = mysqli_query($con, "SELECT
                                                                            SUM(qty_order) AS sum_qty
                                                                        FROM
                                                                            `tbl_schedule_new` a 
                                                                        WHERE
                                                                            NOT EXISTS (
                                                                            SELECT
                                                                                1 
                                                                            FROM
                                                                                `tbl_produksi` b 
                                                                            WHERE
                                                                                b.nokk = a.nokk 
                                                                                AND b.demandno = a.nodemand 
                                                                                AND b.nama_mesin = a.operation 
                                                                                AND b.no_mesin = a.no_mesin 
                                                                            ) 
                                                                            AND a.`status` = 'SCHEDULE' 
                                                                            AND a.no_mesin = 'P3ST304' 
                                                                            AND NOT a.nourut = 0 
                                                                        ORDER BY
                                                                            CONCAT(
                                                                                SUBSTR(TRIM(a.no_mesin), - 5, 2),
                                                                            SUBSTR(TRIM(a.no_mesin), - 2 )) ASC,
                                                                            nourut ASC
                                                                        LIMIT 10");
                                $row_sum_qty    = mysqli_fetch_assoc($q_schedule_sum);
                                ?>
                                <span style="font-size: 10px; color: red"><?= (number_format($row_sum_qty['sum_qty'])) ?> Kg</span></h2>
                                <div class="kolom1">ST 04</div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $q_schedule = mysqli_query($con, "SELECT
                                                                    * 
                                                                FROM
                                                                    `tbl_schedule_new` a 
                                                                WHERE
                                                                    NOT EXISTS (
                                                                    SELECT
                                                                        1 
                                                                    FROM
                                                                        `tbl_produksi` b 
                                                                    WHERE
                                                                        b.nokk = a.nokk 
                                                                        AND b.demandno = a.nodemand 
                                                                        AND b.nama_mesin = a.operation 
                                                                        AND b.no_mesin = a.no_mesin 
                                                                    ) 
                                                                    AND a.`status` = 'SCHEDULE' 
                                                                    AND a.no_mesin = 'P3ST304' 
                                                                    AND NOT a.nourut = 0 
                                                                ORDER BY
                                                                    CONCAT(
                                                                        SUBSTR(TRIM(a.no_mesin), - 5, 2),
                                                                    SUBSTR(TRIM(a.no_mesin), - 2 )) ASC,
                                                                    nourut ASC
                                                                LIMIT 10");
                        ?>
                        <?php while ($row_schedule  = mysqli_fetch_array($q_schedule)) : ?>
                            <?php
                            $q_proses   = mysqli_query($con, "SELECT * FROM tbl_proses WHERE CONCAT(proses, ' (', jns, ')') = '$row_schedule[proses]'");
                            $row_proses = mysqli_fetch_assoc($q_proses);
                            if ($row_proses['ket_proses'] == 'kk/kain belum final proses') {
                                $warna  = "background-color: #FFFF00;";
                            } elseif ($row_proses['ket_proses'] == 'kk/kain finishing final proses') {
                                $warna  = "background-color: palegreen;";
                            } elseif ($row_proses['ket_proses'] == 'pedder') {
                                $warna  = "background-color: #FA8072; color: white;";
                            } elseif ($row_proses['ket_proses'] == 'preset') {
                                $warna  = "background-color: #2471A3; color: white;";
                            } else {
                                $warna = "";
                            }
                            ?>
                            <tr>
                                <td>
                                    <?php
                                    $status_mesin = mysqli_query($con, "SELECT proses, langganan, no_order, qty_order FROM tbl_schedule_new WHERE nodemand = '$row_schedule[nodemand]'");
                                    $row_statusmesin = mysqli_fetch_assoc($status_mesin);
                                    ?>
                                    <div class="kolom" title="<?= (htmlspecialchars($row_statusmesin['proses'] . "\n" . $row_statusmesin['langganan'] . "\n" . $row_statusmesin['no_order'] . "\n" . $row_statusmesin['qty_order'])); ?>" style="<?= $warna; ?>"><?= $row_schedule['nodemand']; ?></div>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
            <div style="flex: 1; margin-right: 5px;">
                <table border="0" width="5%">
                    <thead>
                        <tr>
                            <th>
                                <?php
                                $q_schedule_sum = mysqli_query($con, "SELECT
                                                                            SUM(qty_order) AS sum_qty
                                                                        FROM
                                                                            `tbl_schedule_new` a 
                                                                        WHERE
                                                                            NOT EXISTS (
                                                                            SELECT
                                                                                1 
                                                                            FROM
                                                                                `tbl_produksi` b 
                                                                            WHERE
                                                                                b.nokk = a.nokk 
                                                                                AND b.demandno = a.nodemand 
                                                                                AND b.nama_mesin = a.operation 
                                                                                AND b.no_mesin = a.no_mesin 
                                                                            ) 
                                                                            AND a.`status` = 'SCHEDULE' 
                                                                            AND a.no_mesin = 'P3ST205' 
                                                                            AND NOT a.nourut = 0 
                                                                        ORDER BY
                                                                            CONCAT(
                                                                                SUBSTR(TRIM(a.no_mesin), - 5, 2),
                                                                            SUBSTR(TRIM(a.no_mesin), - 2 )) ASC,
                                                                            nourut ASC
                                                                        LIMIT 10");
                                $row_sum_qty    = mysqli_fetch_assoc($q_schedule_sum);
                                ?>
                                <span style="font-size: 10px; color: red"><?= (number_format($row_sum_qty['sum_qty'])) ?> Kg</span></h2>
                                <div class="kolom1">ST 05</div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $q_schedule = mysqli_query($con, "SELECT
                                                                    * 
                                                                FROM
                                                                    `tbl_schedule_new` a 
                                                                WHERE
                                                                    NOT EXISTS (
                                                                    SELECT
                                                                        1 
                                                                    FROM
                                                                        `tbl_produksi` b 
                                                                    WHERE
                                                                        b.nokk = a.nokk 
                                                                        AND b.demandno = a.nodemand 
                                                                        AND b.nama_mesin = a.operation 
                                                                        AND b.no_mesin = a.no_mesin 
                                                                    ) 
                                                                    AND a.`status` = 'SCHEDULE' 
                                                                    AND a.no_mesin = 'P3ST205' 
                                                                    AND NOT a.nourut = 0 
                                                                ORDER BY
                                                                    CONCAT(
                                                                        SUBSTR(TRIM(a.no_mesin), - 5, 2),
                                                                    SUBSTR(TRIM(a.no_mesin), - 2 )) ASC,
                                                                    nourut ASC
                                                                LIMIT 10");
                        ?>
                        <?php while ($row_schedule  = mysqli_fetch_array($q_schedule)) : ?>
                            <?php
                            $q_proses   = mysqli_query($con, "SELECT * FROM tbl_proses WHERE CONCAT(proses, ' (', jns, ')') = '$row_schedule[proses]'");
                            $row_proses = mysqli_fetch_assoc($q_proses);
                            if ($row_proses['ket_proses'] == 'kk/kain belum final proses') {
                                $warna  = "background-color: #FFFF00;";
                            } elseif ($row_proses['ket_proses'] == 'kk/kain finishing final proses') {
                                $warna  = "background-color: palegreen;";
                            } elseif ($row_proses['ket_proses'] == 'pedder') {
                                $warna  = "background-color: #FA8072; color: white;";
                            } elseif ($row_proses['ket_proses'] == 'preset') {
                                $warna  = "background-color: #2471A3; color: white;";
                            } else {
                                $warna = "";
                            }
                            ?>
                            <tr>
                                <td>
                                    <?php
                                    $status_mesin = mysqli_query($con, "SELECT proses, langganan, no_order, qty_order FROM tbl_schedule_new WHERE nodemand = '$row_schedule[nodemand]'");
                                    $row_statusmesin = mysqli_fetch_assoc($status_mesin);
                                    ?>
                                    <div class="kolom" title="<?= (htmlspecialchars($row_statusmesin['proses'] . "\n" . $row_statusmesin['langganan'] . "\n" . $row_statusmesin['no_order'] . "\n" . $row_statusmesin['qty_order'])); ?>" style="<?= $warna; ?>"><?= $row_schedule['nodemand']; ?></div>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
            <div style="flex: 1; margin-right: 5px;">
                <table border="0" width="5%">
                    <thead>
                        <tr>
                            <th>
                                <?php
                                $q_schedule_sum = mysqli_query($con, "SELECT
                                                                            SUM(qty_order) AS sum_qty
                                                                        FROM
                                                                            `tbl_schedule_new` a 
                                                                        WHERE
                                                                            NOT EXISTS (
                                                                            SELECT
                                                                                1 
                                                                            FROM
                                                                                `tbl_produksi` b 
                                                                            WHERE
                                                                                b.nokk = a.nokk 
                                                                                AND b.demandno = a.nodemand 
                                                                                AND b.nama_mesin = a.operation 
                                                                                AND b.no_mesin = a.no_mesin 
                                                                            ) 
                                                                            AND a.`status` = 'SCHEDULE' 
                                                                            AND a.no_mesin = 'P3ST206' 
                                                                            AND NOT a.nourut = 0 
                                                                        ORDER BY
                                                                            CONCAT(
                                                                                SUBSTR(TRIM(a.no_mesin), - 5, 2),
                                                                            SUBSTR(TRIM(a.no_mesin), - 2 )) ASC,
                                                                            nourut ASC
                                                                        LIMIT 10");
                                $row_sum_qty    = mysqli_fetch_assoc($q_schedule_sum);
                                ?>
                                <span style="font-size: 10px; color: red"><?= (number_format($row_sum_qty['sum_qty'])) ?> Kg</span></h2>
                                <div class="kolom1">ST 06</div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $q_schedule = mysqli_query($con, "SELECT
                                                                    * 
                                                                FROM
                                                                    `tbl_schedule_new` a 
                                                                WHERE
                                                                    NOT EXISTS (
                                                                    SELECT
                                                                        1 
                                                                    FROM
                                                                        `tbl_produksi` b 
                                                                    WHERE
                                                                        b.nokk = a.nokk 
                                                                        AND b.demandno = a.nodemand 
                                                                        AND b.nama_mesin = a.operation 
                                                                        AND b.no_mesin = a.no_mesin 
                                                                    ) 
                                                                    AND a.`status` = 'SCHEDULE' 
                                                                    AND a.no_mesin = 'P3ST206' 
                                                                    AND NOT a.nourut = 0 
                                                                ORDER BY
                                                                    CONCAT(
                                                                        SUBSTR(TRIM(a.no_mesin), - 5, 2),
                                                                    SUBSTR(TRIM(a.no_mesin), - 2 )) ASC,
                                                                    nourut ASC
                                                                LIMIT 10");
                        ?>
                        <?php while ($row_schedule  = mysqli_fetch_array($q_schedule)) : ?>
                            <?php
                            $q_proses   = mysqli_query($con, "SELECT * FROM tbl_proses WHERE CONCAT(proses, ' (', jns, ')') = '$row_schedule[proses]'");
                            $row_proses = mysqli_fetch_assoc($q_proses);
                            if ($row_proses['ket_proses'] == 'kk/kain belum final proses') {
                                $warna  = "background-color: #FFFF00;";
                            } elseif ($row_proses['ket_proses'] == 'kk/kain finishing final proses') {
                                $warna  = "background-color: palegreen;";
                            } elseif ($row_proses['ket_proses'] == 'pedder') {
                                $warna  = "background-color: #FA8072; color: white;";
                            } elseif ($row_proses['ket_proses'] == 'preset') {
                                $warna  = "background-color: #2471A3; color: white;";
                            } else {
                                $warna = "";
                            }
                            ?>
                            <tr>
                                <td>
                                    <?php
                                    $status_mesin = mysqli_query($con, "SELECT proses, langganan, no_order, qty_order FROM tbl_schedule_new WHERE nodemand = '$row_schedule[nodemand]'");
                                    $row_statusmesin = mysqli_fetch_assoc($status_mesin);
                                    ?>
                                    <div class="kolom" title="<?= (htmlspecialchars($row_statusmesin['proses'] . "\n" . $row_statusmesin['langganan'] . "\n" . $row_statusmesin['no_order'] . "\n" . $row_statusmesin['qty_order'])); ?>" style="<?= $warna; ?>"><?= $row_schedule['nodemand']; ?></div>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
            <div style="flex: 1; margin-right: 5px;">
                <table border="0" width="5%">
                    <thead>
                        <tr>
                            <th>
                                <?php
                                $q_schedule_sum = mysqli_query($con, "SELECT
                                                                            SUM(qty_order) AS sum_qty
                                                                        FROM
                                                                            `tbl_schedule_new` a 
                                                                        WHERE
                                                                            NOT EXISTS (
                                                                            SELECT
                                                                                1 
                                                                            FROM
                                                                                `tbl_produksi` b 
                                                                            WHERE
                                                                                b.nokk = a.nokk 
                                                                                AND b.demandno = a.nodemand 
                                                                                AND b.nama_mesin = a.operation 
                                                                                AND b.no_mesin = a.no_mesin 
                                                                            ) 
                                                                            AND a.`status` = 'SCHEDULE' 
                                                                            AND a.no_mesin = 'P3ST307' 
                                                                            AND NOT a.nourut = 0 
                                                                        ORDER BY
                                                                            CONCAT(
                                                                                SUBSTR(TRIM(a.no_mesin), - 5, 2),
                                                                            SUBSTR(TRIM(a.no_mesin), - 2 )) ASC,
                                                                            nourut ASC
                                                                        LIMIT 10");
                                $row_sum_qty    = mysqli_fetch_assoc($q_schedule_sum);
                                ?>
                                <span style="font-size: 10px; color: red"><?= (number_format($row_sum_qty['sum_qty'])) ?> Kg</span></h2>
                                <div class="kolom1">ST 07</div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $q_schedule = mysqli_query($con, "SELECT
                                                                    * 
                                                                FROM
                                                                    `tbl_schedule_new` a 
                                                                WHERE
                                                                    NOT EXISTS (
                                                                    SELECT
                                                                        1 
                                                                    FROM
                                                                        `tbl_produksi` b 
                                                                    WHERE
                                                                        b.nokk = a.nokk 
                                                                        AND b.demandno = a.nodemand 
                                                                        AND b.nama_mesin = a.operation 
                                                                        AND b.no_mesin = a.no_mesin 
                                                                    ) 
                                                                    AND a.`status` = 'SCHEDULE' 
                                                                    AND a.no_mesin = 'P3ST307' 
                                                                    AND NOT a.nourut = 0 
                                                                ORDER BY
                                                                    CONCAT(
                                                                        SUBSTR(TRIM(a.no_mesin), - 5, 2),
                                                                    SUBSTR(TRIM(a.no_mesin), - 2 )) ASC,
                                                                    nourut ASC
                                                                LIMIT 10");
                        ?>
                        <?php while ($row_schedule  = mysqli_fetch_array($q_schedule)) : ?>
                            <?php
                            $q_proses   = mysqli_query($con, "SELECT * FROM tbl_proses WHERE CONCAT(proses, ' (', jns, ')') = '$row_schedule[proses]'");
                            $row_proses = mysqli_fetch_assoc($q_proses);
                            if ($row_proses['ket_proses'] == 'kk/kain belum final proses') {
                                $warna  = "background-color: #FFFF00;";
                            } elseif ($row_proses['ket_proses'] == 'kk/kain finishing final proses') {
                                $warna  = "background-color: palegreen;";
                            } elseif ($row_proses['ket_proses'] == 'pedder') {
                                $warna  = "background-color: #FA8072; color: white;";
                            } elseif ($row_proses['ket_proses'] == 'preset') {
                                $warna  = "background-color: #2471A3; color: white;";
                            } else {
                                $warna = "";
                            }
                            ?>
                            <tr>
                                <td>
                                    <?php
                                    $status_mesin = mysqli_query($con, "SELECT proses, langganan, no_order, qty_order FROM tbl_schedule_new WHERE nodemand = '$row_schedule[nodemand]'");
                                    $row_statusmesin = mysqli_fetch_assoc($status_mesin);
                                    ?>
                                    <div class="kolom" title="<?= (htmlspecialchars($row_statusmesin['proses'] . "\n" . $row_statusmesin['langganan'] . "\n" . $row_statusmesin['no_order'] . "\n" . $row_statusmesin['qty_order'])); ?>" style="<?= $warna; ?>"><?= $row_schedule['nodemand']; ?></div>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
            <div style="flex: 1; margin-right: 5px;">
                <table border="0" width="5%">
                    <thead>
                        <tr>
                            <th>
                                <?php
                                $q_schedule_sum = mysqli_query($con, "SELECT
                                                                            SUM(qty_order) AS sum_qty
                                                                        FROM
                                                                            `tbl_schedule_new` a 
                                                                        WHERE
                                                                            NOT EXISTS (
                                                                            SELECT
                                                                                1 
                                                                            FROM
                                                                                `tbl_produksi` b 
                                                                            WHERE
                                                                                b.nokk = a.nokk 
                                                                                AND b.demandno = a.nodemand 
                                                                                AND b.nama_mesin = a.operation 
                                                                                AND b.no_mesin = a.no_mesin 
                                                                            ) 
                                                                            AND a.`status` = 'SCHEDULE' 
                                                                            AND a.no_mesin = 'P3ST208' 
                                                                            AND NOT a.nourut = 0 
                                                                        ORDER BY
                                                                            CONCAT(
                                                                                SUBSTR(TRIM(a.no_mesin), - 5, 2),
                                                                            SUBSTR(TRIM(a.no_mesin), - 2 )) ASC,
                                                                            nourut ASC
                                                                        LIMIT 10");
                                $row_sum_qty    = mysqli_fetch_assoc($q_schedule_sum);
                                ?>
                                <span style="font-size: 10px; color: red"><?= (number_format($row_sum_qty['sum_qty'])) ?> Kg</span></h2>
                                <div class="kolom1">ST 08</div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $q_schedule = mysqli_query($con, "SELECT
                                                                    * 
                                                                FROM
                                                                    `tbl_schedule_new` a 
                                                                WHERE
                                                                    NOT EXISTS (
                                                                    SELECT
                                                                        1 
                                                                    FROM
                                                                        `tbl_produksi` b 
                                                                    WHERE
                                                                        b.nokk = a.nokk 
                                                                        AND b.demandno = a.nodemand 
                                                                        AND b.nama_mesin = a.operation 
                                                                        AND b.no_mesin = a.no_mesin 
                                                                    ) 
                                                                    AND a.`status` = 'SCHEDULE' 
                                                                    AND a.no_mesin = 'P3ST208' 
                                                                    AND NOT a.nourut = 0 
                                                                ORDER BY
                                                                    CONCAT(
                                                                        SUBSTR(TRIM(a.no_mesin), - 5, 2),
                                                                    SUBSTR(TRIM(a.no_mesin), - 2 )) ASC,
                                                                    nourut ASC
                                                                LIMIT 10");
                        ?>
                        <?php while ($row_schedule  = mysqli_fetch_array($q_schedule)) : ?>
                            <?php
                            $q_proses   = mysqli_query($con, "SELECT * FROM tbl_proses WHERE CONCAT(proses, ' (', jns, ')') = '$row_schedule[proses]'");
                            $row_proses = mysqli_fetch_assoc($q_proses);
                            if ($row_proses['ket_proses'] == 'kk/kain belum final proses') {
                                $warna  = "background-color: #FFFF00;";
                            } elseif ($row_proses['ket_proses'] == 'kk/kain finishing final proses') {
                                $warna  = "background-color: palegreen;";
                            } elseif ($row_proses['ket_proses'] == 'pedder') {
                                $warna  = "background-color: #FA8072; color: white;";
                            } elseif ($row_proses['ket_proses'] == 'preset') {
                                $warna  = "background-color: #2471A3; color: white;";
                            } else {
                                $warna = "";
                            }
                            ?>
                            <tr>
                                <td>
                                    <?php
                                    $status_mesin = mysqli_query($con, "SELECT proses, langganan, no_order, qty_order FROM tbl_schedule_new WHERE nodemand = '$row_schedule[nodemand]'");
                                    $row_statusmesin = mysqli_fetch_assoc($status_mesin);
                                    ?>
                                    <div class="kolom" title="<?= (htmlspecialchars($row_statusmesin['proses'] . "\n" . $row_statusmesin['langganan'] . "\n" . $row_statusmesin['no_order'] . "\n" . $row_statusmesin['qty_order'])); ?>" style="<?= $warna; ?>"><?= $row_schedule['nodemand']; ?></div>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
            <div style="flex: 1; margin-right: 5px;">
                <table border="0" width="5%">
                    <thead>
                        <tr>
                            <th>
                                <?php
                                $q_schedule_sum = mysqli_query($con, "SELECT
                                                                            SUM(qty_order) AS sum_qty
                                                                        FROM
                                                                            `tbl_schedule_new` a 
                                                                        WHERE
                                                                            NOT EXISTS (
                                                                            SELECT
                                                                                1 
                                                                            FROM
                                                                                `tbl_produksi` b 
                                                                            WHERE
                                                                                b.nokk = a.nokk 
                                                                                AND b.demandno = a.nodemand 
                                                                                AND b.nama_mesin = a.operation 
                                                                                AND b.no_mesin = a.no_mesin 
                                                                            ) 
                                                                            AND a.`status` = 'SCHEDULE' 
                                                                            AND a.no_mesin = 'P3CP101' 
                                                                            AND NOT a.nourut = 0 
                                                                        ORDER BY
                                                                            CONCAT(
                                                                                SUBSTR(TRIM(a.no_mesin), - 5, 2),
                                                                            SUBSTR(TRIM(a.no_mesin), - 2 )) ASC,
                                                                            nourut ASC
                                                                        LIMIT 10");
                                $row_sum_qty    = mysqli_fetch_assoc($q_schedule_sum);
                                ?>
                                <span style="font-size: 10px; color: red"><?= (number_format($row_sum_qty['sum_qty'])) ?> Kg</span></h2>
                                <div class="kolom1">CP 01</div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $q_schedule = mysqli_query($con, "SELECT
                                                                    * 
                                                                FROM
                                                                    `tbl_schedule_new` a 
                                                                WHERE
                                                                    NOT EXISTS (
                                                                    SELECT
                                                                        1 
                                                                    FROM
                                                                        `tbl_produksi` b 
                                                                    WHERE
                                                                        b.nokk = a.nokk 
                                                                        AND b.demandno = a.nodemand 
                                                                        AND b.nama_mesin = a.operation 
                                                                        AND b.no_mesin = a.no_mesin 
                                                                    ) 
                                                                    AND a.`status` = 'SCHEDULE' 
                                                                    AND a.no_mesin = 'P3CP101' 
                                                                    AND NOT a.nourut = 0 
                                                                ORDER BY
                                                                    CONCAT(
                                                                        SUBSTR(TRIM(a.no_mesin), - 5, 2),
                                                                    SUBSTR(TRIM(a.no_mesin), - 2 )) ASC,
                                                                    nourut ASC
                                                                LIMIT 10");
                        ?>
                        <?php while ($row_schedule  = mysqli_fetch_array($q_schedule)) : ?>
                            <?php
                            $q_proses   = mysqli_query($con, "SELECT * FROM tbl_proses WHERE CONCAT(proses, ' (', jns, ')') = '$row_schedule[proses]'");
                            $row_proses = mysqli_fetch_assoc($q_proses);
                            if ($row_proses['ket_proses'] == 'kk/kain belum final proses') {
                                $warna  = "background-color: #FFFF00;";
                            } elseif ($row_proses['ket_proses'] == 'kk/kain finishing final proses') {
                                $warna  = "background-color: palegreen;";
                            } elseif ($row_proses['ket_proses'] == 'pedder') {
                                $warna  = "background-color: #FA8072; color: white;";
                            } elseif ($row_proses['ket_proses'] == 'preset') {
                                $warna  = "background-color: #2471A3; color: white;";
                            } else {
                                $warna = "";
                            }
                            ?>
                            <tr>
                                <td>
                                    <?php
                                    $status_mesin = mysqli_query($con, "SELECT proses, langganan, no_order, qty_order FROM tbl_schedule_new WHERE nodemand = '$row_schedule[nodemand]'");
                                    $row_statusmesin = mysqli_fetch_assoc($status_mesin);
                                    ?>
                                    <div class="kolom" title="<?= (htmlspecialchars($row_statusmesin['proses'] . "\n" . $row_statusmesin['langganan'] . "\n" . $row_statusmesin['no_order'] . "\n" . $row_statusmesin['qty_order'])); ?>" style="<?= $warna; ?>"><?= $row_schedule['nodemand']; ?></div>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
            <div style="flex: 1; margin-right: 5px;">
                <table border="0" width="5%">
                    <thead>
                        <tr>
                            <th>
                                <?php
                                $q_schedule_sum = mysqli_query($con, "SELECT
                                                                            SUM(qty_order) AS sum_qty
                                                                        FROM
                                                                            `tbl_schedule_new` a 
                                                                        WHERE
                                                                            NOT EXISTS (
                                                                            SELECT
                                                                                1 
                                                                            FROM
                                                                                `tbl_produksi` b 
                                                                            WHERE
                                                                                b.nokk = a.nokk 
                                                                                AND b.demandno = a.nodemand 
                                                                                AND b.nama_mesin = a.operation 
                                                                                AND b.no_mesin = a.no_mesin 
                                                                            ) 
                                                                            AND a.`status` = 'SCHEDULE' 
                                                                            AND a.no_mesin = 'P3CP102' 
                                                                            AND NOT a.nourut = 0 
                                                                        ORDER BY
                                                                            CONCAT(
                                                                                SUBSTR(TRIM(a.no_mesin), - 5, 2),
                                                                            SUBSTR(TRIM(a.no_mesin), - 2 )) ASC,
                                                                            nourut ASC
                                                                        LIMIT 10");
                                $row_sum_qty    = mysqli_fetch_assoc($q_schedule_sum);
                                ?>
                                <span style="font-size: 10px; color: red"><?= (number_format($row_sum_qty['sum_qty'])) ?> Kg</span></h2>
                                <div class="kolom1">CP 02</div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $q_schedule = mysqli_query($con, "SELECT
                                                                    * 
                                                                FROM
                                                                    `tbl_schedule_new` a 
                                                                WHERE
                                                                    NOT EXISTS (
                                                                    SELECT
                                                                        1 
                                                                    FROM
                                                                        `tbl_produksi` b 
                                                                    WHERE
                                                                        b.nokk = a.nokk 
                                                                        AND b.demandno = a.nodemand 
                                                                        AND b.nama_mesin = a.operation 
                                                                        AND b.no_mesin = a.no_mesin 
                                                                    ) 
                                                                    AND a.`status` = 'SCHEDULE' 
                                                                    AND a.no_mesin = 'P3CP102' 
                                                                    AND NOT a.nourut = 0 
                                                                ORDER BY
                                                                    CONCAT(
                                                                        SUBSTR(TRIM(a.no_mesin), - 5, 2),
                                                                    SUBSTR(TRIM(a.no_mesin), - 2 )) ASC,
                                                                    nourut ASC
                                                                LIMIT 10");
                        ?>
                        <?php while ($row_schedule  = mysqli_fetch_array($q_schedule)) : ?>
                            <?php
                            $q_proses   = mysqli_query($con, "SELECT * FROM tbl_proses WHERE CONCAT(proses, ' (', jns, ')') = '$row_schedule[proses]'");
                            $row_proses = mysqli_fetch_assoc($q_proses);
                            if ($row_proses['ket_proses'] == 'kk/kain belum final proses') {
                                $warna  = "background-color: #FFFF00;";
                            } elseif ($row_proses['ket_proses'] == 'kk/kain finishing final proses') {
                                $warna  = "background-color: palegreen;";
                            } elseif ($row_proses['ket_proses'] == 'pedder') {
                                $warna  = "background-color: #FA8072; color: white;";
                            } elseif ($row_proses['ket_proses'] == 'preset') {
                                $warna  = "background-color: #2471A3; color: white;";
                            } else {
                                $warna = "";
                            }
                            ?>
                            <tr>
                                <td>
                                    <?php
                                    $status_mesin = mysqli_query($con, "SELECT proses, langganan, no_order, qty_order FROM tbl_schedule_new WHERE nodemand = '$row_schedule[nodemand]'");
                                    $row_statusmesin = mysqli_fetch_assoc($status_mesin);
                                    ?>
                                    <div class="kolom" title="<?= (htmlspecialchars($row_statusmesin['proses'] . "\n" . $row_statusmesin['langganan'] . "\n" . $row_statusmesin['no_order'] . "\n" . $row_statusmesin['qty_order'])); ?>" style="<?= $warna; ?>"><?= $row_schedule['nodemand']; ?></div>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
            <div style="flex: 1; margin-right: 5px;">
                <table border="0" width="5%">
                    <thead>
                        <tr>
                            <th>
                                <?php
                                $q_schedule_sum = mysqli_query($con, "SELECT
                                                                            SUM(qty_order) AS sum_qty
                                                                        FROM
                                                                            `tbl_schedule_new` a 
                                                                        WHERE
                                                                            NOT EXISTS (
                                                                            SELECT
                                                                                1 
                                                                            FROM
                                                                                `tbl_produksi` b 
                                                                            WHERE
                                                                                b.nokk = a.nokk 
                                                                                AND b.demandno = a.nodemand 
                                                                                AND b.nama_mesin = a.operation 
                                                                                AND b.no_mesin = a.no_mesin 
                                                                            ) 
                                                                            AND a.`status` = 'SCHEDULE' 
                                                                            AND a.no_mesin = '#' 
                                                                            AND NOT a.nourut = 0 
                                                                        ORDER BY
                                                                            CONCAT(
                                                                                SUBSTR(TRIM(a.no_mesin), - 5, 2),
                                                                            SUBSTR(TRIM(a.no_mesin), - 2 )) ASC,
                                                                            nourut ASC
                                                                        LIMIT 10");
                                $row_sum_qty    = mysqli_fetch_assoc($q_schedule_sum);
                                ?>
                                <span style="font-size: 10px; color: red"><?= (number_format($row_sum_qty['sum_qty'])) ?> Kg</span></h2>
                                <div class="kolom1">OVEN FONG</div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $q_schedule = mysqli_query($con, "SELECT
                                                                    * 
                                                                FROM
                                                                    `tbl_schedule_new` a 
                                                                WHERE
                                                                    NOT EXISTS (
                                                                    SELECT
                                                                        1 
                                                                    FROM
                                                                        `tbl_produksi` b 
                                                                    WHERE
                                                                        b.nokk = a.nokk 
                                                                        AND b.demandno = a.nodemand 
                                                                        AND b.nama_mesin = a.operation 
                                                                        AND b.no_mesin = a.no_mesin 
                                                                    ) 
                                                                    AND a.`status` = 'SCHEDULE' 
                                                                    AND a.no_mesin = '#' 
                                                                    AND NOT a.nourut = 0 
                                                                ORDER BY
                                                                    CONCAT(
                                                                        SUBSTR(TRIM(a.no_mesin), - 5, 2),
                                                                    SUBSTR(TRIM(a.no_mesin), - 2 )) ASC,
                                                                    nourut ASC
                                                                LIMIT 10");
                        ?>
                        <?php while ($row_schedule  = mysqli_fetch_array($q_schedule)) : ?>
                            <?php
                            $q_proses   = mysqli_query($con, "SELECT * FROM tbl_proses WHERE CONCAT(proses, ' (', jns, ')') = '$row_schedule[proses]'");
                            $row_proses = mysqli_fetch_assoc($q_proses);
                            if ($row_proses['ket_proses'] == 'kk/kain belum final proses') {
                                $warna  = "background-color: #FFFF00;";
                            } elseif ($row_proses['ket_proses'] == 'kk/kain finishing final proses') {
                                $warna  = "background-color: palegreen;";
                            } elseif ($row_proses['ket_proses'] == 'pedder') {
                                $warna  = "background-color: #FA8072; color: white;";
                            } elseif ($row_proses['ket_proses'] == 'preset') {
                                $warna  = "background-color: #2471A3; color: white;";
                            } else {
                                $warna = "";
                            }
                            ?>
                            <tr>
                                <td>
                                    <?php
                                    $status_mesin = mysqli_query($con, "SELECT proses, langganan, no_order, qty_order FROM tbl_schedule_new WHERE nodemand = '$row_schedule[nodemand]'");
                                    $row_statusmesin = mysqli_fetch_assoc($status_mesin);
                                    ?>
                                    <div class="kolom" title="<?= (htmlspecialchars($row_statusmesin['proses'] . "\n" . $row_statusmesin['langganan'] . "\n" . $row_statusmesin['no_order'] . "\n" . $row_statusmesin['qty_order'])); ?>" style="<?= $warna; ?>"><?= $row_schedule['nodemand']; ?></div>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
            <div style="flex: 1; margin-right: 5px;">
                <table border="0" width="5%">
                    <thead>
                        <tr>
                            <th>
                                <?php
                                $q_schedule_sum = mysqli_query($con, "SELECT
                                                                            SUM(qty_order) AS sum_qty
                                                                        FROM
                                                                            `tbl_schedule_new` a 
                                                                        WHERE
                                                                            NOT EXISTS (
                                                                            SELECT
                                                                                1 
                                                                            FROM
                                                                                `tbl_produksi` b 
                                                                            WHERE
                                                                                b.nokk = a.nokk 
                                                                                AND b.demandno = a.nodemand 
                                                                                AND b.nama_mesin = a.operation 
                                                                                AND b.no_mesin = a.no_mesin 
                                                                            ) 
                                                                            AND a.`status` = 'SCHEDULE' 
                                                                            AND a.no_mesin = 'P3SM101' 
                                                                            AND NOT a.nourut = 0 
                                                                        ORDER BY
                                                                            CONCAT(
                                                                                SUBSTR(TRIM(a.no_mesin), - 5, 2),
                                                                            SUBSTR(TRIM(a.no_mesin), - 2 )) ASC,
                                                                            nourut ASC
                                                                        LIMIT 10");
                                $row_sum_qty    = mysqli_fetch_assoc($q_schedule_sum);
                                ?>
                                <span style="font-size: 10px; color: red"><?= (number_format($row_sum_qty['sum_qty'])) ?> Kg</span></h2>
                                <div class="kolom1">STEAM<br>&nbsp;</div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $q_schedule = mysqli_query($con, "SELECT
                                                                    * 
                                                                FROM
                                                                    `tbl_schedule_new` a 
                                                                WHERE
                                                                    NOT EXISTS (
                                                                    SELECT
                                                                        1 
                                                                    FROM
                                                                        `tbl_produksi` b 
                                                                    WHERE
                                                                        b.nokk = a.nokk 
                                                                        AND b.demandno = a.nodemand 
                                                                        AND b.nama_mesin = a.operation 
                                                                        AND b.no_mesin = a.no_mesin 
                                                                    ) 
                                                                    AND a.`status` = 'SCHEDULE' 
                                                                    AND a.no_mesin = 'P3SM101' 
                                                                    AND NOT a.nourut = 0 
                                                                ORDER BY
                                                                    CONCAT(
                                                                        SUBSTR(TRIM(a.no_mesin), - 5, 2),
                                                                    SUBSTR(TRIM(a.no_mesin), - 2 )) ASC,
                                                                    nourut ASC
                                                                LIMIT 10");
                        ?>
                        <?php while ($row_schedule  = mysqli_fetch_array($q_schedule)) : ?>
                            <?php
                            $q_proses   = mysqli_query($con, "SELECT * FROM tbl_proses WHERE CONCAT(proses, ' (', jns, ')') = '$row_schedule[proses]'");
                            $row_proses = mysqli_fetch_assoc($q_proses);
                            if ($row_proses['ket_proses'] == 'kk/kain belum final proses') {
                                $warna  = "background-color: #FFFF00;";
                            } elseif ($row_proses['ket_proses'] == 'kk/kain finishing final proses') {
                                $warna  = "background-color: palegreen;";
                            } elseif ($row_proses['ket_proses'] == 'pedder') {
                                $warna  = "background-color: #FA8072; color: white;";
                            } elseif ($row_proses['ket_proses'] == 'preset') {
                                $warna  = "background-color: #2471A3; color: white;";
                            } else {
                                $warna = "";
                            }
                            ?>
                            <tr>
                                <td>
                                    <?php
                                    $status_mesin = mysqli_query($con, "SELECT proses, langganan, no_order, qty_order FROM tbl_schedule_new WHERE nodemand = '$row_schedule[nodemand]'");
                                    $row_statusmesin = mysqli_fetch_assoc($status_mesin);
                                    ?>
                                    <div class="kolom" title="<?= (htmlspecialchars($row_statusmesin['proses'] . "\n" . $row_statusmesin['langganan'] . "\n" . $row_statusmesin['no_order'] . "\n" . $row_statusmesin['qty_order'])); ?>" style="<?= $warna; ?>"><?= $row_schedule['nodemand']; ?></div>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
            <div style="flex: 1; margin-right: 5px;">
                <table border="0" width="5%">
                    <thead>
                        <tr>
                            <th>
                                <?php
                                $q_schedule_sum = mysqli_query($con, "SELECT
                                                                            SUM(qty_order) AS sum_qty
                                                                        FROM
                                                                            `tbl_schedule_new` a 
                                                                        WHERE
                                                                            NOT EXISTS (
                                                                            SELECT
                                                                                1 
                                                                            FROM
                                                                                `tbl_produksi` b 
                                                                            WHERE
                                                                                b.nokk = a.nokk 
                                                                                AND b.demandno = a.nodemand 
                                                                                AND b.nama_mesin = a.operation 
                                                                                AND b.no_mesin = a.no_mesin 
                                                                            ) 
                                                                            AND a.`status` = 'SCHEDULE' 
                                                                            AND a.no_mesin = 'P3IN350' 
                                                                            AND NOT a.nourut = 0 
                                                                        ORDER BY
                                                                            CONCAT(
                                                                                SUBSTR(TRIM(a.no_mesin), - 5, 2),
                                                                            SUBSTR(TRIM(a.no_mesin), - 2 )) ASC,
                                                                            nourut ASC
                                                                        LIMIT 10");
                                $row_sum_qty    = mysqli_fetch_assoc($q_schedule_sum);
                                ?>
                                <span style="font-size: 10px; color: red"><?= (number_format($row_sum_qty['sum_qty'])) ?> Kg</span></h2>
                                <div class="kolom1">LIPAT<br>INSPEK</div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $q_schedule = mysqli_query($con, "SELECT
                                                                    * 
                                                                FROM
                                                                    `tbl_schedule_new` a 
                                                                WHERE
                                                                    NOT EXISTS (
                                                                    SELECT
                                                                        1 
                                                                    FROM
                                                                        `tbl_produksi` b 
                                                                    WHERE
                                                                        b.nokk = a.nokk 
                                                                        AND b.demandno = a.nodemand 
                                                                        AND b.nama_mesin = a.operation 
                                                                        AND b.no_mesin = a.no_mesin 
                                                                    ) 
                                                                    AND a.`status` = 'SCHEDULE' 
                                                                    AND a.no_mesin = 'P3IN350' 
                                                                    AND NOT a.nourut = 0 
                                                                ORDER BY
                                                                    CONCAT(
                                                                        SUBSTR(TRIM(a.no_mesin), - 5, 2),
                                                                    SUBSTR(TRIM(a.no_mesin), - 2 )) ASC,
                                                                    nourut ASC
                                                                LIMIT 10");
                        ?>
                        <?php while ($row_schedule  = mysqli_fetch_array($q_schedule)) : ?>
                            <?php
                            $q_proses   = mysqli_query($con, "SELECT * FROM tbl_proses WHERE CONCAT(proses, ' (', jns, ')') = '$row_schedule[proses]'");
                            $row_proses = mysqli_fetch_assoc($q_proses);
                            if ($row_proses['ket_proses'] == 'kk/kain belum final proses') {
                                $warna  = "background-color: #FFFF00;";
                            } elseif ($row_proses['ket_proses'] == 'kk/kain finishing final proses') {
                                $warna  = "background-color: palegreen;";
                            } elseif ($row_proses['ket_proses'] == 'pedder') {
                                $warna  = "background-color: #FA8072; color: white;";
                            } elseif ($row_proses['ket_proses'] == 'preset') {
                                $warna  = "background-color: #2471A3; color: white;";
                            } else {
                                $warna = "";
                            }
                            ?>
                            <tr>
                                <td>
                                    <?php
                                    $status_mesin = mysqli_query($con, "SELECT proses, langganan, no_order, qty_order FROM tbl_schedule_new WHERE nodemand = '$row_schedule[nodemand]'");
                                    $row_statusmesin = mysqli_fetch_assoc($status_mesin);
                                    ?>
                                    <div class="kolom" title="<?= (htmlspecialchars($row_statusmesin['proses'] . "\n" . $row_statusmesin['langganan'] . "\n" . $row_statusmesin['no_order'] . "\n" . $row_statusmesin['qty_order'])); ?>" style="<?= $warna; ?>"><?= $row_schedule['nodemand']; ?></div>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
            <div style="flex: 1; margin-right: 5px;">
                <table border="0" width="5%">
                    <thead>
                        <tr>
                            <th>
                                <?php
                                $q_schedule_sum = mysqli_query($con, "SELECT
                                                                            SUM(qty_order) AS sum_qty
                                                                        FROM
                                                                            `tbl_schedule_new` a 
                                                                        WHERE
                                                                            NOT EXISTS (
                                                                            SELECT
                                                                                1 
                                                                            FROM
                                                                                `tbl_produksi` b 
                                                                            WHERE
                                                                                b.nokk = a.nokk 
                                                                                AND b.demandno = a.nodemand 
                                                                                AND b.nama_mesin = a.operation 
                                                                                AND b.no_mesin = a.no_mesin 
                                                                            ) 
                                                                            AND a.`status` = 'SCHEDULE' 
                                                                            AND a.no_mesin = '#' 
                                                                            AND NOT a.nourut = 0 
                                                                        ORDER BY
                                                                            CONCAT(
                                                                                SUBSTR(TRIM(a.no_mesin), - 5, 2),
                                                                            SUBSTR(TRIM(a.no_mesin), - 2 )) ASC,
                                                                            nourut ASC
                                                                        LIMIT 10");
                                $row_sum_qty    = mysqli_fetch_assoc($q_schedule_sum);
                                ?>
                                <span style="font-size: 10px; color: red"><?= (number_format($row_sum_qty['sum_qty'])) ?> Kg</span></h2>
                                <div class="kolom1">BC 01</div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $q_schedule = mysqli_query($con, "SELECT
                                                                    * 
                                                                FROM
                                                                    `tbl_schedule_new` a 
                                                                WHERE
                                                                    NOT EXISTS (
                                                                    SELECT
                                                                        1 
                                                                    FROM
                                                                        `tbl_produksi` b 
                                                                    WHERE
                                                                        b.nokk = a.nokk 
                                                                        AND b.demandno = a.nodemand 
                                                                        AND b.nama_mesin = a.operation 
                                                                        AND b.no_mesin = a.no_mesin 
                                                                    ) 
                                                                    AND a.`status` = 'SCHEDULE' 
                                                                    AND a.no_mesin = '#' 
                                                                    AND NOT a.nourut = 0 
                                                                ORDER BY
                                                                    CONCAT(
                                                                        SUBSTR(TRIM(a.no_mesin), - 5, 2),
                                                                    SUBSTR(TRIM(a.no_mesin), - 2 )) ASC,
                                                                    nourut ASC
                                                                LIMIT 10");
                        ?>
                        <?php while ($row_schedule  = mysqli_fetch_array($q_schedule)) : ?>
                            <?php
                            $q_proses   = mysqli_query($con, "SELECT * FROM tbl_proses WHERE CONCAT(proses, ' (', jns, ')') = '$row_schedule[proses]'");
                            $row_proses = mysqli_fetch_assoc($q_proses);
                            if ($row_proses['ket_proses'] == 'kk/kain belum final proses') {
                                $warna  = "background-color: #FFFF00;";
                            } elseif ($row_proses['ket_proses'] == 'kk/kain finishing final proses') {
                                $warna  = "background-color: palegreen;";
                            } elseif ($row_proses['ket_proses'] == 'pedder') {
                                $warna  = "background-color: #FA8072; color: white;";
                            } elseif ($row_proses['ket_proses'] == 'preset') {
                                $warna  = "background-color: #2471A3; color: white;";
                            } else {
                                $warna = "";
                            }
                            ?>
                            <tr>
                                <td>
                                    <?php
                                    $status_mesin = mysqli_query($con, "SELECT proses, langganan, no_order, qty_order FROM tbl_schedule_new WHERE nodemand = '$row_schedule[nodemand]'");
                                    $row_statusmesin = mysqli_fetch_assoc($status_mesin);
                                    ?>
                                    <div class="kolom" title="<?= (htmlspecialchars($row_statusmesin['proses'] . "\n" . $row_statusmesin['langganan'] . "\n" . $row_statusmesin['no_order'] . "\n" . $row_statusmesin['qty_order'])); ?>" style="<?= $warna; ?>"><?= $row_schedule['nodemand']; ?></div>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
            <div style="flex: 1; margin-right: 5px;">
                <table border="0" width="5%">
                    <thead>
                        <tr>
                            <th>
                                <?php
                                $q_schedule_sum = mysqli_query($con, "SELECT
                                                                            SUM(qty_order) AS sum_qty
                                                                        FROM
                                                                            `tbl_schedule_new` a 
                                                                        WHERE
                                                                            NOT EXISTS (
                                                                            SELECT
                                                                                1 
                                                                            FROM
                                                                                `tbl_produksi` b 
                                                                            WHERE
                                                                                b.nokk = a.nokk 
                                                                                AND b.demandno = a.nodemand 
                                                                                AND b.nama_mesin = a.operation 
                                                                                AND b.no_mesin = a.no_mesin 
                                                                            ) 
                                                                            AND a.`status` = 'SCHEDULE' 
                                                                            AND a.no_mesin = '#' 
                                                                            AND NOT a.nourut = 0 
                                                                        ORDER BY
                                                                            CONCAT(
                                                                                SUBSTR(TRIM(a.no_mesin), - 5, 2),
                                                                            SUBSTR(TRIM(a.no_mesin), - 2 )) ASC,
                                                                            nourut ASC
                                                                        LIMIT 10");
                                $row_sum_qty    = mysqli_fetch_assoc($q_schedule_sum);
                                ?>
                                <span style="font-size: 10px; color: red"><?= (number_format($row_sum_qty['sum_qty'])) ?> Kg</span></h2>
                                <div class="kolom1">BC 02</div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $q_schedule = mysqli_query($con, "SELECT
                                                                    * 
                                                                FROM
                                                                    `tbl_schedule_new` a 
                                                                WHERE
                                                                    NOT EXISTS (
                                                                    SELECT
                                                                        1 
                                                                    FROM
                                                                        `tbl_produksi` b 
                                                                    WHERE
                                                                        b.nokk = a.nokk 
                                                                        AND b.demandno = a.nodemand 
                                                                        AND b.nama_mesin = a.operation 
                                                                        AND b.no_mesin = a.no_mesin 
                                                                    ) 
                                                                    AND a.`status` = 'SCHEDULE' 
                                                                    AND a.no_mesin = '#' 
                                                                    AND NOT a.nourut = 0 
                                                                ORDER BY
                                                                    CONCAT(
                                                                        SUBSTR(TRIM(a.no_mesin), - 5, 2),
                                                                    SUBSTR(TRIM(a.no_mesin), - 2 )) ASC,
                                                                    nourut ASC
                                                                LIMIT 10");
                        ?>
                        <?php while ($row_schedule  = mysqli_fetch_array($q_schedule)) : ?>
                            <?php
                            $q_proses   = mysqli_query($con, "SELECT * FROM tbl_proses WHERE CONCAT(proses, ' (', jns, ')') = '$row_schedule[proses]'");
                            $row_proses = mysqli_fetch_assoc($q_proses);
                            if ($row_proses['ket_proses'] == 'kk/kain belum final proses') {
                                $warna  = "background-color: #FFFF00;";
                            } elseif ($row_proses['ket_proses'] == 'kk/kain finishing final proses') {
                                $warna  = "background-color: palegreen;";
                            } elseif ($row_proses['ket_proses'] == 'pedder') {
                                $warna  = "background-color: #FA8072; color: white;";
                            } elseif ($row_proses['ket_proses'] == 'preset') {
                                $warna  = "background-color: #2471A3; color: white;";
                            } else {
                                $warna = "";
                            }
                            ?>
                            <tr>
                                <td>
                                    <?php
                                    $status_mesin = mysqli_query($con, "SELECT proses, langganan, no_order, qty_order FROM tbl_schedule_new WHERE nodemand = '$row_schedule[nodemand]'");
                                    $row_statusmesin = mysqli_fetch_assoc($status_mesin);
                                    ?>
                                    <div class="kolom" title="<?= (htmlspecialchars($row_statusmesin['proses'] . "\n" . $row_statusmesin['langganan'] . "\n" . $row_statusmesin['no_order'] . "\n" . $row_statusmesin['qty_order'])); ?>" style="<?= $warna; ?>"><?= $row_schedule['nodemand']; ?></div>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
            <div style="flex: 1; margin-right: 5px;">
                <table border="0" width="5%">
                    <thead>
                        <tr>
                            <th>
                                <?php
                                $q_schedule_sum = mysqli_query($con, "SELECT
                                                                            SUM(qty_order) AS sum_qty
                                                                        FROM
                                                                            `tbl_schedule_new` a 
                                                                        WHERE
                                                                            NOT EXISTS (
                                                                            SELECT
                                                                                1 
                                                                            FROM
                                                                                `tbl_produksi` b 
                                                                            WHERE
                                                                                b.nokk = a.nokk 
                                                                                AND b.demandno = a.nodemand 
                                                                                AND b.nama_mesin = a.operation 
                                                                                AND b.no_mesin = a.no_mesin 
                                                                            ) 
                                                                            AND a.`status` = 'SCHEDULE' 
                                                                            AND a.no_mesin = '#' 
                                                                            AND NOT a.nourut = 0 
                                                                        ORDER BY
                                                                            CONCAT(
                                                                                SUBSTR(TRIM(a.no_mesin), - 5, 2),
                                                                            SUBSTR(TRIM(a.no_mesin), - 2 )) ASC,
                                                                            nourut ASC
                                                                        LIMIT 10");
                                $row_sum_qty    = mysqli_fetch_assoc($q_schedule_sum);
                                ?>
                                <span style="font-size: 10px; color: red"><?= (number_format($row_sum_qty['sum_qty'])) ?> Kg</span></h2>
                                <div class="kolom1">BC 03</div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $q_schedule = mysqli_query($con, "SELECT
                                                                    * 
                                                                FROM
                                                                    `tbl_schedule_new` a 
                                                                WHERE
                                                                    NOT EXISTS (
                                                                    SELECT
                                                                        1 
                                                                    FROM
                                                                        `tbl_produksi` b 
                                                                    WHERE
                                                                        b.nokk = a.nokk 
                                                                        AND b.demandno = a.nodemand 
                                                                        AND b.nama_mesin = a.operation 
                                                                        AND b.no_mesin = a.no_mesin 
                                                                    ) 
                                                                    AND a.`status` = 'SCHEDULE' 
                                                                    AND a.no_mesin = 'P3CP101' 
                                                                    AND NOT a.nourut = 0 
                                                                ORDER BY
                                                                    CONCAT(
                                                                        SUBSTR(TRIM(a.no_mesin), - 5, 2),
                                                                    SUBSTR(TRIM(a.no_mesin), - 2 )) ASC,
                                                                    nourut ASC
                                                                LIMIT 10");
                        ?>
                        <?php while ($row_schedule  = mysqli_fetch_array($q_schedule)) : ?>
                            <?php
                            $q_proses   = mysqli_query($con, "SELECT * FROM tbl_proses WHERE CONCAT(proses, ' (', jns, ')') = '$row_schedule[proses]'");
                            $row_proses = mysqli_fetch_assoc($q_proses);
                            if ($row_proses['ket_proses'] == 'kk/kain belum final proses') {
                                $warna  = "background-color: #FFFF00;";
                            } elseif ($row_proses['ket_proses'] == 'kk/kain finishing final proses') {
                                $warna  = "background-color: palegreen;";
                            } elseif ($row_proses['ket_proses'] == 'pedder') {
                                $warna  = "background-color: #FA8072; color: white;";
                            } elseif ($row_proses['ket_proses'] == 'preset') {
                                $warna  = "background-color: #2471A3; color: white;";
                            } else {
                                $warna = "";
                            }
                            ?>
                            <tr>
                                <td>
                                    <?php
                                    $status_mesin = mysqli_query($con, "SELECT proses, langganan, no_order, qty_order FROM tbl_schedule_new WHERE nodemand = '$row_schedule[nodemand]'");
                                    $row_statusmesin = mysqli_fetch_assoc($status_mesin);
                                    ?>
                                    <div class="kolom" title="<?= (htmlspecialchars($row_statusmesin['proses'] . "\n" . $row_statusmesin['langganan'] . "\n" . $row_statusmesin['no_order'] . "\n" . $row_statusmesin['qty_order'])); ?>" style="<?= $warna; ?>"><?= $row_schedule['nodemand']; ?></div>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
            <div style="flex: 1; margin-right: 5px;">
                <table border="0" width="5%">
                    <thead>
                        <tr>
                            <th>
                                <?php
                                $q_schedule_sum = mysqli_query($con, "SELECT
                                                                            SUM(qty_order) AS sum_qty
                                                                        FROM
                                                                            `tbl_schedule_new` a 
                                                                        WHERE
                                                                            NOT EXISTS (
                                                                            SELECT
                                                                                1 
                                                                            FROM
                                                                                `tbl_produksi` b 
                                                                            WHERE
                                                                                b.nokk = a.nokk 
                                                                                AND b.demandno = a.nodemand 
                                                                                AND b.nama_mesin = a.operation 
                                                                                AND b.no_mesin = a.no_mesin 
                                                                            ) 
                                                                            AND a.`status` = 'SCHEDULE' 
                                                                            AND a.no_mesin = '#' 
                                                                            AND NOT a.nourut = 0 
                                                                        ORDER BY
                                                                            CONCAT(
                                                                                SUBSTR(TRIM(a.no_mesin), - 5, 2),
                                                                            SUBSTR(TRIM(a.no_mesin), - 2 )) ASC,
                                                                            nourut ASC
                                                                        LIMIT 10");
                                $row_sum_qty    = mysqli_fetch_assoc($q_schedule_sum);
                                ?>
                                <span style="font-size: 10px; color: red"><?= (number_format($row_sum_qty['sum_qty'])) ?> Kg</span></h2>
                                <div class="kolom1">BC 04</div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $q_schedule = mysqli_query($con, "SELECT
                                                                    * 
                                                                FROM
                                                                    `tbl_schedule_new` a 
                                                                WHERE
                                                                    NOT EXISTS (
                                                                    SELECT
                                                                        1 
                                                                    FROM
                                                                        `tbl_produksi` b 
                                                                    WHERE
                                                                        b.nokk = a.nokk 
                                                                        AND b.demandno = a.nodemand 
                                                                        AND b.nama_mesin = a.operation 
                                                                        AND b.no_mesin = a.no_mesin 
                                                                    ) 
                                                                    AND a.`status` = 'SCHEDULE' 
                                                                    AND a.no_mesin = '#' 
                                                                    AND NOT a.nourut = 0 
                                                                ORDER BY
                                                                    CONCAT(
                                                                        SUBSTR(TRIM(a.no_mesin), - 5, 2),
                                                                    SUBSTR(TRIM(a.no_mesin), - 2 )) ASC,
                                                                    nourut ASC
                                                                LIMIT 10");
                        ?>
                        <?php while ($row_schedule  = mysqli_fetch_array($q_schedule)) : ?>
                            <?php
                            $q_proses   = mysqli_query($con, "SELECT * FROM tbl_proses WHERE CONCAT(proses, ' (', jns, ')') = '$row_schedule[proses]'");
                            $row_proses = mysqli_fetch_assoc($q_proses);
                            if ($row_proses['ket_proses'] == 'kk/kain belum final proses') {
                                $warna  = "background-color: #FFFF00;";
                            } elseif ($row_proses['ket_proses'] == 'kk/kain finishing final proses') {
                                $warna  = "background-color: palegreen;";
                            } elseif ($row_proses['ket_proses'] == 'pedder') {
                                $warna  = "background-color: #FA8072; color: white;";
                            } elseif ($row_proses['ket_proses'] == 'preset') {
                                $warna  = "background-color: #2471A3; color: white;";
                            } else {
                                $warna = "";
                            }
                            ?>
                            <tr>
                                <td>
                                    <?php
                                    $status_mesin = mysqli_query($con, "SELECT proses, langganan, no_order, qty_order FROM tbl_schedule_new WHERE nodemand = '$row_schedule[nodemand]'");
                                    $row_statusmesin = mysqli_fetch_assoc($status_mesin);
                                    ?>
                                    <div class="kolom" title="<?= (htmlspecialchars($row_statusmesin['proses'] . "\n" . $row_statusmesin['langganan'] . "\n" . $row_statusmesin['no_order'] . "\n" . $row_statusmesin['qty_order'])); ?>" style="<?= $warna; ?>"><?= $row_schedule['nodemand']; ?></div>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <td colspan="4">kk/kain belum final proses <span class="small-box1"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td colspan="4">kk/kain finishing final proses <span class="small-box2"></span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td colspan="4">Pedder <span class="small-box3"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td colspan="4">Preset <span class="small-box4"></span></td>
        <br>
        <br>
        <marquee class="teks-berjalan" behavior="scroll" direction="left" onmouseover="this.stop();" onmouseout="this.start();" style="font-size: 20px; background-color: #CD6155; color: #F8F9F9;">
            UTAMAKAN KESELAMATAN KERJA, TINGKATKAN PRODUKTIFITAS, KURANGI MASALAH, KURANGI LOSS WAKTU DAN JAGA 5R DI LINGKUNGAN KERJA :: UTAMAKAN KESEHATAN DAN KESELAMATAN KERJA, SELALU MENGGUNAKAN ALAT PELINDUNG DIRI, JAGA 5R, DAN SELALU WASPADA TERHADAP PENYEBARAN COVID-19
        </marquee>
    </div>




    <br>
    <br>


    <!-- NO.URUT = 0 -->
    <hr>
    <nav>
        <h1>STATUS MESIN DEPART FINISHING BELUM ATUR</h1>
    </nav>
    <hr>
    <div class="card">
        <div style="display: flex; width: 100%">
            <div style="flex: 1; margin-right: 5px;">
                <table border="0" width="5%">
                    <thead>
                        <tr>
                            <th>
                                <?php
                                $q_schedule_sum = mysqli_query($con, "SELECT
                                                                            SUM(qty_order) AS sum_qty
                                                                        FROM
                                                                            `tbl_schedule_new` a 
                                                                        WHERE
                                                                            NOT EXISTS (
                                                                            SELECT
                                                                                1 
                                                                            FROM
                                                                                `tbl_produksi` b 
                                                                            WHERE
                                                                                b.nokk = a.nokk 
                                                                                AND b.demandno = a.nodemand 
                                                                                AND b.nama_mesin = a.operation 
                                                                                AND b.no_mesin = a.no_mesin 
                                                                            ) 
                                                                            AND a.`status` = 'SCHEDULE' 
                                                                            AND a.no_mesin = 'P3ST301' 
                                                                            AND a.nourut = 0 
                                                                        ORDER BY
                                                                            CONCAT(
                                                                                SUBSTR(TRIM(a.no_mesin), - 5, 2),
                                                                            SUBSTR(TRIM(a.no_mesin), - 2 )) ASC,
                                                                            nourut ASC
                                                                        LIMIT 10");
                                $row_sum_qty    = mysqli_fetch_assoc($q_schedule_sum);
                                ?>
                                <span style="font-size: 10px; color: red"><?= (number_format($row_sum_qty['sum_qty'])) ?> Kg</span></h2>
                                <div class="kolom1">ST 01</div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $q_schedule = mysqli_query($con, "SELECT
                                                                    * 
                                                                FROM
                                                                    `tbl_schedule_new` a 
                                                                WHERE
                                                                    NOT EXISTS (
                                                                    SELECT
                                                                        1 
                                                                    FROM
                                                                        `tbl_produksi` b 
                                                                    WHERE
                                                                        b.nokk = a.nokk 
                                                                        AND b.demandno = a.nodemand 
                                                                        AND b.nama_mesin = a.operation 
                                                                        AND b.no_mesin = a.no_mesin 
                                                                    ) 
                                                                    AND a.`status` = 'SCHEDULE' 
                                                                    AND a.no_mesin = 'P3ST301' 
                                                                    AND a.nourut = 0 
                                                                ORDER BY
                                                                    CONCAT(
                                                                        SUBSTR(TRIM(a.no_mesin), - 5, 2),
                                                                    SUBSTR(TRIM(a.no_mesin), - 2 )) ASC,
                                                                    nourut ASC
                                                                LIMIT 10");
                        ?>
                        <?php while ($row_schedule  = mysqli_fetch_array($q_schedule)) : ?>
                            <?php
                            $q_proses   = mysqli_query($con, "SELECT * FROM tbl_proses WHERE CONCAT(proses, ' (', jns, ')') = '$row_schedule[proses]'");
                            $row_proses = mysqli_fetch_assoc($q_proses);
                            if ($row_proses['ket_proses'] == 'kk/kain belum final proses') {
                                $warna  = "background-color: #FFFF00;";
                            } elseif ($row_proses['ket_proses'] == 'kk/kain finishing final proses') {
                                $warna  = "background-color: palegreen;";
                            } elseif ($row_proses['ket_proses'] == 'pedder') {
                                $warna  = "background-color: #FA8072; color: white;";
                            } elseif ($row_proses['ket_proses'] == 'preset') {
                                $warna  = "background-color: #2471A3; color: white;";
                            } else {
                                $warna = "";
                            }
                            ?>
                            <tr>
                                <td>
                                    <?php
                                    $status_mesin = mysqli_query($con, "SELECT proses, langganan, no_order, qty_order FROM tbl_schedule_new WHERE nodemand = '$row_schedule[nodemand]'");
                                    $row_statusmesin = mysqli_fetch_assoc($status_mesin);
                                    ?>
                                    <div class="kolom" title="<?= (htmlspecialchars($row_statusmesin['proses'] . "\n" . $row_statusmesin['langganan'] . "\n" . $row_statusmesin['no_order'] . "\n" . $row_statusmesin['qty_order'])); ?>" style="<?= $warna; ?>"><?= $row_schedule['nodemand']; ?></div>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
            <div style="flex: 1; margin-right: 5px;">
                <table border="0" width="10%">
                    <thead>
                        <tr>
                            <th>
                                <?php
                                $q_schedule_sum = mysqli_query($con, "SELECT
                                                                            SUM(qty_order) AS sum_qty
                                                                        FROM
                                                                            `tbl_schedule_new` a 
                                                                        WHERE
                                                                            NOT EXISTS (
                                                                            SELECT
                                                                                1 
                                                                            FROM
                                                                                `tbl_produksi` b 
                                                                            WHERE
                                                                                b.nokk = a.nokk 
                                                                                AND b.demandno = a.nodemand 
                                                                                AND b.nama_mesin = a.operation 
                                                                                AND b.no_mesin = a.no_mesin 
                                                                            ) 
                                                                            AND a.`status` = 'SCHEDULE' 
                                                                            AND a.no_mesin = 'P3ST302' 
                                                                            AND a.nourut = 0 
                                                                        ORDER BY
                                                                            CONCAT(
                                                                                SUBSTR(TRIM(a.no_mesin), - 5, 2),
                                                                            SUBSTR(TRIM(a.no_mesin), - 2 )) ASC,
                                                                            nourut ASC
                                                                        LIMIT 10");
                                $row_sum_qty    = mysqli_fetch_assoc($q_schedule_sum);
                                ?>
                                <span style="font-size: 10px; color: red"><?= (number_format($row_sum_qty['sum_qty'])) ?> Kg</span></h2>
                                <div class="kolom1">ST 02</div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $q_schedule = mysqli_query($con, "SELECT
                                                                    * 
                                                                FROM
                                                                    `tbl_schedule_new` a 
                                                                WHERE
                                                                    NOT EXISTS (
                                                                    SELECT
                                                                        1 
                                                                    FROM
                                                                        `tbl_produksi` b 
                                                                    WHERE
                                                                        b.nokk = a.nokk 
                                                                        AND b.demandno = a.nodemand 
                                                                        AND b.nama_mesin = a.operation 
                                                                        AND b.no_mesin = a.no_mesin 
                                                                    ) 
                                                                    AND a.`status` = 'SCHEDULE' 
                                                                    AND a.no_mesin = 'P3ST302' 
                                                                    AND NOT a.nourut = 0 
                                                                ORDER BY
                                                                    CONCAT(
                                                                        SUBSTR(TRIM(a.no_mesin), - 5, 2),
                                                                    SUBSTR(TRIM(a.no_mesin), - 2 )) ASC,
                                                                    nourut ASC
                                                                LIMIT 10");
                        ?>
                        <?php while ($row_schedule  = mysqli_fetch_array($q_schedule)) : ?>
                            <?php
                            $q_proses   = mysqli_query($con, "SELECT * FROM tbl_proses WHERE CONCAT(proses, ' (', jns, ')') = '$row_schedule[proses]'");
                            $row_proses = mysqli_fetch_assoc($q_proses);
                            if ($row_proses['ket_proses'] == 'kk/kain belum final proses') {
                                $warna  = "background-color: #FFFF00;";
                            } elseif ($row_proses['ket_proses'] == 'kk/kain finishing final proses') {
                                $warna  = "background-color: palegreen;";
                            } elseif ($row_proses['ket_proses'] == 'pedder') {
                                $warna  = "background-color: #FA8072; color: white;";
                            } elseif ($row_proses['ket_proses'] == 'preset') {
                                $warna  = "background-color: #2471A3; color: white;";
                            } else {
                                $warna = "";
                            }
                            ?>
                            <tr>
                                <td>
                                    <?php
                                    $status_mesin = mysqli_query($con, "SELECT proses, langganan, no_order, qty_order FROM tbl_schedule_new WHERE nodemand = '$row_schedule[nodemand]'");
                                    $row_statusmesin = mysqli_fetch_assoc($status_mesin);
                                    ?>
                                    <div class="kolom" title="<?= (htmlspecialchars($row_statusmesin['proses'] . "\n" . $row_statusmesin['langganan'] . "\n" . $row_statusmesin['no_order'] . "\n" . $row_statusmesin['qty_order'])); ?>" style="<?= $warna; ?>"><?= $row_schedule['nodemand']; ?></div>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
            <div style="flex: 1; margin-right: 5px;">
                <table border="0" width="5%">
                    <thead>
                        <tr>
                            <th>
                                <?php
                                $q_schedule_sum = mysqli_query($con, "SELECT
                                                                            SUM(qty_order) AS sum_qty
                                                                        FROM
                                                                            `tbl_schedule_new` a 
                                                                        WHERE
                                                                            NOT EXISTS (
                                                                            SELECT
                                                                                1 
                                                                            FROM
                                                                                `tbl_produksi` b 
                                                                            WHERE
                                                                                b.nokk = a.nokk 
                                                                                AND b.demandno = a.nodemand 
                                                                                AND b.nama_mesin = a.operation 
                                                                                AND b.no_mesin = a.no_mesin 
                                                                            ) 
                                                                            AND a.`status` = 'SCHEDULE' 
                                                                            AND a.no_mesin = 'P3ST103'
                                                                            AND a.nourut = 0 
                                                                        ORDER BY
                                                                            CONCAT(
                                                                                SUBSTR(TRIM(a.no_mesin), - 5, 2),
                                                                            SUBSTR(TRIM(a.no_mesin), - 2 )) ASC,
                                                                            nourut ASC
                                                                        LIMIT 10");
                                $row_sum_qty    = mysqli_fetch_assoc($q_schedule_sum);
                                ?>
                                <span style="font-size: 10px; color: red"><?= (number_format($row_sum_qty['sum_qty'])) ?> Kg</span></h2>
                                <div class="kolom1">ST 03</div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $q_schedule = mysqli_query($con, "SELECT
                                                                    * 
                                                                FROM
                                                                    `tbl_schedule_new` a 
                                                                WHERE
                                                                    NOT EXISTS (
                                                                    SELECT
                                                                        1 
                                                                    FROM
                                                                        `tbl_produksi` b 
                                                                    WHERE
                                                                        b.nokk = a.nokk 
                                                                        AND b.demandno = a.nodemand 
                                                                        AND b.nama_mesin = a.operation 
                                                                        AND b.no_mesin = a.no_mesin 
                                                                    ) 
                                                                    AND a.`status` = 'SCHEDULE' 
                                                                    AND a.no_mesin = 'P3ST103' 
                                                                    AND NOT a.nourut = 0 
                                                                ORDER BY
                                                                    CONCAT(
                                                                        SUBSTR(TRIM(a.no_mesin), - 5, 2),
                                                                    SUBSTR(TRIM(a.no_mesin), - 2 )) ASC,
                                                                    nourut ASC
                                                                LIMIT 10");
                        ?>
                        <?php while ($row_schedule  = mysqli_fetch_array($q_schedule)) : ?>
                            <?php
                            $q_proses   = mysqli_query($con, "SELECT * FROM tbl_proses WHERE CONCAT(proses, ' (', jns, ')') = '$row_schedule[proses]'");
                            $row_proses = mysqli_fetch_assoc($q_proses);
                            if ($row_proses['ket_proses'] == 'kk/kain belum final proses') {
                                $warna  = "background-color: #FFFF00;";
                            } elseif ($row_proses['ket_proses'] == 'kk/kain finishing final proses') {
                                $warna  = "background-color: palegreen;";
                            } elseif ($row_proses['ket_proses'] == 'pedder') {
                                $warna  = "background-color: #FA8072; color: white;";
                            } elseif ($row_proses['ket_proses'] == 'preset') {
                                $warna  = "background-color: #2471A3; color: white;";
                            } else {
                                $warna = "";
                            }
                            ?>
                            <tr>
                                <td>
                                    <?php
                                    $status_mesin = mysqli_query($con, "SELECT proses, langganan, no_order, qty_order FROM tbl_schedule_new WHERE nodemand = '$row_schedule[nodemand]'");
                                    $row_statusmesin = mysqli_fetch_assoc($status_mesin);
                                    ?>
                                    <div class="kolom" title="<?= (htmlspecialchars($row_statusmesin['proses'] . "\n" . $row_statusmesin['langganan'] . "\n" . $row_statusmesin['no_order'] . "\n" . $row_statusmesin['qty_order'])); ?>" style="<?= $warna; ?>"><?= $row_schedule['nodemand']; ?></div>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
            <div style="flex: 1; margin-right: 5px;">
                <table border="0" width="5%">
                    <thead>
                        <tr>
                            <th>
                                <?php
                                $q_schedule_sum = mysqli_query($con, "SELECT
                                                                            SUM(qty_order) AS sum_qty
                                                                        FROM
                                                                            `tbl_schedule_new` a 
                                                                        WHERE
                                                                            NOT EXISTS (
                                                                            SELECT
                                                                                1 
                                                                            FROM
                                                                                `tbl_produksi` b 
                                                                            WHERE
                                                                                b.nokk = a.nokk 
                                                                                AND b.demandno = a.nodemand 
                                                                                AND b.nama_mesin = a.operation 
                                                                                AND b.no_mesin = a.no_mesin 
                                                                            ) 
                                                                            AND a.`status` = 'SCHEDULE' 
                                                                            AND a.no_mesin = 'P3ST304'
                                                                            AND a.nourut = 0 
                                                                        ORDER BY
                                                                            CONCAT(
                                                                                SUBSTR(TRIM(a.no_mesin), - 5, 2),
                                                                            SUBSTR(TRIM(a.no_mesin), - 2 )) ASC,
                                                                            nourut ASC
                                                                        LIMIT 10");
                                $row_sum_qty    = mysqli_fetch_assoc($q_schedule_sum);
                                ?>
                                <span style="font-size: 10px; color: red"><?= (number_format($row_sum_qty['sum_qty'])) ?> Kg</span></h2>
                                <div class="kolom1">ST 04</div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $q_schedule = mysqli_query($con, "SELECT
                                                                    * 
                                                                FROM
                                                                    `tbl_schedule_new` a 
                                                                WHERE
                                                                    NOT EXISTS (
                                                                    SELECT
                                                                        1 
                                                                    FROM
                                                                        `tbl_produksi` b 
                                                                    WHERE
                                                                        b.nokk = a.nokk 
                                                                        AND b.demandno = a.nodemand 
                                                                        AND b.nama_mesin = a.operation 
                                                                        AND b.no_mesin = a.no_mesin 
                                                                    ) 
                                                                    AND a.`status` = 'SCHEDULE' 
                                                                    AND a.no_mesin = 'P3ST304' 
                                                                    AND NOT a.nourut = 0 
                                                                ORDER BY
                                                                    CONCAT(
                                                                        SUBSTR(TRIM(a.no_mesin), - 5, 2),
                                                                    SUBSTR(TRIM(a.no_mesin), - 2 )) ASC,
                                                                    nourut ASC
                                                                LIMIT 10");
                        ?>
                        <?php while ($row_schedule  = mysqli_fetch_array($q_schedule)) : ?>
                            <?php
                            $q_proses   = mysqli_query($con, "SELECT * FROM tbl_proses WHERE CONCAT(proses, ' (', jns, ')') = '$row_schedule[proses]'");
                            $row_proses = mysqli_fetch_assoc($q_proses);
                            if ($row_proses['ket_proses'] == 'kk/kain belum final proses') {
                                $warna  = "background-color: #FFFF00;";
                            } elseif ($row_proses['ket_proses'] == 'kk/kain finishing final proses') {
                                $warna  = "background-color: palegreen;";
                            } elseif ($row_proses['ket_proses'] == 'pedder') {
                                $warna  = "background-color: #FA8072; color: white;";
                            } elseif ($row_proses['ket_proses'] == 'preset') {
                                $warna  = "background-color: #2471A3; color: white;";
                            } else {
                                $warna = "";
                            }
                            ?>
                            <tr>
                                <td>
                                    <?php
                                    $status_mesin = mysqli_query($con, "SELECT proses, langganan, no_order, qty_order FROM tbl_schedule_new WHERE nodemand = '$row_schedule[nodemand]'");
                                    $row_statusmesin = mysqli_fetch_assoc($status_mesin);
                                    ?>
                                    <div class="kolom" title="<?= (htmlspecialchars($row_statusmesin['proses'] . "\n" . $row_statusmesin['langganan'] . "\n" . $row_statusmesin['no_order'] . "\n" . $row_statusmesin['qty_order'])); ?>" style="<?= $warna; ?>"><?= $row_schedule['nodemand']; ?></div>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
            <div style="flex: 1; margin-right: 5px;">
                <table border="0" width="5%">
                    <thead>
                        <tr>
                            <th>
                                <?php
                                $q_schedule_sum = mysqli_query($con, "SELECT
                                                                            SUM(qty_order) AS sum_qty
                                                                        FROM
                                                                            `tbl_schedule_new` a 
                                                                        WHERE
                                                                            NOT EXISTS (
                                                                            SELECT
                                                                                1 
                                                                            FROM
                                                                                `tbl_produksi` b 
                                                                            WHERE
                                                                                b.nokk = a.nokk 
                                                                                AND b.demandno = a.nodemand 
                                                                                AND b.nama_mesin = a.operation 
                                                                                AND b.no_mesin = a.no_mesin 
                                                                            ) 
                                                                            AND a.`status` = 'SCHEDULE' 
                                                                            AND a.no_mesin = 'P3ST205'
                                                                            AND a.nourut = 0 
                                                                        ORDER BY
                                                                            CONCAT(
                                                                                SUBSTR(TRIM(a.no_mesin), - 5, 2),
                                                                            SUBSTR(TRIM(a.no_mesin), - 2 )) ASC,
                                                                            nourut ASC
                                                                        LIMIT 10");
                                $row_sum_qty    = mysqli_fetch_assoc($q_schedule_sum);
                                ?>
                                <span style="font-size: 10px; color: red"><?= (number_format($row_sum_qty['sum_qty'])) ?> Kg</span></h2>
                                <div class="kolom1">ST 05</div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $q_schedule = mysqli_query($con, "SELECT
                                                                    * 
                                                                FROM
                                                                    `tbl_schedule_new` a 
                                                                WHERE
                                                                    NOT EXISTS (
                                                                    SELECT
                                                                        1 
                                                                    FROM
                                                                        `tbl_produksi` b 
                                                                    WHERE
                                                                        b.nokk = a.nokk 
                                                                        AND b.demandno = a.nodemand 
                                                                        AND b.nama_mesin = a.operation 
                                                                        AND b.no_mesin = a.no_mesin 
                                                                    ) 
                                                                    AND a.`status` = 'SCHEDULE' 
                                                                    AND a.no_mesin = 'P3ST205' 
                                                                    AND NOT a.nourut = 0 
                                                                ORDER BY
                                                                    CONCAT(
                                                                        SUBSTR(TRIM(a.no_mesin), - 5, 2),
                                                                    SUBSTR(TRIM(a.no_mesin), - 2 )) ASC,
                                                                    nourut ASC
                                                                LIMIT 10");
                        ?>
                        <?php while ($row_schedule  = mysqli_fetch_array($q_schedule)) : ?>
                            <?php
                            $q_proses   = mysqli_query($con, "SELECT * FROM tbl_proses WHERE CONCAT(proses, ' (', jns, ')') = '$row_schedule[proses]'");
                            $row_proses = mysqli_fetch_assoc($q_proses);
                            if ($row_proses['ket_proses'] == 'kk/kain belum final proses') {
                                $warna  = "background-color: #FFFF00;";
                            } elseif ($row_proses['ket_proses'] == 'kk/kain finishing final proses') {
                                $warna  = "background-color: palegreen;";
                            } elseif ($row_proses['ket_proses'] == 'pedder') {
                                $warna  = "background-color: #FA8072; color: white;";
                            } elseif ($row_proses['ket_proses'] == 'preset') {
                                $warna  = "background-color: #2471A3; color: white;";
                            } else {
                                $warna = "";
                            }
                            ?>
                            <tr>
                                <td>
                                    <?php
                                    $status_mesin = mysqli_query($con, "SELECT proses, langganan, no_order, qty_order FROM tbl_schedule_new WHERE nodemand = '$row_schedule[nodemand]'");
                                    $row_statusmesin = mysqli_fetch_assoc($status_mesin);
                                    ?>
                                    <div class="kolom" title="<?= (htmlspecialchars($row_statusmesin['proses'] . "\n" . $row_statusmesin['langganan'] . "\n" . $row_statusmesin['no_order'] . "\n" . $row_statusmesin['qty_order'])); ?>" style="<?= $warna; ?>"><?= $row_schedule['nodemand']; ?></div>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
            <div style="flex: 1; margin-right: 5px;">
                <table border="0" width="5%">
                    <thead>
                        <tr>
                            <th>
                                <?php
                                $q_schedule_sum = mysqli_query($con, "SELECT
                                                                            SUM(qty_order) AS sum_qty
                                                                        FROM
                                                                            `tbl_schedule_new` a 
                                                                        WHERE
                                                                            NOT EXISTS (
                                                                            SELECT
                                                                                1 
                                                                            FROM
                                                                                `tbl_produksi` b 
                                                                            WHERE
                                                                                b.nokk = a.nokk 
                                                                                AND b.demandno = a.nodemand 
                                                                                AND b.nama_mesin = a.operation 
                                                                                AND b.no_mesin = a.no_mesin 
                                                                            ) 
                                                                            AND a.`status` = 'SCHEDULE' 
                                                                            AND a.no_mesin = 'P3ST206'
                                                                            AND a.nourut = 0 
                                                                        ORDER BY
                                                                            CONCAT(
                                                                                SUBSTR(TRIM(a.no_mesin), - 5, 2),
                                                                            SUBSTR(TRIM(a.no_mesin), - 2 )) ASC,
                                                                            nourut ASC
                                                                        LIMIT 10");
                                $row_sum_qty    = mysqli_fetch_assoc($q_schedule_sum);
                                ?>
                                <span style="font-size: 10px; color: red"><?= (number_format($row_sum_qty['sum_qty'])) ?> Kg</span></h2>
                                <div class="kolom1">ST 06</div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $q_schedule = mysqli_query($con, "SELECT
                                                                    * 
                                                                FROM
                                                                    `tbl_schedule_new` a 
                                                                WHERE
                                                                    NOT EXISTS (
                                                                    SELECT
                                                                        1 
                                                                    FROM
                                                                        `tbl_produksi` b 
                                                                    WHERE
                                                                        b.nokk = a.nokk 
                                                                        AND b.demandno = a.nodemand 
                                                                        AND b.nama_mesin = a.operation 
                                                                        AND b.no_mesin = a.no_mesin 
                                                                    ) 
                                                                    AND a.`status` = 'SCHEDULE' 
                                                                    AND a.no_mesin = 'P3ST206' 
                                                                    AND NOT a.nourut = 0 
                                                                ORDER BY
                                                                    CONCAT(
                                                                        SUBSTR(TRIM(a.no_mesin), - 5, 2),
                                                                    SUBSTR(TRIM(a.no_mesin), - 2 )) ASC,
                                                                    nourut ASC
                                                                LIMIT 10");
                        ?>
                        <?php while ($row_schedule  = mysqli_fetch_array($q_schedule)) : ?>
                            <?php
                            $q_proses   = mysqli_query($con, "SELECT * FROM tbl_proses WHERE CONCAT(proses, ' (', jns, ')') = '$row_schedule[proses]'");
                            $row_proses = mysqli_fetch_assoc($q_proses);
                            if ($row_proses['ket_proses'] == 'kk/kain belum final proses') {
                                $warna  = "background-color: #FFFF00;";
                            } elseif ($row_proses['ket_proses'] == 'kk/kain finishing final proses') {
                                $warna  = "background-color: palegreen;";
                            } elseif ($row_proses['ket_proses'] == 'pedder') {
                                $warna  = "background-color: #FA8072; color: white;";
                            } elseif ($row_proses['ket_proses'] == 'preset') {
                                $warna  = "background-color: #2471A3; color: white;";
                            } else {
                                $warna = "";
                            }
                            ?>
                            <tr>
                                <td>
                                    <?php
                                    $status_mesin = mysqli_query($con, "SELECT proses, langganan, no_order, qty_order FROM tbl_schedule_new WHERE nodemand = '$row_schedule[nodemand]'");
                                    $row_statusmesin = mysqli_fetch_assoc($status_mesin);
                                    ?>
                                    <div class="kolom" title="<?= (htmlspecialchars($row_statusmesin['proses'] . "\n" . $row_statusmesin['langganan'] . "\n" . $row_statusmesin['no_order'] . "\n" . $row_statusmesin['qty_order'])); ?>" style="<?= $warna; ?>"><?= $row_schedule['nodemand']; ?></div>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
            <div style="flex: 1; margin-right: 5px;">
                <table border="0" width="5%">
                    <thead>
                        <tr>
                            <th>
                                <?php
                                $q_schedule_sum = mysqli_query($con, "SELECT
                                                                            SUM(qty_order) AS sum_qty
                                                                        FROM
                                                                            `tbl_schedule_new` a 
                                                                        WHERE
                                                                            NOT EXISTS (
                                                                            SELECT
                                                                                1 
                                                                            FROM
                                                                                `tbl_produksi` b 
                                                                            WHERE
                                                                                b.nokk = a.nokk 
                                                                                AND b.demandno = a.nodemand 
                                                                                AND b.nama_mesin = a.operation 
                                                                                AND b.no_mesin = a.no_mesin 
                                                                            ) 
                                                                            AND a.`status` = 'SCHEDULE' 
                                                                            AND a.no_mesin = 'P3ST307'
                                                                            AND a.nourut = 0 
                                                                        ORDER BY
                                                                            CONCAT(
                                                                                SUBSTR(TRIM(a.no_mesin), - 5, 2),
                                                                            SUBSTR(TRIM(a.no_mesin), - 2 )) ASC,
                                                                            nourut ASC
                                                                        LIMIT 10");
                                $row_sum_qty    = mysqli_fetch_assoc($q_schedule_sum);
                                ?>
                                <span style="font-size: 10px; color: red"><?= (number_format($row_sum_qty['sum_qty'])) ?> Kg</span></h2>
                                <div class="kolom1">ST 07</div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $q_schedule = mysqli_query($con, "SELECT
                                                                    * 
                                                                FROM
                                                                    `tbl_schedule_new` a 
                                                                WHERE
                                                                    NOT EXISTS (
                                                                    SELECT
                                                                        1 
                                                                    FROM
                                                                        `tbl_produksi` b 
                                                                    WHERE
                                                                        b.nokk = a.nokk 
                                                                        AND b.demandno = a.nodemand 
                                                                        AND b.nama_mesin = a.operation 
                                                                        AND b.no_mesin = a.no_mesin 
                                                                    ) 
                                                                    AND a.`status` = 'SCHEDULE' 
                                                                    AND a.no_mesin = 'P3ST307' 
                                                                    AND NOT a.nourut = 0 
                                                                ORDER BY
                                                                    CONCAT(
                                                                        SUBSTR(TRIM(a.no_mesin), - 5, 2),
                                                                    SUBSTR(TRIM(a.no_mesin), - 2 )) ASC,
                                                                    nourut ASC
                                                                LIMIT 10");
                        ?>
                        <?php while ($row_schedule  = mysqli_fetch_array($q_schedule)) : ?>
                            <?php
                            $q_proses   = mysqli_query($con, "SELECT * FROM tbl_proses WHERE CONCAT(proses, ' (', jns, ')') = '$row_schedule[proses]'");
                            $row_proses = mysqli_fetch_assoc($q_proses);
                            if ($row_proses['ket_proses'] == 'kk/kain belum final proses') {
                                $warna  = "background-color: #FFFF00;";
                            } elseif ($row_proses['ket_proses'] == 'kk/kain finishing final proses') {
                                $warna  = "background-color: palegreen;";
                            } elseif ($row_proses['ket_proses'] == 'pedder') {
                                $warna  = "background-color: #FA8072; color: white;";
                            } elseif ($row_proses['ket_proses'] == 'preset') {
                                $warna  = "background-color: #2471A3; color: white;";
                            } else {
                                $warna = "";
                            }
                            ?>
                            <tr>
                                <td>
                                    <?php
                                    $status_mesin = mysqli_query($con, "SELECT proses, langganan, no_order, qty_order FROM tbl_schedule_new WHERE nodemand = '$row_schedule[nodemand]'");
                                    $row_statusmesin = mysqli_fetch_assoc($status_mesin);
                                    ?>
                                    <div class="kolom" title="<?= (htmlspecialchars($row_statusmesin['proses'] . "\n" . $row_statusmesin['langganan'] . "\n" . $row_statusmesin['no_order'] . "\n" . $row_statusmesin['qty_order'])); ?>" style="<?= $warna; ?>"><?= $row_schedule['nodemand']; ?></div>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
            <div style="flex: 1; margin-right: 5px;">
                <table border="0" width="5%">
                    <thead>
                        <tr>
                            <th>
                                <?php
                                $q_schedule_sum = mysqli_query($con, "SELECT
                                                                            SUM(qty_order) AS sum_qty
                                                                        FROM
                                                                            `tbl_schedule_new` a 
                                                                        WHERE
                                                                            NOT EXISTS (
                                                                            SELECT
                                                                                1 
                                                                            FROM
                                                                                `tbl_produksi` b 
                                                                            WHERE
                                                                                b.nokk = a.nokk 
                                                                                AND b.demandno = a.nodemand 
                                                                                AND b.nama_mesin = a.operation 
                                                                                AND b.no_mesin = a.no_mesin 
                                                                            ) 
                                                                            AND a.`status` = 'SCHEDULE' 
                                                                            AND a.no_mesin = 'P3ST208'
                                                                            AND a.nourut = 0 
                                                                        ORDER BY
                                                                            CONCAT(
                                                                                SUBSTR(TRIM(a.no_mesin), - 5, 2),
                                                                            SUBSTR(TRIM(a.no_mesin), - 2 )) ASC,
                                                                            nourut ASC
                                                                        LIMIT 10");
                                $row_sum_qty    = mysqli_fetch_assoc($q_schedule_sum);
                                ?>
                                <span style="font-size: 10px; color: red"><?= (number_format($row_sum_qty['sum_qty'])) ?> Kg</span></h2>
                                <div class="kolom1">ST 08</div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $q_schedule = mysqli_query($con, "SELECT
                                                                    * 
                                                                FROM
                                                                    `tbl_schedule_new` a 
                                                                WHERE
                                                                    NOT EXISTS (
                                                                    SELECT
                                                                        1 
                                                                    FROM
                                                                        `tbl_produksi` b 
                                                                    WHERE
                                                                        b.nokk = a.nokk 
                                                                        AND b.demandno = a.nodemand 
                                                                        AND b.nama_mesin = a.operation 
                                                                        AND b.no_mesin = a.no_mesin 
                                                                    ) 
                                                                    AND a.`status` = 'SCHEDULE' 
                                                                    AND a.no_mesin = 'P3ST208' 
                                                                    AND NOT a.nourut = 0 
                                                                ORDER BY
                                                                    CONCAT(
                                                                        SUBSTR(TRIM(a.no_mesin), - 5, 2),
                                                                    SUBSTR(TRIM(a.no_mesin), - 2 )) ASC,
                                                                    nourut ASC
                                                                LIMIT 10");
                        ?>
                        <?php while ($row_schedule  = mysqli_fetch_array($q_schedule)) : ?>
                            <?php
                            $q_proses   = mysqli_query($con, "SELECT * FROM tbl_proses WHERE CONCAT(proses, ' (', jns, ')') = '$row_schedule[proses]'");
                            $row_proses = mysqli_fetch_assoc($q_proses);
                            if ($row_proses['ket_proses'] == 'kk/kain belum final proses') {
                                $warna  = "background-color: #FFFF00;";
                            } elseif ($row_proses['ket_proses'] == 'kk/kain finishing final proses') {
                                $warna  = "background-color: palegreen;";
                            } elseif ($row_proses['ket_proses'] == 'pedder') {
                                $warna  = "background-color: #FA8072; color: white;";
                            } elseif ($row_proses['ket_proses'] == 'preset') {
                                $warna  = "background-color: #2471A3; color: white;";
                            } else {
                                $warna = "";
                            }
                            ?>
                            <tr>
                                <td>
                                    <?php
                                    $status_mesin = mysqli_query($con, "SELECT proses, langganan, no_order, qty_order FROM tbl_schedule_new WHERE nodemand = '$row_schedule[nodemand]'");
                                    $row_statusmesin = mysqli_fetch_assoc($status_mesin);
                                    ?>
                                    <div class="kolom" title="<?= (htmlspecialchars($row_statusmesin['proses'] . "\n" . $row_statusmesin['langganan'] . "\n" . $row_statusmesin['no_order'] . "\n" . $row_statusmesin['qty_order'])); ?>" style="<?= $warna; ?>"><?= $row_schedule['nodemand']; ?></div>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
            <div style="flex: 1; margin-right: 5px;">
                <table border="0" width="5%">
                    <thead>
                        <tr>
                            <th>
                                <?php
                                $q_schedule_sum = mysqli_query($con, "SELECT
                                                                            SUM(qty_order) AS sum_qty
                                                                        FROM
                                                                            `tbl_schedule_new` a 
                                                                        WHERE
                                                                            NOT EXISTS (
                                                                            SELECT
                                                                                1 
                                                                            FROM
                                                                                `tbl_produksi` b 
                                                                            WHERE
                                                                                b.nokk = a.nokk 
                                                                                AND b.demandno = a.nodemand 
                                                                                AND b.nama_mesin = a.operation 
                                                                                AND b.no_mesin = a.no_mesin 
                                                                            ) 
                                                                            AND a.`status` = 'SCHEDULE' 
                                                                            AND a.no_mesin = 'P3CP101'
                                                                            AND a.nourut = 0 
                                                                        ORDER BY
                                                                            CONCAT(
                                                                                SUBSTR(TRIM(a.no_mesin), - 5, 2),
                                                                            SUBSTR(TRIM(a.no_mesin), - 2 )) ASC,
                                                                            nourut ASC
                                                                        LIMIT 10");
                                $row_sum_qty    = mysqli_fetch_assoc($q_schedule_sum);
                                ?>
                                <span style="font-size: 10px; color: red"><?= (number_format($row_sum_qty['sum_qty'])) ?> Kg</span></h2>
                                <div class="kolom1">CP 01</div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $q_schedule = mysqli_query($con, "SELECT
                                                                    * 
                                                                FROM
                                                                    `tbl_schedule_new` a 
                                                                WHERE
                                                                    NOT EXISTS (
                                                                    SELECT
                                                                        1 
                                                                    FROM
                                                                        `tbl_produksi` b 
                                                                    WHERE
                                                                        b.nokk = a.nokk 
                                                                        AND b.demandno = a.nodemand 
                                                                        AND b.nama_mesin = a.operation 
                                                                        AND b.no_mesin = a.no_mesin 
                                                                    ) 
                                                                    AND a.`status` = 'SCHEDULE' 
                                                                    AND a.no_mesin = 'P3CP101' 
                                                                    AND NOT a.nourut = 0 
                                                                ORDER BY
                                                                    CONCAT(
                                                                        SUBSTR(TRIM(a.no_mesin), - 5, 2),
                                                                    SUBSTR(TRIM(a.no_mesin), - 2 )) ASC,
                                                                    nourut ASC
                                                                LIMIT 10");
                        ?>
                        <?php while ($row_schedule  = mysqli_fetch_array($q_schedule)) : ?>
                            <?php
                            $q_proses   = mysqli_query($con, "SELECT * FROM tbl_proses WHERE CONCAT(proses, ' (', jns, ')') = '$row_schedule[proses]'");
                            $row_proses = mysqli_fetch_assoc($q_proses);
                            if ($row_proses['ket_proses'] == 'kk/kain belum final proses') {
                                $warna  = "background-color: #FFFF00;";
                            } elseif ($row_proses['ket_proses'] == 'kk/kain finishing final proses') {
                                $warna  = "background-color: palegreen;";
                            } elseif ($row_proses['ket_proses'] == 'pedder') {
                                $warna  = "background-color: #FA8072; color: white;";
                            } elseif ($row_proses['ket_proses'] == 'preset') {
                                $warna  = "background-color: #2471A3; color: white;";
                            } else {
                                $warna = "";
                            }
                            ?>
                            <tr>
                                <td>
                                    <?php
                                    $status_mesin = mysqli_query($con, "SELECT proses, langganan, no_order, qty_order FROM tbl_schedule_new WHERE nodemand = '$row_schedule[nodemand]'");
                                    $row_statusmesin = mysqli_fetch_assoc($status_mesin);
                                    ?>
                                    <div class="kolom" title="<?= (htmlspecialchars($row_statusmesin['proses'] . "\n" . $row_statusmesin['langganan'] . "\n" . $row_statusmesin['no_order'] . "\n" . $row_statusmesin['qty_order'])); ?>" style="<?= $warna; ?>"><?= $row_schedule['nodemand']; ?></div>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
            <div style="flex: 1; margin-right: 5px;">
                <table border="0" width="5%">
                    <thead>
                        <tr>
                            <th>
                                <?php
                                $q_schedule_sum = mysqli_query($con, "SELECT
                                                                            SUM(qty_order) AS sum_qty
                                                                        FROM
                                                                            `tbl_schedule_new` a 
                                                                        WHERE
                                                                            NOT EXISTS (
                                                                            SELECT
                                                                                1 
                                                                            FROM
                                                                                `tbl_produksi` b 
                                                                            WHERE
                                                                                b.nokk = a.nokk 
                                                                                AND b.demandno = a.nodemand 
                                                                                AND b.nama_mesin = a.operation 
                                                                                AND b.no_mesin = a.no_mesin 
                                                                            ) 
                                                                            AND a.`status` = 'SCHEDULE' 
                                                                            AND a.no_mesin = 'P3CP102'
                                                                            AND a.nourut = 0 
                                                                        ORDER BY
                                                                            CONCAT(
                                                                                SUBSTR(TRIM(a.no_mesin), - 5, 2),
                                                                            SUBSTR(TRIM(a.no_mesin), - 2 )) ASC,
                                                                            nourut ASC
                                                                        LIMIT 10");
                                $row_sum_qty    = mysqli_fetch_assoc($q_schedule_sum);
                                ?>
                                <span style="font-size: 10px; color: red"><?= (number_format($row_sum_qty['sum_qty'])) ?> Kg</span></h2>
                                <div class="kolom1">CP 02</div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $q_schedule = mysqli_query($con, "SELECT
                                                                    * 
                                                                FROM
                                                                    `tbl_schedule_new` a 
                                                                WHERE
                                                                    NOT EXISTS (
                                                                    SELECT
                                                                        1 
                                                                    FROM
                                                                        `tbl_produksi` b 
                                                                    WHERE
                                                                        b.nokk = a.nokk 
                                                                        AND b.demandno = a.nodemand 
                                                                        AND b.nama_mesin = a.operation 
                                                                        AND b.no_mesin = a.no_mesin 
                                                                    ) 
                                                                    AND a.`status` = 'SCHEDULE' 
                                                                    AND a.no_mesin = 'P3CP102' 
                                                                    AND NOT a.nourut = 0 
                                                                ORDER BY
                                                                    CONCAT(
                                                                        SUBSTR(TRIM(a.no_mesin), - 5, 2),
                                                                    SUBSTR(TRIM(a.no_mesin), - 2 )) ASC,
                                                                    nourut ASC
                                                                LIMIT 10");
                        ?>
                        <?php while ($row_schedule  = mysqli_fetch_array($q_schedule)) : ?>
                            <?php
                            $q_proses   = mysqli_query($con, "SELECT * FROM tbl_proses WHERE CONCAT(proses, ' (', jns, ')') = '$row_schedule[proses]'");
                            $row_proses = mysqli_fetch_assoc($q_proses);
                            if ($row_proses['ket_proses'] == 'kk/kain belum final proses') {
                                $warna  = "background-color: #FFFF00;";
                            } elseif ($row_proses['ket_proses'] == 'kk/kain finishing final proses') {
                                $warna  = "background-color: palegreen;";
                            } elseif ($row_proses['ket_proses'] == 'pedder') {
                                $warna  = "background-color: #FA8072; color: white;";
                            } elseif ($row_proses['ket_proses'] == 'preset') {
                                $warna  = "background-color: #2471A3; color: white;";
                            } else {
                                $warna = "";
                            }
                            ?>
                            <tr>
                                <td>
                                    <?php
                                    $status_mesin = mysqli_query($con, "SELECT proses, langganan, no_order, qty_order FROM tbl_schedule_new WHERE nodemand = '$row_schedule[nodemand]'");
                                    $row_statusmesin = mysqli_fetch_assoc($status_mesin);
                                    ?>
                                    <div class="kolom" title="<?= (htmlspecialchars($row_statusmesin['proses'] . "\n" . $row_statusmesin['langganan'] . "\n" . $row_statusmesin['no_order'] . "\n" . $row_statusmesin['qty_order'])); ?>" style="<?= $warna; ?>"><?= $row_schedule['nodemand']; ?></div>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
            <div style="flex: 1; margin-right: 5px;">
                <table border="0" width="5%">
                    <thead>
                        <tr>
                            <th>
                                <?php
                                $q_schedule_sum = mysqli_query($con, "SELECT
                                                                            SUM(qty_order) AS sum_qty
                                                                        FROM
                                                                            `tbl_schedule_new` a 
                                                                        WHERE
                                                                            NOT EXISTS (
                                                                            SELECT
                                                                                1 
                                                                            FROM
                                                                                `tbl_produksi` b 
                                                                            WHERE
                                                                                b.nokk = a.nokk 
                                                                                AND b.demandno = a.nodemand 
                                                                                AND b.nama_mesin = a.operation 
                                                                                AND b.no_mesin = a.no_mesin 
                                                                            ) 
                                                                            AND a.`status` = 'SCHEDULE' 
                                                                            AND a.no_mesin = '#'
                                                                            AND a.nourut = 0 
                                                                        ORDER BY
                                                                            CONCAT(
                                                                                SUBSTR(TRIM(a.no_mesin), - 5, 2),
                                                                            SUBSTR(TRIM(a.no_mesin), - 2 )) ASC,
                                                                            nourut ASC
                                                                        LIMIT 10");
                                $row_sum_qty    = mysqli_fetch_assoc($q_schedule_sum);
                                ?>
                                <span style="font-size: 10px; color: red"><?= (number_format($row_sum_qty['sum_qty'])) ?> Kg</span></h2>
                                <div class="kolom1">OVEN FONG</div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $q_schedule = mysqli_query($con, "SELECT
                                                                    * 
                                                                FROM
                                                                    `tbl_schedule_new` a 
                                                                WHERE
                                                                    NOT EXISTS (
                                                                    SELECT
                                                                        1 
                                                                    FROM
                                                                        `tbl_produksi` b 
                                                                    WHERE
                                                                        b.nokk = a.nokk 
                                                                        AND b.demandno = a.nodemand 
                                                                        AND b.nama_mesin = a.operation 
                                                                        AND b.no_mesin = a.no_mesin 
                                                                    ) 
                                                                    AND a.`status` = 'SCHEDULE' 
                                                                    AND a.no_mesin = '#' 
                                                                    AND NOT a.nourut = 0 
                                                                ORDER BY
                                                                    CONCAT(
                                                                        SUBSTR(TRIM(a.no_mesin), - 5, 2),
                                                                    SUBSTR(TRIM(a.no_mesin), - 2 )) ASC,
                                                                    nourut ASC
                                                                LIMIT 10");
                        ?>
                        <?php while ($row_schedule  = mysqli_fetch_array($q_schedule)) : ?>
                            <?php
                            $q_proses   = mysqli_query($con, "SELECT * FROM tbl_proses WHERE CONCAT(proses, ' (', jns, ')') = '$row_schedule[proses]'");
                            $row_proses = mysqli_fetch_assoc($q_proses);
                            if ($row_proses['ket_proses'] == 'kk/kain belum final proses') {
                                $warna  = "background-color: #FFFF00;";
                            } elseif ($row_proses['ket_proses'] == 'kk/kain finishing final proses') {
                                $warna  = "background-color: palegreen;";
                            } elseif ($row_proses['ket_proses'] == 'pedder') {
                                $warna  = "background-color: #FA8072; color: white;";
                            } elseif ($row_proses['ket_proses'] == 'preset') {
                                $warna  = "background-color: #2471A3; color: white;";
                            } else {
                                $warna = "";
                            }
                            ?>
                            <tr>
                                <td>
                                    <?php
                                    $status_mesin = mysqli_query($con, "SELECT proses, langganan, no_order, qty_order FROM tbl_schedule_new WHERE nodemand = '$row_schedule[nodemand]'");
                                    $row_statusmesin = mysqli_fetch_assoc($status_mesin);
                                    ?>
                                    <div class="kolom" title="<?= (htmlspecialchars($row_statusmesin['proses'] . "\n" . $row_statusmesin['langganan'] . "\n" . $row_statusmesin['no_order'] . "\n" . $row_statusmesin['qty_order'])); ?>" style="<?= $warna; ?>"><?= $row_schedule['nodemand']; ?></div>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
            <div style="flex: 1; margin-right: 5px;">
                <table border="0" width="5%">
                    <thead>
                        <tr>
                            <th>
                                <?php
                                $q_schedule_sum = mysqli_query($con, "SELECT
                                                                            SUM(qty_order) AS sum_qty
                                                                        FROM
                                                                            `tbl_schedule_new` a 
                                                                        WHERE
                                                                            NOT EXISTS (
                                                                            SELECT
                                                                                1 
                                                                            FROM
                                                                                `tbl_produksi` b 
                                                                            WHERE
                                                                                b.nokk = a.nokk 
                                                                                AND b.demandno = a.nodemand 
                                                                                AND b.nama_mesin = a.operation 
                                                                                AND b.no_mesin = a.no_mesin 
                                                                            ) 
                                                                            AND a.`status` = 'SCHEDULE' 
                                                                            AND a.no_mesin = 'P3SM101'
                                                                            AND a.nourut = 0 
                                                                        ORDER BY
                                                                            CONCAT(
                                                                                SUBSTR(TRIM(a.no_mesin), - 5, 2),
                                                                            SUBSTR(TRIM(a.no_mesin), - 2 )) ASC,
                                                                            nourut ASC
                                                                        LIMIT 10");
                                $row_sum_qty    = mysqli_fetch_assoc($q_schedule_sum);
                                ?>
                                <span style="font-size: 10px; color: red"><?= (number_format($row_sum_qty['sum_qty'])) ?> Kg</span></h2>
                                <div class="kolom1">STEAM<br>&nbsp;</div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $q_schedule = mysqli_query($con, "SELECT
                                                                    * 
                                                                FROM
                                                                    `tbl_schedule_new` a 
                                                                WHERE
                                                                    NOT EXISTS (
                                                                    SELECT
                                                                        1 
                                                                    FROM
                                                                        `tbl_produksi` b 
                                                                    WHERE
                                                                        b.nokk = a.nokk 
                                                                        AND b.demandno = a.nodemand 
                                                                        AND b.nama_mesin = a.operation 
                                                                        AND b.no_mesin = a.no_mesin 
                                                                    ) 
                                                                    AND a.`status` = 'SCHEDULE' 
                                                                    AND a.no_mesin = 'P3SM101' 
                                                                    AND NOT a.nourut = 0 
                                                                ORDER BY
                                                                    CONCAT(
                                                                        SUBSTR(TRIM(a.no_mesin), - 5, 2),
                                                                    SUBSTR(TRIM(a.no_mesin), - 2 )) ASC,
                                                                    nourut ASC
                                                                LIMIT 10");
                        ?>
                        <?php while ($row_schedule  = mysqli_fetch_array($q_schedule)) : ?>
                            <?php
                            $q_proses   = mysqli_query($con, "SELECT * FROM tbl_proses WHERE CONCAT(proses, ' (', jns, ')') = '$row_schedule[proses]'");
                            $row_proses = mysqli_fetch_assoc($q_proses);
                            if ($row_proses['ket_proses'] == 'kk/kain belum final proses') {
                                $warna  = "background-color: #FFFF00;";
                            } elseif ($row_proses['ket_proses'] == 'kk/kain finishing final proses') {
                                $warna  = "background-color: palegreen;";
                            } elseif ($row_proses['ket_proses'] == 'pedder') {
                                $warna  = "background-color: #FA8072; color: white;";
                            } elseif ($row_proses['ket_proses'] == 'preset') {
                                $warna  = "background-color: #2471A3; color: white;";
                            } else {
                                $warna = "";
                            }
                            ?>
                            <tr>
                                <td>
                                    <?php
                                    $status_mesin = mysqli_query($con, "SELECT proses, langganan, no_order, qty_order FROM tbl_schedule_new WHERE nodemand = '$row_schedule[nodemand]'");
                                    $row_statusmesin = mysqli_fetch_assoc($status_mesin);
                                    ?>
                                    <div class="kolom" title="<?= (htmlspecialchars($row_statusmesin['proses'] . "\n" . $row_statusmesin['langganan'] . "\n" . $row_statusmesin['no_order'] . "\n" . $row_statusmesin['qty_order'])); ?>" style="<?= $warna; ?>"><?= $row_schedule['nodemand']; ?></div>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
            <div style="flex: 1; margin-right: 5px;">
                <table border="0" width="5%">
                    <thead>
                        <tr>
                            <th>
                                <?php
                                $q_schedule_sum = mysqli_query($con, "SELECT
                                                                            SUM(qty_order) AS sum_qty
                                                                        FROM
                                                                            `tbl_schedule_new` a 
                                                                        WHERE
                                                                            NOT EXISTS (
                                                                            SELECT
                                                                                1 
                                                                            FROM
                                                                                `tbl_produksi` b 
                                                                            WHERE
                                                                                b.nokk = a.nokk 
                                                                                AND b.demandno = a.nodemand 
                                                                                AND b.nama_mesin = a.operation 
                                                                                AND b.no_mesin = a.no_mesin 
                                                                            ) 
                                                                            AND a.`status` = 'SCHEDULE' 
                                                                            AND a.no_mesin = 'P3IN350'
                                                                            AND a.nourut = 0 
                                                                        ORDER BY
                                                                            CONCAT(
                                                                                SUBSTR(TRIM(a.no_mesin), - 5, 2),
                                                                            SUBSTR(TRIM(a.no_mesin), - 2 )) ASC,
                                                                            nourut ASC
                                                                        LIMIT 10");
                                $row_sum_qty    = mysqli_fetch_assoc($q_schedule_sum);
                                ?>
                                <span style="font-size: 10px; color: red"><?= (number_format($row_sum_qty['sum_qty'])) ?> Kg</span></h2>
                                <div class="kolom1">LIPAT<br>INSPEK</div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $q_schedule = mysqli_query($con, "SELECT
                                                                    * 
                                                                FROM
                                                                    `tbl_schedule_new` a 
                                                                WHERE
                                                                    NOT EXISTS (
                                                                    SELECT
                                                                        1 
                                                                    FROM
                                                                        `tbl_produksi` b 
                                                                    WHERE
                                                                        b.nokk = a.nokk 
                                                                        AND b.demandno = a.nodemand 
                                                                        AND b.nama_mesin = a.operation 
                                                                        AND b.no_mesin = a.no_mesin 
                                                                    ) 
                                                                    AND a.`status` = 'SCHEDULE' 
                                                                    AND a.no_mesin = 'P3IN350' 
                                                                    AND NOT a.nourut = 0 
                                                                ORDER BY
                                                                    CONCAT(
                                                                        SUBSTR(TRIM(a.no_mesin), - 5, 2),
                                                                    SUBSTR(TRIM(a.no_mesin), - 2 )) ASC,
                                                                    nourut ASC
                                                                LIMIT 10");
                        ?>
                        <?php while ($row_schedule  = mysqli_fetch_array($q_schedule)) : ?>
                            <?php
                            $q_proses   = mysqli_query($con, "SELECT * FROM tbl_proses WHERE CONCAT(proses, ' (', jns, ')') = '$row_schedule[proses]'");
                            $row_proses = mysqli_fetch_assoc($q_proses);
                            if ($row_proses['ket_proses'] == 'kk/kain belum final proses') {
                                $warna  = "background-color: #FFFF00;";
                            } elseif ($row_proses['ket_proses'] == 'kk/kain finishing final proses') {
                                $warna  = "background-color: palegreen;";
                            } elseif ($row_proses['ket_proses'] == 'pedder') {
                                $warna  = "background-color: #FA8072; color: white;";
                            } elseif ($row_proses['ket_proses'] == 'preset') {
                                $warna  = "background-color: #2471A3; color: white;";
                            } else {
                                $warna = "";
                            }
                            ?>
                            <tr>
                                <td>
                                    <?php
                                    $status_mesin = mysqli_query($con, "SELECT proses, langganan, no_order, qty_order FROM tbl_schedule_new WHERE nodemand = '$row_schedule[nodemand]'");
                                    $row_statusmesin = mysqli_fetch_assoc($status_mesin);
                                    ?>
                                    <div class="kolom" title="<?= (htmlspecialchars($row_statusmesin['proses'] . "\n" . $row_statusmesin['langganan'] . "\n" . $row_statusmesin['no_order'] . "\n" . $row_statusmesin['qty_order'])); ?>" style="<?= $warna; ?>"><?= $row_schedule['nodemand']; ?></div>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
            <div style="flex: 1; margin-right: 5px;">
                <table border="0" width="5%">
                    <thead>
                        <tr>
                            <th>
                                <?php
                                $q_schedule_sum = mysqli_query($con, "SELECT
                                                                            SUM(qty_order) AS sum_qty
                                                                        FROM
                                                                            `tbl_schedule_new` a 
                                                                        WHERE
                                                                            NOT EXISTS (
                                                                            SELECT
                                                                                1 
                                                                            FROM
                                                                                `tbl_produksi` b 
                                                                            WHERE
                                                                                b.nokk = a.nokk 
                                                                                AND b.demandno = a.nodemand 
                                                                                AND b.nama_mesin = a.operation 
                                                                                AND b.no_mesin = a.no_mesin 
                                                                            ) 
                                                                            AND a.`status` = 'SCHEDULE' 
                                                                            AND a.no_mesin = '#'
                                                                            AND a.nourut = 0 
                                                                        ORDER BY
                                                                            CONCAT(
                                                                                SUBSTR(TRIM(a.no_mesin), - 5, 2),
                                                                            SUBSTR(TRIM(a.no_mesin), - 2 )) ASC,
                                                                            nourut ASC
                                                                        LIMIT 10");
                                $row_sum_qty    = mysqli_fetch_assoc($q_schedule_sum);
                                ?>
                                <span style="font-size: 10px; color: red"><?= (number_format($row_sum_qty['sum_qty'])) ?> Kg</span></h2>
                                <div class="kolom1">BC 01</div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $q_schedule = mysqli_query($con, "SELECT
                                                                    * 
                                                                FROM
                                                                    `tbl_schedule_new` a 
                                                                WHERE
                                                                    NOT EXISTS (
                                                                    SELECT
                                                                        1 
                                                                    FROM
                                                                        `tbl_produksi` b 
                                                                    WHERE
                                                                        b.nokk = a.nokk 
                                                                        AND b.demandno = a.nodemand 
                                                                        AND b.nama_mesin = a.operation 
                                                                        AND b.no_mesin = a.no_mesin 
                                                                    ) 
                                                                    AND a.`status` = 'SCHEDULE' 
                                                                    AND a.no_mesin = '#' 
                                                                    AND NOT a.nourut = 0 
                                                                ORDER BY
                                                                    CONCAT(
                                                                        SUBSTR(TRIM(a.no_mesin), - 5, 2),
                                                                    SUBSTR(TRIM(a.no_mesin), - 2 )) ASC,
                                                                    nourut ASC
                                                                LIMIT 10");
                        ?>
                        <?php while ($row_schedule  = mysqli_fetch_array($q_schedule)) : ?>
                            <?php
                            $q_proses   = mysqli_query($con, "SELECT * FROM tbl_proses WHERE CONCAT(proses, ' (', jns, ')') = '$row_schedule[proses]'");
                            $row_proses = mysqli_fetch_assoc($q_proses);
                            if ($row_proses['ket_proses'] == 'kk/kain belum final proses') {
                                $warna  = "background-color: #FFFF00;";
                            } elseif ($row_proses['ket_proses'] == 'kk/kain finishing final proses') {
                                $warna  = "background-color: palegreen;";
                            } elseif ($row_proses['ket_proses'] == 'pedder') {
                                $warna  = "background-color: #FA8072; color: white;";
                            } elseif ($row_proses['ket_proses'] == 'preset') {
                                $warna  = "background-color: #2471A3; color: white;";
                            } else {
                                $warna = "";
                            }
                            ?>
                            <tr>
                                <td>
                                    <?php
                                    $status_mesin = mysqli_query($con, "SELECT proses, langganan, no_order, qty_order FROM tbl_schedule_new WHERE nodemand = '$row_schedule[nodemand]'");
                                    $row_statusmesin = mysqli_fetch_assoc($status_mesin);
                                    ?>
                                    <div class="kolom" title="<?= (htmlspecialchars($row_statusmesin['proses'] . "\n" . $row_statusmesin['langganan'] . "\n" . $row_statusmesin['no_order'] . "\n" . $row_statusmesin['qty_order'])); ?>" style="<?= $warna; ?>"><?= $row_schedule['nodemand']; ?></div>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
            <div style="flex: 1; margin-right: 5px;">
                <table border="0" width="5%">
                    <thead>
                        <tr>
                            <th>
                                <?php
                                $q_schedule_sum = mysqli_query($con, "SELECT
                                                                            SUM(qty_order) AS sum_qty
                                                                        FROM
                                                                            `tbl_schedule_new` a 
                                                                        WHERE
                                                                            NOT EXISTS (
                                                                            SELECT
                                                                                1 
                                                                            FROM
                                                                                `tbl_produksi` b 
                                                                            WHERE
                                                                                b.nokk = a.nokk 
                                                                                AND b.demandno = a.nodemand 
                                                                                AND b.nama_mesin = a.operation 
                                                                                AND b.no_mesin = a.no_mesin 
                                                                            ) 
                                                                            AND a.`status` = 'SCHEDULE' 
                                                                            AND a.no_mesin = '#'
                                                                            AND a.nourut = 0 
                                                                        ORDER BY
                                                                            CONCAT(
                                                                                SUBSTR(TRIM(a.no_mesin), - 5, 2),
                                                                            SUBSTR(TRIM(a.no_mesin), - 2 )) ASC,
                                                                            nourut ASC
                                                                        LIMIT 10");
                                $row_sum_qty    = mysqli_fetch_assoc($q_schedule_sum);
                                ?>
                                <span style="font-size: 10px; color: red"><?= (number_format($row_sum_qty['sum_qty'])) ?> Kg</span></h2>
                                <div class="kolom1">BC 02</div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $q_schedule = mysqli_query($con, "SELECT
                                                                    * 
                                                                FROM
                                                                    `tbl_schedule_new` a 
                                                                WHERE
                                                                    NOT EXISTS (
                                                                    SELECT
                                                                        1 
                                                                    FROM
                                                                        `tbl_produksi` b 
                                                                    WHERE
                                                                        b.nokk = a.nokk 
                                                                        AND b.demandno = a.nodemand 
                                                                        AND b.nama_mesin = a.operation 
                                                                        AND b.no_mesin = a.no_mesin 
                                                                    ) 
                                                                    AND a.`status` = 'SCHEDULE' 
                                                                    AND a.no_mesin = '#' 
                                                                    AND NOT a.nourut = 0 
                                                                ORDER BY
                                                                    CONCAT(
                                                                        SUBSTR(TRIM(a.no_mesin), - 5, 2),
                                                                    SUBSTR(TRIM(a.no_mesin), - 2 )) ASC,
                                                                    nourut ASC
                                                                LIMIT 10");
                        ?>
                        <?php while ($row_schedule  = mysqli_fetch_array($q_schedule)) : ?>
                            <?php
                            $q_proses   = mysqli_query($con, "SELECT * FROM tbl_proses WHERE CONCAT(proses, ' (', jns, ')') = '$row_schedule[proses]'");
                            $row_proses = mysqli_fetch_assoc($q_proses);
                            if ($row_proses['ket_proses'] == 'kk/kain belum final proses') {
                                $warna  = "background-color: #FFFF00;";
                            } elseif ($row_proses['ket_proses'] == 'kk/kain finishing final proses') {
                                $warna  = "background-color: palegreen;";
                            } elseif ($row_proses['ket_proses'] == 'pedder') {
                                $warna  = "background-color: #FA8072; color: white;";
                            } elseif ($row_proses['ket_proses'] == 'preset') {
                                $warna  = "background-color: #2471A3; color: white;";
                            } else {
                                $warna = "";
                            }
                            ?>
                            <tr>
                                <td>
                                    <?php
                                    $status_mesin = mysqli_query($con, "SELECT proses, langganan, no_order, qty_order FROM tbl_schedule_new WHERE nodemand = '$row_schedule[nodemand]'");
                                    $row_statusmesin = mysqli_fetch_assoc($status_mesin);
                                    ?>
                                    <div class="kolom" title="<?= (htmlspecialchars($row_statusmesin['proses'] . "\n" . $row_statusmesin['langganan'] . "\n" . $row_statusmesin['no_order'] . "\n" . $row_statusmesin['qty_order'])); ?>" style="<?= $warna; ?>"><?= $row_schedule['nodemand']; ?></div>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
            <div style="flex: 1; margin-right: 5px;">
                <table border="0" width="5%">
                    <thead>
                        <tr>
                            <th>
                                <?php
                                $q_schedule_sum = mysqli_query($con, "SELECT
                                                                            SUM(qty_order) AS sum_qty
                                                                        FROM
                                                                            `tbl_schedule_new` a 
                                                                        WHERE
                                                                            NOT EXISTS (
                                                                            SELECT
                                                                                1 
                                                                            FROM
                                                                                `tbl_produksi` b 
                                                                            WHERE
                                                                                b.nokk = a.nokk 
                                                                                AND b.demandno = a.nodemand 
                                                                                AND b.nama_mesin = a.operation 
                                                                                AND b.no_mesin = a.no_mesin 
                                                                            ) 
                                                                            AND a.`status` = 'SCHEDULE' 
                                                                            AND a.no_mesin = '#'
                                                                            AND a.nourut = 0 
                                                                        ORDER BY
                                                                            CONCAT(
                                                                                SUBSTR(TRIM(a.no_mesin), - 5, 2),
                                                                            SUBSTR(TRIM(a.no_mesin), - 2 )) ASC,
                                                                            nourut ASC
                                                                        LIMIT 10");
                                $row_sum_qty    = mysqli_fetch_assoc($q_schedule_sum);
                                ?>
                                <span style="font-size: 10px; color: red"><?= (number_format($row_sum_qty['sum_qty'])) ?> Kg</span></h2>
                                <div class="kolom1">BC 03</div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $q_schedule = mysqli_query($con, "SELECT
                                                                    * 
                                                                FROM
                                                                    `tbl_schedule_new` a 
                                                                WHERE
                                                                    NOT EXISTS (
                                                                    SELECT
                                                                        1 
                                                                    FROM
                                                                        `tbl_produksi` b 
                                                                    WHERE
                                                                        b.nokk = a.nokk 
                                                                        AND b.demandno = a.nodemand 
                                                                        AND b.nama_mesin = a.operation 
                                                                        AND b.no_mesin = a.no_mesin 
                                                                    ) 
                                                                    AND a.`status` = 'SCHEDULE' 
                                                                    AND a.no_mesin = '#' 
                                                                    AND NOT a.nourut = 0 
                                                                ORDER BY
                                                                    CONCAT(
                                                                        SUBSTR(TRIM(a.no_mesin), - 5, 2),
                                                                    SUBSTR(TRIM(a.no_mesin), - 2 )) ASC,
                                                                    nourut ASC
                                                                LIMIT 10");
                        ?>
                        <?php while ($row_schedule  = mysqli_fetch_array($q_schedule)) : ?>
                            <?php
                            $q_proses   = mysqli_query($con, "SELECT * FROM tbl_proses WHERE CONCAT(proses, ' (', jns, ')') = '$row_schedule[proses]'");
                            $row_proses = mysqli_fetch_assoc($q_proses);
                            if ($row_proses['ket_proses'] == 'kk/kain belum final proses') {
                                $warna  = "background-color: #FFFF00;";
                            } elseif ($row_proses['ket_proses'] == 'kk/kain finishing final proses') {
                                $warna  = "background-color: palegreen;";
                            } elseif ($row_proses['ket_proses'] == 'pedder') {
                                $warna  = "background-color: #FA8072; color: white;";
                            } elseif ($row_proses['ket_proses'] == 'preset') {
                                $warna  = "background-color: #2471A3; color: white;";
                            } else {
                                $warna = "";
                            }
                            ?>
                            <tr>
                                <td>
                                    <?php
                                    $status_mesin = mysqli_query($con, "SELECT proses, langganan, no_order, qty_order FROM tbl_schedule_new WHERE nodemand = '$row_schedule[nodemand]'");
                                    $row_statusmesin = mysqli_fetch_assoc($status_mesin);
                                    ?>
                                    <div class="kolom" title="<?= (htmlspecialchars($row_statusmesin['proses'] . "\n" . $row_statusmesin['langganan'] . "\n" . $row_statusmesin['no_order'] . "\n" . $row_statusmesin['qty_order'])); ?>" style="<?= $warna; ?>"><?= $row_schedule['nodemand']; ?></div>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
            <div style="flex: 1; margin-right: 5px;">
                <table border="0" width="5%">
                    <thead>
                        <tr>
                            <th>
                                <?php
                                $q_schedule_sum = mysqli_query($con, "SELECT
                                                                            SUM(qty_order) AS sum_qty
                                                                        FROM
                                                                            `tbl_schedule_new` a 
                                                                        WHERE
                                                                            NOT EXISTS (
                                                                            SELECT
                                                                                1 
                                                                            FROM
                                                                                `tbl_produksi` b 
                                                                            WHERE
                                                                                b.nokk = a.nokk 
                                                                                AND b.demandno = a.nodemand 
                                                                                AND b.nama_mesin = a.operation 
                                                                                AND b.no_mesin = a.no_mesin 
                                                                            ) 
                                                                            AND a.`status` = 'SCHEDULE' 
                                                                            AND a.no_mesin = '#'
                                                                            AND a.nourut = 0 
                                                                        ORDER BY
                                                                            CONCAT(
                                                                                SUBSTR(TRIM(a.no_mesin), - 5, 2),
                                                                            SUBSTR(TRIM(a.no_mesin), - 2 )) ASC,
                                                                            nourut ASC
                                                                        LIMIT 10");
                                $row_sum_qty    = mysqli_fetch_assoc($q_schedule_sum);
                                ?>
                                <span style="font-size: 10px; color: red"><?= (number_format($row_sum_qty['sum_qty'])) ?> Kg</span></h2>
                                <div class="kolom1">BC 04</div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $q_schedule = mysqli_query($con, "SELECT
                                                                    * 
                                                                FROM
                                                                    `tbl_schedule_new` a 
                                                                WHERE
                                                                    NOT EXISTS (
                                                                    SELECT
                                                                        1 
                                                                    FROM
                                                                        `tbl_produksi` b 
                                                                    WHERE
                                                                        b.nokk = a.nokk 
                                                                        AND b.demandno = a.nodemand 
                                                                        AND b.nama_mesin = a.operation 
                                                                        AND b.no_mesin = a.no_mesin 
                                                                    ) 
                                                                    AND a.`status` = 'SCHEDULE' 
                                                                    AND a.no_mesin = '#' 
                                                                    AND NOT a.nourut = 0 
                                                                ORDER BY
                                                                    CONCAT(
                                                                        SUBSTR(TRIM(a.no_mesin), - 5, 2),
                                                                    SUBSTR(TRIM(a.no_mesin), - 2 )) ASC,
                                                                    nourut ASC
                                                                LIMIT 10");
                        ?>
                        <?php while ($row_schedule  = mysqli_fetch_array($q_schedule)) : ?>
                            <?php
                            $q_proses   = mysqli_query($con, "SELECT * FROM tbl_proses WHERE CONCAT(proses, ' (', jns, ')') = '$row_schedule[proses]'");
                            $row_proses = mysqli_fetch_assoc($q_proses);
                            if ($row_proses['ket_proses'] == 'kk/kain belum final proses') {
                                $warna  = "background-color: #FFFF00;";
                            } elseif ($row_proses['ket_proses'] == 'kk/kain finishing final proses') {
                                $warna  = "background-color: palegreen;";
                            } elseif ($row_proses['ket_proses'] == 'pedder') {
                                $warna  = "background-color: #FA8072; color: white;";
                            } elseif ($row_proses['ket_proses'] == 'preset') {
                                $warna  = "background-color: #2471A3; color: white;";
                            } else {
                                $warna = "";
                            }
                            ?>
                            <tr>
                                <td>
                                    <?php
                                    $status_mesin = mysqli_query($con, "SELECT proses, langganan, no_order, qty_order FROM tbl_schedule_new WHERE nodemand = '$row_schedule[nodemand]'");
                                    $row_statusmesin = mysqli_fetch_assoc($status_mesin);
                                    ?>
                                    <div class="kolom" title="<?= (htmlspecialchars($row_statusmesin['proses'] . "\n" . $row_statusmesin['langganan'] . "\n" . $row_statusmesin['no_order'] . "\n" . $row_statusmesin['qty_order'])); ?>" style="<?= $warna; ?>"><?= $row_schedule['nodemand']; ?></div>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <td colspan="4">kk/kain belum final proses <span class="small-box1"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td colspan="4">kk/kain finishing final proses <span class="small-box2"></span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td colspan="4">Pedder <span class="small-box3"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td colspan="4">Preset <span class="small-box4"></span></td>
        <br>
        <br>
        <marquee class="teks-berjalan" behavior="scroll" direction="left" onmouseover="this.stop();" onmouseout="this.start();" style="font-size: 20px; background-color: #CD6155; color: #F8F9F9;">
            UTAMAKAN KESELAMATAN KERJA, TINGKATKAN PRODUKTIFITAS, KURANGI MASALAH, KURANGI LOSS WAKTU DAN JAGA 5R DI LINGKUNGAN KERJA :: UTAMAKAN KESEHATAN DAN KESELAMATAN KERJA, SELALU MENGGUNAKAN ALAT PELINDUNG DIRI, JAGA 5R, DAN SELALU WASPADA TERHADAP PENYEBARAN COVID-19
        </marquee>
    </div>
    <br>

</body>

</html>