<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<?php include('../koneksi.php'); ?>
<body>
    <table width="100%" border="1">
        <tbody>
            <tr>
                <?php
                    $q_nomesin = mysqli_query($con, "SELECT DISTINCT
                                                        CONCAT(SUBSTR( TRIM( no_mesin ), - 5, 2 ), SUBSTR( TRIM( no_mesin ), - 2 )) AS nomesin 
                                                    FROM
                                                        `tbl_schedule_new` 
                                                    ORDER BY
                                                        CONCAT(SUBSTR( TRIM( no_mesin ), - 5, 2 ), SUBSTR( TRIM( no_mesin ), - 2 )) ASC, nourut ASC");
                ?>
                <?php while ($row_nomesin = mysqli_fetch_array($q_nomesin)) : ?>
                    <td><?= $row_nomesin['nomesin']; ?></td>
                <?php endwhile; ?>
            </tr>
        </tbody>
    </table>
</body>
</html>