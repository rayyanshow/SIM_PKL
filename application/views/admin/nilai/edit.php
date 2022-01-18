<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <form action="<?= base_url('admin/ubahNilai') ?>" method="post">
                <div class="modal-header">
                    <h2 class="modal-title" id="exampleModalLabel">Ubah Nilai Siswa</h2>

                </div>

                <div class="modal-body">
                    <?php foreach ($join as $e) : ?>
                        <!-- Hidden data -->
                        <input type="hidden" value="<?= $e->id_siswa ?>" name="id">
                        <div class="row">
                            <div class="col-md-3">Nama</div>
                            <div class="col">: <?= $e->nama_siswa;  ?></div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">Nama Instansi</div>
                            <div class="col text-uppercase">: <?= $e->nama_perusahaan;  ?></div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">Alamat Instansi</div>
                            <div class="col">: <?= $e->alamat;  ?></div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">Kelas</div>
                            <div class="col">: <?= $e->kelas;  ?></div>
                        </div>
                    <?php endforeach; ?>
                    <br>
                    <?php foreach ($siswa as $s) : ?>
                        <div class="container mt-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="kerajinan">Nilai Kerajinan :</label>
                                        <input type="text" class="form-control form-control-alternative" id="kerajinan" value="<?= $s->kerajinan ?> " name="kera">
                                        <small class="form-text text-danger"><?= form_error('kera'); ?></small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="prestasi">Nilai Prestasi :</label>
                                        <input type="text" class="form-control form-control-alternative" id="prestasi" value="<?= $s->prestasi ?> " name="prestasi">
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="kerajinan">Nilai Disiplin :</label>
                                        <input type="text" class="form-control form-control-alternative" id="exampleFormControlInput1" value="<?= $s->disiplin ?> " name="disiplin">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="kerajinan">Nilai Kerjasama :</label>
                                        <input type="text" class="form-control form-control-alternative" id="exampleFormControlInput1" value="<?= $s->kerjasama ?> " name="kerjasama">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="kerajinan">Nilai Inisiatif :</label>
                                        <input type="text" class="form-control form-control-alternative" id="exampleFormControlInput1" value="<?= $s->inisiatif ?> " name="inisiatif">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="kerajinan">Nilai Tanggung Jawab :</label>
                                        <input type="text" class="form-control form-control-alternative" id="exampleFormControlInput1" value="<?= $s->tanggung_jawab ?> " name="tanggung">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="kerajinan">Nilai Ujian Prakerin :</label>
                                        <input type="text" class="form-control form-control-alternative" id="exampleFormControlInput1" value="<?= $s->ujian_prakerin ?> " name="ujian">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p>* Keterangan Nilai Teknis *</p>
                        <p>96 - 100 = A</p>
                        <p>91 - 95 = A-</p>
                        <p>86 - 90 = B+</p>
                        <p>81 - 85 = B</p>
                        <p>75 - 80 = B-</p>
                </div>

            <?php endforeach; ?>


            <div class="modal-footer">
                <a href="<?= base_url('admin/nilaiSiswa') ?>" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        $("#exampleModal").modal("show");
    });
</script>