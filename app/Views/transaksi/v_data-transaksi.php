<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
    </div>

    <!-- DataTales Example -->
    <div class="row">
        <div class="col-lg">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-success">Data Menu</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>No Invoice</th>
                                    <th>Pelanggan</th>
                                    <th>Layanan</th>
                                    <th>Total Biayay</th>
                                    <th>Pembayaran</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $db           = \Config\Database::connect();
                                $i = 1;
                                foreach ($transaksi as $t) :
                                ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= $t['tanggal_mulai']; ?></td>
                                        <td><?= $t['invoice']; ?></td>
                                        <td>
                                            <?php
                                            $member = $db->table('tb_member')->select('nama')->getWhere(['id' => $t['id_member']])->getRowArray();
                                            echo $member['nama'];
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            $id = $t['id_layanan'];
                                            $query = "SELECT `tb_layanan`.*, `tb_d_layanan` .*
                                            FROM `tb_layanan` JOIN `tb_d_layanan`
                                            ON `tb_layanan`.`id` = `tb_d_layanan`.`id_layanan` WHERE `tb_d_layanan`.`id` = $id";
                                            $layanan = $db->query($query)->getRowArray();
                                            ?>
                                            <?= $layanan['nama_layanan'];  ?>
                                            <?= '(' . $layanan['layanan'] . ')'; ?>
                                        </td>
                                        <td>
                                            <?= 'Rp. ' . number_format($t['total_biaya'], 2, ',', '.'); ?>
                                        </td>
                                        <td>
                                            <span class="badge badge-<?= $t['pembayaran'] == 'Belum Dibayar' ? 'danger'  : ('Di Bayar' ? 'success' : '') ?>"><?= $t['pembayaran']; ?></span>
                                        </td>
                                        <td>
                                            <?php
                                            $status = $t['status'];
                                            $color = '';
                                            if ($status == 'Baru') {
                                                $color = 'danger';
                                            } elseif ($status == 'Proses') {
                                                $color = 'warning';
                                            } elseif ($status == 'Selesai') {
                                                $color = 'success';
                                            } elseif ($status == 'Diambil') {
                                                $color = 'info';
                                            }
                                            ?>

                                            <span class="badge badge-<?= $color; ?>"><?= $status; ?></span>
                                        </td>
                                        <td>
                                            <a href="<?= base_url('/detail-transaksi') . '?invoice=' . $t['invoice']; ?>" class="btn btn-success btn-circle btn-sm"><i class="fas fa-mouse-pointer fa-sm"></i></a>
                                            <a href="" class="btn btn-danger btn-circle btn-sm"><i class="fas fa-trash-alt fa-sm"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>




</div>
<!-- /.container-fluid -->

<?= $this->endSection(); ?>