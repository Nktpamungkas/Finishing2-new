<?php
    if (isset($_POST['cari_delivery'])) {
        $demand      = $_POST['no_demand'];
        header("Location: fin_cetaklabel.php?demand=$demand");
    }
?>
<?php require_once 'header.php'; ?>
<title><?php $title = "FIN - Filter Laporan Harian"; echo $title; ?></title>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><i class="nav-icon fas fa-search"></i> FILTER PENCARIAN LAPORAN HARIAN FINISHING</h1>
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
                                    <label>NOMOR DEMAND:</label>
                                    <div class="input-group">
                                        <input type="text" name="no_demand" class="form-control">
                                    </div>
                                </div>
                                <button type="submit" name="cari_delivery" class="btn btn-primary">Cari data</button>
                            </form>
                        </div>
                        <div class="card-footer">
                            Masukan <a href="#">Nomor Demand </a> yang ada pada <b>KARTU KERJA PPC (PROCESS CONTROL CARD)</b>. Data pencarian berdasarkan data yang tersimpan dalam database NOW. Untuk data pada program lama tidak dapat dicari menggunakan sistem ini.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once 'footer.php'; ?>