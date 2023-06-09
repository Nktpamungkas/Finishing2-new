<?php
    if (isset($_POST['cari_delivery'])) {
        $thn = $_POST['thn'];
        header("Location: ppc_laporder_pertahun.php?thn=$thn");
    }
?>
<?php require_once 'header.php'; ?>
<title><?php $title = "PPC - Filter Laporan Order"; echo $title; ?></title>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><i class="nav-icon fas fa-search"></i> FILTER PENCARIAN LAPORAN ORDER</h1>
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
                            <h3 class="card-title">A. Laporan <b>Order Pertahun</b></h3>
                        </div>
                        <div class="card-body">
                            <form action="" method="post">
                                <div class="form-group">
                                    <label>Tahun:</label>
                                    <?php $years = range(2022, strftime("2030", time())); ?>
                                    <select name="thn" class="form-control" required>
                                        <option disabled selected value="">Select Year</option>
                                        <?php foreach($years as $year) : ?>
                                            <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <button type="submit" name="cari_delivery" class="btn btn-primary">Cari data</button>
                            </form>
                        </div>
                        <div class="card-footer">
                            Gunakan <a href="#">Filter Pencarian </a> Cari laporan berdasarkan <b>tanggal delivery sales order</b>. Data pencarian berdasarkan data yang tersimpan dalam database NOW. Untuk data pada program lama tidak dapat dicari menggunakan sistem ini.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<?php require_once 'footer.php'; ?>