<?php require_once 'header.php'; ?>
<title><?php $title = "PPC - Memo Penting"; echo $title; ?></title>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Dashboard</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">DataTable with default features</h3>
                    </div>
                    <div class="card-body">
                        <table id="harian-fin" class="table table-bordered table-striped">
                            <thead>
                                <tr align="center">
                                    <th>TGL TERIMA ORDER</th>
                                    <th>PELANGGAN</th>
                                    <th>NO. ORDER</th>
                                    <th>NO. PO</th>
                                    <th>KETERANGAN PRODUK</th>
                                    <th>LEBAR</th>
                                    <th>GRAMASI</th>
                                    <th>WARNA</th>
                                    <th>NO WARNA</th>
                                    <th>DELIVERY</th>
                                    <th>BAGI KAIN TGL</th>
                                    <th>KG (Bruto)</th>
                                    <th>delay</th>
                                    <th>STATUS TERAKHIR</th>
                                    <th>NO KARTU KERJA</th>
                                    <th>catatan po greige</th>
                                    <th>target selesai</th>
                                    <th>ket</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    ini_set("error_reporting", 1);
                                    session_start();
                                    require_once "koneksi.php";
                                    $no_order = $_GET['no_order'];
                                    $tgl1     = $_GET['tgl1'];
                                    $tgl2     = $_GET['tgl2'];

                                    if ($no_order) {
                                        $sqlDB2="SELECT 
                                                    s2.ORDERDATE AS TGLTERIMAORDER,
                                                    s.PROJECTCODE AS ORDER,
                                                    s2.REQUIREDDUEDATE AS DELIVERY,
                                                    s.EXTERNALREFERENCE AS PO,
                                                    s2.FNCORDPRNCUSTOMERSUPPLIERCODE AS KODE_PELANGGAN,
                                                    o.ORDERBUSINESSPARTNERNUMBERID,
                                                    b.LEGALNAME1 AS PELANGGAN,
                                                    s.ORDERLINE,
                                                    trim( LONGDESCRIPTION ) AS WARNA,
                                                    trim( ITEMDESCRIPTION ) AS JENISKAIN,
                                                    trim( p.CODE ) AS KK,
                                                    trim( s.SUBCODE01 ) AS SUBCODE01,
                                                    trim( s.SUBCODE02 ) AS SUBCODE02,
                                                    trim( s.SUBCODE03 ) AS SUBCODE03,
                                                    trim( s.SUBCODE04 ) AS SUBCODE04,
                                                    trim( s.SUBCODE05 ) AS SUBCODE05,
                                                    trim( s.SUBCODE06 ) AS SUBCODE06,
                                                    trim( s.SUBCODE07 ) AS SUBCODE07,
                                                    trim( s.SUBCODE08 ) AS SUBCODE08
                                                FROM 
                                                    SALESORDERLINE s 
                                                    LEFT JOIN SALESORDER s2 ON s2.CODE = s.PROJECTCODE
                                                    RIGHT JOIN ORDERPARTNER o ON o.CUSTOMERSUPPLIERCODE = s2.FNCORDPRNCUSTOMERSUPPLIERCODE
                                                    RIGHT JOIN BUSINESSPARTNER b ON b.NUMBERID = o.ORDERBUSINESSPARTNERNUMBERID
                                                    LEFT JOIN USERGENERICGROUP u ON u.CODE = s.SUBCODE05
                                                    LEFT JOIN PRODUCTIONDEMAND p ON p.PROJECTCODE = s.PROJECTCODE AND p.ITEMTYPEAFICODE = s.ITEMTYPEAFICODE 
                                                                                                                AND p.SUBCODE01 =  s.SUBCODE01 AND p.SUBCODE02 =  s.SUBCODE02
                                                                                                                AND p.SUBCODE03 =  s.SUBCODE03 AND p.SUBCODE04 =  s.SUBCODE04
                                                                                                                AND p.SUBCODE05 =  s.SUBCODE05 AND p.SUBCODE06 =  s.SUBCODE06
                                                                                                                AND p.SUBCODE07 =  s.SUBCODE07 AND p.SUBCODE08 =  s.SUBCODE08
                                                                                                                AND p.DLVSALESORDERLINEORDERLINE = s.ORDERLINE
                                                WHERE
                                                    s.PROJECTCODE = '$no_order' AND NOT p.CODE ISNULL";
                                    } else {
                                        $sqlDB2="SELECT 
                                                    s2.ORDERDATE AS TGLTERIMAORDER,
                                                    s.PROJECTCODE AS ORDER,
                                                    s2.REQUIREDDUEDATE AS DELIVERY,
                                                    s.EXTERNALREFERENCE AS PO,
                                                    s2.FNCORDPRNCUSTOMERSUPPLIERCODE AS KODE_PELANGGAN,
                                                    o.ORDERBUSINESSPARTNERNUMBERID,
                                                    b.LEGALNAME1 AS PELANGGAN,
                                                    s.ORDERLINE,
                                                    trim( LONGDESCRIPTION ) AS WARNA,
                                                    trim( ITEMDESCRIPTION ) AS JENISKAIN,
                                                    trim( p.CODE ) AS KK,
                                                    trim( s.SUBCODE01 ) AS SUBCODE01,
                                                    trim( s.SUBCODE02 ) AS SUBCODE02,
                                                    trim( s.SUBCODE03 ) AS SUBCODE03,
                                                    trim( s.SUBCODE04 ) AS SUBCODE04,
                                                    trim( s.SUBCODE05 ) AS SUBCODE05,
                                                    trim( s.SUBCODE06 ) AS SUBCODE06,
                                                    trim( s.SUBCODE07 ) AS SUBCODE07,
                                                    trim( s.SUBCODE08 ) AS SUBCODE08
                                                FROM 
                                                    SALESORDERLINE s 
                                                    LEFT JOIN SALESORDER s2 ON s2.CODE = s.PROJECTCODE
                                                    RIGHT JOIN ORDERPARTNER o ON o.CUSTOMERSUPPLIERCODE = s2.FNCORDPRNCUSTOMERSUPPLIERCODE
                                                    RIGHT JOIN BUSINESSPARTNER b ON b.NUMBERID = o.ORDERBUSINESSPARTNERNUMBERID
                                                    LEFT JOIN USERGENERICGROUP u ON u.CODE = s.SUBCODE05 
                                                    LEFT JOIN PRODUCTIONDEMAND p ON p.PROJECTCODE = s.PROJECTCODE AND p.ITEMTYPEAFICODE = s.ITEMTYPEAFICODE 
                                                                                                                AND p.SUBCODE01 =  s.SUBCODE01 AND p.SUBCODE02 =  s.SUBCODE02
                                                                                                                AND p.SUBCODE03 =  s.SUBCODE03 AND p.SUBCODE04 =  s.SUBCODE04
                                                                                                                AND p.SUBCODE05 =  s.SUBCODE05 AND p.SUBCODE06 =  s.SUBCODE06
                                                                                                                AND p.SUBCODE07 =  s.SUBCODE07 AND p.SUBCODE08 =  s.SUBCODE08
                                                                                                                AND p.DLVSALESORDERLINEORDERLINE = s.ORDERLINE
                                                WHERE
                                                    s2.REQUIREDDUEDATE BETWEEN '$tgl1' AND '$tgl2' AND NOT p.CODE ISNULL";
                                    }

                                    $stmt=db2_exec($conn1,$sqlDB2, array('cursor'=>DB2_SCROLLABLE));
                                    while ($rowdb2 = db2_fetch_assoc($stmt)) {
                                        $kodepelanggan = $rowdb2['KODE_PELANGGAN'];
                                        // $order = $rowdb2['ORDER'];
                                        // $s1 = $rowdb2['SUBCODE01']; $s2 = $rowdb2['SUBCODE02']; $s3 = $rowdb2['SUBCODE03']; $s4 = $rowdb2['SUBCODE04'];
                                        // $s5 = $rowdb2['SUBCODE05']; $s6 = $rowdb2['SUBCODE06']; $s7 = $rowdb2['SUBCODE07']; $s8 = $rowdb2['SUBCODE08'];
                                        // // LEBAR
                                        // $sqlLebar = "SELECT A.NAMENAME,A.VALUEDECIMAL AS LEBAR
                                        //                 FROM
                                        //                     ADSTORAGE a 
                                        //                     RIGHT JOIN (SELECT * FROM PRODUCT p )p ON p.ABSUNIQUEID = A.UNIQUEID
                                        //                 WHERE
                                        //                     a.NAMENAME = 'Width' AND p.SUBCODE01 = '$s1' AND p.SUBCODE02 = '$s2' AND p.SUBCODE03 = '$s3' AND p.SUBCODE04 = '$s4' AND
                                        //                     p.SUBCODE05 = '$s5' AND p.SUBCODE06 = '$s6' AND p.SUBCODE07 = '$s7' AND p.SUBCODE08 = '$s8'";  
                                        // $stmt_lebar = db2_exec($conn1,$sqlLebar, array('cursor'=>DB2_SCROLLABLE));
                                        // $rowdb2_lebar = db2_fetch_assoc($stmt_lebar);
                                        // // GRAMASI
                                        // $sqlGramasi = "SELECT A.NAMENAME,A.VALUEDECIMAL AS GRAMASI
                                        //                 FROM
                                        //                     ADSTORAGE a 
                                        //                     RIGHT JOIN PRODUCT p ON p.ABSUNIQUEID = A.UNIQUEID
                                        //                 WHERE
                                        //                     a.NAMENAME = 'GSM' AND p.SUBCODE01 = '$s1' AND p.SUBCODE02 = '$s2' AND p.SUBCODE03 = '$s3' AND p.SUBCODE04 = '$s4' AND p.SUBCODE05 = '$s5' AND
                                        //                     p.SUBCODE06 = '$s6' AND p.SUBCODE07 = '$s7' AND p.SUBCODE08 = '$s8'";
                                        // $stmt_gramasi = db2_exec($conn1,$sqlGramasi, array('cursor'=>DB2_SCROLLABLE));
                                        // $rowdb2_gramasi = db2_fetch_assoc($stmt_gramasi);

                                        // // KG BRUTO
                                        // $sqlKg = "SELECT SUM(USERPRIMARYQUANTITY) AS KG_BRUTO FROM PRODUCTIONDEMAND WHERE SUBCODE03 = '$s3' AND PROJECTCODE = '$order' AND ITEMTYPEAFICODE = 'KGF'";
                                        // $stmt_kg = db2_exec($conn1,$sqlKg, array('cursor'=>DB2_SCROLLABLE));
                                        // $rowdb2_kg = db2_fetch_assoc($stmt_kg);

                                        // // STATUS TERAKHIR
                                        // $demand = $rowdb2_kk['KK'];
                                        // $sqlstatus = "SELECT trim(OPERATIONCODE) AS OPERATIONCODE, LONGDESCRIPTION FROM PRODUCTIONDEMANDSTEP WHERE PRODUCTIONDEMANDCODE = '$demand' ORDER BY STEPNUMBER DESC LIMIT 1";
                                        // $stmt_status = db2_exec($conn1,$sqlstatus, array('cursor'=>DB2_SCROLLABLE));
                                        // $rowdb2_status = db2_fetch_assoc($stmt_status);

                                        // // CATATAN PO GREIGE
                                        // $sqlcatatanpogreiege = "SELECT * FROM PRODUCTIONDEMAND WHERE SUBCODE03 = '$s3' AND PROJECTCODE = '$order' AND ITEMTYPEAFICODE = 'KGF'";
                                        // $stmt_catatanpogreiege = db2_exec($conn1,$sqlcatatanpogreiege, array('cursor'=>DB2_SCROLLABLE));
                                        // $rowdb2_catatanpogreiege = db2_fetch_assoc($stmt_catatanpogreiege);

                                        // // BAGI KAIN
                                        // $sqlbagikain = "SELECT trim( ISSUEDATE ) AS BAGIKAIN FROM PRODUCTIONRESERVATION WHERE PROJECTCODE = '$order' AND ORDERCODE = '$demand' AND ITEMTYPEAFICODE ='KGF'";
                                        // $stmt_bagi = db2_exec($conn1,$sqlbagikain, array('cursor'=>DB2_SCROLLABLE));
                                        // $rowdb2_bagikain = db2_fetch_assoc($stmt_bagi);
                                ?>
                                <?php // if ($rowdb2_status['OPERATIONCODE'] != 'CNP1') : ?>
                                    <?php // if($rowdb2_kk['KK']) : ?>
                                        <tr>
                                            <td><?= $rowdb2['TGLTERIMAORDER']; ?></td>
                                            <td><?= $rowdb2['PELANGGAN']; ?></td>
                                            <td><?= $rowdb2['ORDER']; ?></td>
                                            <td><?= $rowdb2['PO']; ?></td>
                                            <td><?= $rowdb2['JENISKAIN'].' '.
                                                    $rowdb2['SUBCODE01'].' '.
                                                    $rowdb2['SUBCODE02'].' '.
                                                    $rowdb2['SUBCODE03'].' '.
                                                    $rowdb2['SUBCODE04'].' '.
                                                    $rowdb2['SUBCODE05'].' '.
                                                    $rowdb2['SUBCODE06'].' '.
                                                    $rowdb2['SUBCODE07'].' '.
                                                    $rowdb2['SUBCODE08']; ?>
                                            </td>
                                            <td><?= number_format($rowdb2_lebar['LEBAR'],0); ?></td>
                                            <td><?= number_format($rowdb2_gramasi['GRAMASI'],0); ?></td>
                                            <td><?= $rowdb2['WARNA']; ?></td>
                                            <td><?= $rowdb2['SUBCODE05']; ?></td>
                                            <td><?= $rowdb2['DELIVERY']; ?></td>
                                            <td><?= $rowdb2_bagikain['BAGIKAIN']; ?></td>
                                            <td><?= $rowdb2_kg['KG_BRUTO']; ?></td>
                                            <td></td>
                                            <td><?php $rowdb2_status['OPERATIONCODE']."(".$rowdb2_status['LONGDESCRIPTION'].")"; ?></td>
                                            <td><?= $rowdb2['KK']; ?></td>
                                            <td><?= $rowdb2_catatanpogreiege['CODE'].' '.$rowdb2_catatanpogreiege['FINALPLANNEDDATE']; ?></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    <?php //endif; ?>
                                <?php // endif; ?>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once 'footer.php'; ?>