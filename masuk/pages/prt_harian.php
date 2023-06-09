<?php require_once 'header.php'; ?>
<title><?php $title = "Harian Printing"; echo $title; ?></title>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Laporan Harian Printing</h1>
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
                                    <th rowspan="2">#</th>
                                    <th rowspan="2">NOMOR KK</th>
                                    <th rowspan="2">LANGGANAN</th>
                                    <th >NO. ORDER</th>
                                    <th>NO HANGER</th>
                                    <th>JENIS KAIN</th>
                                    <th>WARNA</th>
                                    <th>QTY (KG)</th>
                                    <th>PROSES</th>
                                    <th align="center">Suhu</th>
                                    <th align="center">Speed</th>
                                    <th>Permintaan Lebar</th>
                                    <th>Permintaan Gramasi </th>
                                    <th>Hasil Lebar</th>
                                    <th>Hasil Gramasi</th>
                                    <th>Waktu Mulai</th>
                                    <th>Waktu Selesai</th>
                                    <th>Total</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    ini_set("error_reporting", 1);
                                    session_start();
                                    require_once "koneksi.php"; 
                                ?>
                                <?php
                                    $jenismesin   = $_GET['jenismesin'];
                                    $nomesin      = $_GET['nomesin'];
                                    $tgl1         = $_GET['tgl1'];
                                    $tgl2         = $_GET['tgl2'];
                                    if ($nomesin = "All") {
                                        $sqlDB2 = "SELECT
                                                    q.HEADERLINE AS HEADERLINE,
                                                    q.PRODUCTIONORDERCODE AS PRODUCTIONORDER,
                                                    trim(op.LONGDESCRIPTION) || ' | ' || trim(q.OPERATIONCODE) AS PROSES,
                                                    q.OPERATIONCODE,
                                                    p.MACHINECODE,
                                                    p.WORKCENTERCODE
                                                FROM
                                                    QUALITYDOCUMENT q 
                                                    LEFT JOIN OPERATION op ON op.CODE = q.OPERATIONCODE
                                                    LEFT JOIN PRODUCTIONPROGRESS p ON p.PRODUCTIONORDERCODE = q.PRODUCTIONORDERCODE AND p.OPERATIONCODE = q.OPERATIONCODE
                                                WHERE
                                                    p.OPERATIONCODE IN ('CUR1','FLT1','FLT2','INS2','INS4','PST1','PST2','ROT1','ROT2','SUB1')
                                                AND
                                                    p.PROGRESSSTARTPROCESSDATE BETWEEN '$tgl1' AND '$tgl2'
                                                GROUP BY
                                                    q.HEADERLINE, q.PRODUCTIONORDERCODE, op.LONGDESCRIPTION, q.OPERATIONCODE, p.MACHINECODE, p.WORKCENTERCODE
                                                ORDER BY
                                                    q.HEADERLINE ASC";
                                    } else {
                                        $sqlDB2 = "SELECT
                                                    q.HEADERLINE AS HEADERLINE,
                                                    q.PRODUCTIONORDERCODE AS PRODUCTIONORDER,
                                                    trim(op.LONGDESCRIPTION) || ' | ' || trim(q.OPERATIONCODE) AS PROSES,
                                                    q.OPERATIONCODE,
                                                    p.MACHINECODE,
                                                    p.WORKCENTERCODE
                                                FROM
                                                    QUALITYDOCUMENT q 
                                                    LEFT JOIN OPERATION op ON op.CODE = q.OPERATIONCODE
                                                    LEFT JOIN PRODUCTIONPROGRESS p ON p.PRODUCTIONORDERCODE = q.PRODUCTIONORDERCODE AND p.OPERATIONCODE = q.OPERATIONCODE
                                                WHERE
                                                    p.MACHINECODE = '$nomesin'
                                                AND
                                                    p.PROGRESSSTARTPROCESSDATE BETWEEN '$tgl1' AND '$tgl2'
                                                GROUP BY
                                                    q.HEADERLINE, q.PRODUCTIONORDERCODE, op.LONGDESCRIPTION, q.OPERATIONCODE, p.MACHINECODE, p.WORKCENTERCODE
                                                ORDER BY
                                                    q.HEADERLINE ASC";
                                    }
                                    
                                    $stmt = db2_exec($conn1,$sqlDB2, array('cursor'=>DB2_SCROLLABLE));
                                    $no = 1;
                                    while ($rowdb2 = db2_fetch_assoc($stmt)) {

                                        $nokk = $rowdb2['PRODUCTIONORDER'];

                                        // NO_PRODORDER, NO_DEMAND, LANGGANAN, NO_ORDER, HANGER, JENIS_KAIN, WARNA
                                        $sql_data = "SELECT 
                                                        p2.PRODUCTIONORDERCODE AS NO_PRODORDER,
                                                        p2.PRODUCTIONDEMANDCODE AS NO_DEMAND,
                                                        b.LEGALNAME1 AS LANGGANAN,
                                                        p.PROJECTCODE AS NO_ORDER,
                                                        (trim( s2.SUBCODE01 ) || trim( s2.SUBCODE02 ) || trim( s2.SUBCODE03 )) AS HANGER,
                                                        s2.ITEMDESCRIPTION AS JENIS_KAIN,
                                                        (trim( s2.SUBCODE05 ) || ' ' || trim( u.LONGDESCRIPTION )) AS WARNA,
                                                        s2.SUBCODE01,s2.SUBCODE02,s2.SUBCODE03,s2.SUBCODE04,s2.SUBCODE05,
                                                        s2.SUBCODE06,s2.SUBCODE07,s2.SUBCODE08,s2.SUBCODE09,s2.SUBCODE10                                                        
                                                    FROM 
                                                        PRODUCTIONDEMANDSTEP p2 
                                                        LEFT JOIN PRODUCTIONDEMAND p ON p.CODE = p2.PRODUCTIONDEMANDCODE
                                                        LEFT JOIN ORDERPARTNER o ON o.CUSTOMERSUPPLIERCODE = p.CUSTOMERCODE
                                                        LEFT JOIN BUSINESSPARTNER b ON b.NUMBERID = o.ORDERBUSINESSPARTNERNUMBERID
                                                        LEFT JOIN SALESORDERLINE s2 ON s2.SALESORDERCODE = p.PROJECTCODE AND p.SUBCODE01 = s2.SUBCODE01 AND p.SUBCODE02 = s2.SUBCODE02 AND p.SUBCODE03 = s2.SUBCODE03 AND p.SUBCODE04 = s2.SUBCODE04 AND p.SUBCODE05 = s2.SUBCODE05 AND p.SUBCODE06 = s2.SUBCODE06 AND p.SUBCODE07 = s2.SUBCODE07 AND p.SUBCODE08 = s2.SUBCODE08 
                                                        LEFT JOIN USERGENERICGROUP u ON u.CODE = s2.SUBCODE05
                                                    WHERE p2.PRODUCTIONORDERCODE = '$nokk'";
                                        $stmt_data = db2_exec($conn1,$sql_data, array('cursor'=>DB2_SCROLLABLE));
                                        $rowdb2_data = db2_fetch_assoc($stmt_data);

                                        $headerline = $rowdb2['HEADERLINE']; 
                                        $prodorder = $rowdb2_data['NO_PRODORDER']; 
                                        $demand = $rowdb2_data['NO_DEMAND'];
                                        $opr = $rowdb2['OPERATIONCODE'];
                                        $s1 = $rowdb2_data['SUBCODE01'];
                                        $s2 = $rowdb2_data['SUBCODE02'];
                                        $s3 = $rowdb2_data['SUBCODE03'];
                                        $s4 = $rowdb2_data['SUBCODE04'];
                                        $s5 = $rowdb2_data['SUBCODE05'];
                                        $s6 = $rowdb2_data['SUBCODE06'];
                                        $s7 = $rowdb2_data['SUBCODE07'];
                                        $s8 = $rowdb2_data['SUBCODE08'];
                                        $s9 = $rowdb2_data['SUBCODE09'];
                                        $s10 = $rowdb2_data['SUBCODE10'];

                                         // PERMINTAAN LEBAR 
                                         $sqlLebar = "SELECT A.NAMENAME,A.VALUEDECIMAL AS LEBAR
                                                        FROM
                                                            ADSTORAGE a 
                                                            RIGHT JOIN (SELECT * FROM PRODUCT p )p ON p.ABSUNIQUEID = A.UNIQUEID
                                                        WHERE
                                                            a.NAMENAME = 'Width' AND
                                                            p.SUBCODE01 = '$s1' AND
                                                            p.SUBCODE02 = '$s2' AND
                                                            p.SUBCODE03 = '$s3' AND
                                                            p.SUBCODE04 = '$s4' AND
                                                            p.SUBCODE05 = '$s5' AND
                                                            p.SUBCODE06 = '$s6' AND
                                                            p.SUBCODE07 = '$s7' AND
                                                            p.SUBCODE08 = '$s8' AND
                                                            p.SUBCODE09 = '$s9' AND
                                                            p.SUBCODE10 = '$s10'";  
                                        $stmt_lebar = db2_exec($conn1,$sqlLebar, array('cursor'=>DB2_SCROLLABLE));
                                        $rowdb2_lebar = db2_fetch_assoc($stmt_lebar);

                                        // PERMINTAAN GRAMASI
                                        $sqlGramasi = "SELECT A.NAMENAME,A.VALUEDECIMAL AS GRAMASI
                                                        FROM
                                                            ADSTORAGE a 
                                                            RIGHT JOIN (SELECT * FROM PRODUCT p )p ON p.ABSUNIQUEID = A.UNIQUEID
                                                        WHERE
                                                            a.NAMENAME = 'GSM' AND
                                                            p.SUBCODE01 = '$s1' AND
                                                            p.SUBCODE02 = '$s2' AND
                                                            p.SUBCODE03 = '$s3' AND
                                                            p.SUBCODE04 = '$s4' AND
                                                            p.SUBCODE05 = '$s5' AND
                                                            p.SUBCODE06 = '$s6' AND
                                                            p.SUBCODE07 = '$s7' AND
                                                            p.SUBCODE08 = '$s8' AND
                                                            p.SUBCODE09 = '$s9' AND
                                                            p.SUBCODE10 = '$s10'";
                                        $stmt_gramasi = db2_exec($conn1,$sqlGramasi, array('cursor'=>DB2_SCROLLABLE));
                                        $rowdb2_gramasi = db2_fetch_assoc($stmt_gramasi);

                                        // KG BAGI KAN DI STEPS
                                        $sqlKg_bagikain = "SELECT PRODUCTIONDEMANDCODE, FINALUSERPRIMARYQUANTITY FROM PRODUCTIONDEMANDSTEP WHERE PRODUCTIONDEMANDCODE = '$demand' ORDER BY STEPNUMBER ASC limit 1";
                                        $stmt_kg_bagikain = db2_exec($conn1,$sqlKg_bagikain, array('cursor'=>DB2_SCROLLABLE));
                                        $rowdb2_kg_bagikain = db2_fetch_assoc($stmt_kg_bagikain);

                                        // SUHU ATAU TEMPERATURE
                                        $sqltmp = "SELECT * FROM QUALITYDOCLINE WHERE QUALITYDOCUMENTHEADERLINE = '$headerline' AND CHARACTERISTICCODE = 'TMP'";  
                                        $stmt_tmp = db2_exec($conn1,$sqltmp, array('cursor'=>DB2_SCROLLABLE));
                                        $rowdb2_tmp = db2_fetch_assoc($stmt_tmp);

                                        // SPEED 
                                        $sqlspeed = "SELECT * FROM QUALITYDOCLINE WHERE QUALITYDOCUMENTHEADERLINE = '$headerline' AND CHARACTERISTICCODE = 'SPEEDFIN'";  
                                        $stmt_speed = db2_exec($conn1,$sqlspeed, array('cursor'=>DB2_SCROLLABLE));
                                        $rowdb2_speed = db2_fetch_assoc($stmt_speed);

                                        // HASIL LEBAR 
                                        $sqlHasilLebar = "SELECT * FROM QUALITYDOCLINE WHERE QUALITYDOCUMENTHEADERLINE = '$headerline' AND CHARACTERISTICCODE = 'LEBAR'";  
                                        $stmt_hasillebar = db2_exec($conn1,$sqlHasilLebar, array('cursor'=>DB2_SCROLLABLE));
                                        $rowdb2_hasillebar = db2_fetch_assoc($stmt_hasillebar);
                                        
                                        // HASIL GRAMASI 
                                        $sqlHasilGramasi = "SELECT * FROM QUALITYDOCLINE WHERE QUALITYDOCUMENTHEADERLINE = '$headerline' AND CHARACTERISTICCODE = 'GRAMASI'";  
                                        $stmt_hasilgramasi = db2_exec($conn1,$sqlHasilGramasi, array('cursor'=>DB2_SCROLLABLE));
                                        $rowdb2_hasilgramasi = db2_fetch_assoc($stmt_hasilgramasi);
                                        
                                        // WAKTU MULAI 
                                        $sqlwaktumulai = "SELECT * FROM PRODUCTIONPROGRESS pp WHERE PROGRESSTEMPLATECODE = 'S01' AND PRODUCTIONORDERCODE = '$prodorder' AND OPERATIONCODE = '$opr'";  
                                        $stmt_waktumulai = db2_exec($conn1,$sqlwaktumulai, array('cursor'=>DB2_SCROLLABLE));
                                        $rowdb2_waktumulai = db2_fetch_assoc($stmt_waktumulai);
                                        
                                        // WAKTU SELESAI 
                                        $sqlwaktuselesai = "SELECT * FROM PRODUCTIONPROGRESS pp WHERE PROGRESSTEMPLATECODE = 'E01' AND PRODUCTIONORDERCODE = '$prodorder' AND OPERATIONCODE = '$opr'";  
                                        $stmt_waktuselesai = db2_exec($conn1,$sqlwaktuselesai, array('cursor'=>DB2_SCROLLABLE));
                                        $rowdb2_waktuselesai = db2_fetch_assoc($stmt_waktuselesai);
                                ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $rowdb2_data['NO_DEMAND']; ?></td> <!-- NO KK -->
                                    <td><?= $rowdb2_data['LANGGANAN']; ?></td> <!-- Langganan -->
                                    <td><?= $rowdb2_data['NO_ORDER']; ?></td> <!-- No. Order -->
                                    <td><?= $rowdb2_data['HANGER']; ?></td> <!-- No Hanger -->
                                    <td><?= $rowdb2_data['JENIS_KAIN']; ?></td> <!-- Jenis Kain -->
                                    <td><?= $rowdb2_data['WARNA']; ?></td> <!-- Warna -->
                                    <td><?= $rowdb2_kg_bagikain['FINALUSERPRIMARYQUANTITY']; ?></td> <!-- Qty (Kg) -->
                                    <td><?= $rowdb2['PROSES']; ?></td> <!-- Proses -->
                                    <td align="center"><?= floor($rowdb2_tmp['VALUEQUANTITY']); ?></td> <!-- Suhu -->
                                    <td align="center"><?= floor($rowdb2_speed['VALUEQUANTITY']); ?></td=> <!-- Speed -->
                                    <td align="center"><?= floor($rowdb2_lebar['LEBAR']); ?></td> <!-- Permintaan Lebar -->
                                    <td align="center"><?= floor($rowdb2_gramasi['GRAMASI']); ?></td><!-- Permintaan Gramasi -->
                                    <td align="center"><?= round($rowdb2_hasillebar['VALUEQUANTITY'], 1); ?></td> <!-- Hasil Lebar -->
                                    <td align="center"><?= round($rowdb2_hasilgramasi['VALUEQUANTITY'], 1); ?></td> <!-- Hasil Gramasi -->
                                    <td align="center"><?= $rowdb2_waktumulai['PROGRESSSTARTPROCESSTIME']; ?></td> <!-- Waktu Mulai -->
                                    <td align="center"><?= $rowdb2_waktuselesai['PROGRESSENDTIME']; ?></td> <!-- Waktu Selesai -->
                                    <!-- <td align="center"></td> Stop Mesin Mulai  -->
                                    <!-- <td align="center"></td> Stop Mesin Mulai Proses Kembali -->
                                    <td>=TEXT(P4-Q3,"mm:ss")</td> <!-- Total -->
                                    <!-- <td></td> Kode -->
                                    <td></td> <!-- Keterangan -->
                                </tr>
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