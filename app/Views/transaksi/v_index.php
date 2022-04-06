<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
    </div>

    <div class="card shadow mb-5">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-success">Transaksi Baru</h6>
            <h6 class="m-0 font-weight-bold text-success">No Invoice <?= $noInvoice; ?></h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-5">
                    <div class="card mb-5">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-success">Data Member(s)</h6>
                        </div>
                        <div class="card-body">
                            <form action="<?= base_url('/add-transaksi'); ?>" method="POST">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="invoice" id="invoice" value="<?= $noInvoice; ?>">
                                <div class="form-group">
                                    <label for="member">Member/Pelanggan</label>
                                    <select type="text" class="form-control <?= $validation->hasError('id_member') ? 'is-invalid' : ''; ?>" id="member" name="id_member" aria-describedby="member">
                                        <option value="">Pilih</option>
                                        <?php foreach ($member as $m) : ?>
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
                                            <?php foreach ($layanan as $l) : ?>
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
                                    <input class="form-check-input <?= $validation->hasError('status_bayar') ? 'is-invalid' : ''; ?>" type="radio" name="status_bayar" id="status_bayar" value="Belum Dibayar">
                                    <label class="form-check-label" for="status_bayar">
                                        Belum Dibayar
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input <?= $validation->hasError('status_bayar') ? 'is-invalid' : ''; ?>" type="radio" name="status_bayar" id="status_bayar" value="Telah Dibayar">
                                    <label class="form-check-label" for="status_bayar">
                                        Telah Dibayar
                                    </label>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('status_bayar'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <h3>Rp.
                                    <span id="total_biaya">0</span>
                                </h3>
                                <input type="hidden" name="total_biaya" id="tot">
                            </div>
                            <div class="form-group">
                                <button type="submit" id="tombol_transaksi" class="btn btn-success">Buat Transaksi</button>
                            </div>
                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>

        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->




</div>
<!-- /.container-fluid -->

<?= $this->endSection(); ?>