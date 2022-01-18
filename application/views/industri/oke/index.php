<!-- Modal -->
<div class="modal fade bd-example-modal-sm" id="modal-kepo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-body">

                <?php echo form_open_multipart('industri/validasiPKL')  ?>
                <div class="row">
                    <div class="col-md-12">
                        
                        <?php foreach ($dataSiswa as $o) : ?>
                            <input type="hidden" name="id_rekomendasi" value="<?= $o->id_rekomendasi;  ?>">
                            <input type="hidden" name="id_guru" value="<?= $o->id_guru; ?>">
                            <input type="hidden" name="id_siswa" value="<?= $o->id_siswa;  ?>">
                            <input type="hidden" name="id_periode" value="<?= $o->id_periode; ?>">
                            <h4>Yakin data sudah benar?</h4>
                        <?php endforeach; ?>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <a href="<?php echo base_url('industri/notif') ?>" class="btn btn-secondary">Kembali</a>
                <button type="submit" class=" btn btn-primary">Yoi</button>
            </div>
        </div>
        </form>


    </div>
</div>

<script>
    $(document).ready(function() {
        $('#modal-kepo').modal('show');
    });
</script>