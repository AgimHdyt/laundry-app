<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>G-sok | <?= $title; ?></title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url('/assets'); ?>/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url('/assets'); ?>/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top" onload="window.print()">

    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Begin Page Content -->
        <div class="container-fluid">
            <!-- DataTales Example -->
            <div class="row">
                <div class="col-lg">
                    <div class="card">
                        <div class="card-header text-center py-3">
                            <div class="row">
                                <div class="col-sm-2 text-right">
                                    <img src="<?= base_url('/assets/img') . '/logo.png'; ?>" width="95px" alt="brand" />
                                </div>
                                <div class="col-sm-10 text-left">
                                    <h3>G-sok<sup>2</sup></h3>
                                    <h6>Jl Alternatif Sentul No 45, Telp 085717766367</h6>
                                    <h6>www.gosok.com</h6>
                                </div>
                            </div>
                        </div>
                        <div class="card-body" id="data-transaksi">
                            <?php
                            $db           = \Config\Database::connect();
                            $id = $transaksi['id_member'];
                            $id_layanan = $transaksi['id_layanan'];
                            $member = $db->table('tb_member')->getWhere(['id' => $id])->getRowArray();
                            $query = "SELECT `tb_layanan`.*, `tb_d_layanan` .*
                                            FROM `tb_layanan` JOIN `tb_d_layanan`
                                            ON `tb_layanan`.`id` = `tb_d_layanan`.`id_layanan` WHERE `tb_d_layanan`.`id` = $id_layanan";
                            $layanan = $db->query($query)->getRowArray();
                            $i = 1;
                            ?>
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td>No Invoice</td>
                                                    <td>: T0316</td>
                                                    <input type="hidden" name="no_invoice" id="no_invoice" value="<?= $transaksi['invoice']; ?>">
                                                </tr>
                                                <tr>
                                                    <td>Tanggal Transaksi</td>
                                                    <td>: <?= $transaksi['tanggal_mulai']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Pelanggan</td>
                                                    <td>: <?= $member['nama']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>No Telp</td>
                                                    <td>: <?= $member['tlp']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Alamat</td>
                                                    <td>: <?= $member['alamat']; ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-8">
                                </div>
                            </div>
                            <style>
                                .tabelnya>tr>th {
                                    vertical-align: middle;
                                }
                            </style>

                            <table class="table table-bordered">
                                <thead class="text-center tabelnya">
                                    <tr>
                                        <th rowspan="2">No</th>
                                        <th rowspan="2">Layanan</th>
                                        <th rowspan="2">Jenis</th>
                                        <th rowspan="2">Tarif</th>
                                        <th rowspan="2">Berat</th>
                                        <th rowspan="2">Total Biaya</th>
                                        <th colspan="2">Waktu</th>
                                    </tr>
                                    <tr>
                                        <th>Mulai</th>
                                        <th>Selesai</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    <tr>
                                        <td>1</td>
                                        <td><?= $layanan['nama_layanan']; ?></td>
                                        <td><?= $layanan['layanan']; ?></td>
                                        <td><?= 'Rp. ' . number_format($layanan['harga'], 0, ',', '.') . '/KG'; ?></td>
                                        <td><?= $transaksi['berat'] . ' KG'; ?></td>
                                        <td><?= 'Rp. ' . number_format($transaksi['total_biaya'], 0, ',', '.'); ?></td>
                                        <td><?= $transaksi['tanggal_mulai']; ?></td>
                                        <td><?= $transaksi['tanggal_selesai']; ?></td>
                                    </tr>

                                </tbody>
                            </table>
                            <span class="text-right">
                                <h3>Total Bayar : <?= 'Rp. ' . number_format($transaksi['total_biaya'], 0, ',', '.'); ?></h3>
                            </span>
                        </div>
                    </div>
                </div>
            </div>




        </div>
        <!-- /.container-fluid -->
    </div>
</body>

</html>