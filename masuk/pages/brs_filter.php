<?php
    if (isset($_POST['cari_delivery'])) {
        $jenismesin      = $_POST['jenismesin'];
        $nomesin         = $_POST['nomesin'];
        $tgl1            = $_POST['tgl1'];
        $tgl2            = $_POST['tgl2'];
        header("Location: brs_harian.php?nomesin=$nomesin&jenismesin=$jenismesin&tgl1=$tgl1&tgl2=$tgl2");
    }
?>
<?php require_once 'header.php'; ?>
<title><?php $title = "BRS - Filter Laporan Harian"; echo $title; ?></title>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><i class="nav-icon fas fa-search"></i> FILTER PENCARIAN LAPORAN HARIAN BRUSHING</h1>
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
            <div class="col-4">
                <div class="card">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">A. Filter By <b>Date Begin Operation</b></h3>
                        </div>
                        <div class="card-body">
                            <form action="" method="post">
                                <div class="form-group">
                                    <label>Jenis Mesin:</label>
                                    <div class="input-group">
                                        <select name="nomesin" class="form-control" style="width: 100%;" onChange="window.location='http://10.0.0.10/laporan/brs_filter.php?jnsmsn='+this.value" required>
                                            <option value="" disabled selected>Pilih Jenis Mesin</option>
                                            <?php 
                                                require_once "koneksi.php"; 
                                                $namamesin = $_GET['jnsmsn'];
                                                $sqlDB="SELECT
                                                            trim(CODE) AS JENIS_MESIN,
                                                            LONGDESCRIPTION
                                                        FROM
                                                            WORKCENTER 
                                                        WHERE
                                                            COSTCENTERCODE = 'C022'";
                                                $stmt=db2_exec($conn1,$sqlDB);
                                                while ($rowdb = db2_fetch_assoc($stmt)) {
                                            ?>
                                            <option 
                                                value="<?= $rowdb['JENIS_MESIN']; ?>" 
                                                <?php 
                                                    if($rowdb['JENIS_MESIN'] == $namamesin){ 
                                                        echo "SELECTED"; 
                                                    } 
                                                ?>>
                                                <?= $rowdb['JENIS_MESIN'].' - '.$rowdb['LONGDESCRIPTION']; ?>
                                            </option>
                                            <?php  } ?> 
                                        </select>
                                    </div>
                                    <label>Nomor Mesin:</label>
                                    <div class="input-group">
                                        <select name="jenismesin" class="form-control" style="width: 100%;">
                                            <option disabled selected>Pilih No Mesin</option>
                                            <option value="All">Semua Mesin</option>
                                            <?php 
                                                require_once "koneksi.php";
                                                $namamesin = $_GET['jnsmsn'];
                                                $sqlDB2="SELECT
                                                                trim(r.CODE) AS NO_NAMA_MESIN,
                                                                w.LONGDESCRIPTION
                                                            FROM
                                                                RESOURCES r
                                                                LEFT JOIN WORKCENTER w ON w.CODE = LEFT(r.CODE, 5) 
                                                            WHERE
                                                                r.TYPE = '2' AND w.COSTCENTERCODE = 'C022' AND w.CODE = '$namamesin'
                                                            ORDER BY r.CODE ASC";
                                                $stmt=db2_exec($conn1,$sqlDB2, array('cursor'=>DB2_SCROLLABLE));
                                                while ($rowdb2 = db2_fetch_assoc($stmt)) {
                                            ?>
                                            <option value="<?= $rowdb2['NO_NAMA_MESIN']; ?>"><?= $rowdb2['NO_NAMA_MESIN'].' - '.$rowdb2['LONGDESCRIPTION']; ?></option>
                                            <?php  } ?> 
                                        </select>
                                    </div>
                                    <hr>
                                    <label>Dari Tanggal:</label>
                                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                        <input type="date" name="tgl1" class="form-control" required/>
                                        <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                    <label>Sampai Tanggal:</label>
                                    <div class="input-group date" id="reservationdate2" data-target-input="nearest">
                                        <input type="date" name="tgl2" class="form-control" required/>
                                        <div class="input-group-append" data-target="#reservationdate2" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                    <label>Shift:</label>
                                    <div class="input-group">
                                        <select name="shift" class="form-control" style="width: 100%;">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                        </select>
                                    </div>
                                </div>
                                <button type="submit" name="cari_delivery" class="btn btn-primary">Cari data</button>
                            </form>
                        </div>
                        <div class="card-footer">
                            Gunakan <a href="#">Filter Pencarian </a> Cari laporan berdasarkan <b>Begin Operation</b>. Data pencarian berdasarkan data yang tersimpan dalam database NOW. Untuk data pada program lama tidak dapat dicari menggunakan sistem ini.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once 'footer.php'; ?>