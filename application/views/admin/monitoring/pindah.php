<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pindah Perusahaan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php foreach ($pindah as $p) : ?>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-5">Nama</div>
                        <div class="col-1">:</div>
                        <div class="col-6"><?= $p->nama_siswa; ?></div>
                    </div>
                    <div class="row">
                        <div class="col-5">Jurusan</div>
                        <div class="col-1">:</div>
                        <div class="col-6"><?= $p->jurusan; ?></div>
                    </div>
                    <div class="row">
                        <div class="col-5">Kelas</div>
                        <div class="col-1">:</div>
                        <div class="col-6"><?= $p->kelas; ?></div>
                    </div>
                    <div class="row">
                        <div class="col-5">Perusahaan Saat ini</div>
                        <div class="col-1">:</div>
                        <div class="col-6"><?= $p->nama_perusahaan; ?></div>
                    </div>
                    <div class="row">
                        <div class="col-5">Tempat Rekomendasi</div>
                        <div class="col-1">:</div>
                        <div class="col-6">
                            <select name="rekomendasi">
                                <?php
                                $cek    = $this->db->query('SELECT * FROM tb_tempat_rekomendasi')->result();
                                foreach ($cek as $b) :
                                    ?>
                                    <option value=""><?= $b->nama_perusahaan ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                <button type="button" class="btn btn-primary">Kirim</button>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        $('#exampleModal').modal('show');
    });
</script>