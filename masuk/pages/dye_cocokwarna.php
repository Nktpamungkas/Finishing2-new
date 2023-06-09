<?php require_once 'header.php'; ?>
<title><?php $title = "Harian Dyeing"; echo $title; ?></title>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Laporan Harian DYEING</h1>
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
                                    <th>NO</th>
                                    <th>TGL CELUP</th>
                                    <th>PROD. ORDER</th>
                                    <th>PROD. DEMAND</th>
                                    <th>LANGGANAN</th>
                                    <th>PO</th>
                                    <th>ORDER</th>
                                    <th>ITEM/HANGER</th>
                                    <th>JENIS KAIN</th>
                                    <th>WARNA</th>
                                    <th>NO WARNA</th>
                                    <th>NO MESIN</th>
                                    <th>COLORIST DYE</th>
                                    <th>BRUTO</th>
                                    <th>SHIFT</th>
                                    <th>STATUS WARNA</th>
                                    <th>DISPOSISI</th>
                                    <th>COLORIST QCF</th>
                                    <th>KETERANGAN</th>
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
                                    $shift        = $_GET['shift'];
                                    $tgl1         = $_GET['tgl1'];
                                    $tgl2         = $_GET['tgl2'];
                                    if ($shift = "All") {
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
                                                    p.OPERATIONCODE IN ('CBL1','DYE1','DYE2','DYE3','DYE4','DYE5','DYE6','FEW1','FIX1','HEW1','HOT1','LVL1','MWS1','NCP1','NEU1','PER1','RLX1','RTW1','SCO1','SOA1','TBS1')
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

                                        // NO_PRODORDER, NO_DEMAND, LANGGANAN, NO_ORDER, HANGER, JENIS_KAIN, WARNA, NOMOR PO
                                        $sql_data = "SELECT 
                                                        p2.PRODUCTIONORDERCODE AS NO_PRODORDER,
                                                        p2.PRODUCTIONDEMANDCODE AS NO_DEMAND,
                                                        b.LEGALNAME1 AS LANGGANAN,
                                                        p.PROJECTCODE AS NO_ORDER,
                                                        (trim( s2.SUBCODE01 ) || trim( s2.SUBCODE02 ) || trim( s2.SUBCODE03 )) AS HANGER,
                                                        s2.ITEMDESCRIPTION AS JENIS_KAIN,
                                                        trim( u.LONGDESCRIPTION ) AS WARNA,
                                                        trim( s2.SUBCODE05 ) AS NO_WARNA,
                                                        s2.SUBCODE01,s2.SUBCODE02,s2.SUBCODE03,s2.SUBCODE04,s2.SUBCODE05,
                                                        s2.SUBCODE06,s2.SUBCODE07,s2.SUBCODE08,s2.SUBCODE09,s2.SUBCODE10,
                                                        s2.EXTERNALREFERENCE AS NOMOR_PO                                                        
                                                    FROM 
                                                        PRODUCTIONDEMANDSTEP p2 
                                                        LEFT JOIN PRODUCTIONDEMAND p ON p.CODE = p2.PRODUCTIONDEMANDCODE
                                                        LEFT JOIN ORDERPARTNER o ON o.CUSTOMERSUPPLIERCODE = p.CUSTOMERCODE
                                                        LEFT JOIN BUSINESSPARTNER b ON b.NUMBERID = o.ORDERBUSINESSPARTNERNUMBERID
                                                        LEFT JOIN SALESORDERLINE s2 ON s2.SALESORDERCODE = p.PROJECTCODE AND p.SUBCODE01 = s2.SUBCODE01 AND p.SUBCODE02 = s2.SUBCODE02 AND p.SUBCODE03 = s2.SUBCODE03 AND p.SUBCODE04 = s2.SUBCODE04 AND p.SUBCODE05 = s2.SUBCODE05 AND p.SUBCODE06 = s2.SUBCODE06 AND p.SUBCODE07 = s2.SUBCODE07 AND p.SUBCODE08 = s2.SUBCODE08 
                                                        LEFT JOIN USERGENERICGROUP u ON u.CODE = s2.SUBCODE05
                                                    WHERE p2.PRODUCTIONORDERCODE = '$nokk' OR p2.PRODUCTIONDEMANDCODE = '$'";
                                        $stmt_data = db2_exec($conn1,$sql_data, array('cursor'=>DB2_SCROLLABLE));
                                        $rowdb2_data = db2_fetch_assoc($stmt_data);

                                        $headerline = $rowdb2['HEADERLINE']; 
                                        $prodorder = $rowdb2_data['NO_PRODORDER']; 
                                        $demand = $rowdb2_data['NO_DEMAND'];

                                        // KG BAGI KAN DI STEPS
                                        $sqlKg_bagikain = "SELECT PRODUCTIONDEMANDCODE, FINALUSERPRIMARYQUANTITY FROM PRODUCTIONDEMANDSTEP WHERE PRODUCTIONDEMANDCODE = '$demand' ORDER BY STEPNUMBER ASC limit 1";
                                        $stmt_kg_bagikain = db2_exec($conn1,$sqlKg_bagikain, array('cursor'=>DB2_SCROLLABLE));
                                        $rowdb2_kg_bagikain = db2_fetch_assoc($stmt_kg_bagikain);
                                ?>
                                <tr>
                                    <td><?= $no++; ?></td><!-- NO -->
                                    <td></td><!-- TGL CELUP -->
                                    <td><?= $prodorder; ?></td> <!-- PROD ORDER -->
                                    <td><?= $demand; ?></td> <!-- PROD DEMAND -->
                                    <td><?= $rowdb2_data['LANGGANAN']; ?></td><!-- LANGGANAN -->
                                    <td><?= $rowdb2_data['NOMOR_PO']; ?></td><!-- NOMOR_PO -->
                                    <td><?= $rowdb2_data['NO_ORDER']; ?></td><!-- ORDER -->
                                    <td><?= $rowdb2_data['HANGER']; ?></td><!-- ITEM/HANGER -->
                                    <td><?= $rowdb2_data['JENIS_KAIN']; ?></td><!-- JENIS KAIN -->
                                    <td><?= $rowdb2_data['WARNA']; ?></td><!-- WARNA -->
                                    <td><?= $rowdb2_data['NO_WARNA']; ?></td><!-- NO WARNA -->
                                    <td><?= $rowdb2['MACHINECODE']; ?></td><!-- NO MESIN -->
                                    <td></td><!-- COLORIST DYE -->
                                    <td><?= $rowdb2_kg_bagikain['FINALUSERPRIMARYQUANTITY']; ?></td><!-- BRUTO -->
                                    <td></td><!-- SHIFT -->
                                    <td></td><!-- STATUS WARNA -->
                                    <td></td><!-- DISPOSISI -->
                                    <td></td><!-- COLORIST QCF -->
                                    <td></td><!-- KETERANGAN -->
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