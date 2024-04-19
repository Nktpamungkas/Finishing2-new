<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<?php include('../koneksi.php'); ?>
<body>
    <table width="100%">
        <tbody>
            <tr>
                <?php
                    $q_nomesin = mysqli_query($con, "SELECT
                                                        a.nama_mesin
                                                    FROM
                                                        `tbl_masuk` a
                                                    WHERE
                                                        NOT EXISTS (
                                                                SELECT 1
                                                                FROM
                                                                    `tbl_schedule_new` b
                                                                WHERE
                                                                    b.nokk = a.nokk 
                                                                    AND b.nodemand = a.nodemand 
                                                                    AND b.operation = a.operation
                                                        )
                                                    GROUP BY
                                                        a.nama_mesin
                                                    ORDER BY
                                                        a.nama_mesin ASC");
                ?>
                <?php while ($row_nomesin = mysqli_fetch_array($q_nomesin)) : ?>
                    <td style="border:1px solid;vertical-align:middle; text-align: center; background-color: #F1F1F1;">
                        <span style="border:1px solid; background-color: #C0F3FC; font-size: 12px;"><?= $row_nomesin['nama_mesin']; ?></span>
                    </td>
                <?php endwhile; ?>
            </tr>
        </tbody>
    </table>
</body>
</html>