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
                    <h6 class="m-0 font-weight-bold text-success">Detail Transaksi</h6>
                </div>
                <div class="card-body" id="data-transaksi">
                    <?php

                    use CodeIgniter\HTTP\Request;

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
                        <div class="col-lg-4">
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

                    <a href="" data-toggle="modal" data-target="#editDataTransaksi" class="btn btn-warning" id="edit-data-transaksi" data-id="<?= $transaksi['id']; ?>"><i class="fa fa-address-book"></i> Edit Data</a>
                    <!-- Tombol cetak invoice -->
                    <a href="<?= base_url('/cetak-pdf') . '?invoice=' . $transaksi['invoice']; ?>" target="_blank" class="btn btn-primary btn-icon-split cetak-invoice"><span class="text"><i class="fas fa-print"></i> Cetak Invoice</span></a>
                    <a href="<?= base_url('/cetak-thermal') . '?invoice=' . $transaksi['invoice']; ?>" target="_blank" class="btn btn-success btn-icon-split"><span class="text"><i class="fas fa-print"></i> Printer Thermal</span></a>
                    <a href="<?= base_url('/unduh-pdf') . '?invoice=' . $transaksi['invoice'];  ?>" target="_blank" class="btn btn-danger btn-icon-pdf"><span class="text"><i class="fas fa-file-pdf"></i> Export PDF</span></a>
                </div>
            </div>
        </div>
    </div>

    <!-- Submenu Modal-->
    <div class="modal fade" id="editDataTransaksi" tabindex="-1" role="dialog" aria-labelledby="editDataTransaksiModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <form action="<?= base_url('/edit-transaksi'); ?>" method="POST">
                    <?= csrf_field(); ?>
                    <div class="modal-header">
                        <h5 class="modal-title" id="editDataTransaksiModalLabel">Edit Data Transaksi</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">x</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-lg-5">
                                <div class="card mb-5">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-success">Data Member(s)</h6>
                                    </div>
                                    <div class="card-body">
                                        <input type="hidden" name="invoice" id="invoice">
                                        <div class="form-group">
                                            <label for="member">Member/Pelanggan</label>
                                            <select type="text" class="form-control <?= $validation->hasError('id_member') ? 'is-invalid' : ''; ?>" id="member" name="id_member" aria-describedby="member">
                                                <option value="">Pilih</option>
                                                <?php foreach ($pelanggan as $m) : ?>
                                                    <option value="<?= $m['id']; ?>"><?= $m['nama']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('id_member'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="nama">Nama</label>
                                            <input type="text" class="form-control <?= $validation->hasError('nama') ? 'is-invalid' : ''; ?>" id="nama" name="nama" aria-describedby="nama" placeholder="Nama">
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('nama'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="alamat">Alamat</label>
                                            <textarea type="text" class="form-control <?= $validation->hasError('alamat') ? 'is-invalid' : ''; ?>" id="alamat" name="alamat" aria-describedby="alamat" placeholder="Alamat"></textarea>
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('alamat'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="tlp">Telephone</label>
                                            <input type="text" class="form-control <?= $validation->hasError('tlp') ? 'is-invalid' : ''; ?>" id="tlp" name="tlp" aria-describedby="tlp" placeholder="Telephone">
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('tlp'); ?>
                                            </div>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input <?= $validation->hasError('tlp') ? 'is-invalid' : ''; ?>" type="radio" name="jenis_kelamin" id="jenis_kelamin" value="L">
                                            <label class="form-check-label" for="jenis_kelamin">
                                                Man
                                            </label>
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('tlp'); ?>
                                            </div>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input <?= $validation->hasError('tlp') ? 'is-invalid' : ''; ?>" type="radio" name="jenis_kelamin" id="jenis_kelamin" value="P">
                                            <label class="form-check-label" for="jenis_kelamin">
                                                Wonam
                                            </label>
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('tlp'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>
                            <div class="col-lg-7">
                                <div class="card mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-success">Pilih Layanan</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <select type="text" class="form-control <?= $validation->hasError('layanan') ? 'is-invalid' : ''; ?>" id="transaksi_layanan" name="layanan" aria-describedby="layanan">
                                                        <?php foreach ($jenis as $l) : ?>
                                                            <option value="<?= $l['id']; ?>"><?= $l['nama_layanan']; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                    <div class="invalid-feedback">
                                                        <?= $validation->getError('layanan'); ?>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <select type="text" class="form-control <?= $validation->hasError('id_layanan') ? 'is-invalid' : ''; ?>" id="jenis_layanan" name="id_layanan" aria-describedby="jenis_layanan">
                                                    </select>
                                                    <div class="invalid-feedback">
                                                        <?= $validation->getError('id_layanan'); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Image</th>
                                                    <th>Layanan</th>
                                                    <th>Jenis</th>
                                                    <th>Estimasi Waktu</th>
                                                    <th>Tarif</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td id="image-table-td" class="text-center">

                                                    </td>
                                                    <td id="tabel-nama-layanan">

                                                    </td>
                                                    <td id="tabel-jenis-layanan">

                                                    </td>
                                                    <td id="tabel-waktu-layanan">

                                                    </td>
                                                    <td id="tabel-tarif-layanan">

                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div class="form-group">
                                            <label for="berat">Berat/(KG)</label>
                                            <input type="number" class="form-control <?= $validation->hasError('berat') ? 'is-invalid' : ''; ?>" id="berat" name="berat" aria-describedby="berat">
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('berat'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="tgl_masuk">Tanggal Masuk</label>
                                            <input type="date" class="form-control <?= $validation->hasError('tanggal_mulai') ? 'is-invalid' : ''; ?>" id="tgl_masuk" name="tanggal_mulai" aria-describedby="tgl_masuk">
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('tanggal_mulai'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="tgl_selesai">Tanggal Selesai</label>
                                            <input type="date" class="form-control <?= $validation->hasError('tanggal_selesai') ? 'is-invalid' : ''; ?>" id="tgl_selesai" name="tanggal_selesai" aria-describedby="tgl_selesai" readonly>
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('tanggal_selesai'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="keterangan">Keterangan</label>
                                            <textarea type="text" class="form-control <?= $validation->hasError('keterangan') ? 'is-invalid' : ''; ?>" id="keterangan" name="keterangan" aria-describedby="keterangan" placeholder="Keterangan"></textarea>
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('keterangan'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="keterangan">Setatus Pembayaran</label>
                                            <div class="form-check">
                                                <input class="form-check-input <?= $validation->hasError('status_bayar') ? 'is-invalid' : ''; ?>" type="radio" name="status_bayar" id="status_bayar" status="belum_dibayar" value="Belum Dibayar">
                                                <label class="form-check-label" for="status_bayar">
                                                    Belum Dibayar
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input <?= $validation->hasError('status_bayar') ? 'is-invalid' : ''; ?>" type="radio" name="status_bayar" id="status_bayar" status="telah_dibayar" value="Telah Dibayar">
                                                <label class="form-check-label" for="status_bayar">
                                                    Telah Dibayar
                                                </label>
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('status_bayar'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="keterangan">Setatus</label>
                                            <div class="form-check">
                                                <input class="form-check-input <?= $validation->hasError('status') ? 'is-invalid' : ''; ?>" type="radio" name="status" id="status" value="Baru">
                                                <label class="form-check-label" for="status">
                                                    Baru
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input <?= $validation->hasError('status') ? 'is-invalid' : ''; ?>" type="radio" name="status" id="status" value="Proses">
                                                <label class="form-check-label" for="status">
                                                    Proses
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input <?= $validation->hasError('status') ? 'is-invalid' : ''; ?>" type="radio" name="status" id="status" value="Selesai">
                                                <label class="form-check-label" for="status">
                                                    Selesai
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input <?= $validation->hasError('status') ? 'is-invalid' : ''; ?>" type="radio" name="status" id="status" value="Diambil">
                                                <label class="form-check-label" for="status">
                                                    Diambil
                                                </label>
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('status'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <h3>Rp.
                                                <span id="total_biaya">0</span>
                                            </h3>
                                            <input type="hidden" name="total_biaya" id="tot">
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="reset" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-success" type="submit">Edit Transaksi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


</div>
<!-- /.container-fluid -->

<?= $this->endSection(); ?>