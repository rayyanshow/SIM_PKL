<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <?php
            if (count($dataNilai) == 0) {
            ?>
                <form action="<?= base_url('industri/doInputNilai') ?>" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Input Nilai Siswa</h5>

                    </div>
                    <div class="modal-body">
                        <?php foreach ($nilai as $d) : ?>
                            <!-- Hidden data -->
                            <input type="hidden" value="<?= $d->id_siswa ?>" name="id_siswa">
                            <div class="row">
                                <div class="col-md-3">Nama</div>
                                <div class="col">: <?= $d->nama_siswa;  ?></div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">Nama Instansi</div>
                                <div class="col text-uppercase">: <?= $d->nama_perusahaan;  ?></div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">Alamat Instansi</div>
                                <div class="col">: <?= $d->alamat;  ?></div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">Kelas</div>
                                <div class="col">: <?= $d->kelas;  ?></div>
                            </div><br>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        Kerajinan :
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <input type="number" class="form-control" min=0 name="kerajinan">
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        Prestasi :
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="number" class="form-control" min=0 name="prestasi">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    Disiplin :
                                </div>
                                <div class="col-md-4">
                                    <input type="number" class="form-control" min=0 name="disiplin">
                                </div>
                                <div class="col-md-2">
                                    Kerjasama :
                                </div>
                                <div class="col-md-4">
                                    <input type="number" class="form-control" min=0 name="kerjasama">
                                </div>
                                <div class="col-md-2">
                                    Inisiatif :
                                </div>
                                <div class="col-md-4">
                                    <input type="number" min=0 class="form-control" name="inisiatif">
                                </div>
                                <div class="col-md-2">
                                    Tanggung Jawab :
                                </div>
                                <div class="col-md-4">
                                    <input type="number" class="form-control" min=0 name="tanggung_jawab">
                                </div>
                            </div>

                    </div>

                <?php endforeach; ?>


                <div class="modal-footer">
                    <a href="<?= base_url('industri/nilaiSiswa') ?>" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
                </form>

            <?php } else { ?>
                <form action="<?= base_url('industri/doEditNilai') ?>" method="post">
                    <?php foreach ($dataNilai as $n) { ?>
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Input Nilai Siswa</h5>

                        </div>
                        <div class="modal-body">
                            <?php foreach ($nilai as $d) : ?>
                                <!-- Hidden data -->
                                <input type="hidden" value="<?= $n->id_nilai ?>" name="id_nilai">
                                <div class="row">
                                    <div class="col">Nama</div>
                                    <div class="col">:</div>
                                    <div class="col"><?= $d->nama_siswa;  ?></div>
                                </div>
                                <div class="row">
                                    <div class="col">Nama Instansi</div>
                                    <div class="col">:</div>
                                    <div class="col text-uppercase"><?= $d->nama_perusahaan;  ?></div>
                                </div>
                                <div class="row">
                                    <div class="col">Alamat Instansi</div>
                                    <div class="col">:</div>
                                    <div class="col"><?= $d->alamat;  ?></div>
                                </div>
                                <div class="row">
                                    <div class="col">Kelas</div>
                                    <div class="col">:</div>
                                    <div class="col"><?= $d->kelas;  ?></div>
                                </div><br>
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            Kerajinan
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        :
                                    </div>
                                    <div class="col-md-3">
                                        <input type="number" value="<?php echo $n->kerajinan ?>" class="form-control" min=0 name="kerajinan">
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            Prestasi
                                        </div>
                                    </div>
                                    <div class="col-md-1">:</div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input type="number" class="form-control" value="<?php echo $n->prestasi ?>" min=0 name="prestasi">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        Disiplin
                                    </div>
                                    <div class="col-md-1">:</div>
                                    <div class="col-md-3">
                                        <input type="number" class="form-control" min=0 value="<?php echo $n->disiplin ?>" name="disiplin">
                                    </div>
                                    <div class="col-md-2">
                                        Kerjasama
                                    </div>
                                    <div class="col-md-1">:</div>
                                    <div class="col-md-3">
                                        <input type="number" class="form-control" min=0 value="<?php echo $n->kerjasama ?>" name="kerjasama">
                                    </div>
                                    <div class="col-md-2">
                                        Inisiatif
                                    </div>
                                    <div class="col-md-1">:</div>
                                    <div class="col-md-3">
                                        <input type="number" min=0 class="form-control" value="<?php echo $n->inisiatif ?>" name="inisiatif">
                                    </div>
                                    <div class="col-md-2">
                                        Tanggung Jawab
                                    </div>
                                    <div class="col-md-1">:</div>
                                    <div class="col-md-3">
                                        <input type="number" class="form-control" min=0 value="<?php echo $n->tanggung_jawab ?>" name="tanggung_jawab">
                                    </div>


                                </div>

                            <?php endforeach; ?>

                            <div class="modal-footer">
                                <a href="<?= base_url('industri/nilaiSiswa') ?>" class="btn btn-secondary">Kembali</a>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                        
                </form>
        <?php }
                } ?>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        $("#exampleModal").modal("show");
    });
</script>