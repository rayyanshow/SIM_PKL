<?php

foreach ($komentar as $k) : ?>
    <!-- Modal -->
    <form action="<?= base_url('guru/addKomen') ?>" method="POST">
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Masukan Pesan</h5>
                    </div>
                    <div class="modal-body">
                        <?php
                        $guru   = $this->session->userdata('guru');
                        $ambil  = $this->db->query("SELECT * FROM tb_guru WHERE user = '$guru' ");
                        $pecah  = $ambil->row();
                        ?>
                        <input type="hidden" value="<?= $k->id_siswa; ?>" name="id">
                        <input type="hidden" value="<?= $pecah->id_guru ?>" name="guru">
                        <input type="hidden" value="<?= $k->nama_perusahaan; ?>" name="perusahaan">
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Masukan Pesan Kejadian disini" name="kejadian"></textarea><br>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Masukan keterangan disini" name="keterangan"></textarea><br>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Masukan tindakan rekomendasi disini" name="rekomendasi"></textarea>

                    </div>
                    <div class="modal-footer">
                        <a href="<?= base_url('guru/kejadian') ?>" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-primary">Kirim</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
<?php endforeach; ?>

<script>
    $(document).ready(function() {
        $('#exampleModal').modal('show');
    });
</script>