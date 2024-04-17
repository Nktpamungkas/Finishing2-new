<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
    include('../koneksi.php');
?>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>KK Masuk</title>
  <link rel="stylesheet" type="text/css" href="../css/datatable.css" />
  <link rel="stylesheet" type="text/css" href="../css/jquery-ui.css" />
  <script src="../js/jquery.js" type="text/javascript"></script>
  <script src="../js/jquery.dataTables.js" type="text/javascript"></script>
  <script>
    $(document).ready(function() {
      $('#datatables').dataTable({
        "sScrollY": "500px",
        "sScrollX": "100%",
        "bScrollCollapse": false,
        "bPaginate": false,
        "bJQueryUI": true,
        "bSort": false // Menonaktifkan sort
      });
    })
  </script>
</head>
<style>
    .button {
        display: inline-block;
        padding: 3px 8px;
        background-color: #ff004c;
        color: #ffffff;
        text-decoration: none;
        border-radius: 5px;
    }
</style>

<style>
    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.5);
    }

    .modal-content {
        background-color: #fefefe;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 20%;
    }

    .modal-content button {
        margin-right: 10px;
    }
</style>

<body>
    <form id="form1" name="form1" method="post" action="">
        <table width="650" border="0">
            <tr>
                <td colspan="3">
                    <div align="center"><strong>KK MASUK FINISHING</strong></div>
                    <?php
                        $user_name = $_SESSION['username'];
                        date_default_timezone_set('Asia/Jakarta');
                        $tgl = date("Y-M-d h:i:s A");
                        echo $tgl; 
                    ?>
                    <br>
                </td>
            </tr>
            <tr>
                <td><strong>Mesin</strong></td>
                <td>:</td>
                <td>
                    <select name="nama_mesin" class="form-control select2">
                        <option value="-" disabled selected>-nama mesin-</option>
                        <?php
                            $q_mesin    = mysqli_query($con, "SELECT
                                                                    DISTINCT
                                                                    nama_mesin
                                                                FROM
                                                                    `tbl_masuk`");
                        ?>
                        <?php while ($row_mesin = mysqli_fetch_array($q_mesin)) : ?>
                            <option value="<?= $row_mesin['nama_mesin']; ?>" <?php if($row_mesin['nama_mesin'] == $_POST['nama_mesin']){ echo 'SELECTED'; } ?>><?= $row_mesin['nama_mesin']; ?></option>
                        <?php endwhile; ?>
                    </select>
                </td>
            </tr>
            <tr valign="middle">
                <td width="127"><strong>Tanggal Awal</strong></td>
                <td width="3">:</td>
                <td width="280"><input name="awal" type="text" id="awal" value="<?= $_POST['awal'] ?>" onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.awal);return false;" size="14" /><a href="javascript:void(0)" onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.awal);return false;"><img src="../calender/calender.jpeg" alt="" name="popcal" width="30" height="25" id="popcal" style="border:none" align="absmiddle" border="0" /></a></td>
            </tr>
            <tr>
                <td><strong>Tanggal Akhir</strong></td>
                <td>:</td>
                <td width="280"><input name="akhir" type="text" id="akhir" value="<?= $_POST['akhir'] ?>" onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.akhir);return false;" size="14" /><a href="javascript:void(0)" onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.akhir);return false;"><img src="../calender/calender.jpeg" alt="" name="popcal" width="30" height="25" id="popcal" style="border:none" align="absmiddle" border="0" /></a></td>
            </tr>
            <tr>
                <td colspan="3">
                    <input type="submit" name="button" id="button" value="Cari data" class="art-button"> 
		            <?php if(isset($_POST['button'])) : ?>
                        <input type="button" name="batal" value="Reset" onclick="window.location.href='index.php?p=LihatData'" class="art-button">
                        <a href="pages/ExportData.php?nama_mesin=<?= $_POST['nama_mesin'] ?>&awal=<?= $_POST['awal'] ?>&akhir=<?= $_POST['akhir']; ?>" class="art-button">Cetak Ke Excel</a>
                        
                    <?php endif; ?>
                </td>
            </tr>
        </table>
    </form>
    <table width="100%" border="1" id="datatables" class="display">
        <thead>
            <tr>
                <th style="border:1px solid;vertical-align:middle; font-weight: bold;">NAMA MESIN</th>
                <th style="border:1px solid;vertical-align:middle; font-weight: bold;">OPERATION</th>
                <th style="border:1px solid;vertical-align:middle; font-weight: bold;">NO KK</th>
                <th style="border:1px solid;vertical-align:middle; font-weight: bold;">NO DEMAND</th>
                <th style="border:1px solid;vertical-align:middle; font-weight: bold;">LANGGANAN</th>
                <th style="border:1px solid;vertical-align:middle; font-weight: bold;">BUYER</th>
                <th style="border:1px solid;vertical-align:middle; font-weight: bold;">NO ORDER</th>
                <th style="border:1px solid;vertical-align:middle; font-weight: bold;">JENIS KAIN</th>
                <th style="border:1px solid;vertical-align:middle; font-weight: bold;">NO WARNA</th>
                <th style="border:1px solid;vertical-align:middle; font-weight: bold;">WARNA</th>
                <th style="border:1px solid;vertical-align:middle; font-weight: bold;">ROL</th>
                <th style="border:1px solid;vertical-align:middle; font-weight: bold;">QTY</th>
                <th style="border:1px solid;vertical-align:middle; font-weight: bold;">QTY YD</th>
                <th style="border:1px solid;vertical-align:middle; font-weight: bold;">PROSES</th>
                <th style="border:1px solid;vertical-align:middle; font-weight: bold;">CATATAN</th>
                <th style="border:1px solid;vertical-align:middle; font-weight: bold;">CREATION DATE TIME</th>
                <th style="border:1px solid;vertical-align:middle; font-weight: bold;" width="10%">OPSI</th>
            </tr>
        </thead>
        <tbody>
            <?php
                if($_POST['nama_mesin']){
                    $where_nama_mesin  = "AND nama_mesin = '$_POST[nama_mesin]'";
                }else{
                    $where_nama_mesin  = "";
                }
                
                if($_POST['awal']){
                    $where_tgl  = "AND creationdatetime BETWEEN '$_POST[awal]' AND '$_POST[akhir]'";
                }else{
                    $where_tgl  = "";
                }

                $q_tblmasuk     = mysqli_query($con, "SELECT * FROM tbl_masuk WHERE `status` = 'KK MASUK' $where_tgl $where_nama_mesin ORDER BY id ASC");
                $totalQty = 0;
                $totalRoll = 0;
            ?>
            <?php while ($row_tblmasuk  = mysqli_fetch_array($q_tblmasuk)) : ?>
                <?php
                    // CEK, JIKA KARTU KERJA SUDAH DIBIKIN SCHEDULE MAKA TIDAK AKAN MUNCUL DI KK MASUK. 
                    $cek_schedule   = mysqli_query($con, "SELECT COUNT(*) AS jml FROM tbl_schedule_new WHERE nokk = '$row_tblmasuk[nokk]' AND nodemand = '$row_tblmasuk[nodemand]' AND operation = '$row_tblmasuk[operation]'");
                    $data_schedule  = mysqli_fetch_assoc($cek_schedule);
                ?>
                <?php if(empty($data_schedule['jml'])) : ?>
                    <tr>
                        <td style="border:1px solid;vertical-align:middle; text-align: center;"><?= $row_tblmasuk['nama_mesin'] ?></td>
                        <td style="border:1px solid;vertical-align:middle; text-align: center;"><?= $row_tblmasuk['operation'] ?></td>
                        <td style="border:1px solid;vertical-align:middle;"><?= $row_tblmasuk['nokk'] ?></td>
                        <td style="border:1px solid;vertical-align:middle;"><a target="_BLANK" href="http://online.indotaichen.com/laporan/ppc_filter_steps.php?demand=<?= $row_tblmasuk['nodemand']; ?>&prod_order=<?= $row_tblmasuk['nokk']; ?>"><?= $row_tblmasuk['nodemand'] ?></a></td>
                        <td style="border:1px solid;vertical-align:middle;"><?= $row_tblmasuk['langganan'] ?></td>
                        <td style="border:1px solid;vertical-align:middle;"><?= $row_tblmasuk['buyer'] ?></td>
                        <td style="border:1px solid;vertical-align:middle;"><?= $row_tblmasuk['no_order'] ?></td>
                        <td style="border:1px solid;vertical-align:middle;"><?= $row_tblmasuk['jenis_kain'] ?></td>
                        <td style="border:1px solid;vertical-align:middle;"><?= $row_tblmasuk['no_warna'] ?></td>
                        <td style="border:1px solid;vertical-align:middle;"><?= $row_tblmasuk['warna'] ?></td>
                        <td style="border:1px solid;vertical-align:middle;"><?= $row_tblmasuk['roll'] ?></td>
                        <td style="border:1px solid;vertical-align:middle;"><?= $row_tblmasuk['qty_order'] ?></td>
                        <td style="border:1px solid;vertical-align:middle;"><?= $row_tblmasuk['qty_order_yd'] ?></td>
                        <td style="border:1px solid;vertical-align:middle;"><?= $row_tblmasuk['proses'] ?></td>
                        <td style="border:1px solid;vertical-align:middle; color:red;"><?= $row_tblmasuk['catatan'] ?></td>
                        <td style="border:1px solid;vertical-align:middle;"><?= $row_tblmasuk['creationdatetime'] ?></td>
                        <td style="border:1px solid;vertical-align:middle;">
                            <button class="button" onclick="showConfirmation(<?= $row_tblmasuk['id'] ?>);">Hapus</button>
                        </td>
                        <?php $totalQty += $row_tblmasuk['qty_order']; ?>
                        <?php $totalRoll += $row_tblmasuk['roll']; ?>
                    </tr>
                <?php endif; ?>
            <?php endwhile; ?>
                
        </tbody>
        <tfoot>
            <tr>
                <td style="border:1px solid;vertical-align:middle; text-align: center;"></td>
                <td style="border:1px solid;vertical-align:middle; text-align: center;"></td>
                <td style="border:1px solid;vertical-align:middle; text-align: center;"></td>
                <td style="border:1px solid;vertical-align:middle; text-align: center;"></td>
                <td style="border:1px solid;vertical-align:middle; text-align: center;"></td>
                <td style="border:1px solid;vertical-align:middle; text-align: center;"></td>
                <td style="border:1px solid;vertical-align:middle; text-align: center;"></td>
                <td style="border:1px solid;vertical-align:middle; text-align: center;"></td>
                <td style="border:1px solid;vertical-align:middle; text-align: center;"></td>
                <td style="border:1px solid;vertical-align:middle; text-align: center;"></td>
                <td style="border:1px solid;vertical-align:middle; text-align: center;"><?= $totalRoll; ?></td>
                <td style="border:1px solid;vertical-align:middle; text-align: center;"><?= $totalQty; ?></td>
                <td style="border:1px solid;vertical-align:middle; text-align: center;"></td>
                <td style="border:1px solid;vertical-align:middle; text-align: center;"></td>
                <td style="border:1px solid;vertical-align:middle; text-align: center;"></td>
                <td style="border:1px solid;vertical-align:middle; text-align: center;"></td>
                <td style="border:1px solid;vertical-align:middle; text-align: center;"></td>
            </tr>
        </tfoot>
    </table>
    <div id="confirmation-modal" class="modal">
        <div class="modal-content">
            <p>Are you sure you want to delete this item?</p>
            <button id="confirm-delete-button">Yes</button>
            <button onclick="closeModal()">No</button>
        </div>
    </div>
    <script>
        function showConfirmation(id) {
            document.getElementById('confirmation-modal').style.display = 'block';
            document.getElementById('confirm-delete-button').setAttribute('data-id', id);
        }

        function closeModal() {
            document.getElementById('confirmation-modal').style.display = 'none';
        }

        document.getElementById('confirm-delete-button').addEventListener('click', function() {
            var id = this.getAttribute('data-id');
            confirmDelete(id);
        });

        function confirmDelete(id) {
            $.ajax({
                url: '?p=delete_kkmasuk',
                type: 'POST',
                data: { id: id },
                success: function(response) {
                    // Tampilkan pesan sukses atau gagal
                    swal({
                        title: 'Data deleted successfully.',   
                        text: 'Klik Ok untuk input data kembali',
                        type: 'warning',
                    }).then((result) => {
                        if (result.value) {
                            window.location.href = 'http://online.indotaichen.com/finishing2-new/masuk/index.php?p=LihatData'; 
                        }
                    });
                    closeModal();
                },
                error: function(xhr, status, error) {
                    // Tampilkan pesan kesalahan jika terjadi error
                    alert('Failed to delete item. Please try again later.');
                }
            });
        }
    </script>
</body>
</html>